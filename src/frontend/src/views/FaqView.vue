<!-- Página de Perguntas Frequentes -->

<template>
  <v-container class="fill-height" fluid>
    <!-- Alinhar cartão horizontalmente para o centro -->
    <v-row justify="center" align="center">
      <!-- Das 12 colunas criadas, apenas 8 vão ser usadas para o card (4 erq e 4 dir a partir do centro) -->
      <v-col cols="12" md="12">
        <!-- card com padding: 24 e com contorno -->
        <v-card class="pa-4" variant="outlined" style="border: 3px dashed #dd8e07;">
          <!-- Titulo central amarelo de tamanho h4 e a negrito --><!-- FAQs -->
          <v-card-title class="text-center text-orange-darken-2 text-h4 font-weight-bold">Perguntas Frequentes</v-card-title>

          <v-card-subtitle class="text-center text-subtitle-1 font-italic"
                           style="white-space: normal; overflow: visible; text-overflow: unset;">
            Responderemos a todas as perguntas para que possa ficar esclarecido sobre a plataforma!
          </v-card-subtitle>

          <!-- Divisor -->
          <br><v-divider :thickness="5"></v-divider><br>

          <!-- Painel das FAQs em que permite abrir uma janela de pergunta de cada vez -->
          <!-- Para remover sombreado faz elevation="0" -->
          <v-expansion-panels elevation="0" variant="inset">
            <!-- Pergunta 1 | Question 1 -->
            <v-expansion-panel>
              <v-expansion-panel-title class="text-white text-h6">
                1. O que é a Bibli@lma?
              </v-expansion-panel-title>
              <v-expansion-panel-text>
                Uma plataforma digital desenvolvida para auxiliar o utilizador a manter o controlo total sobre a sua coleção
                pessoal de livros - sejam físicos ou digitais -, facilitando o registo, a catalogação, a consulta e a gestão
                de empréstimos ou leituras.
              </v-expansion-panel-text>
            </v-expansion-panel>

            <!-- Pergunta 2 | Question 2 -->
            <v-expansion-panel>
              <v-expansion-panel-title class="text-white text-h6">
                2. Quais são as funcionalidades disponíveis da plataforma?
              </v-expansion-panel-title>
              <v-expansion-panel-text>
                Permite:
                <ul class="ml-6 mt-2">
                  <li><b>Registo de livros:</b> Inserção de informações como título, autor, editora, data de aquisição, ISBN, capa, estado do livro, etc.</li>
                  <li><b>Classificação e pesquisa:</b> Organização por categorias (género, tema, idioma), e funcionalidades de busca rápida por título ou autor.</li>
                  <li><b>Gestão de leitura:</b> Marcação de livros como lidos, em leitura ou por ler, e acompanhamento do progresso de leitura.</li>
                  <li><b>Empréstimos:</b> Controlo de livros emprestados, com registo de quem levou, data de empréstimo e devolução.</li>
                  <li><b>Anotações e avaliações:</b> Permite ao utilizador escrever comentários, anotações pessoais ou atribuir classificações.</li>
                  <li><b>Relatórios e estatísticas:</b> Geração de resumos sobre o número de livros lidos, mais lidos, autores favoritos, etc.</li>
                </ul>
              </v-expansion-panel-text>
            </v-expansion-panel>

            <!-- Pergunta 3 | Question 3 -->
            <v-expansion-panel>
              <v-expansion-panel-title class="text-white text-h6">
                3. Esta plataforma está destinada a quem?
              </v-expansion-panel-title>
              <v-expansion-panel-text>
                Público-alvo:
                <ul class="ml-6 mt-2">
                  <li><b>Leitores assíduos com bibliotecas caseiras.</b></li>
                  <li><b>Estudantes e académicos que precisam manter controlo sobre o seu material.</b></li>
                  <li><b>Professores ou profissionais que utilizam livros frequentemente.</b></li>
                  <li><b>Colecionadores de edições raras ou temáticas.</b></li>
                </ul>
              </v-expansion-panel-text>
            </v-expansion-panel>

            <!-- Pergunta 4 | Question 4 -->
            <v-expansion-panel>
              <v-expansion-panel-title class="text-white text-h6">
                4. Quais são os benefícios na sua utilização?
              </v-expansion-panel-title>
              <v-expansion-panel-text>
                <ul class="ml-6 mt-2">
                  <li><b>Evita compras duplicadas.</b></li>
                  <li><b>Reduz perdas por esquecimento de empréstimos.</b></li>
                  <li><b>Melhora a organização e facilita o acesso à informação.</b></li>
                  <li><b>Valoriza a coleção pessoal com dados bem estruturados.</b></li>
                </ul>
              </v-expansion-panel-text>
            </v-expansion-panel>
          </v-expansion-panels>

          <!-- Painel de "Mais informações, consulta..." -->
          <v-row class="ml-1 mr-1" justify="center">
            <v-col>
              <v-card class="pa-3" elevation="0">
                <!-- Titulo -->
                <h3>
                  Caso tenha alguma dúvida, pode contactar o Administrador por via correio eletrónico,
                  através do seguinte endereço: <a href="mailto:coord.ei.estg@ipleiria.pt">gui_amado1@hotmail.com</a>
                </h3>
              </v-card>
            </v-col>
          </v-row>
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
  background-color: #dd8e07;
  border: 3px solid #ffe4c8;
}

.v-expansion-panel-title:hover {
  background-color: #acacac;
}
</style>

<script setup>
</script>