<template>

  <div class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="card p-4" style="width: 400px;">
      <img src="path/to/your/image.jpg" class="card-img-top" alt="Imagem de login">
      <div class="card-body">
        <h2 class="card-title text-center">Login</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" v-model="email" placeholder="Digite seu email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="password" v-model="password" placeholder="Digite sua senha"
              required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
  <Loader v-if="loading" />

</template>

<script>

import APIClient from '../services/APIClient.js';
import Loader from "@/components/Loader.vue";
import { showError } from '@/components/utils/alertHandler.js'

export default {
  /* eslint-disable */

  components: {
    Loader
  },
  data() {
    return {
      email: '',
      password: '',
      error: '',
      loading: false

    };
  },
  methods: {
    async submitForm() {
      this.loading = true;

      try {
        await APIClient.login(this.email, this.password);
        const tokenApi = await APIClient.login(this.email, this.password);
        console.log(tokenApi.data.data.token)
        await APIClient.authenticateWithFirebase(this.email, this.password);
        this.$router.push('/tasks');
      } catch (error) {  
        showError('invalid credentials');


      } finally {
        this.loading = false;
      };

    },

  }
};
</script>

<style scoped>
.bg-light {
  background-color: #f8f9fa !important;
}
</style>
