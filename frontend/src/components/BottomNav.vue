<template>
  <div class="fixed bottom-0 left-0 w-full h-12 flex border-t shadow-md z-50 md:hidden bg-white">
    <router-link
      v-for="button in buttons"
      :key="button.title"
      :to="button.to"
      class="flex-1 flex items-center justify-center bg-transparent"
    >
      <div
        class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100/50 relative
               transition-all duration-200
               hover:scale-95 hover:shadow-sm hover:bg-blue-100/70"
      >
        <FontAwesomeIcon
          :icon="button.icon"
          class="text-2xl"
          style="color: #0174ca"
        />
        <span
          v-if="button.title === 'Notificações' && notificationCount > 0"
          class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center"
        >
          {{ notificationCount }}
        </span>
      </div>
    </router-link>
  </div>
</template>

<script setup>
import { ref } from "vue"
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const notificationCount = ref(3)

const buttons = [
  { title: "Home", to: "/courier/dashboard", icon: ['fas','house'] },
  { title: "Notificações", to: "/courier/notificacoes", icon: ['fas','bell'] },
  { title: "Entregas", to: "/courier/entregas", icon: ['fas','truck'] },
  { title: "Configurações", to: "/courier/configuracoes", icon: ['fas','cog'] }
]
</script>
