<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const username = ref(localStorage.getItem('username') || '');
const email = ref(localStorage.getItem('email') || '');
const router = useRouter();

const logout = () => {
  localStorage.removeItem('username');
  localStorage.removeItem('email');
  router.push('/login');
};
</script>

<template>
  <div class="profile">
    <h2>Профіль користувача</h2>
    <p><strong>Email:</strong> {{ email }}</p>
    <p><strong>Ім'я користувача:</strong> {{ username }}</p>
    <p>Ласкаво просимо до вашого профілю!</p>
    <button @click="logout">Вийти</button>
  </div>
</template>

<style scoped>
.profile {
  max-width: 400px;
  height: fit-content;  
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

button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 3px;
  cursor: pointer;
  width: 400px;
}

button:hover {
  background-color: #0056b3;
}
</style>
