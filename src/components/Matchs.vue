<template>
  <div class="matches">
    <div v-for="(matches, tour) in groupedMatches" :key="tour" class="tour">
      <h2>Тур {{ tour }}</h2>
      <div v-for="match in matches" :key="match.id" class="match">
        <div class="team">
          <img :src="match.home_team_logo" alt="Home Team Logo" class="team-logo">
          <span class="team-name">{{ match.home_team_name }}</span>
          
        </div>
        <div class="vs">
          <span class="goals">{{ match.home_team_goals }}</span>
          :
          <span class="goals">{{ match.away_team_goals }}</span>
        </div>
        <div class="team">
         
          <span class="team-name">{{ match.away_team_name }}</span>
          <img :src="match.away_team_logo" alt="Away Team Logo" class="team-logo">
        </div>
        <div class="date">{{ formatDate(match.date) }}</div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      matches: [],
    };
  },
  computed: {
    groupedMatches() {
      const grouped = this.matches.reduce((groups, match) => {
        const tour = match.tour || 'Невизначений тур'; // Додано значення за замовчуванням
        if (!groups[tour]) {
          groups[tour] = [];
        }
        groups[tour].push(match);
        return groups;
      }, {});

      // Сортування турів за спаданням (новіші зверху)
      const sortedGroups = {};
      Object.keys(grouped).sort((a, b) => b - a).forEach(key => {
        sortedGroups[key] = grouped[key];
      });

      // Сортування матчів у кожному турі за датою в порядку спадання
      Object.values(sortedGroups).forEach(matches => {
        matches.sort((a, b) => new Date(b.date) - new Date(a.date));
      });

      return sortedGroups;
    },
  },
  created() {
    this.fetchMatches();
  },
  methods: {
    fetchMatches() {
      axios.get('http://localhost/praktika/php/getMatchs.php')
        .then(response => {
          this.matches = response.data;
        })
        .catch(error => {
          console.error('There was an error!', error);
        });
    },
    formatDate(dateString) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString(undefined, options);
    }
  },
};
</script>

<style scoped>
.matches {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.tour {
  margin-bottom: 20px;
}

.match {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.team {
  display: flex;
  align-items: center;
}

.team-logo {
  width: 30px;
  height: auto;
  margin-right: 10px;
}

.team-name {
  min-width: 120px; /* Фіксована ширина для назв команд */
  text-align: left;
}

.goals {
  flex-basis: 30px;
  text-align: center;
  font-weight: bold; /* Робимо голи жирним шрифтом */
  flex-grow: 1;
  font-size: larger;
}

.vs {
  margin: 0 20px;
  font-weight: bold;
  flex-shrink: 0; 
  display: flex;
  align-items: center;
}

.date {
  font-size: 0.9em;
  color: #666;
}
</style>
