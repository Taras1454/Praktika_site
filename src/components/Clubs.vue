<template>
  <div class="clubs">
    <h2>Клуби</h2>
    <div class="club-row" v-for="(row, index) in clubRows" :key="index">
      <div class="club-item" v-for="(club, clubIndex) in row" :key="clubIndex">
        <div class="club-content">
        <img :src="club.logo" alt="Club Logo" class="club-logo">
        <p>{{ club.name_team }}</p>
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
      clubs: [],
      loading: true,
      clubsPerRow: 2 
    };
  },
  computed: {
    clubRows() {
      let rows = [];
      for (let i = 0; i < this.clubs.length; i += this.clubsPerRow) {
        rows.push(this.clubs.slice(i, i + this.clubsPerRow));
      }
      return rows;
    }
  },
  created() {
    this.fetchClubs();
  },
  methods: {
    fetchClubs() {
      axios.get('http://localhost/praktika/php/getClubs.php')
        .then(response => {
          this.clubs = response.data;
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
.clubs {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.club-row {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.club-item {
  width: calc(50% - 10px); /* Половина ширини з відступом між елементами */
  margin-bottom: 20px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-sizing: border-box;
}

.club-content {
  display: flex;
  flex-direction: column;
  align-items: center; 
  text-align: center; 

}
p{
  font-weight: bold;
  font-size: large;

}
.club-logo {
  width: 100px;
  height: auto;
  margin-bottom: 10px;
  padding-bottom: 10px;
}

.club-item p {
  margin: 0;
  text-align: center;
}
h2{
text-align: center;

}

</style>
