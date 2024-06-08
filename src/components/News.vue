<template>
    <div class="news">
      <h2>Новини</h2>
      <div v-if="loading">Завантаження...</div>
      <div v-else>
        <div v-for="newsItem in news" :key="newsItem.title" class="news-item">
          <img :src="newsItem.img" alt="News Image" class="news-img">
          <div class="news-info">
            <p v-html="newsItem.description"></p>
            <h3>{{ newsItem.title }}</h3>
            <p>{{ newsItem.discription }}</p>
            
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
        news: [],
        loading: true
      };
    },
    created() {
      this.fetchNews();
    },
    methods: {
      fetchNews() {
        axios.get('http://localhost/praktika/php/getNews.php')
          .then(response => {
            this.news = response.data;
            this.loading = false;
          })
          .catch(error => {
            console.error("There was an error!", error);
            this.loading = false;
          });
      },
      getImgPath(img) {
      return img.replace(/\\/g, '/'); // Заміна зворотніх слешів на прямі
    }
    }
  }
  </script>
  
  <style scoped>
  .news {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
  }
  
  .news-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 20px;
  }
  
  .news-img {
    width: 175px;
    height: 150px;
    object-fit: cover;
    margin-right: 20px;
    
  }
  
  .news-info h3 {
    margin: 0 0 10px;
  }
  
  .news-info p {
    margin: 0;
    text-align:justify;
  }
  </style>
  