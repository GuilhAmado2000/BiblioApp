<script setup>
import { onMounted, ref } from 'vue'
import api from '@/plugins/axios.js'

const isLoading = ref(true)
const isActive = ref(false)

const addDialog = ref(false)

const formIsValid = ref(false)

const requiredRule = (v) => !!v || 'Campo obrigatório!'
const numberRule = v => v >= 0 || 'Não pode ser negativo'

const authors = ref([])
const publishers = ref([])
const languages = ref([])
const types = ref([])
const categories = ref([])

const bookForm = ref({
  isbn: '',
  name: '',
  code: '',
  edition: '',
  publication_date: '',
  description: '',
  pages: '',
  image: null,
  price: '',
  quantity: '',
  language: '',
  type: '',
  category: '',
  author: '',
  publisher: '',
})

const priceInput = ref('')

function formatPrice() {
  if (!priceInput.value) return
  const numeric = parseFloat(
    priceInput.value.replace(/\./g, '').replace(',', '.')
  )
  if (!isNaN(numeric)) {
    priceInput.value = numeric.toLocaleString('pt-PT', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    })
    bookForm.value.price = numeric // número puro para enviar ao backend
  }
}

onMounted(async () => {
  isLoading.value = true

  try {
    const authorsResp = await api.get('/author/')
    authors.value = authorsResp.data.map(author => ({
      id: author.id,
      name: author.name,
    }))

    const publishersResp = await api.get('/publisher/')
    publishers.value = publishersResp.data.map(publisher => ({
      id: publisher.id,
      name: publisher.name,
    }))

    const languagesResp = await api.get('/language/')
    languages.value = languagesResp.data.map(language => ({
      id: language.id,
      name: language.name,
    }))

    const typesResp = await api.get('/type/')
    types.value = typesResp.data.map(type => ({
      id: type.id,
      name: type.name + ' (' + type.description + ')',
    }))

    const categoriesResp = await api.get('/category/')
    categories.value = categoriesResp.data.map(category => ({
      id: category.id,
      name: category.name,
    }))
  } catch (error) {
    console.log('Erro ao carregar os idiomas:', error)
  } finally {
    isLoading.value = false
  }

  isLoading.value = false
})

