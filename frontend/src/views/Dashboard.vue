<template>
  <MainLayout>
    <template #dashboard-cards>
      <DashboardCard
        v-for="(card, index) in cards"
        :key="index"
        :title="card.status"
        :count="card.total"
        :color="card.color"
        :icon="statusIcons[card.status] || ['fas', 'circle']"
      />
    </template>

    <template #delivery-cards>
      <DeliveryCard 
        v-for="delivery in deliveries.slice(0, 4)" 
        :key="delivery.id"
        :title="`#${delivery.tracking_code} - ${delivery.delivery_address}`" 
        :client="delivery.customer_name || 'Cliente não informado'" 
        :type="delivery.type || 'N/A'"
      />
    </template>

    <template #delivery-pagination>
      <Pagination />
    </template>

    <template #history-cards>
      
      <HistoryCard
        v-for="history in histories.slice(0, 4)" 
        :key="history.id"
        :title="`#${history.tracking_code} - ${history.delivery_address}`" 
        :status="history.status.name"
        :color="history.status.color"
      />

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
import Pagination from '@/components/Pagination.vue'

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
  } catch (error) {
    error(msgError)
  }
}

onMounted(() => {
  getDashboardData()
  getAvailableDeliveries()
  getDeliveryHistory()
})
</script>
