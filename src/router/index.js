import { createRouter, createWebHistory } from 'vue-router';
import News from '../components/News.vue';
import Home from '../components/Home.vue'; 

const routes = [
    { path: '/home', component: Home },
    { path: '/news', component: News }
  ];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
