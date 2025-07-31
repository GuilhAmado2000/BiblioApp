<!-- Página acerca da plataforma -->

<template>
  <v-container class="fill-height" fluid>
    <!-- Alinhar cartão horizontalmente para o centro -->
    <v-row justify="center" align="center">
      <!-- Das 12 colunas criadas, apenas 8 vão ser usadas para o card (4 erq e 4 dir a partir do centro) -->
      <v-col cols="12" md="8">
        <!-- card com padding: 24 e com contorno -->
        <v-card class="pa-4" variant="outlined">
          <!-- Titulo central azul de tamanho h4 e a negrito -->
          <v-card-title class="text-center text-blue-darken-4 text-h4 font-weight-bold">
            GesETP - Gestão de Estudante a Tempo Parcial
          </v-card-title>

          <!-- Subtitulo versão da plataforma central azul de tamanho subtitle -->
          <v-card-subtitle class="text-center text-subtitle-1">Version 2.0</v-card-subtitle>

          <!-- Divisor -->
          <br><v-divider :thickness="5"></v-divider><br>

          <!-- Titulo Acerca da Plataforma -->
          <v-card-title class="text-center text-h4">Acerca da GesETP</v-card-title>

          <!-- Informações dos desenvolvedores -->
          <v-row class="mt-1" justify="center">

            <!-- ESTUDANTES | STUDENTS -->
            <v-col cols="12" md="5">
              <v-card elevation="0" style="border: 5px solid #aed7ff;">
                <v-card-title class="bg-blue-darken-4 text-white text-center">Estudantes</v-card-title>
                <v-card-text class="pa-4">
                  <p class="text-body-1"><b>2200665</b> Joao Miguel Cardeal Vieira</p>
                  <p class="text-body-1"><b>2201754</b> Guilherme José Gomes Amado</p>
                </v-card-text>
              </v-card>
            </v-col>

            <!-- ORIENTADORAS | TEACHERS -->
            <v-col cols="12" md="5">
              <v-card elevation="0" style="border: 5px solid #aed7ff;">
                <v-card-title class="bg-blue-darken-4 text-white text-center">Orientadoras</v-card-title>
                <v-card-text class="pa-4">
                  <p class="text-body-1"><b>Prof.ª Dra.</b> Marisa da Silva Maximiano</p>
                  <p class="text-body-1"><b>Prof.ª Dra.</b> Sónia Maria Almeida da Luz</p>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>

          <!-- Rodapé da GesETP -->
          <v-card-text class="text-center mt-1">
            Trabalho elaborado no âmbito da Unidade Curricular de Projeto Informático em Engenharia Informática
          </v-card-text>
          <v-card-subtitle class="text-center">
            @2025 - Engenharia Informática
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

.v-expansion-panel-title {
  background-color: #1e88e5;
  border: 3px solid #aed7ff;
}

.v-expansion-panel-title:hover {
  background-color: #acacac;
}

</style>