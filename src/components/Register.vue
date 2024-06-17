<template>
    <div>
      <h2>Реєстрація</h2>
      <form @submit.prevent="register">
        <div>
          <label for="username">Ім'я користувача:</label>
          <input type="text" v-model="username" required>
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" v-model="email" required>
        </div>
        <div>
          <label for="password">Пароль:</label>
          <input type="password" v-model="password" required>
        </div>
        <button type="submit">Зареєструватися</button>
      </form>
      <p v-if="message">{{ message }}</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        username: '',
        email: '',
        password: '',
        message: ''
      };
    },
    methods: {
      register() {
        axios.post('http://localhost/praktika/register.php', {
          username: this.username,
          email: this.email,
          password: this.password
        })
        .then(response => {
          this.message = response.data.message;
        })
        .catch(error => {
          this.message = 'Помилка при реєстрації';
        });
      }
    }
  };
  </script>
  <style scoped>
  .register {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  </style>