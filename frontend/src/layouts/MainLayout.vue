<template>
  <div class="w-full h-1 bg-[#0a66c2]"></div>
  <div class="flex flex-col min-h-screen bg-gray-100">
    <Header />

    <main class="flex-1 overflow-y-auto p-6 flex justify-center">
      <div class="w-full max-w-6xl flex flex-col gap-6">
        <!-- Dashboard -->
        <Dashboard>
          <template #cards>
            <slot name="dashboard-cards" />
          </template>
        </Dashboard>

        <!-- Seções de Entregas e Histórico -->
        <div class="flex flex-col lg:flex-row gap-6 mt-2">
          <DeliveryList>
            <template #cards>
              <slot name="delivery-cards" />
            </template>

            <!-- 
            <template #pagination>
              <slot name="delivery-pagination" />
            </template>
            -->
          </DeliveryList>

          <HistoryList>
            <template #cards>
              <slot name="history-cards" />
            </template>
          </HistoryList>
        </div>

        <!-- Banner Publicidade -->
        <div class="flex flex-col lg:flex-row gap-6 mt-2">
          <Banner />
        </div>
      </div>

      
    </main>
    
     <!-- Mobile -->
    <BottomNav />

  </div>
</template>

<script setup>
import { ref } from "vue"

const notificationCount = ref(3) 

import Header from '@/components/Header.vue'
import Dashboard from '@/components/Dashboard/Dashboard.vue'
import DeliveryList from '@/components/Delivery/DeliveryList.vue'
import HistoryList from '@/components/History/HistoryList.vue'
import Banner from "@/components/Banner.vue"
import BottomNav from "@/components/BottomNav.vue"
</script>
