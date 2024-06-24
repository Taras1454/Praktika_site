<template>
    <div class="goalscorers">
      <h2>Таблиця бомбардирів</h2>
      <table>
        <thead>
          <tr>
            <th>№</th>
            <th>Гравець</th>
            <th>Голи</th>
            <th>Позиція</th>
            <th>Національність</th>
            <th>Клуб</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(scorer, index) in sortedScorers" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ scorer.name }}</td>
            <td>{{ scorer.goals }}</td>
            <td>{{ scorer.position }}</td>
            <td><img :src="scorer.national_image" alt="National Flag" class="national-flag"></td>
            <td><img :src="scorer.club_logo" alt="Club Logo" class="club-logo"></td>
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
  
  .national-flag, .club-logo {
    width: 30px;
    height: auto;
  }
  </style>
  