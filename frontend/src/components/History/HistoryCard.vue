<template>
  <div
    class="flex flex-row justify-between items-center p-4 rounded-lg shadow-sm border transition bg-blue-50 sm:bg-white hover:shadow-md relative gap-2"
  >
    <!-- Ícone e título -->
    <div class="flex items-center gap-2">
      <font-awesome-icon :icon="icon" class="text-xl" style="color: #0068c0;" />
      <p class="font-semibold text-gray-800 text-sm">{{ title }}</p>
    </div>

    <!-- Status sempre à direita -->
    <span class="font-medium text-right" :style="{ color: color }">{{ status }}</span>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faCheckCircle, faTimesCircle, faClock, faRoute } from '@fortawesome/free-solid-svg-icons'

library.add(faCheckCircle, faTimesCircle, faClock, faRoute)

defineProps({
  title: String,
  status: String,
  color: String
})

// Ícone dinâmico conforme status
const icon = computed(() => {
  if (status === 'Concluída') return ['fas', 'check-circle']
  if (status === 'Pendente') return ['fas', 'clock']
  if (status === 'Em Rota') return ['fas', 'route']
  return ['fas', 'circle'] // fallback
})
</script>
