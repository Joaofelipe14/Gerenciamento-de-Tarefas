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

import { auth } from '../firebase';
import { createUserWithEmailAndPassword, getAuth, signInWithEmailAndPassword } from "firebase/auth";
import Loader from "@/components/Loader.vue";
import { showError } from '@/components/utils/alertHandler.js'


export default {
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
      createUserWithEmailAndPassword(auth, this.email, this.password)
        .then((credential) => {
          console.log(credential)
          this.$router.push('/tasks');
        })
        .catch((error) => {
          if (error.code === 'auth/email-already-in-use') {
            this.signIn();
          } else {
            showError(error.message);
          }
        })
        .finally(() => {
          this.loading = false;
        });

    },
    async signIn() {
      const auth = getAuth();
      signInWithEmailAndPassword(auth, this.email, this.password)
        .then((userCredential) => {
          console.log(userCredential)
          this.$router.push('/tasks');
        })
        .catch((error) => {
          showError(error.message);
          console.error(error);
        });

    }
  }
};
</script>

<style scoped>
.bg-light {
  background-color: #f8f9fa !important;
}
</style>
