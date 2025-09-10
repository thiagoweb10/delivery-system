<template>
  <section
    class="flex-1 bg-transparent sm:bg-white rounded-lg border-0 sm:border shadow-none sm:shadow p-2 sm:p-4 flex flex-col gap-1"
  >
    <div class="flex justify-between items-center mb-1">
      <h2 class="text-base sm:text-lg font-semibold text-gray-800">
        Novas Entregas Disponíveis
      </h2>
      <button
        class="w-8 h-8 flex items-center justify-center bg-[#0a66c2] rounded-full hover:bg-blue-800 transition"
      >
        <span class="text-white font-bold">➔</span>
      </button>
    </div>

    <div class="flex flex-col gap-3">
      <slot name="cards" />
    </div>

    <slot name="pagination" />
  </section>
</template>
