<script setup>

import { ref } from 'vue'
import api from '@/plugins/axios.js'
import { useAuthStore } from '@/stores/authStore.js'
import { useRouter } from 'vue-router'

const showPassword = ref(false)
const showPasswordConfirmation = ref(false)

const usernameRule = v => (v && v.length >= 2 && v.length <= 30) ||
  'O username deve ter entre 2 e 30 caracteres.'

const requiredRule = v => !!v || 'Campo obrigatório!'
const passwordRule = v => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).{8,}$/.test(v) ||
  'A palavra-passe deve conter pelo menos 8 caracteres, sendo 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caracter especial.'

const passwordMatchRule = v => v === userForm.value.password || 'As palavras-passe não coincidem!'

const check_politica = ref(false)
const check_termos = ref(false)

const showSuccess = ref(false)

const router = useRouter();
const authStore = useAuthStore()

const isLoading = ref(false)

const userForm = ref({
  firstName: '',
  lastName: '',
  username: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const register = async () => {
  if (!check_politica.value || !check_termos.value) {
    alert("É obrigatório aceitar a política de privacidade e os termos antes de continuar.")
    return
  }

  isLoading.value = true;

  try {
    if (userForm.value.username === '' || userForm.value.email === '' || userForm.value.password === '') {
      isLoading.value = false
      return;
    }

    const payload = {
      name: userForm.value.firstName + ' ' + userForm.value.lastName,
      username: 'l.' + userForm.value.username,
      email: userForm.value.email,
      password: userForm.value.password,
      password_confirmation: userForm.value.password_confirmation,
    }

    // Criar utilizador
    await api.post('/users/create', payload)

    // Mostrar mensagem de sucesso
    showSuccess.value = true

    // Esperar 2 segundos para o usuário ver a mensagem
    setTimeout(async () => {
      try {
        // Fazer login automático após criar a conta
        const loginResponse = await api.post('/login', {
          username: 'l.' + userForm.value.username,
          password: userForm.value.password
        })

        // Guardar token e dados do utilizador
        const token = loginResponse.data.token
        authStore.setToken(token)
        authStore.setUserId(loginResponse.data.user.id)
        authStore.setUsername(loginResponse.data.user.username)
        authStore.setName(loginResponse.data.user.name)
        authStore.setUserType(loginResponse.data.user.type)

        // Redirecionar para o dashboard
        await router.push({ name: 'Dashboard' })
      } catch (loginError) {
        console.error('Erro no login automático:', loginError)
      }
    }, 2000)

  } catch (error) {
    console.log('Falha ao criar utilizador:', error)
  } finally {
    isLoading.value = false;
  }
}
</script>

<template>
  <v-container class="fill-height" fluid>
    <!-- Alinhar cartão horizontalmente para o centro -->
    <v-row justify="center" align="center">
      <!-- Das 12 colunas criadas, apenas 8 vão ser usadas para o card (4 erq e 4 dir a partir do centro) -->
      <v-col cols="12" md="7">
        <!-- card com padding: 24 e com contorno -->
        <v-card class="pa-4" variant="outlined" style="border: 3px dashed #dd8e07;">
          <!-- Titulo central amarelo de tamanho h4 e a negrito -->
          <v-card-title class="text-center text-h4 font-weight-bold" style="white-space: normal">
            Criar nova conta
          </v-card-title>

          <!-- Divisor -->
          <v-divider class="mb-6" :thickness="3"></v-divider>

          <!-- Formulário -->
          <v-form fast-fail @submit.prevent="register">
            <!-- Campo Name -->
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field
                  dense
                  outlined
                  v-model="userForm.firstName"
                  label="Primeiro Nome"
                  required
                  :rules="[requiredRule]"
                  />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  dense
                  outlined
                  v-model="userForm.lastName"
                  label="Último Nome"
                  required
                  :rules="[requiredRule]"
                  />
              </v-col>
            </v-row>

            <!-- Campo Username -->
            <v-row class="mb-2">
              <v-col cols="12" md="6">
                <v-text-field
                  dense
                  outlined
                  v-model="userForm.username"
                  label="Username"
                  required
                  :rules="[requiredRule, usernameRule]">
                  <template #prepend-inner>
                    l.
                  </template>
                </v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-alert type="info" variant="tonal" density="compact">
                  O username deve ter entre 2 e 30 caracteres.
                </v-alert>
              </v-col>
            </v-row>

            <!-- Campo Email -->
            <v-text-field
              dense
              outlined
              v-model="userForm.email"
              label="Email"
              type="email"
              required
              :rules="[requiredRule]"
              class="mb-4"
            />

            <!-- Campo Password -->
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field
                      dense
                      outlined
                      v-model="userForm.password"
                      label="Palavra-Passe"
                      :type="showPassword ? 'text' : 'password'"
                      :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                      @click:append="showPassword = !showPassword"
                      required
                      :rules="[requiredRule, passwordRule]"
                />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                      dense
                      outlined
                      v-model="userForm.password_confirmation"
                      label="Confirmar Palavra-Passe"
                      :type="showPasswordConfirmation ? 'text' : 'password'"
                      :append-icon="showPasswordConfirmation ? 'mdi-eye-off' : 'mdi-eye'"
                      @click:append="showPasswordConfirmation = !showPasswordConfirmation"
                      required
                      :rules="[requiredRule, passwordMatchRule]"
                />
              </v-col>
            </v-row>

            <v-alert class="mt-4" type="info" variant="tonal" density="compact">
              A palavra-passe deve conter pelo menos 8 caracteres, sendo 1 letra maiúscula, 1 letra minúscula, 1 número e 1 caracter especial.
            </v-alert>

            <v-checkbox class="mt-4"
                v-model="check_politica"
                label="Li e compreendi a Política de Privacidade"
                color="primary"
                density="compact"
                hide-details
            />

            <v-checkbox
                v-model="check_termos"
                label="Li, compreendi e aceito os Termos e Condições"
                color="primary"
                density="compact"
                hide-details
            />

            <!-- Botão Login -->
            <v-btn class="register-btn mt-4 font-weight-bold" type="submit" block>Registar</v-btn>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>

  <!-- Overlay de carregamento -->
  <div v-if="isLoading" class="loading-overlay">
    <v-progress-circular indeterminate color="white" size="50" width="5" />
  </div>

  <!-- Snackbar -->
  <v-snackbar
    v-model="showSuccess"
    color="success"
    timeout="2000"
    location="top center"
    variant="flat"
    class="success-snackbar"
  >
    <v-icon start>mdi-check-circle</v-icon>
    Conta criada com sucesso! A iniciar sessão...
  </v-snackbar>
</template>

<style scoped>
.loading-overlay {
  position: fixed;
  z-index: 9999;
  background-color: rgba(0, 0, 0, 0.5); /* fundo escurecido */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;

  display: flex;
  align-items: center;
  justify-content: center;
}

.v-card{
  background-color: white;
}

.register-btn {
  background-color: #dd8e07;
  color: white;
}

.register-btn:hover {
  background-color: white !important;
  color: black !important;
}

.success-snackbar {
  font-size: 1.1rem;
  font-weight: bold;
}

</style>