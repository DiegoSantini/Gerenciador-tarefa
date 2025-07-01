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

<style scoped>
@import url('../../../public/webflow/css/alloy-tests.webflow.css');
</style>
