<template>
  <MainLayout>
    <template #dashboard-cards>
      <DashboardCard title="Pendentes"  count="4" :icon="['fas', 'clock']" color="yellow"/>
      <DashboardCard title="Em Rota"    count="2" :icon="['fas', 'route']" color="blue"/>
      <DashboardCard title="Concluídas" count="8" :icon="['fas', 'check']" color="green"/>
      <DashboardCard title="Canceladas" count="1" :icon="['fas', 'thumbs-down']" color="red"/>
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
import MainLayout from '@/layouts/MainLayout.vue'
import DashboardCard from '@/components/Dashboard/DashboardCard.vue'
import DeliveryCard from '@/components/Delivery/DeliveryCard.vue'
import HistoryCard from '@/components/History/HistoryCard.vue'
import Pagination from '@/components/Pagination.vue'
</script>