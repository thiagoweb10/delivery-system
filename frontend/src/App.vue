<template>
  <div class="flex flex-col min-h-screen bg-gray-100">
    <!-- Header fixo -->
    <header class="h-12 bg-white flex items-center justify-between px-6 shadow-sm border-b">
      <span class="font-bold text-[#0a66c2] text-lg">DeliverySys</span>
      <div class="flex items-center gap-4">
        <button class="relative p-2 rounded-full hover:bg-gray-100">
          🔔
          <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>
        <img src="https://i.pravatar.cc/40" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-[#0a66c2]" />
      </div>
    </header>

    <!-- Conteúdo central -->
    <main class="flex-1 overflow-y-auto p-6 flex justify-center">
      <div class="w-full max-w-6xl flex flex-col gap-6">

        <!-- Dashboard Cards -->
        <section class="flex gap-4 overflow-x-auto">
          <div class="min-w-[140px] bg-white rounded-lg shadow p-4 flex flex-col items-center border-t-4 border-yellow-500 hover:shadow-lg transition">
            <div class="text-yellow-500 text-2xl mb-2">⏳</div>
            <p class="text-sm text-gray-500">Pendentes</p>
            <p class="text-2xl font-bold text-yellow-500 mt-1">4</p>
          </div>

          <div class="min-w-[140px] bg-white rounded-lg shadow p-4 flex flex-col items-center border-t-4 border-blue-700 hover:shadow-lg transition">
            <div class="text-blue-700 text-2xl mb-2">🚚</div>
            <p class="text-sm text-gray-500">Em Rota</p>
            <p class="text-2xl font-bold text-blue-700 mt-1">2</p>
          </div>

          <div class="min-w-[140px] bg-white rounded-lg shadow p-4 flex flex-col items-center border-t-4 border-green-500 hover:shadow-lg transition">
            <div class="text-green-500 text-2xl mb-2">✅</div>
            <p class="text-sm text-gray-500">Concluídas</p>
            <p class="text-2xl font-bold text-green-500 mt-1">8</p>
          </div>

          <div class="min-w-[140px] bg-white rounded-lg shadow p-4 flex flex-col items-center border-t-4 border-red-500 hover:shadow-lg transition">
            <div class="text-red-500 text-2xl mb-2">❌</div>
            <p class="text-sm text-gray-500">Canceladas</p>
            <p class="text-2xl font-bold text-red-500 mt-1">1</p>
          </div>

          <div class="min-w-[140px] bg-white rounded-lg shadow p-4 flex flex-col items-center border-t-4 border-[#0a66c2] hover:shadow-lg transition">
            <div class="text-[#0a66c2] text-2xl mb-2">📊</div>
            <p class="text-sm text-gray-500">Total Hoje</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">15</p>
          </div>
        </section>

        <!-- Seções lado a lado: Entregas e Histórico -->
        <div class="flex flex-col lg:flex-row gap-6 mt-2">

          <!-- Entregas Disponíveis -->
          <section class="flex-1 bg-white rounded-lg shadow p-4 flex flex-col gap-4">
            <div class="flex justify-between items-center mb-2">
              <h2 class="text-lg font-semibold text-gray-800">Entregas Disponíveis</h2>
              <button class="w-8 h-8 flex items-center justify-center bg-[#0a66c2] rounded-full hover:bg-blue-800 transition">
                <span class="text-white font-bold">➔</span>
              </button>
            </div>

            <div class="flex flex-col gap-3">
              <div class="flex justify-between items-center p-4 rounded-lg hover:bg-gray-50 transition shadow-sm border relative">
                <div>
                  <p class="font-semibold text-gray-800">#12345 - Rua das Flores</p>
                  <p class="text-sm text-gray-500">Cliente: João Silva | Distância: 2,5 km</p>
                  <p class="text-sm text-gray-500">ETA: 15 min</p>
                  <p class="text-sm text-gray-500 italic">Observação: Portão fechado</p>
                </div>
                <button class="bg-[#0a66c2] text-white px-4 py-2 rounded hover:bg-blue-800 transition">Aceitar</button>
              </div>

              <div class="flex justify-between items-center p-4 rounded-lg hover:bg-gray-50 transition shadow-sm border relative">
                <div>
                  <p class="font-semibold text-gray-800">#12346 - Av. Paulista</p>
                  <p class="text-sm text-gray-500">Cliente: Maria Souza | Distância: 5 km</p>
                  <p class="text-sm text-gray-500">ETA: 25 min</p>
                </div>
                <button class="bg-[#0a66c2] text-white px-4 py-2 rounded hover:bg-blue-800 transition">Aceitar</button>
              </div>
            </div>

            <!-- Paginação com botões circulares -->
            <div class="flex justify-center items-center gap-2 mt-4">
              <button class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition">◀</button>
              <button class="w-8 h-8 flex items-center justify-center bg-[#0a66c2] text-white rounded-full hover:bg-blue-800 transition">1</button>
              <button class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition">2</button>
              <button class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition">3</button>
              <button class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-700 rounded-full hover:bg-gray-300 transition">▶</button>
            </div>
          </section>

          <!-- Histórico de Entregas -->
          <section class="flex-1 bg-white rounded-lg shadow p-4 flex flex-col gap-4">
            <div class="flex justify-between items-center mb-2">
              <h2 class="text-lg font-semibold text-gray-800">Histórico de Entregas</h2>
              <button class="w-8 h-8 flex items-center justify-center bg-[#0a66c2] rounded-full hover:bg-blue-800 transition">
                <span class="text-white font-bold">➔</span>
              </button>
            </div>

            <div class="flex flex-col gap-3">
              <div class="flex justify-between items-center p-4 rounded-lg hover:bg-gray-50 transition shadow-sm border">
                <div class="flex items-center gap-2">
                  <span class="text-green-600 text-xl">✅</span>
                  <p class="font-semibold text-gray-800">#12340 - Rua das Acácias</p>
                </div>
                <span class="text-sm text-green-600 font-medium">Concluída</span>
              </div>

              <div class="flex justify-between items-center p-4 rounded-lg hover:bg-gray-50 transition shadow-sm border">
                <div class="flex items-center gap-2">
                  <span class="text-red-500 text-xl">❌</span>
                  <p class="font-semibold text-gray-800">#12339 - Rua das Laranjeiras</p>
                </div>
                <span class="text-sm text-red-500 font-medium">Cancelada</span>
              </div>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>
</template>
