<script setup>
const props = defineProps(['task'])
const emit = defineEmits(['edit', 'delete', 'toggle'])

function formatDate(dateStr) {
  return dateStr ? new Date(dateStr).toLocaleString('pt-BR') : 'Sem data'
}
</script>

<template>
  <div class="bg-white shadow rounded p-4 mb-3 flex justify-between items-start">
    <div>
      <h3 :class="['text-lg font-bold', task.finalizado ? 'line-through text-gray-400' : '']">
        {{ task.nome }}
      </h3>
      <p class="text-sm text-gray-600">{{ task.descricao || 'Sem descrição' }}</p>
      <p class="text-xs text-gray-400">Limite: {{ formatDate(task.data_limite) }}</p>
    </div>

    <div class="flex gap-2">
      <button @click="$emit('toggle', task.id)" class="text-green-600 hover:underline">
        {{ task.finalizado ? 'Desfazer' : 'Finalizar' }}
      </button>
      <button @click="$emit('edit', task)" class="text-blue-600 hover:underline">Editar</button>
      <button @click="$emit('delete', task.id)" class="text-red-600 hover:underline">Excluir</button>
    </div>
  </div>
</template>
