<template>
    <div class="container">
      <h2>Login</h2>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" id="email" v-model="email" placeholder="Digite seu email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Senha:</label>
          <input type="password" class="form-control" id="password" v-model="password" placeholder="Digite sua senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: ''
      };
    },
    methods: {
      submitForm() {
        console.log('Email:', this.email);
        console.log('Senha:', this.password);
      }
    }
  };
  </script>
  
  <style scoped>
  /* Estilos específicos para este componente */
  .container {
    max-width: 400px;
    margin: 0 auto;
    padding-top: 50px;
  }
  </style>
  