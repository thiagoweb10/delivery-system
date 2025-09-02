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
      <DeliveryCard title="#12345 - Rua das Flores" client="João Silva" distance="2,5 km"/>
      <DeliveryCard title="#12346 - Av. Paulista" client="Maria Souza" distance="5 km"/>
    </template>

    <template #delivery-pagination>
      <Pagination />
    </template>

    <template #history-cards>
      <HistoryCard title="#12340 - Rua das Acácias" status="Concluída" />
      <HistoryCard title="#12339 - Rua das Laranjeiras" status="Cancelada" />
      <HistoryCard title="#12339 - Rua das Laranjeiras" status="Pendente" />
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

const statusIcons = {
  'Pendente': ['fas', 'clock'],
  'Em Rota': ['fas', 'route'],
  'Entregue': ['fas', 'thumbs-up'],
  'Cancelado': ['fas', 'thumbs-down']
}

const fetchDashboardData = async () => {
  try {
    const { data } = await deliveryApi.get('/deliveries/dashboard')
    cards.value = data.data
  } catch (msgError) {
    error(msgError)
  }
}

onMounted(() => {
  fetchDashboardData()
})
</script>
