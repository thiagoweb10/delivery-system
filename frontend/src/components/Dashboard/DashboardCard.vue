<template>
  <div
    class="w-full bg-white rounded-xl p-4 flex items-center justify-between shadow-sm hover:shadow-md transition"
  >
    <!-- Ícone em bolha -->
    <div
      class="w-12 h-12 flex items-center justify-center rounded-full"
      :style="{ backgroundColor: color }"
    >
      <!-- Ícone só se existir count -->
      <FontAwesomeIcon 
        :icon="icon" 
        class="text-2xl" 
        :class="textColors[color]" 
        v-show="count !== null && count !== undefined"
      />
    </div>

    <!-- Texto -->
    <div class="text-right">
      <p class="text-lg font-bold text-[#0068c0]">
        {{ count !== null && count !== undefined ? count : '' }}
      </p>
      <p class="text-sm text-[#0068c0]">
        {{ title || '' }}
      </p>
    </div>
  </div>
</template>

<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

defineProps({
  title: String,
  count: [String, Number],
  icon: {
    type: Array,
    required: true
  },
  color: {
    type: String,
    default: 'blue'
  }
})

const textColors = {
  blue: 'text-[#0068c0]',
  yellow: 'text-[#0068c0]',
  green: 'text-[#0068c0]',
  red: 'text-[#0068c0]'
}
</script>
