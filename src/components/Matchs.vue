<template>
  <div class="matches">
    <div v-for="(matches, tour) in groupedMatches" :key="tour" class="tour">
      <h2>Тур {{ tour }}</h2>
      <div v-for="match in matches" :key="match.id" class="match">
        <div class="team">
          <img :src="match.home_team_logo" alt="Home Team Logo" class="team-logo">
          <span>{{ match.home_team_name }}</span>
          <span>{{ match.home_team_goals }}</span>
        </div>
        <div class="vs">:</div>
        <div class="team">
          <span>{{ match.away_team_goals }}</span>
          <span>{{ match.away_team_name }}</span>
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
      return this.matches.reduce((groups, match) => {
        const tour = match.tour || 'Невизначений тур'; // Додано значення за замовчуванням
        if (!groups[tour]) {
          groups[tour] = [];
        }
        groups[tour].push(match);
        return groups;
      }, {});
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

.vs {
  margin: 0 20px;
  font-weight: bold;
}

.date {
  font-size: 0.9em;
  color: #666;
}
</style>
