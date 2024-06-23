<template>
  <div class="registration">
    <h2>Реєстрація</h2>
    <form @submit.prevent="register" class="registration-form">
      <div class="form-group">
        <label for="username">Ім'я користувача:</label>
        <input type="text" id="username" v-model="username" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" required>
      </div>
      <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" v-model="password" required>
      </div>
      <button type="submit">Зареєструватися</button>
    </form>
    <p v-if="message" class="message">{{ message }}</p>
    <div class="login-link">
      <router-link to="/login">Зареєстровані? Увійдіть в акаунт</router-link>
    </div>
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
      axios.post('http://localhost/praktika/php/register.php', {
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
.registration {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f0f0f0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.registration-form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 15px;
}

label {
  font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

button[type="submit"] {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}

.message {
  margin-top: 15px;
  text-align: center;
  font-style: italic;
  color: #ff0000;
}

.login-link {
  margin-top: 20px;
  text-align: center;
}

.login-link a {
  color: #007bff;
  text-decoration: none;
}

.login-link a:hover {
  text-decoration: underline;
}
</style>
