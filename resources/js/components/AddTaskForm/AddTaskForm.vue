<script setup lang="ts">
import { ref, onMounted } from 'vue';
import type { FormInst } from 'naive-ui'
import { useMessage } from 'naive-ui'
import Label from '../ui/label/Label.vue';
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
    const handleValidateClick = (e: MouseEvent) => {
        e.preventDefault()
        formRef.value?.validate((errors) => {
          if (!errors) {
            const sendData = {...formValue.value};
            console.log(sendData);
            message.success('Задача создана')
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
          value: 'creared',
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
                    Создать задачу
                </n-button>
            </n-form-item>
        </n-form>
    </div>
</template>
