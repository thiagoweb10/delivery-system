<template>
     <div
    class="w-full rounded-lg shadow-md p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-4
           mb-4 sm:mb-0 bg-cover bg-center text-white h-64"
    :style="{ backgroundImage: `url(${bannerImage})` }"
  >
    <!-- Texto do Banner -->
    <div class="flex-1 text-center sm:text-left bg-black/30 p-4 rounded">
      <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-2">
        Novidade na Entrega!
      </h2>
      <p class="text-sm sm:text-base md:text-lg">
        Confira as últimas atualizações do sistema e fique por dentro das novidades.
      </p>
    </div>

    <!-- Botão do Banner -->
    <button class="bg-white text-blue-600 font-semibold px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
      Saiba Mais
    </button>
  </div>
</template>

<script setup>
import bannerImage from '@/assets/img/banner.png' 
</script>

<style scoped>
/* Se quiser, pode adicionar altura mínima para deixar o banner mais chamativo */
div {
  min-height: 200px;
}
</style>
