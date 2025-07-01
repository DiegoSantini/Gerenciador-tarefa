<script setup>
defineProps({
  task: Object
})
const emit = defineEmits(['edit', 'delete', 'toggle'])

// Função para formatar data
const formatDate = (dateString) => {
  if (!dateString) return ''
  
  const date = new Date(dateString)
  const today = new Date()
  const tomorrow = new Date(today)
  tomorrow.setDate(tomorrow.getDate() + 1)
  
  // Resetar horários para comparação
  const dateOnly = new Date(date.getFullYear(), date.getMonth(), date.getDate())
  const todayOnly = new Date(today.getFullYear(), today.getMonth(), today.getDate())
  const tomorrowOnly = new Date(tomorrow.getFullYear(), tomorrow.getMonth(), tomorrow.getDate())
  
  if (dateOnly.getTime() === todayOnly.getTime()) {
    return 'Hoje'
  } else if (dateOnly.getTime() === tomorrowOnly.getTime()) {
    return 'Amanhã'
  } else {
    const weekdays = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado']
    const weekday = weekdays[date.getDay()]
    const day = date.getDate().toString().padStart(2, '0')
    const month = (date.getMonth() + 1).toString().padStart(2, '0')
    const year = date.getFullYear()
    return `${weekday}, dia ${day}/${month}/${year}`
  }
}
</script>

<template>
  <div class="task">
    <div class="w-checkbox checkbox-field">
      <div 
        class="w-checkbox-input w-checkbox-input--inputType-custom checkbox margin-right-10"
        :class="{ 'checked': task.concluida }"
        @click="emit('toggle', task.id)"
      ></div>
      <input 
        type="checkbox" 
        :checked="task.concluida"
        style="opacity:0;position:absolute;z-index:-1"
      >
      <span 
        class="checkbox-label w-form-label" 
        :class="{ 'checked': task.concluida }"
        @click="emit('toggle', task.id)"
      >
        {{ task.nome }}
      </span>
    </div>
    
    <div class="date-button margin-left-40" v-if="task.data_limite">
      <div>{{ formatDate(task.data_limite) }}</div>
    </div>
    
    <div class="task-details" v-if="task.descricao">
      <div>{{ task.descricao }}</div>
    </div>
    
    <div class="task-actions">
      <button 
        @click="emit('edit', task)"
        class="button outlined rounded small edit-btn"
        title="Editar tarefa"
      >
        <div class="icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13M18.5 2.50001C18.8978 2.10219 19.4374 1.87869 20 1.87869C20.5626 1.87869 21.1022 2.10219 21.5 2.50001C21.8978 2.89784 22.1213 3.4374 22.1213 4.00001C22.1213 4.56262 21.8978 5.10219 21.5 5.50001L12 15L8 16L9 12L18.5 2.50001Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </button>
      
      <button 
        @click="emit('toggle', task.id)"
        class="button outlined rounded small toggle-btn"
        title="Finalizar/Reativar tarefa"
      >
        <div class="icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </button>
      
      <button 
        @click="emit('delete', task.id)"
        class="button outlined rounded small delete-btn"
        title="Excluir tarefa"
      >
        <div class="icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 6V5.2C16 4.0799 16 3.51984 15.782 3.09202C15.5903 2.71569 15.2843 2.40973 14.908 2.21799C14.4802 2 13.9201 2 12.8 2H11.2C10.0799 2 9.51984 2 9.09202 2.21799C8.71569 2.40973 8.40973 2.71569 8.21799 3.09202C8 3.51984 8 4.0799 8 5.2V6M10 11.5V16.5M14 11.5V16.5M3 6H21M19 6V17.2C19 18.8802 19 19.7202 18.673 20.362C18.3854 20.9265 17.9265 21.3854 17.362 21.673C16.7202 22 15.8802 22 14.2 22H9.8C8.11984 22 7.27976 22 6.63803 21.673C6.07354 21.3854 5.6146 20.9265 5.32698 20.362C5 19.7202 5 18.8802 5 17.2V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </button>
    </div>
  </div>
</template>

<style scoped>
@import url('../../../public/webflow/css/alloy-tests.webflow.css');
</style>