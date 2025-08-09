<!-- Página acerca da plataforma -->

<template>
  <v-container class="fill-height" fluid>
    <!-- Alinhar cartão horizontalmente para o centro -->
    <v-row justify="center" align="center">
      <!-- Das 12 colunas criadas, apenas 8 vão ser usadas para o card (4 erq e 4 dir a partir do centro) -->
      <v-col cols="12" md="10">
        <!-- card com padding: 24 e com contorno -->
        <v-card class="pa-4" variant="outlined" style="border: 3px dashed #dd8e07;">
          <!-- Titulo central amarelo de tamanho h4 e a negrito -->
          <v-card-title class="text-center text-orange-darken-2 text-h4 font-weight-bold" style="white-space: normal">
            Bibli@lma - Gestão de Biblioteca Pessoal
          </v-card-title>

          <!-- Subtitulo versão da plataforma central amarelo de tamanho subtitle -->
          <v-card-subtitle class="text-center text-subtitle-1">Version 1.0</v-card-subtitle>

          <!-- Divisor -->
          <v-divider class="my-6" :thickness="5"></v-divider>

          <!-- Titulo Acerca da Plataforma -->
          <!--<v-card-title class="text-center text-h4">Acerca da Bibli@lma</v-card-title>-->

          <!-- Informações dos desenvolvedores -->
          <v-row class="mt-1" justify="center">

            <!-- DESENVOLVEDOR -->
            <v-col cols="12" md="5">
              <v-card elevation="0" style="border: 5px solid #ffd17b;">
                <v-card-title class="bg-orange-accent-2 text-white text-center">Desenvolvedor</v-card-title>
                <v-card-text class="pa-4">
                  <p class="text-body-1 text-center">Guilherme José Gomes Amado</p>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>

          <!-- Rodapé da Bibli@lma -->
          <v-card-text class="text-center mt-1">
            Trabalho elaborado no âmbito pessoal
          </v-card-text>
          <v-card-subtitle class="text-center">
            @2025 - Porto de Mós, Portugal
          </v-card-subtitle>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.v-card{
  background-color: white;
}
</style>
<script setup lang="ts">
</script>