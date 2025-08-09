<script setup>
import { useAuthStore } from '@/stores/authStore.js'
import { onMounted, ref } from 'vue'
import api from '@/plugins/axios.js'

const authStore = useAuthStore()

const books = ref([])

onMounted(async () => {
  try {
    const response = await api.get(`/book-management/${authStore.getUserId}`)
    books.value = response.data
  } catch (error) {
    console.error('Erro ao carregar livros:', error)
  }
})
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
          <v-card-title class="text-center text-orange-darken-2 text-h4 font-weight-bold"
            >Gestão de Livros</v-card-title
          >

          <!-- Divisor -->
          <v-divider class="my-6" :thickness="5"></v-divider>

          <!-- Lista de livros -->
          <v-row>
            <v-col v-for="book in books" :key="book.id" cols="12" sm="6" md="4">
              <v-card outlined>
                <v-card-title class="font-weight-bold">{{ book.title }}</v-card-title>
                <v-card-subtitle>{{ book.author }}</v-card-subtitle>
                <v-card-text>
                  <!-- Outras informações do livro -->
                </v-card-text>
                <v-card-actions>
                  <v-btn color="primary" variant="tonal">Ver detalhes</v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
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