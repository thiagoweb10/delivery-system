<template>
  <MainLayout>
   Teste Thiago o brabo.
  </MainLayout>
</template>

<script setup>
import { ref } from 'vue'
import { deliveryApi } from '@/api/Api'
import { useAlert } from '@/utils/alert.js'

import MainLayout from '@/layouts/MainLayout.vue'

const { error } = useAlert()
const cards = ref([])
const deliveries = ref([])
const histories = ref([])

</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: all 1.5s ease;
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

.fade-leave-active {
   position: absolute;
  width: 100%;
}
</style>
