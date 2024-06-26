<template>
    <div class="media">
      <h2>Найкращі голи кожного туру</h2>
      <div class="media-container">
        <button @click="prevVideo" class="arrow">←</button>
        <div class="video-wrapper">
          <iframe :src="currentVideoUrl" frameborder="0" allowfullscreen></iframe>
        </div>
        <button @click="nextVideo" class="arrow">→</button>
      </div>
      <div class="tour-title">
        <h3>Тур {{ currentTour }}</h3>
      </div>
      <div class="media-text">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Італійський футбол завжди вражав своєю неповторною атмосферою, емоціями та неймовірними голами. З кожним туром ми стаємо свідками неймовірних моментів, які залишаються в пам'яті на довгі роки. Відео, представлені тут, дозволяють вам зануритися в цей захоплюючий світ, переглянути найкращі моменти кожного туру та насолодитися красою гри.</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;Переглядайте відео, насолоджуйтесь кожним моментом та підтримуйте свої улюблені команди. Італійська футбольна ліга завжди готова дивувати та захоплювати своїх вболівальників!</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        videos: [],
        currentIndex: 0,
      };
    },
    computed: {
      currentVideoUrl() {
        return this.videos.length ? this.videos[this.currentIndex].href : '';
      },
      currentTour() {
        return this.videos.length ? this.videos[this.currentIndex].tour : '';
      }
    },
    created() {
      this.fetchVideos();
    },
    methods: {
      fetchVideos() {
        axios.get('http://localhost/praktika/php/getVideos.php')
          .then(response => {
            this.videos = response.data.sort((a, b) => a.tour - b.tour);
          })
          .catch(error => {
            console.error('There was an error!', error);
          });
      },
      prevVideo() {
        if (this.currentIndex > 0) {
          this.currentIndex--;
        } else {
          this.currentIndex = this.videos.length - 1;
        }
      },
      nextVideo() {
        if (this.currentIndex < this.videos.length - 1) {
          this.currentIndex++;
        } else {
          this.currentIndex = 0;
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .media {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .media-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  
  .video-wrapper {
    flex-grow: 1;
    padding: 0 20px;
  }
  
  iframe {
    width: 100%;
    height: 400px;
  }
  
  .arrow {
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    padding: 10px 20px;
  }
  
  .arrow:hover {
    background-color: #45a049;
  }
  
  .tour-title {
    text-align: center;
    margin-bottom: 20px;
  }
  
  .media-text {
    font-size: 1.2em;
    text-align: justify;
  }
  h2{
    font-size: 2em;
    text-align: center;
  }
  h3{
    font-size: 1.8em;
    text-align: center;
  }
  </style>
  