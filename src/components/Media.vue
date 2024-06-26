<template>
    <div class="media">
      <h2>Медіа футбольної італійської ліги</h2>
      <div class="media-container">
        <button @click="prevVideo" class="arrow">←</button>
        <div class="video-wrapper">
          <iframe :src="currentVideoUrl" frameborder="0" allowfullscreen></iframe>
        </div>
        <button @click="nextVideo" class="arrow">→</button>
      </div>
      <div class="media-text">
        <p>Великий гарний текст на тему медіа футбольної італійської ліги. Тут можна додати будь-яку інформацію про відео, цікаві факти та інші дані, які будуть цікаві користувачам.</p>
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
    }
  },
  created() {
    this.fetchVideos();
  },
  methods: {
    fetchVideos() {
      axios.get('http://localhost/praktika/php/getVideos.php')
        .then(response => {
          this.videos = response.data;
        })
        .catch(error => {
          console.error('There was an error!', error);
        });
    },
    prevVideo() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      }
    },
    nextVideo() {
      if (this.currentIndex < this.videos.length - 1) {
        this.currentIndex++;
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

.media-text {
  font-size: 1.2em;
  text-align: justify;
}
</style>
  