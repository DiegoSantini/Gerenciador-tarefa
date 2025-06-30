<script setup>
import { ref, watch } from 'vue'
import { useTaskStore } from '@/stores/task'

const emit = defineEmits(['close'])
const props = defineProps({ task: Object })
const store = useTaskStore()

const form = ref({
  nome: '',
  descricao: '',
  data_limite: ''
})

watch(() => props.task, (newVal) => {
  if (newVal) {
    form.value = {
      nome: newVal.nome,
      descricao: newVal.descricao,
      data_limite: newVal.data_limite?.slice(0, 16) ?? ''
    }
  } else {
    form.value = { nome: '', descricao: '', data_limite: '' }
  }
}, { immediate: true })

async function submit() {
  if (props.task?.id) {
    await store.updateTask(props.task.id, form.value)
  } else {
    await store.createTask(form.value)
  }
  emit('close')
}
</script>

<template>
  <form @submit.prevent="submit" class="flex flex-col gap-3">
    <label>
      <span class="block font-semibold">Nome *</span>
      <input v-model="form.nome" required class="border p-2 rounded w-full" />
    </label>

    <label>
      <span class="block font-semibold">Descrição</span>
      <textarea v-model="form.descricao" class="border p-2 rounded w-full"></textarea>
    </label>

    <label>
      <span class="block font-semibold">Data limite</span>
      <input v-model="form.data_limite" type="datetime-local" class="border p-2 rounded w-full" />
    </label>

    <div class="flex justify-end gap-2 mt-4">
      <button type="button" @click="$emit('close')" class="text-gray-600">Cancelar</button>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        {{ props.task ? 'Atualizar' : 'Criar' }}
      </button>
    </div>
  </form>
</template>
