<script setup>
import { RouterView } from 'vue-router'
import MainNavbar from '@/components/layout/MainNavbar.vue'
</script>

<template>
  <v-app>
    <MainNavbar/>
    <v-main class="main-background">
      <router-view :key="$route.fullPath"/>
    </v-main>
  </v-app>
</template>


<style scoped>
.main-background {
  background-color: #bedbff;
  min-height: 100vh;
}
</style>
