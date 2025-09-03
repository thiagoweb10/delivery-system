<template>
  <MainLayout>
    <!-- Dashboard -->
    <template #dashboard-cards>
      <DashboardCard
        v-for="(card, index) in cards"
        :key="index"
        :title="card.status"
        :count="card.total"
        :color="card.color"
        :icon="statusIcons[card.status] || ['fas', 'circle']"
      />
      <div 
        v-if="cards.length === 0" 
        class="w-full bg-white rounded-xl p-4 flex items-center justify-between shadow-sm hover:shadow-md transition"
      >
        Nenhuma entrega disponível
      </div>
    </template>

    <!-- Delivery -->
    <template #delivery-cards>
      <TransitionGroup
        name="fade"
        tag="div"
        class="space-y-2 relative"
      >
        <DeliveryCard
          @loadDataCards="getLoadingDataCards"
          v-for="delivery in deliveries.slice(0, 3)"
          :key="delivery.id"
          :title="`#${delivery.tracking_code} - ${delivery.delivery_address}`"
          :client="delivery.customer_name || 'Cliente não informado'"
          :type="delivery.type || 'N/A'"
          :deliveryId="delivery.id"
          class="w-full"
        />
      </TransitionGroup>
    </template>

    <!-- History -->
    <template #history-cards>
      <TransitionGroup
        name="fade"
        tag="div"
        class="space-y-2 relative"
      >
        <HistoryCard
          v-for="history in histories.slice(0, 4)" 
          :key="history.id"
          :title="`#${history.tracking_code} - ${history.delivery_address}`" 
          :status="history.status.name"
          :color="history.status.color"
          class="w-full"
        />
      </TransitionGroup>
    </template>
  </MainLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { deliveryApi } from '@/api/Api'
import { useAlert } from '@/utils/alert.js'

import MainLayout from '@/layouts/MainLayout.vue'
import DashboardCard from '@/components/Dashboard/DashboardCard.vue'
import DeliveryCard from '@/components/Delivery/DeliveryCard.vue'
import HistoryCard from '@/components/History/HistoryCard.vue'

const { error } = useAlert()
const cards = ref([])
const deliveries = ref([])
const histories = ref([])

const statusIcons = {
  'Pendente': ['fas', 'clock'],
  'Em Rota': ['fas', 'route'],
  'Entregue': ['fas', 'thumbs-up'],
  'Cancelado': ['fas', 'thumbs-down']
}

const getDashboardData = async () => {
  try {
    const { data } = await deliveryApi.get('/deliveries/dashboard')
    cards.value = data.data
  } catch (msgError) {
    error(msgError)
  }
}

const getAvailableDeliveries = async () => {
  try {
    const { data } = await deliveryApi.get('/deliveries/available')
    deliveries.value = data.data.data
  } catch (msgError) {
    error(msgError)
  }
}

const getDeliveryHistory = async () => {
  try {
    const { data } = await deliveryApi.get('/deliveries/history')
    histories.value = data.data.data
  } catch (msgError) {
    error(msgError)
  }
}

const getLoadingDataCards = async () => {
  try {
    await Promise.all([
      getDashboardData(),
      getAvailableDeliveries(),
      getDeliveryHistory()
    ])
  } catch (e) {
    error(e)
  }
}

onMounted(() => {
  getLoadingDataCards()
})
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 1.5s ease; /* mais lento */
}

.fade-enter-from {
  opacity: 0;
  transform: translateY(20px);
}

.fade-enter-to {
  opacity: 1;
  transform: translateY(0);
}

.fade-leave-from {
  opacity: 1;
  transform: translateY(0);
}

.fade-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}

.fade-move {
  transition: transform 1.2s ease;
}

/* 🔑 Evita "crescimento" na troca */
.fade-leave-active {
   position: absolute;
  width: 100%;
}
</style>
