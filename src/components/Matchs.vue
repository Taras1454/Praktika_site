<template>
  <div class="matches">
    <div v-for="(matches, tour) in visibleGroupedMatches" :key="tour" class="tour">
      <h2>Тур {{ tour }}</h2>
      <div v-for="match in matches" :key="match.id" class="match" @click="openMatchDetails(match)">
        <div class="team">
          <img :src="match.home_team_logo" alt="Home Team Logo" class="team-logo">
          <span class="team-name">{{ match.home_team_name }}</span>
        </div>
        <div class="vs">
          <span class="goals">{{ match.home_team_goals }} : {{ match.away_team_goals }}</span>
        </div>
        <div class="team">
          <span class="team-name">{{ match.away_team_name }}</span>
          <img :src="match.away_team_logo" alt="Away Team Logo" class="team-logo">
        </div>
        <div class="date">{{ formatDate(match.date) }}</div>
      </div>
    </div>
    <button v-if="visibleTourCount < Object.keys(groupedMatches).length" @click="showMoreTours">Показати ще</button>

    <!-- Модальне вікно -->
    <div v-if="selectedMatch" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeModal">&times;</span>
        <div class="teams-container">
          <div class="team-details">
            <img :src="selectedMatch.home_team_logo" alt="Home Team Logo" class="team-logo-window">
            <h3>{{ selectedMatch.home_team_name }}</h3>
          </div>
          <div class="stats">
            <div class="date">{{ formatDate(selectedMatch.date) }}</div> <!-- Дата вище рахунку -->
            <h2>{{ selectedMatch.home_team_goals }} : {{ selectedMatch.away_team_goals }}</h2>
            <p class="status">ЗАВЕРШЕНО</p> <!-- Напис ЗАВЕРШЕНО -->
          </div>
          <div class="team-details">
            <img :src="selectedMatch.away_team_logo" alt="Away Team Logo" class="team-logo-window">
            <h3>{{ selectedMatch.away_team_name }}</h3>
          </div>
        </div>
        <div class="additional-info">
          <div class="blok_stats">
            <p class="stats-label">Володіння м'ячем:</p>
            <div class="stats_content">
              <div class="bar home" :style="{ width: selectedMatch.home_team_passion + '%' }">{{ selectedMatch.home_team_passion }}%</div>
              <div class="bar away" :style="{ width: selectedMatch.away_team_passion + '%' }">{{ selectedMatch.away_team_passion }}%</div>
            </div>
          </div>
          <div class="blok_stats">
            <p class="stats-label">Удари:</p>
            <div class="stats_content">
              <div class="bar home" :style="{ width: calculateWidth(selectedMatch.home_team_shots, selectedMatch.away_team_shots) + '%' }">{{ selectedMatch.home_team_shots }}</div>
              <div class="bar away" :style="{ width: calculateWidth(selectedMatch.away_team_shots, selectedMatch.home_team_shots) + '%' }">{{ selectedMatch.away_team_shots }}</div>
            </div>
          </div>
          <div class="blok_stats">
            <p class="stats-label">Удари в ствір:</p>
            <div class="stats_content">
              <div class="bar home" :style="{ width: calculateWidth(selectedMatch.home_team_shots_target, selectedMatch.away_team_shots_target) + '%' }">{{ selectedMatch.home_team_shots_target }}</div>
              <div class="bar away" :style="{ width: calculateWidth(selectedMatch.away_team_shots_target, selectedMatch.home_team_shots_target) + '%' }">{{ selectedMatch.away_team_shots_target }}</div>
            </div>
          </div>
          <div class="blok_stats">
            <p class="stats-label">Штрафні удари:</p>
            <div class="stats_content">
              <div class="bar home" :style="{ width: calculateWidth(selectedMatch.home_team_free_kick, selectedMatch.away_team_free_kick) + '%' }">{{ selectedMatch.home_team_free_kick }}</div>
              <div class="bar away" :style="{ width: calculateWidth(selectedMatch.away_team_free_kick, selectedMatch.home_team_free_kick) + '%' }">{{ selectedMatch.away_team_free_kick }}</div>
            </div>
          </div>
          <div class="blok_stats">
            <p class="stats-label">Сейви воротаря:</p>
            <div class="stats_content">
              <div class="bar home" :style="{ width: calculateWidth(selectedMatch.home_team_saves, selectedMatch.away_team_saves) + '%' }">{{ selectedMatch.home_team_saves }}</div>
              <div class="bar away" :style="{ width: calculateWidth(selectedMatch.away_team_saves, selectedMatch.home_team_saves) + '%' }">{{ selectedMatch.away_team_saves }}</div>
            </div>
          </div>
        </div>
        <div class="stadium">
          <h3>Стадіон: {{ selectedMatch.stadium }}</h3>
        </div>
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
      selectedMatch: null,
      visibleTourCount: 3, // Спочатку показуємо 3 тура
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
    visibleGroupedMatches() {
      
      const visibleTours = Object.keys(this.groupedMatches).slice(0, this.visibleTourCount);
      const visibleGroups = {};
      visibleTours.forEach(tour => {
        visibleGroups[tour] = this.groupedMatches[tour];
      });
      return visibleGroups;
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
    },
    openMatchDetails(match) {
      this.selectedMatch = match;
    },
    closeModal() {
      this.selectedMatch = null;
    },
    calculateWidth(homeValue, awayValue) {
      const total = homeValue + awayValue;
      if (total === 0) return 50; 
      return (homeValue / total) * 100;
    },
    showMoreTours() {
      this.visibleTourCount += 3; 
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
  cursor: pointer;
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

.team-logo-window {
  width: 55px;
  height: auto;
  margin-right: 10px;
}

.team-name {
  min-width: 120px; 
  text-align: left;
}

.goals {
  flex-basis: 30px;
  text-align: center;
  font-weight: bold; 
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

button {
  display: block;
  margin: 20px auto;
  width: 100%;
  padding: 10px 20px;
  background-color: #007BFF;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

.modal {
  display: flex;
  align-items: center;
  justify-content: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  max-width: 600px;
  width: 100%;
  position: relative;
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 1.5em;
  cursor: pointer;
}

.teams-container {
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}

.team-details {
  display: flex;
  flex-direction: column;
  align-items: center; 
}

.team-logo-window {
  width: 55px;
  height: auto;
  margin-right: 10px;
}

.team-details h3 {
  font-size: 1.4em;
  margin: 0; 
}

.stats {
  text-align: center;
  flex-grow: 1;
}

.stats .date {
  margin-bottom: 10px; /* Відстань між датою і рахунком */
}

.status {
  font-size: 1.4em;
  font-weight: bolder;
  margin-top: 10px;
}

.additional-info {
  text-align: center;
  margin-top: 20px;
}

.blok_stats {
  margin-bottom: 10px;
}

.stats_content {
  display: flex;
  justify-content: space-between;
  font-weight: bold;
  position: relative;
  font-size: large;
  
}

.bar {
  height: 20px;
  border-radius: 5px;
  padding: 0 10px;
  display: flex;
  align-items: center;
  color: #fff;
}

.bar.home {
  background-color: #4caf50; 
}

.bar.away {
  background-color: #f44336; 
  justify-content: flex-end;
}

.stats-label {
  font-size: 1.0em;
  font-weight: bold;
  margin-bottom: 5px;
}

.stadium {
  text-align: center;
}

.stats h2 {
  font-size: 1.8em;
}

.team-details h3 {
  font-size: 1.4em;
}
</style>
