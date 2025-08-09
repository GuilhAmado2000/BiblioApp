<script setup>
import { useAuthStore } from '@/stores/authStore.js'

const authStore = useAuthStore()

</script>

<template>
  <v-container class="fill-height" fluid>
    <!-- Alinhar cartão horizontalmente para o centro -->
    <v-row justify="center" align="center">
      <!-- Das 12 colunas criadas, apenas 8 vão ser usadas para o card (4 erq e 4 dir a partir do centro) -->
      <v-col cols="12" md="12">
        <!-- card com padding: 24 e com contorno -->
        <v-card class="pa-4" variant="outlined" style="border: 3px dashed #dd8e07">
          <!-- Titulo central amarelo de tamanho h4 e a negrito --><!-- FAQs -->
          <v-card-title class="text-center text-orange-darken-2 text-h4 font-weight-bold">Bem vindo, {{ authStore.name }}!</v-card-title>

          <!-- Divisor -->
          <v-divider class="my-6" :thickness="5"></v-divider>


        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.v-card {
  background-color: white;
}
</style>