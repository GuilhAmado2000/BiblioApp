<script setup>
import { RouterLink, useRoute, useRouter } from 'vue-router'
import { ref } from 'vue'
import { useAuthStore } from '@/stores/authStore.js'
import api from '@/plugins/axios.js'

const isLoggingOut = ref(false)

const authStore = useAuthStore()
const route = useRoute()
const router = useRouter()

const loginButton = () => {
  router.push('/login')
}

const bookManagementButton = () => {
  router.push('/book-management')
}

const statisticsButton = () => {
  router.push('/statistics')
}

const faqButton = () => {
  router.push('/faq')
}

const aboutButton = () => {
  router.push('/about')
}

const logoutButton = async () => {
  isLoggingOut.value = true
  try {
    await api.post('/logout')
    authStore.logout()
    await router.push({ name: 'Login' })
    sessionStorage.clear()
  } catch (error) {
    console.log('Erro ao fazer logout', error)
  } finally {
    isLoggingOut.value = false
  }
}
</script>

<template>
  <!-- NAVBAR HORIZONTAL -->
  <!-- Fixa a navbar no inicio (top)/fim (bottom) da paginação -->
  <v-app-bar :elevation="2" location="top">
    <!-- prepend = conteúdo localizado à esquerda da barra (nav) -->
    <template v-slot:prepend>
      <!-- Logotipo Plataforma BiblioApp -->
      <RouterLink to="/login">
        <v-img alt="Logo da plataforma" height="40" src="/abrev.png" width="100"></v-img>
      </RouterLink>
    </template>

    <!-- Titulo da plataforma -->
    <v-spacer />
    <v-toolbar-title class="text-center font-weight-bold">
      Bibli@lma
    </v-toolbar-title>
    <v-spacer />

    <!-- Loggin da plataforma -->
    <template v-slot:append>
      <v-btn
        v-if="!authStore.isAuthenticated"
        class="me-2 custom-hover"
        color="brown"
        variant="elevated"
        @click="loginButton"
      >Login
      </v-btn>
      <v-btn
        v-if="authStore.isAuthenticated"
        class="me-2 logout"
        variant="elevated"
        @click="logoutButton"
      >Logout
      </v-btn>
    </template>
  </v-app-bar>
  <v-progress-linear v-if="isLoggingOut" color="primary" fixed height="4" indeterminate top />

  <!-- DRAWER LATERAL/VERTICAL -->
  <v-navigation-drawer :elevation="2" app permanent width="180">
    <v-list>
      <v-list-item
        v-if="authStore.isAuthenticated"
        :class="{ 'active-item': route.path === '/book-management' }"
        @click="bookManagementButton">
        <v-list-item-title>Gestão de Livros</v-list-item-title>
      </v-list-item>
      <v-list-item
        v-if="authStore.isAuthenticated"
        :class="{ 'active-item': route.path === '/statistics' }"
        @click="statisticsButton">
        <v-list-item-title>Estatísticas</v-list-item-title>
      </v-list-item>
      <v-list-item
        :class="{ 'active-item': route.path === '/faq' }"
        @click="faqButton">
        <v-list-item-title>FAQs</v-list-item-title>
      </v-list-item>
      <v-list-item
        :class="{ 'active-item': route.path === '/about' }"
        @click="aboutButton">
        <v-list-item-title>Acerca Bibli@lma</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<style scoped>
/* CSS dos Botões */
.custom-hover {
  transition: border 0.3s ease, background-color 0.3s ease, color 0.3s ease;
  border: 3px solid transparent;
  box-shadow: none !important;
}

.custom-hover:hover {
  background-color: white !important;
  color: black !important;
  border: 3px solid #a5592a;
  box-shadow: none !important;
}

.logout {
  transition: border 0.3s ease, background-color 0.3s ease, color 0.3s ease;
  background-color: darkred !important;
  color: white !important;
  border: 3px solid transparent;
  box-shadow: none !important;
}

.logout:hover {
  background-color: white !important;
  color: darkred !important;
  border: 3px solid darkred;
  box-shadow: none !important;
}

.v-list-item {
  transition: background-color 0.3s, color 0.3s;
  cursor: pointer;
}

.v-list-item:hover {
  background-color: #a5592a !important;
  color: white !important;
  border: 3px solid transparent;
}

.active-item {
  background-color: #a5592a !important;
  color: white !important;
  border: 3px solid transparent;
}
</style>