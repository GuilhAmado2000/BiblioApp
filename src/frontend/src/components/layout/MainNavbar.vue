<script setup>
import { RouterLink, useRouter } from 'vue-router'
import { ref } from 'vue'

const isLoggingOut = ref(false)

const router = useRouter()

const loginButton = () => {
  router.push('/login')
}

const aboutButton = () => {
  router.push('/about')
}

const faqButton = () => {
  router.push('/faq')
}
</script>

<template>
  <!-- NAVBAR HORIZONTAL -->
  <!-- Fixa a navbar no inicio (top)/fim (bottom) da paginação -->
  <v-app-bar :elevation="2" location="top">
    <!-- prepend = conteúdo localizado à esquerda da barra (nav) -->
    <template v-slot:prepend>
      <!-- Logotipo Plataforma BiblioApp -->
      <RouterLink to="/">
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
        class="me-2 custom-hover"
        color="brown"
        variant="elevated"
        @click="loginButton"
      >Login
      </v-btn>
    </template>
  </v-app-bar>
  <v-progress-linear v-if="isLoggingOut" color="primary" fixed height="4" indeterminate top />

  <!-- DRAWER LATERAL/VERTICAL -->
  <v-navigation-drawer :elevation="2" app permanent width="180">
    <v-list>
      <v-list-item @click="loginButton">
        <v-list-item-title>Gestão</v-list-item-title>
      </v-list-item>
      <v-list-item @click="aboutButton">
        <v-list-item-title>Visualizar Livros</v-list-item-title>
      </v-list-item>
      <v-list-item @click="faqButton">
        <v-list-item-title>Estatísticas</v-list-item-title>
      </v-list-item>
      <v-list-item @click="aboutButton">
        <v-list-item-title>Acerca Bibli@lma</v-list-item-title>
      </v-list-item>
      <v-list-item @click="faqButton">
        <v-list-item-title>FAQs</v-list-item-title>
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


/* CSS do Menu */
.hover-list-item {
  transition:
    background-color 0.3s,
    color 0.3s;
}

.hover-list-item:hover {
  cursor: pointer;
  background-color: #1e88e5 !important;
  color: white !important;
}

.logout {
  background-color: white !important;
  transition:
    background-color 0.3s,
    color 0.3s;
  color: red !important;
}

.logout:hover {
  background-color: red !important;
  color: white !important;
}
</style>