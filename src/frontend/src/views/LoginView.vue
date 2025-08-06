<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/authStore.js'
import { useRouter } from 'vue-router'
import api from '@/plugins/axios.js'

const username = ref('');
const password = ref('');
const router = useRouter();
const loginFailed = ref(false);
const authStore = useAuthStore();

const isLoading = ref(false);

const login = async () => {
  loginFailed.value = false;
  isLoading.value = true;

  try {
    if (username.value === '' || password.value === '') {
      loginFailed.value = true;
      return;
    }

    const response = await api.post('/login', {
      username: username.value,
      password: password.value
    },
      {
        headers: {
          'Content-Type': 'application/json',
        }
      });

    const token = response.data.token;
    authStore.setToken(token);
    authStore.setUserId(response.data.user.id);
    authStore.setUsername(response.data.user.username);
    authStore.setUserType(response.data.user.type);

    await router.push({ name: 'Dashboard' });

  } catch (error) {
    loginFailed.value = true;
    console.error(error);
  } finally {
    isLoading.value = false;
  }
}

</script>

<template>
  <v-progress-circular v-if="isLoading" indeterminate color="white" size="20" width="2"></v-progress-circular>
  <v-container class="fill-height" fluid>
    <!-- Alinhar cartão horizontalmente para o centro -->
    <v-row justify="center" align="center">
      <v-col cols="12" md="5">
        <v-card class="pa-8" variant="outlined" style="border: 3px dashed #dd8e07;">
          <!-- Titulo central amarelo de tamanho h4 e a negrito -->
          <v-card-title class="text-center text-h4 font-weight-bold" style="white-space: normal">
            Entrar na Bibli@lma
          </v-card-title>

          <!-- Divisor -->
          <br><v-divider :thickness="3"></v-divider><br>

          <v-form fast-fail @submit.prevent="login">
            <!-- Campo Username -->
            <v-text-field v-model="username" label="Nome de utilizador" required></v-text-field>
            <!-- Campo Password -->
            <v-text-field v-model="password" label="Senha" type="password" required></v-text-field>
            <!-- Botão Login -->
            <v-btn class="login-btn mt-4 font-weight-bold" type="submit" block>Login</v-btn>
          </v-form>

          <!-- Link "Esqueceu a palavra-passe?" -->
          <v-btn class="mt-4 text-none" variant="text" color="primary" block @click="forgotPassword">Esqueceu a palavra-passe?</v-btn>

          <br>
          <v-alert v-if="loginFailed" type="error">
            <strong>Erro a efetuar login!</strong> Verifique o nome de utilizador e a password.
          </v-alert>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.v-card{
  background-color: white;
}

.login-btn {
  background-color: #dd8e07;
  color: white;
}

.login-btn:hover {
  background-color: white !important;
  color: black !important;
}
</style>
