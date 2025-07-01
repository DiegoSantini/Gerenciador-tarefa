<script setup>
import TaskForm from './TaskForm.vue'
const props = defineProps({ task: Object })
const emit = defineEmits(['close'])
</script>

<template>
  <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 shadow-lg w-full max-w-lg relative">
      <h2 class="text-xl font-bold mb-4">
        {{ props.task ? 'Editar Tarefa' : 'Nova Tarefa' }}
      </h2>
      <TaskForm :task="props.task" @close="emit('close')" />
    </div>
  </div>
</template>

<style scoped>
@import url('../../../public/webflow/css/alloy-tests.webflow.css');
</style>
