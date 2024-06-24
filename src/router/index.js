import { createRouter, createWebHistory } from 'vue-router';
import News from '../components/News.vue';
import Home from '../components/Home.vue'; 
import Register from '../components/Register.vue';
import Clubs from '../components/Clubs.vue';
import ChampionshipTable from '../components/ChampionshipTable.vue';
import Matchs from '../components/Matchs.vue';
import Goalscorers from '../components/Goalscorers.vue';
import Login from '../components/Login.vue';
import Profile from '../components/Profile.vue';

const routes = [
    { path: '/home', component: Home },
    { path: '/news', component: News },
    { path: '/register', component: Register },
    { path: '/clubs' , component: Clubs},
    { path: '/table' , component: ChampionshipTable},
    { path: '/matchs' , component: Matchs},
    { path: '/goalscorers' , component: Goalscorers},
    { path: '/login', component: Login },
    { path: '/profile', component: Profile },
  { path: '/', redirect: '/login' }
  ];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
