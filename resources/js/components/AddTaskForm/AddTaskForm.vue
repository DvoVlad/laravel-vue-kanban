<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import type { FormInst } from 'naive-ui'
import { useMessage } from 'naive-ui'
import { useTasksStore } from '@/store/store';
const emit = defineEmits(["sended"]);
const taskStore = useTasksStore();
const message = useMessage();
const formRef = ref<FormInst | null>(null);
const formValue = ref({
    title: '',
    status: '',
    notes: ''
});
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
    const handleSubmit = () => {
        formRef.value?.validate((errors) => {
          if (!errors) {
            const sendData = {...formValue.value};
            axios({
                method: 'post',
                url: '/api/tasks',
                data: sendData
            }).then(() => {
                message.success('Задача создана');
            }).then(() => {
                return axios({
                method: 'get',
                url: '/api/tasks',
                }).then((response) => {
                    taskStore.tasksData = response.data;
                    formValue.value = {
                        title: '',
                        status: '',
                        notes: ''
                    };
                    emit('sended');
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
            @submit.prevent="handleSubmit"
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
                <n-button type="primary" attr-type="submit">
                    Создать задачу
                </n-button>
            </n-form-item>
        </n-form>
    </div>
</template>
