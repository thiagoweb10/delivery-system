<template>
  <div
    class="flex flex-col sm:flex-row justify-between items-start p-4 rounded-lg shadow-sm border transition bg-blue-50 sm:bg-white hover:shadow-md relative gap-2"
  >
    <div class="flex-1">
      <p class="font-semibold text-gray-800">{{ title }}</p>
      <p class="text-sm text-gray-500">Cliente: {{ client }} | Distância: {{ distance }}</p>
    </div>
    <button
      class="bg-[#0a66c2] font-bold text-white px-4 py-2 rounded-md hover:bg-blue-800 transition w-full sm:w-auto mt-2 mx-auto sm:mx-0"
    >
      R$ 200,00
    </button>
  </div>
</template>





<script setup>
defineProps({
  title: String,
  client: String,
  distance: String
})
</script>
