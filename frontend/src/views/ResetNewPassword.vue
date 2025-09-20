<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
    
    <img :src="logo" alt="Logo" class="w-1/2 max-w-[180px] object-contain mb-6" />

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Redefinir Senha</h2>

      <!-- Passo 1: Enviar e-mail -->
      <form v-if="step === 1 && !successState" @submit.prevent="sendCode">
        <div class="mb-4">
          <label class="block mb-1 text-gray-600 font-medium" for="email">E-mail:</label>
          <input id="email" type="email" v-model="email" required
            class="w-full text-gray-600 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Digite seu e-mail"/>
        </div>
        <button type="submit" :disabled="loading"
          class="w-full bg-[#0D47A1] text-white py-2 rounded-lg font-semibold hover:bg-[#1565C0] transition disabled:opacity-50">
          {{ loading ? 'Enviando...' : 'Enviar Código' }}
        </button>
      </form>

      <!-- Passo 2: Validar código -->
      <form v-if="step === 2 && !successState" @submit.prevent="validateCode">
        <div class="mb-4">
          <label class="block mb-1 text-gray-600 font-medium" for="code">Código de 5 dígitos:</label>
          <input id="code" type="text" maxlength="5" v-model="code" required
            class="w-full text-gray-600 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Digite o código recebido"/>
        </div>
        <button type="submit" :disabled="loading"
          class="w-full bg-[#0D47A1] text-white py-2 rounded-lg font-semibold hover:bg-[#1565C0] transition disabled:opacity-50">
          {{ loading ? 'Validando...' : 'Validar Código' }}
        </button>
      </form>

      <!-- Passo 3: Alterar senha -->
      <form v-if="step === 3 && !successState" @submit.prevent="resetPassword">
        <div class="mb-4">
          <label class="block mb-1 text-gray-600 font-medium" for="password">Nova senha:</label>
          <input type="password" id="password" v-model="password" required
            class="w-full text-gray-600 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Digite a nova senha" @input="checkStrength"/>
        </div>

        <!-- Barra de força -->
        <div class="h-2 w-full bg-gray-200 rounded-full mb-2 overflow-hidden">
          <div class="h-2 rounded-full transition-all duration-500"
               :class="strengthColor"
               :style="{ width: strengthPercent + '%' }"></div>
        </div>
        <p class="text-sm text-gray-500 mb-4">Força: <span class="font-bold">{{ strengthLabel }}</span></p>

        <div class="mb-6">
          <label class="block mb-1 text-gray-600 font-medium" for="confirmPassword">Confirmar senha:</label>
          <input type="password" id="confirmPassword" v-model="confirmPassword" required
            class="w-full text-gray-600 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="Confirme a nova senha"/>
          <p v-if="confirmPassword && password !== confirmPassword" class="text-red-500 text-sm mt-1 font-bold">
            As senhas não coincidem.
          </p>
        </div>

        <button type="submit" :disabled="loading || password !== confirmPassword"
          class="w-full bg-[#0D47A1] text-white py-2 rounded-lg font-semibold hover:bg-[#1565C0] transition disabled:opacity-50">
          {{ loading ? 'Alterando...' : 'Salvar nova senha' }}
        </button>
      </form>

      <!-- Mensagem de sucesso -->
      <div v-if="successState" class="text-center">
        <p class="mt-4 text-green-500 text-lg font-medium">{{ successMsg }}</p>
        <button @click="goToLogin"
          class="mt-6 w-full bg-[#0D47A1] text-white py-2 rounded-lg font-semibold hover:bg-[#1565C0] transition">
          Voltar para Login
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { userApi } from '@/api/Api'
import { useAlert } from '@/utils/alert.js'
import { useRouter } from 'vue-router'

import logo from '@/assets/img/logo-system-delivery.png'


const router = useRouter()
const step = ref(1)
const email = ref('')
const code = ref('')
const password = ref('')
const confirmPassword = ref('')
const loading = ref(false)

const { error, success } = useAlert()
const successState = ref(false)
const successMsg = ref('')

// Força da senha
const strengthPercent = ref(0)
const strengthLabel = ref('Fraca')
const strengthColor = ref('bg-red-500')

const checkStrength = () => {
  const val = password.value
  let score = 0

  if (val.length >= 6) score++
  if (/[A-Z]/.test(val)) score++
  if (/[0-9]/.test(val)) score++
  if (/[\W_]/.test(val)) score++

  const strengthMap = [
    { percent: 25, label: 'Fraca', color: 'bg-red-500' },
    { percent: 25, label: 'Fraca', color: 'bg-red-500' },
    { percent: 50, label: 'Média', color: 'bg-yellow-500' },
    { percent: 75, label: 'Forte', color: 'bg-blue-500' },
    { percent: 100, label: 'Muito Forte', color: 'bg-green-500' },
  ]

  const strength = strengthMap[score] || strengthMap[0]
  strengthPercent.value = strength.percent
  strengthLabel.value = strength.label
  strengthColor.value = strength.color
}


const sendCode = async () => {
  loading.value = true
  try {
    const res = await userApi.post('/password/email', { email: email.value })
    success(res.data.message)
    step.value = 2
  } catch (err) {
    error(err.response?.data?.message || 'Erro ao enviar código')
  } finally {
    loading.value = false
  }
}

const validateCode = async () => {
  loading.value = true
  try {
    const res = await userApi.post('/password/validate-reset-code', {
      email: email.value,
      code: code.value.toString()
    })
    success(res.data.message || 'Código válido!')
    step.value = 3
  } catch (err) {
    error(err.response?.data?.message || 'Código inválido')
  } finally {
    loading.value = false
  }
}

const resetPassword = async () => {
  if (password.value !== confirmPassword.value) {
    error('Senhas não coincidem')
    return
  }
  loading.value = true
  try {
    const res = await userApi.post('/password/reset', {
      email: email.value,
      token: code.value,
      password: password.value,
      password_confirmation: confirmPassword.value,
    })
    successMsg.value = res.data.message || 'Senha redefinida com sucesso!'
    success('Senha redefinida com sucesso!')
    successState.value = true
  } catch (err) {
    error(err.response?.data?.message || 'Erro ao redefinir senha')
  } finally {
    loading.value = false
  }
}

const goToLogin = () => {
  router.push({ name: 'login' })
}
</script>
