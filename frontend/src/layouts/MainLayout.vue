<template>
  <!-- Linha azul fixa no topo -->
  <div class="fixed top-0 left-0 w-full h-1 bg-[#0a66c2] z-50"></div>

  <div class="flex flex-col min-h-screen bg-gray-100 overflow-hidden pt-2">
    <Header />

    <main class="flex-1 p-6 flex justify-center">
      <div class="w-full max-w-6xl flex flex-col gap-6">
        <slot />
      </div>
    </main>

    <BottomNav />
  </div>
</template>
<script setup>
import Header from '@/components/Header.vue'
import BottomNav from "@/components/BottomNav.vue"
</script>
