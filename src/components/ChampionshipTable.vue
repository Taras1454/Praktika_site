<template>
  <div class="championship">
    <h2 style="text-align: center;">Таблиця чемпіонату</h2>
    <table class="center-table">
      <thead>
        <tr>
          <th>Місце</th>
          <th>Клуб</th>
          <th class="points-header">Очки</th>
          <th>Перемоги</th>
          <th>Поразки</th>
          <th>Нічиї</th>
          <th>Голи</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(club, index) in sortedChampionshipData" :key="club.id_club"
            :class="{
              'champions-league': index < 5,
              'europa-league': index >= 5 && index < 7,
              'conference-league': index === 7,
              'relegation': index >= sortedChampionshipData.length - 3
            }">
          <td>{{ index + 1 }}</td>
          <td class="club-cell">
            <div class="club-info">
              <img :src="club.club_logo" alt="Club Logo" class="club-logo">
              <span class="club-name">{{ club.club_name }}</span>
            </div>
          </td>
          <td class="points">{{ club.points }}</td>
          <td>{{ club.wins }}</td>
          <td>{{ club.loses }}</td>
          <td>{{ club.draws }}</td>
          <td>{{ club.goals }}</td>
        </tr>
      </tbody>
    </table>
    <div class="legend">
      <div class="legend-item champions-league"></div>
      <div class="legend-text">Команди, що вийшли до Ліги Чемпіонів (перші 5 місць)</div>
      <div class="legend-item europa-league"></div>
      <div class="legend-text">Команди, що вийшли до Ліги Європи (6-7 місця)</div>
      <div class="legend-item conference-league"></div>
      <div class="legend-text">Команда, що вийшла до Ліги Конференцій (8 місце)</div>
      <div class="legend-item relegation"></div>
      <div class="legend-text">Команди, що вилетіли з ліги (останні 3 місця)</div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      championshipData: [],
      loading: true
    };
  },
  computed: {
    sortedChampionshipData() {
      // Сортуємо дані за кількістю очок (points) у спадаючому порядку
      return this.championshipData.sort((a, b) => b.points - a.points);
    }
  },
  created() {
    this.fetchChampionship();
  },
  methods: {
    fetchChampionship() {
      axios.get('http://localhost/praktika/php/getChampionship.php')
        .then(response => {
          this.championshipData = response.data.slice(0, 20);
          this.loading = false;
        })
        .catch(error => {
          console.error("There was an error!", error);
          this.loading = false;
        });
    }
  }
};
</script>

<style scoped>
.championship {
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px;
  text-align: center; 
}

.center-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  max-width: 800px; 
  margin: 0 auto; 
}

th, td {
  padding: 8px; 
  text-align: center;
  border: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

.club-cell {
  text-align: left;
}

.club-info {
  display: flex;
  align-items: center;
}

.club-logo {
  width: 25px; 
  height: auto;
  margin-right: 10px;
}

.club-name {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.legend {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.legend-item {
  width: 20px;
  height: 20px;
  margin-right: 10px;
  border: 1px solid #ccc;
}

.legend-text {
  margin-bottom: 10px;
}

.points-header {
  font-weight: bold;
}

.points {
  font-weight: bold;
}

.champions-league {
  background-color: #e6f7ff; /* Синій фон для Ліги Чемпіонів */
}

.europa-league {
  background-color: #ffe6cc; /* Оранжевий фон для Ліги Європи */
}

.conference-league {
  background-color: #d9ead3; /* Зелений фон для Ліги Конференцій */
}

.relegation {
  background-color: #ffe6e6; /* Червоний фон для вилітних команд */
}
</style>
