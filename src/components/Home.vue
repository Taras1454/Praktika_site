<template>
    <div class="home">
      
  
      <section class="section news">
        <h2>Новини</h2>
        <p>Останні новини італійської футбольної ліги. Дізнайтеся про останні події, інтерв'ю з гравцями, результати матчів та багато іншого.</p>
      </section>
  
      <section class="section matches">
        <h2>Матчі</h2>
        <p>Перегляньте розклад і результати всіх матчів італійської футбольної ліги. Відстежуйте результати улюблених команд та отримуйте найсвіжіші дані.</p>
        
      </section>
  
      <section class="section standings">
        <h2>Турнірна таблиця</h2>
        <p>Актуальна турнірна таблиця італійської футбольної ліги. Дізнайтеся, на якому місці знаходиться ваша улюблена команда.</p>
        
      </section>
  
      <section class="section teams">
        <h2>Команди</h2>
        <p>Інформація про всі команди італійської футбольної ліги. Дізнайтеся про склади, тренерів та історію команд.</p>
        
      </section>
  
      <section class="section statistics">
        <h2>Статистика</h2>
        <p>Детальна статистика гравців і команд. Перегляньте голи, передачі, сейви та багато іншого.</p>
        
      </section>
  
      <section class="section media">
        <h2>Медіа</h2>
        <p>Дивіться відео найкращих моментів, інтерв'ю з гравцями та інші медіаматеріали.</p>
        
      </section>
  
      
  
      
    </div>
  </template>
  
  <script>
  export default {
    name: 'Home',
  };
  </script>
  
  <style scoped>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  
  .home {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
  }
  
  header {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    text-align: center;
    margin-bottom: 20px;
  }
  
  .section {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
  }
  
  .section h2 {
    margin-top: 0;
  }
  
  .section p {
    font-size: 1.1em;
    line-height: 1.5;
  }
  
  .section-image {
    width: 100%;
    max-width: 600px;
    height: auto;
    display: block;
    margin: 20px auto;
    border-radius: 10px;
  }
  
  footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    margin-top: 20px;
  }
  h2{
    text-align: center;
  }
  </style>
  