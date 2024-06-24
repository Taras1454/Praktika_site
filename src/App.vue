<script setup>
import { ref, watch } from 'vue';
import { useRouter } from 'vue-router';

import Links from './components/Links.vue';
import News from './components/News.vue';
import Register from './components/Register.vue';
import Clubs from './components/Clubs.vue';
import ChampionshipTable from './components/ChampionshipTable.vue';
import Matchs from './components/Matchs.vue';
import Goalscorers from './components/Goalscorers.vue';
import Login from './components/Login.vue';
import Profile from './components/Profile.vue';

const isLoggedIn = ref(!!localStorage.getItem('email'));
const router = useRouter();

const logout = () => {
  localStorage.removeItem('username');
  localStorage.removeItem('email');
  isLoggedIn.value = false;
  router.push('/login');
};

watch(
  () => router.currentRoute.value,
  () => {
    isLoggedIn.value = !!localStorage.getItem('email');
  }
);
</script>

<template>
  <body>
    <Links />
    <div id="app">
      <nav>
        <img id="main_icon" src="/src/assets/seria_a_icon.jfif" type="icon" />
        <router-link to="/home">Головна</router-link>
        <router-link to="/news">Новини</router-link>
        <router-link to="/matchs">Матчі</router-link>
        <router-link to="/table">Таблиця чемпіонату</router-link>
        <router-link to="/clubs">Команди</router-link>
        <router-link to="/goalscorers">Голи</router-link>
        <router-link to="#fans">Спільнота</router-link>
        <router-link to="/login" v-if="!isLoggedIn">Вхід</router-link>
        <router-link to="/profile" v-if="isLoggedIn">Кабінет</router-link>
        
      </nav>
      <router-view></router-view>
    </div>
    <footer>
      <p>&copy; 2024 Італійська Футбольна Ліга. Всі права захищено.</p>
    </footer>
  </body>
</template>

<style scoped>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
}

header {
  background-color: #2c3e50;
  color: #fff;
  padding: 10px 0;
  text-align: center;
}

nav {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #34495e;
}

nav a {
  color: #fff;
  padding: 15px 20px;
  text-decoration: none;
  text-transform: uppercase;
}

nav a:hover {
  background-color: #2c3e50;
}

footer {
  background-color: #2c3e50;
  color: #fff;
  text-align: center;
  padding: 10px 0;
  width: 100%;
  bottom: 0;
  z-index: 0;
}

#main_icon {
  height: 60px;
  width: 50px;
  position: relative;
  left: -27px;
}

button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 3px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
