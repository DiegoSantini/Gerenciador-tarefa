import { defineStore } from 'pinia'
import taskService from '../services/taskService'

export const useTaskStore = defineStore('tasks', {
  state: () => ({
    tasks: [],
    loading: false
  }),

  actions: {
    async fetchTasks() {
      this.loading = true
      try {
        const res = await taskService.fetch()
        this.tasks = res.data
      } catch (e) {
        console.error('Erro ao buscar tarefas:', e)
      } finally {
        this.loading = false
      }
    },

    async createTask(task) {
      await taskService.create(task)
      await this.fetchTasks()
    },

    async deleteTask(id) {
  try {
    await taskService.remove(id)
    await this.fetchTasks()
  } catch (error) {
    console.error('Erro ao excluir tarefa:', error.response?.data || error)
  }
},

async toggleTask(id) {
  try {
    await taskService.toggle(id)
    await this.fetchTasks()
  } catch (error) {
    console.error('Erro ao finalizar tarefa:', error.response?.data || error)
  }
},

async updateTask(id, task) {
  try {
    await taskService.update(id, task)
    await this.fetchTasks()
  } catch (error) {
    console.error('Erro ao atualizar tarefa:', error.response?.data || error)
  }
}

  }
})
