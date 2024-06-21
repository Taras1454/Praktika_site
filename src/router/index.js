import { createRouter, createWebHistory } from 'vue-router';
import News from '../components/News.vue';
import Home from '../components/Home.vue'; 
import Register from '../components/Register.vue';
import Clubs from '../components/Clubs.vue'
import ChampionshipTable from '../components/ChampionshipTable.vue';

const routes = [
    { path: '/home', component: Home },
    { path: '/news', component: News },
    { path: '/register', component: Register },
    { path: '/clubs' , component: Clubs},
    { path: '/table' , component: ChampionshipTable}
  ];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
