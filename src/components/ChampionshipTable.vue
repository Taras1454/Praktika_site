<template>
  <div class="championship">
    <h2>Таблиця чемпіонату</h2>
    <table>
      <thead>
        <tr>
          <th>Місце</th>
          <th>Клуб</th>
          <th>І</th>
          <th>В</th>
          <th>Н</th>
          <th>П</th>
          <th>Голи</th>
          <th>Очки</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(club, index) in championshipData" :key="club.club_name">
          <td>{{ index + 1 }}</td>
          <td class="club-info">
            <img :src="club.club_logo" alt="Club Logo" class="club-logo">
            {{ club.club_name }}
          </td>
          <td>{{ club.played }}</td>
          <td>{{ club.wins }}</td>
          <td>{{ club.draws }}</td>
          <td>{{ club.loses }}</td>
          <td>{{ club.goals }}</td>
          <td>{{ club.points }}</td>
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
      championshipData: [],
      loading: true
    };
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
  font-family: Arial, sans-serif;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: #fff;
}

th, td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

.club-info {
  display: flex;
  align-items: center;
  justify-content: flex-start;
}

.club-logo {
  width: 30px; 
  height: auto;
  margin-right: 10px;
  vertical-align: middle;
}
</style>