// resources/js/stores/task.js

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

    async updateTask(id, task) {
      await taskService.update(id, task)
      await this.fetchTasks()
    },

    async deleteTask(id) {
      await taskService.remove(id)
      await this.fetchTasks()
    },

    async toggleTask(id) {
      await taskService.toggle(id)
      await this.fetchTasks()
    }
  }
})
