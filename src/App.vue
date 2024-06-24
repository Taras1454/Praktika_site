<script setup>
import Links from './components/Links.vue'
import News from  './components/News.vue'
import Register from './components/Register.vue'
import Clubs from './components/Clubs.vue'
import ChampionshipTable from './components/ChampionshipTable.vue'
import Matchs from './components/Matchs.vue'
import Goalscorers from './components/Goalscorers.vue'
</script>

<template>
  <body>
     
    <Links />
     
   
     <nav>
    <img id=main_icon src="/src/assets/seria_a_icon.jfif" type="icon">
      <router-link to="/home">Головна</router-link>
      <router-link to="/news">Новини</router-link>
      <router-link to="/matchs">Матчі</router-link>
      <router-link to="/table">Таблиця чемпіонату</router-link>
      <router-link to="/clubs">Команди</router-link>
      <router-link to="/goalscorers">Голи</router-link>
      <router-link to="#fans">Спільнота</router-link>
      <router-link to="/register">Реєстрація</router-link>
    </nav>

    <router-view></router-view>

    
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
        #main_icon{
          height:60px;
          width:50px;
          position:relative;
          left:-27px;
         
        } 
</style>
