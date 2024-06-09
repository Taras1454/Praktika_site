<script setup>
import Links from './components/Links.vue'
import News from  './components/News.vue'
</script>

<template>
  <body>
     
     <Links />
     
    <nav>
        <a href="#news-item">Новини</a>
        <a href="#schedule">Розклад матчів</a>
        <a href="#standings">Таблиця чемпіонату</a>
        <a href="#teams">Команди</a>
        <a href="#media">Медіа</a>
        <a href="#fans">Спільнота</a>
    </nav>

    <News />

    
    <div class="container">
        
        <div id="schedule" class="section">
            <h2>Розклад матчів</h2>
            <p>Дізнайтеся, коли і де відбудуться наступні ігри, а також переглядайте результати попередніх матчів.</p>
        </div>
        <div id="standings" class="section">
            <h2>Таблиця чемпіонату</h2>
            <p>Слідкуйте за змінами в таблиці чемпіонату та дізнавайтеся, хто лідирує в гонці за титул.</p>
        </div>
        <div id="teams" class="section">
            <h2>Команди</h2>
            <p>Вивчайте детальні профілі улюблених команд, їхню статистику, досягнення та цікаві факти з кар'єри.</p>
        </div>
      
        <div id="media" class="section">
            <h2>Медіа</h2>
            <p>Насолоджуйтесь найяскравішими моментами матчів, переглядайте найкращі голи та красиві знімки з полів.</p>
        </div>
        <div id="fans" class="section">
            <h2>Спільнота</h2>
            <p>Приєднуйтесь до обговорень, беріть участь у конкурсах та взаємодійте з іншими фанатами футболу.</p>
        </div>
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
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px 0;
        }
        .section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
</style>
