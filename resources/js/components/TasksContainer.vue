<script setup>
import { onMounted, ref } from 'vue'
import { useTaskStore } from '@/stores/task'
import TaskForm from './TaskForm.vue'
import TaskItem from './TaskItem.vue'
import TaskModal from './TaskModal.vue'

const taskStore = useTaskStore()
const showModal = ref(false)
const editingTask = ref(null)

onMounted(() => {
  taskStore.fetchTasks()
})

const openModal = (task = null) => {
  editingTask.value = task
  showModal.value = true
}
</script>

<template>
  <div class="p-4 max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Minhas Tarefas</h2>
      <button @click="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded">+ Nova</button>
    </div>

    <div v-if="taskStore.loading" class="text-gray-500">Carregando tarefas...</div>
    <div v-else>
      <TaskItem
        v-for="task in taskStore.tasks"
        :key="task.id"
        :task="task"
        @edit="openModal"
        @delete="taskStore.deleteTask"
        @toggle="taskStore.toggleTask"
      />
    </div>

    <TaskModal
      v-if="showModal"
      :task="editingTask"
      @close="showModal = false"
    />
  </div>
</template>
