<template>
  <MainLayout>
    <div class="w-full max-w-6xl mx-auto flex flex-col gap-6 text-gray-800">

      <!-- Header da entrega -->
      <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-xl shadow-md">
        <div class="flex-1">
          <h1 class="text-2xl font-bold text-gray-800">{{ delivery.title }}</h1>
          <p class="text-gray-500 mt-1">
            Cliente: {{ delivery.client }} | Tipo: {{ delivery.type }}
          </p>
        </div>
        <p class="text-gray-700 font-semibold">{{ delivery.tracking_code }}</p>
      </div>

      <!-- Linha do tempo dos status com animação -->
      <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between overflow-x-auto">
        <div
          v-for="(step, index) in statusTimeline"
          :key="index"
          class="flex-1 flex items-center relative"
        >
          <div class="flex flex-col items-center text-center z-10 relative">
            <div 
              :class="[
                'w-6 h-6 rounded-full mb-2 flex items-center justify-center text-white transition-colors duration-700',
                step.completed ? 'bg-blue-600' : 'bg-gray-300'
              ]"
            >
              <span class="text-xs font-bold">{{ index + 1 }}</span>
            </div>
            <span class="text-sm text-gray-600 whitespace-nowrap">{{ step.name }}</span>
          </div>

          <!-- Linha de conexão com animação de preenchimento -->
          <div v-if="index < statusTimeline.length - 1" class="flex-1 h-1 bg-gray-300 mx-2 relative overflow-hidden rounded">
            <div
              class="h-1 bg-blue-600 absolute left-0 top-0 transition-all duration-700 ease-in-out"
              :style="{ width: step.completed ? '100%' : '0%' }"
            ></div>
          </div>
        </div>
      </div>

      <div class="flex flex-col lg:flex-row gap-6">
        <!-- Detalhes e formulário -->
        <div class="flex-1 flex flex-col gap-4">
          <!-- Informações da entrega -->
          <div class="bg-white p-6 rounded-xl shadow-md flex flex-col gap-2">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Detalhes da Entrega</h2>
            <p><span class="font-semibold">Endereço de retirada:</span> {{ delivery.pickup_address }}</p>
            <p><span class="font-semibold">Endereço de entrega:</span> {{ delivery.delivery_address }}</p>
            <p><span class="font-semibold">Data prevista:</span> {{ delivery.delivery_date }}</p>
          </div>

          <!-- Formulário de atualização de status -->
          <div class="bg-white p-6 rounded-xl shadow-md flex flex-col gap-4">
            <h2 class="text-lg font-semibold text-gray-800">Atualizar Status</h2>
            <select v-model="delivery.status" class="border rounded-md p-2">
              <option v-for="status in allStatuses" :key="status" :value="status">{{ status }}</option>
            </select>

            <textarea 
              v-model="delivery.note"
              placeholder="Adicionar observação..."
              class="border rounded-md p-2 h-24 resize-none"
            ></textarea>

            <button 
              @click="updateDelivery"
              class="bg-blue-600 text-white font-semibold px-4 py-2 rounded-md hover:bg-blue-700 transition"
            >
              Salvar Alterações
            </button>
          </div>
        </div>

        <!-- Mapa -->
        <div class="flex-1 bg-white rounded-xl shadow-md p-6 h-96">
          <h2 class="text-lg font-semibold text-gray-800 mb-2">Mapa de Entrega</h2>
          <div class="w-full h-[calc(100%-2rem)]">
            <iframe
                class="w-full h-full rounded-md"
                src="https://www.google.com/maps?q=Rua%20Antonieta%20Rudge%20Muller%20-%20Jardim%20Brasil&output=embed"
                style="border:0;"
                allowfullscreen
                loading="lazy"
                ></iframe>
            </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useRoute, useRouter } from 'vue-router' 
import { deliveryApi } from '@/api/Api'
import { useAlert } from '@/utils/alert.js'
import MainLayout from '@/layouts/MainLayout.vue'

defineProps({
  id: {
    type: String,
    required: false
  }
})

//const router = useRouter()
const route = useRoute()
const deliveryId = atob(route.params.id)

const delivery = ref({
  title: '#12345 - Rua das Flores',
  client: 'João Silva',
  type: 'Same Day',
  tracking_code: 'TRK-60886',
  pickup_address: 'Rua A, 123',
  delivery_address: 'Rua Antonieta Rudge Muller - Jardim Brasil',
  delivery_date: '2025-09-03',
  status: 'Pendente',
  note: ''
})

const statusTimeline = ref([
  { name: 'Pendente', completed: true },
  { name: 'Pedido Coletado', completed: true },
  { name: 'Em Rota', completed: false },
  { name: 'Entregue', completed: false }
])

const allStatuses = ['Pendente', 'Pedido Coletado', 'Em Rota', 'Entregue']

const updateDelivery = async () => {

    /*
    // Atualiza status do timeline com animação
    statusTimeline.value.forEach(step => step.completed = false)
    const currentIndex = allStatuses.indexOf(delivery.value.status)
    for (let i = 0; i <= currentIndex; i++) {
    setTimeout(() => {
        statusTimeline.value[i].completed = true
    }, i * 200) // animação escalonada
    }

    await deliveryApi.post(`/deliveries/${delivery_id}/status`)

    alert(`Status atualizado para: ${delivery.value.status}\nObservação: ${delivery.value.note}`)


    // Aqui você pode fazer POST para API
    */


    try {

        await deliveryApi.post(`/deliveries/${delivery_id}/status`, {
            status: delivery.value.status,
            notes: delivery.value.note
        })

        statusTimeline.value.forEach(step => step.completed = false)
        const currentIndex = allStatuses.indexOf(delivery.value.status)

        for (let i = 0; i <= currentIndex; i++) 
        {
            setTimeout(() => {
                statusTimeline.value[i].completed = true
            }, i * 200)
        }

        success('Entrega Atualizada!')

    } catch (e) {
        error(e)
    }
}
</script>

<style scoped>
/* Scroll horizontal da linha do tempo */
.flex-1.overflow-x-auto::-webkit-scrollbar {
  height: 6px;
}
.flex-1.overflow-x-auto::-webkit-scrollbar-thumb {
  background-color: rgba(0,0,0,0.2);
  border-radius: 3px;
}
</style>
