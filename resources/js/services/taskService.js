import axios from 'axios'

const api = axios.create({
  baseURL: '/api' 
})

export default {
  fetch: () => api.get('/tasks'),
  create: (task) => api.post('/tasks', task),
  update: (id, task) => api.put(`/tasks/${id}`, task),
  remove: (id) => api.delete(`/tasks/${id}`),
  toggle: (id) => api.patch(`/tasks/${id}/toggle`)
}