const addBook = async () => {
  isLoading.value = true

  try {
    const payload = {
      isbn: bookForm.value.isbn,
      name: bookForm.value.name,
      code: bookForm.value.code,
      edition: bookForm.value.edition,
      publication_date: bookForm.value.publication_date,
      description: bookForm.value.description,
      pages: bookForm.value.pages,
      image: bookForm.value.image,
      price: bookForm.value.price,
      quantity: bookForm.value.quantity,
      language: '',
      type: '',
      category: ''
    }

    await api.post('/book-management/', payload)
  } catch (error) {
    console.log('Erro ao criar livro:', error)
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <div class="pa-4 text-center">
    <v-dialog width="75%" height="75%" scrollable v-model="isActive" persistent>
      <!-- Botão Adicionar Livro no BookManagementView -->
      <template v-slot:activator="{ props: activatorProps }">
        <v-btn block color="warning" variant="elevated" v-bind="activatorProps" class="button-add"
          ><v-icon icon="mdi-book-plus" class="mr-2"></v-icon> Adicionar Livro</v-btn
        >
      </template>

      <template v-slot:default="{ isActive }">
        <v-progress-circular
          v-if="isLoading"
          indeterminate
          size="64"
          width="8"
          color="primary"
          class="ma-4"
          style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%)"
        ></v-progress-circular>

        <!-- Caixa de Adicionar Livro -->
        <v-card v-else>
          <v-card-title class="text-h5" style="background-color: darkorange; color: white">
            <v-icon icon="mdi-book-plus" class="mr-2"></v-icon>Adicionar Livro
          </v-card-title>

          <!-- Formulário -->
          <v-card-text class="px-4" style="height: 600px; overflow-y: auto">
            <v-form v-model="formIsValid">
              <v-row>
                <v-col cols="12" md="4">
                  <!-- ISBN -->
                  <v-text-field
                    dense
                    variant="outlined"
                    v-model="bookForm.isbn"
                    label="ISBN"
                    required
                    :rules="[requiredRule]"
                  />
                </v-col>
                <v-col cols="12" md="4">
                  <!-- Código do Livro -->
                  <v-text-field
                    dense
                    variant="outlined"
                    v-model="bookForm.code"
                    label="Código"
                    required
                    :rules="[requiredRule]"
                  />
                </v-col>
                <v-col cols="12" md="4">
                  <!-- Quantidade -->
                  <v-text-field
                    dense
                    variant="outlined"
                    v-model="bookForm.quantity"
                    label="Qtd."
                    type="number"
                    min="0"
                    required
                    :rules="[requiredRule, numberRule]"
                  />
                </v-col>
              </v-row>

              <!-- Título do Livro -->
              <v-text-field
                dense
                variant="outlined"
                v-model="bookForm.name"
                label="Título"
                required
                :rules="[requiredRule]"
              />

              <v-row>
                <v-col cols="12" md="6">
                  <!-- Autor -->
                  <v-select
                    dense
                    variant="outlined"
                    v-model="bookForm.author"
                    label="Autores"
                    :items="authors"
                    item-title="name"
                    item-value="id"
                    required
                    :rules="[requiredRule]"
                  >
                    <template #append-item>
                      <v-divider class="mt-2 mb-2"></v-divider>
                      <v-list-item @click="showAddPlanDialog = true">
                        <v-list-item-title class="text-primary">+ Adicionar autor</v-list-item-title>
                      </v-list-item>
                    </template>
                  </v-select>
                </v-col>

                <v-col cols="12" md="6">
                  <!-- Editora -->
                  <v-select
                    dense
                    variant="outlined"
                    v-model="bookForm.publisher"
                    label="Editora"
                    :items="publishers"
                    item-title="name"
                    item-value="id"
                    required
                    :rules="[requiredRule]"
                  >
                    <template #append-item>
                      <v-divider class="mt-2 mb-2"></v-divider>
                      <v-list-item @click="showAddPlanDialog = true">
                        <v-list-item-title class="text-primary">+ Adicionar editora</v-list-item-title>
                      </v-list-item>
                    </template>
                  </v-select>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12" md="2">
                  <!-- Edição do Livro -->
                  <v-text-field
                    dense
                    variant="outlined"
                    v-model="bookForm.edition"
                    label="N.º de edição"
                    required
                    :rules="[requiredRule]"
                  />
                </v-col>
                <v-col cols="12" md="2">
                  <!-- Data de Publicação (mês e ano) -->
                  <v-text-field
                    dense
                    variant="outlined"
                    v-model="bookForm.publication_date"
                    label="Publicação (mês e ano)"
                    type="month"
                    required
                    :rules="[requiredRule]"
                  />
                </v-col>
                <v-col cols="12" md="2">
                  <!-- Número de páginas -->
                  <v-text-field
                    dense
                    variant="outlined"
                    v-model="bookForm.pages"
                    type="number"
                    label="N.º de páginas"
                    min="0"
                    required
                    :rules="[requiredRule, numberRule]"
                  />
                </v-col>
                <v-col cols="12" md="2">
                  <!-- Preço do livro -->
                  <v-text-field
                    dense
                    variant="outlined"
                    v-model="priceInput"
                    label="Preço"
                    prepend-inner-icon="mdi-currency-eur"
                    required
                    :rules="[requiredRule]"
                    @blur="formatPrice"
                  />
                </v-col>
                <v-col cols="12" md="4">
                  <v-file-input
                    dense
                    variant="outlined"
                    v-model="bookForm.image"
                    label="Capa"
                    accept="image/*"
                    prepend-inner-icon="mdi-image"
                  />
                </v-col>
              </v-row>

              <!-- Descrição do Livro -->
              <v-textarea
                dense
                variant="outlined"
                v-model="bookForm.description"
                type="text"
                label="Descrição breve"
                required
                :rules="[requiredRule]"
              />

              <v-row>
                <v-col cols="12" md="4">
                  <!-- Idioma -->
                  <v-select
                    dense
                    variant="outlined"
                    v-model="bookForm.language"
                    label="Idioma"
                    :items="languages"
                    item-title="name"
                    item-value="id"
                    required
                    :rules="[requiredRule]"
                  />
                </v-col>
                <v-col cols="12" md="4">
                  <!-- Tipo -->
                  <v-select
                    dense
                    variant="outlined"
                    v-model="bookForm.type"
                    label="Tipo"
                    :items="types"
                    item-title="name"
                    item-value="id"
                    required
                    :rules="[requiredRule]"
                  />
                </v-col>
                <v-col cols="12" md="4">
                  <!-- Categoria -->
                  <v-select
                    dense
                    variant="outlined"
                    v-model="bookForm.category"
                    label="Categoria"
                    :items="categories"
                    item-title="name"
                    item-value="id"
                    required
                    :rules="[requiredRule]"
                  />
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-btn text="Cancelar" class="button-cancel" @click="isActive.value = false"></v-btn>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              text="Adicionar"
              variant="elevated"
              class="button-add-branch"
              :disabled="!formIsValid"
              @click="addDialog = true"
            ></v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-dialog>
  </div>

  <!-- Dialogo Confirmar Livro -->
  <v-dialog v-model="addDialog" max-width="400" persistent>
    <v-card>
      <v-card-title class="text-h5" style="background-color: darkblue; color: white"
        >Confirmação</v-card-title
      >
      <!-- Linha separadora -->
      <v-divider />
      <v-card-text class="text-center"> Deseja criar um livro? </v-card-text>
      <v-card-actions class="d-flex justify-space-between">
        <v-btn color="error" variant="elevated" class="button-no" @click="addDialog = false">
          Não
        </v-btn>
        <v-btn
          color="success"
          variant="elevated"
          class="button-yes"
          @click="
            () => {
              addDialog = false
              addBook()
            }
          "
        >
          Sim
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>