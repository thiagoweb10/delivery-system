<template>
  <div
    class="flex flex-col justify-between p-4 rounded-lg shadow-sm border transition bg-blue-50 sm:bg-white hover:shadow-md gap-4 min-h-[100px]"
  >
    <!-- Conteúdo da entrega -->
    <div class="flex-1">
      <p class="font-semibold text-gray-800 text-sm truncate">{{ title }}</p>
      <p class="text-gray-500 text-xs mt-1 truncate">
        Cliente: {{ client }} | Tipo: {{ type }}
      </p>
    </div>

    <!-- Botões alinhados à direita -->
    <div class="flex gap-2 justify-end items-center">
      <!-- Botão aceitar/valor -->
      <button
        @click="handleDeliveryAddClick(deliveryId)"
        class="bg-[#0a66c2] text-white font-bold px-3 py-1.5 rounded-md hover:bg-blue-800 transition text-xs flex-1 sm:flex-none flex items-center justify-center gap-1"
      >
        <span v-if="loading" class="animate-spin border-2 border-white border-t-transparent rounded-full w-3 h-3"></span>
        <span v-else>R$ 200,00</span>
      </button>

      <!-- Botão de detalhes apenas com ícone -->
      <button
        @click="handleViewDetails(deliveryId)"
        class="bg-gray-200 text-gray-800 p-2 rounded-md hover:bg-gray-300 transition flex items-center justify-center"
      >
        <font-awesome-icon :icon="['fas', 'info-circle']" class="text-lg" />
      </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  client: String,
  type: String,
  deliveryId: Number
})

import { ref } from 'vue'
import { deliveryApi } from '@/api/Api'
import { useAlert } from '@/utils/alert.js'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faInfoCircle } from '@fortawesome/free-solid-svg-icons'

library.add(faInfoCircle)

const emit = defineEmits(['loadDataCards'])
const { error, success } = useAlert()
const loading = ref(false)

// Aceitar entrega
const handleDeliveryAddClick = async (delivery_id) => {
  loading.value = true
  try {
    await deliveryApi.post(`/deliveries/${delivery_id}/accept`)
    emit('loadDataCards')
    success('Entrega aceita com sucesso!')
  } catch (msgError) {
    error(msgError)
  } finally {
    loading.value = false
  } 
}

// Visualizar detalhes da entrega
const handleViewDetails = (delivery_id) => {
  console.log('Visualizar detalhes da entrega:', delivery_id)
  // aqui você pode abrir modal ou redirecionar
}
</script>
