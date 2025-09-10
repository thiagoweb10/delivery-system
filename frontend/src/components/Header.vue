<template>
  <header class="h-12 bg-white flex items-center justify-between px-6 shadow-sm border-b relative">
    <div class="hidden md:flex items-center gap-4">
      <img :src="logo" alt="Logo" class="h-full max-w-[150px] mt-4 object-contain"/>
      <span class="font-bold text-[#0068c0] text-sm animate-fadeIn">
      {{ auth.welcomeMessage }}
      </span>
    </div>

    <div class="flex md:hidden justify-center w-full">
      <img :src="logo" alt="Logo" class="h-full max-w-[150px] mt-4 object-contain"/>
    </div>

    <div class="hidden md:flex items-center gap-4 relative">
      <!-- Botão sino com submenu -->
      <div class="relative mt-2" ref="notificationsRef">
        <button @click="toggleNotifications" class="relative p-2 rounded-full hover:bg-gray-100 transition group">
          <font-awesome-icon :icon="['fas', 'bell']" class="text-[#0a66c2] text-xl"/>
          <span 
            v-if="notifications > 0"
            class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] bg-red-500 text-white text-[11px] font-bold rounded-full flex items-center justify-center px-1 transition-colors group-hover:bg-red-600"
          >
            {{ notifications }}
          </span>
        </button>

        <!-- Submenu Notificações -->
        <div 
          v-if="notificationsOpen"
          @mouseleave="notificationsOpen = false"
          class="absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg py-2 z-50"
        >
          <div v-if="notifications > 0" class="divide-y divide-gray-200">
            <div class="px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer" v-for="(notif, index) in notificationsList" :key="index">
              {{ notif }}
            </div>
          </div>
          <div v-else class="px-4 py-2 text-gray-500 text-sm">
            Nenhuma notificação
          </div>
        </div>
      </div>

      <!-- Avatar com dropdown -->
      <div class="relative" ref="menuRef">
        
        <img :src="auth.userAvatarUrl" alt="Avatar" class="w-18 h-12 rounded-full"  @click="toggleMenu" />
        <div 
          @mouseleave="menuOpen = false"
          v-if="menuOpen"
          class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg py-2 z-50"
        >
          <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
            <font-awesome-icon :icon="['fas', 'cog']" class="text-[#0a66c2]"/>
            Configurações
          </button>
          <button class="flex items-center gap-2 w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
            <font-awesome-icon :icon="['fas', 'right-from-bracket']" class="text-[#0a66c2]"/>
            Sair
          </button>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue"
import logo from '@/assets/img/logo-2.png'
import { useAuthStore } from "@/store/auth"
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome"
import { library } from "@fortawesome/fontawesome-svg-core"
import { faBell, faCog, faRightFromBracket } from "@fortawesome/free-solid-svg-icons"

library.add(faBell, faCog, faRightFromBracket)

const auth = useAuthStore()

// Notificações
const notifications = 3
const notificationsList = [
  "Nova entrega disponível",
  "Mensagem do sistema",
  "Atualização de rota"
]

// Controle dos menus
const menuOpen = ref(false)
const notificationsOpen = ref(false)
const menuRef = ref(null)
const notificationsRef = ref(null)

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value
}

const toggleNotifications = () => {
  notificationsOpen.value = !notificationsOpen.value
}

// Fecha menus ao clicar fora
const handleClickOutside = (e) => {
  if (menuRef.value && !menuRef.value.contains(e.target)) {
    menuOpen.value = false
  }
  if (notificationsRef.value && !notificationsRef.value.contains(e.target)) {
    notificationsOpen.value = false
  }
}

onMounted(() => {
  document.addEventListener("click", handleClickOutside)
})

onBeforeUnmount(() => {
  document.removeEventListener("click", handleClickOutside)
})
</script>
