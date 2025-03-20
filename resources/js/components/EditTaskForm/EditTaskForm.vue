<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue';
import axios from 'axios';
import type { FormInst } from 'naive-ui'
import { useMessage } from 'naive-ui'
import { useTasksStore } from '@/store/store';
const props = defineProps({
  id: Number
})
const taskStore = useTasksStore();
const message = useMessage();
const formRef = ref<FormInst | null>(null);
const formValue = ref({
    title: '',
    status: '',
    notes: ''
});
onMounted(() => {
    axios({
        method: 'get',
        url: `/api/tasks/${props.id}`,
    }).then((response) => {
        formValue.value = response.data;
    })
})
const rules = ref(
    {
        title: {
            required: true,
            message: 'Please input your name',
            trigger: 'blur'
        },
        status: {
            required: true,
            message: 'Please chose status',
            trigger: ['input', 'blur']
        }
    })
    const handleValidateClick = (e: MouseEvent) => {
        e.preventDefault()
        formRef.value?.validate((errors) => {
          if (!errors) {
            const sendData = {...formValue.value};
            axios({
                method: 'put',
                url: `/api/tasks/${props.id}`,
                data: sendData
            }).then(() => {
                message.success('Задача отредактирована');
            }).then(() => {
                return axios({
                method: 'get',
                url: '/api/tasks',
                }).then((response) => {
                    taskStore.tasksData = response.data;
                });
            });

          }
          else {
            message.error('Не валидные поля')
          }
        })
    }
    const options = [
        {
            label: 'Укажите статус',
            value: ''
        },
        {
          label: 'Создана',
          value: 'created',
        },
        {
          label: 'В работе',
          value: 'inwork'
        },
        {
          label: 'На ревью',
          value: 'onreview'
        },
        {
          label: 'Готова',
          value: 'done'
        },
      ]
</script>

<template>
    <div>
        <n-form
            ref="formRef"
            :label-width="80"
            :model="formValue"
            :rules="rules"
            size="medium"
            >
            <n-form-item label="Название задачи" path="title">
                <n-input v-model:value="formValue.title" placeholder="Input Name" />
            </n-form-item>
            <n-form-item label="Статус" path="status">
                <n-select v-model:value="formValue.status" :options="options" />
            </n-form-item>
            <n-form-item label="Заметки" path="notes">
                <n-mention
                    v-model:value="formValue.notes"
                    type="textarea"
                />
            </n-form-item>
            <n-form-item>
                <n-button @click="handleValidateClick">
                    Редактировать задачу
                </n-button>
            </n-form-item>
        </n-form>
    </div>
</template>
