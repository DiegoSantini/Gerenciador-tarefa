<script setup>
defineProps({
  task: Object
})
const emit = defineEmits(['edit', 'delete', 'toggle'])
</script>

<template>
  <div>
    <h3>{{ task.nome }}</h3>
    <h3>{{ task.descricao }}</h3>
    <h3>{{ task.data_limite }}</h3>
    
    <button @click="emit('edit', task)">Editar</button>
    <button @click="emit('delete', task.id)">Excluir</button>
    <button @click="emit('toggle', task.id)">Finalizar</button>
  </div>
</template>
