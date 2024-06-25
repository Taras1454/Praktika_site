<template>
  <div class="goalscorers">
    
    <div class="header">
      <h2>Таблиця бомбардирів</h2>
      <button @click="goToAssistants">
        <img id="arrow_r" src="/src/assets/right_arrow.png" type="icon">
        <span class="tooltip-text">Таблиця асистентів</span>
      </button>
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
      this.$router.push('/assistants'); // Використовуйте this.$router
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
  position: relative;
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
  color: white;
  border: none;
  padding: 10px;
  border-radius: 15px;
  cursor: pointer;
  background-color: transparent;
  position: relative;
}

button:hover {
  background-color: #b9c5d1;
}

#arrow_r {
  width: 50px;
}

.tooltip-text {
  display: none;
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  background-color: #555;
  color: #fff;
  padding: 5px 10px;
  border-radius: 6px;
  white-space: nowrap;
}

button:hover .tooltip-text {
  display: block;
}

h2 {
  margin: 0 auto; 
  
}

</style>
