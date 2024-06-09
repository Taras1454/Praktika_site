<template>
    <div class="news">
      <h2>Новини</h2>
      <div v-if="loading">Завантаження...</div>
      <div v-else>
        <div v-for="newsItem in news" :key="newsItem.title" class="news-item">
          <img :src="newsItem.img" alt="News Image" class="news-img">
          <div class="news-info">
            <h5>{{ newsItem.date_news }}</h5>
            <h3>{{ newsItem.title }}</h3>
            <p v-html="newsItem.discription"></p>
            
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
    align-items: flex-start;
  }
  
  .news-img {
    width: 175px;
    height: 150px;
    object-fit: cover;
    margin-right: 20px;
   
    
  }
  .news-info h5{
    font-size:13px;
    margin: 0 0 5px;
    color:rgb(3, 26, 96);
  }
  
  .news-info h3 {
    margin: 0 0 10px;
  }
  
  .news-info p {
    margin: 0;
    text-align:justify;
  }
  h2{
    text-align: center;
  }
  </style>
  