<template>
  <div class="flex min-h-screen bg-gray-50">
    <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-[#0a66c2] to-blue-500 items-center justify-center rounded-l-2xl">
      <img :src="mascote" alt="Mascote" class="object-contain"/>
    </div>

    <!-- Lado direito: formulário com logo flutuante -->
    <div class="flex flex-1 items-center justify-center p-8">
      <div class="relative w-full max-w-md flex flex-col items-center">
        <div class="absolute -top-20 bg-white rounded-full p-2 shadow-xl border border-gray-200 transition-transform duration-300 hover:scale-105">
          <img :src="logo" alt="Logo" class="w-36 h-36 object-contain"/>
        </div>

        <!-- Caixa branca -->
        <div class="w-full bg-white p-10 rounded-2xl shadow-lg space-y-6 pt-28">
          <h2 class="text-3xl font-bold text-center text-gray-800">Acesse sua conta</h2>
          <p class="text-center text-gray-500 mt-0">Insira suas credenciais para continuar</p>

          <form  @submit.prevent="handleLogin" class="space-y-4">
            <div>
              <label class="block text-gray-600 mb-1">Email</label>
              <input type="email" placeholder="seu@email.com" required
                     v-model="credentials.email"
                     class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#0a66c2] focus:outline-none text-gray-900 bg-white placeholder-gray-400"/>
            </div>

            <div>
              <label class="block text-gray-600 mb-1">Senha</label>
              <input type="password" placeholder="********" required
                     v-model="credentials.password"
                     class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#0a66c2] focus:outline-none text-gray-900 bg-white placeholder-gray-400"/>
            </div>
            <div class="flex justify-end mb-4">
              <router-link to="/nova-senha" class="text-sm text-[#0a66c2] hover:underline">
                Esqueci minha senha?
              </router-link>
            </div>
            <button
                type="submit"
                class="w-full bg-[#006cce] text-white py-3 rounded-full hover:bg-[#28acfb] transition-all duration-300 font-semibold flex items-center justify-center gap-2"
                :disabled="loading"
                >
                <svg v-if="loading" class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-80" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 100 16v-4l-3 3 3 3v-4a8 8 0 01-8-8z"></path>
                </svg>
                <span v-else>Entrar</span>
            </button>
          </form>

          <p class="text-center text-gray-500 text-sm">
            Não tem uma conta?
            <a href="#" class="text-[#0a66c2] font-semibold hover:underline">Cadastre-se</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'

import { useAuthStore } from "@/store/auth"
import { userApi, setGlobalToken } from '@/api/Api'

import mascote from '@/assets/img/mascote-delivery-entregador.png'
import logo from '@/assets/img/logo-system-delivery.png'
import { useAlert } from '@/utils/alert.js'

const auth = useAuthStore()
const router = useRouter()
const { error } = useAlert()
const loading = ref(false)
const credentials = reactive({
	email:'',
	password:''
})

const handleLogin = async () => {
  
  loading.value = true;

	try {
      const { data } = await userApi.post("/login", {
        email: credentials.email,
        password: credentials.password,
      })

      auth.setToken(data.data.access_token)
      auth.setUser(data.data.user)
      setGlobalToken(data.data.access_token)

      router.push('/dashboard');

    } catch (errorr) {
        error('Credencias Invalidas!')
    } finally {
    loading.value = false;
  }
}
</script>
