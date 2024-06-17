import { createRouter, createWebHistory } from 'vue-router';
import News from '../components/News.vue';
import Home from '../components/Home.vue'; 
import Register from '../components/Register.vue';

const routes = [
    { path: '/home', component: Home },
    { path: '/news', component: News },
    { path: '/register', component: Register }
  ];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
