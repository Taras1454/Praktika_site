<template>
  <div class="goalscorers">
    <div class="header">
      <h2>Таблиця бомбардирів</h2>
      <button @click="goToAssistants">Таблиця асистентів</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>№</th>
          <th>Гравець</th>
          <th>Клуб</th>
          <th>Позиція</th>
          <th>Голи</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(scorer, index) in sortedScorers" :key="index">
          <td>{{ index + 1 }}</td>
          <td class="player-cell">
            <div class="player-info">
              <img :src="scorer.player_photo" alt="Player Photo" class="player-photo">
              <div class="player-details">
                <img :src="scorer.national_image" alt="National Flag" class="national-flag">
                <span>{{ scorer.name }}</span>
              </div>
            </div>
          </td>
          <td><img :src="scorer.club_logo" alt="Club Logo" class="club-logo"></td>
          <td>{{ scorer.position }}</td>
          <td><b>{{ scorer.goals }}</b></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
  data() {
    return {
      scorers: [],
      loading: true,
    };
  },
  computed: {
    sortedScorers() {
      // Сортуємо дані за кількістю голів у спадаючому порядку
      return this.scorers.sort((a, b) => b.goals - a.goals);
    },
  },
  created() {
    this.fetchScorers();
  },
  methods: {
    fetchScorers() {
      axios.get('http://localhost/praktika/php/getGoalscorers.php')
        .then(response => {
          this.scorers = response.data;
          this.loading = false;
        })
        .catch(error => {
          console.error('There was an error!', error);
          this.loading = false;
        });
    },
    goToAssistants() {
      const router = useRouter();
      router.push('/assistants'); // Змініть '/assistants' на шлях до вашого компонента таблиці асистентів
    }
  },
};
</script>

<style scoped>
.goalscorers {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

.player-cell {
  display: flex;
  align-items: center;
}

.player-info {
  display: flex;
  align-items: center;
}

.player-photo {
  width: 50px;
  height: auto;
  margin-right: 10px;
}

.national-flag {
  width: 30px;
  height: auto;
}

.player-details {
  display: flex;
  flex-direction: column;
  font-weight: bold;
}

.club-logo {
  width: 30px;
  height: auto;
}

button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
