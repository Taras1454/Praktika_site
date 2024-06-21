<template>
    <div class="championship">
      <h2>Таблиця чемпіонату</h2>
      <table>
        <thead>
          <tr>
            <th>Місце</th>
            <th>Клуб</th>
            <th>Очки</th>
            <th>Перемоги</th>
            <th>Поразки</th>
            <th>Нічиї</th>
            <th>Голи</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(club, index) in championshipData" :key="club.club_name">
            <td>{{ index + 1 }}</td>
            <td>
              <img :src="club.club_logo" alt="Club Logo" class="club-logo">
              {{ club.club_name }}
            </td>
            <td>{{ club.points }}</td>
            <td>{{ club.wins }}</td>
            <td>{{ club.loses }}</td>
            <td>{{ club.draws }}</td>
            <td>{{ club.passion }}</td>
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
  
  .club-logo {
    width: 20px; /* Adjust size as needed */
    height: auto;
    margin-right: 10px;
    vertical-align: middle; /* Center logo vertically */
  }
  </style>
  