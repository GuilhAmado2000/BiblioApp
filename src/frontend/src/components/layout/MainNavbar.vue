<script setup>
import { RouterLink, useRouter } from 'vue-router'
import { ref } from 'vue'

const isLoggingOut = ref(false)

const router = useRouter()

const loginButton = () => {
  router.push('/')
}

const aboutButton = () => {
  router.push('/about')
}

const faqButton = () => {
  router.push('/faq')
}
</script>

<template>
  <v-progress-linear v-if="isLoggingOut" color="primary" fixed height="4" indeterminate top />
  <!-- Fixa a navbar no inicio (top)/fim (bottom) da paginação -->
  <v-app-bar :elevation="2" location="top">
    <!-- prepend = conteúdo localizado à esquerda da barra (nav) -->
    <template v-slot:prepend>
      <v-btn>
        <!-- Logotipo Plataforma BiblioApp -->
        <RouterLink to="/">
          <v-img alt="Logo da plataforma" height="30" src="/LogotipoS.png" width="100"></v-img>
        </RouterLink>
      </v-btn>
    </template>

    <template v-slot:append>
      <!-- Botão About -->
      <v-btn
        class="me-2 custom-hover"
        color="black"
        variant="elevated"
        @click="aboutButton"
      >Acerca De
      </v-btn>
      <!-- Botão FAQ -->
      <v-btn
        class="me-2 custom-hover"
        color="black"
        variant="elevated"
        @click="faqButton"
      >FAQ
      </v-btn>
      <v-btn
        class="me-2 custom-hover"
        color="blue"
        variant="elevated"
        @click="loginButton"
      >Login
      </v-btn>
    </template>
  </v-app-bar>
</template>

<style scoped>
/* CSS dos Botões */
.custom-hover:hover {
  background-color: white !important;
  color: black !important;
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