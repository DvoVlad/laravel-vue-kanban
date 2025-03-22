<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { useTasksStore } from '@/store/store';
import { VueDraggableNext as draggable } from 'vue-draggable-next'
import axios from 'axios';

import AddTaskForm from '@/components/AddTaskForm/AddTaskForm.vue';
import EditTaskForm from '@/components/EditTaskForm/EditTaskForm.vue';
const activeDrawerAdd = ref(false);
const taskStore = useTasksStore();
const activateDrawerAdd = () => {
    activeDrawerAdd.value = true;
}

const chosenToEditId = ref(0);
const activeDrawerEdit = ref(false);
const activateDrawerEdit = (id:number) => {
    activeDrawerEdit.value = true;
    chosenToEditId.value = id;
}

const deleteTask = (id: number) => {
    axios({
    method: 'delete',
    url: `/api/tasks/${id}`,
    })
    .then(() => {
        return axios({
            method: 'get',
            url: '/api/tasks',
        }).then((response) => {
            taskStore.tasksData = response.data;
        });
    });
}

const updateTasksKanban = () => {
    axios({
        method: 'patch',
        url: '/api/tasks',
        data: {
            data: taskStore.tasksData
        }
    })
}

const closeFormAdd = () => {
    activeDrawerAdd.value = false;
}

const closeFormEdit = () => {
    activeDrawerEdit.value = false;
}

onMounted(() => {
    axios({
    method: 'get',
    url: '/api/tasks',
    }).then((response) => {
        taskStore.tasksData = response.data;
    });
});
</script>

<template>
    <n-message-provider>
        <Head title="Welcome to Kanban!">
        </Head>
        <div class="container">
            <n-button type="primary" @click="activateDrawerAdd()">
            Add task
            </n-button>
            <h1>Канбан</h1>
            <n-drawer v-model:show="activeDrawerAdd" placement="right">
                <n-drawer-content title="Добавить задачу">
                    <add-task-form @sended="closeFormAdd"></add-task-form>
                </n-drawer-content>
            </n-drawer>
        </div>
        <div class="box">
            <div class="kanbanColumn">
                <h2>Создано</h2>
                <draggable class="kanbanArea" :list="taskStore.tasksData.created" group="task" @change="updateTasksKanban">
                    <div
                        class="kanbanCard"
                        v-for="element in taskStore.tasksData.created"
                        :key="element.id"
                    >
                        {{ element.title }} #{{ element.id }}
                        <p v-if="element.notes">Заметки: {{ element.notes }}</p>
                        <n-divider />
                        <div class="buttonsGroup">
                            <n-button type="primary" ghost @click="activateDrawerEdit(element.id)">
                                Edit task
                            </n-button>
                            <n-button ghost color="#ff0000" @click="deleteTask(element.id)">
                                Delete task
                            </n-button>
                        </div>
                        <n-drawer v-if="chosenToEditId === element.id" v-model:show="activeDrawerEdit" placement="right">
                            <n-drawer-content title="Редактировать задачу">
                                <edit-task-form @sended="closeFormEdit" :id="element.id"></edit-task-form>
                            </n-drawer-content>
                        </n-drawer>
                    </div>
                </draggable>
            </div>
            <div class="kanbanColumn">
                <h2>В работе</h2>
                <draggable class="kanbanArea" :list="taskStore.tasksData.inwork" group="task" @change="updateTasksKanban">
                    <div
                        class="kanbanCard"
                        v-for="element in taskStore.tasksData.inwork"
                        :key="element.id"
                    >
                        {{ element.title }} #{{ element.id }}
                        <p v-if="element.notes">Заметки: {{ element.notes }}</p>
                        <n-divider />
                        <div class="buttonsGroup">
                            <n-button type="primary" ghost @click="activateDrawerEdit(element.id)">
                                Edit task
                            </n-button>
                            <n-button ghost color="#ff0000" @click="deleteTask(element.id)">
                                Delete task
                            </n-button>
                        </div>
                        <n-drawer v-if="chosenToEditId === element.id" v-model:show="activeDrawerEdit" placement="right">
                            <n-drawer-content title="Редактировать задачу">
                                <edit-task-form @sended="closeFormEdit" :id="element.id"></edit-task-form>
                            </n-drawer-content>
                        </n-drawer>
                    </div>
                </draggable>
            </div>
            <div class="kanbanColumn">
                <h2>На ревью</h2>
                <draggable class="kanbanArea" :list="taskStore.tasksData.onreview" group="task" @change="updateTasksKanban">
                    <div
                        class="kanbanCard"
                        v-for="element in taskStore.tasksData.onreview"
                        :key="element.id"
                    >
                        {{ element.title }} #{{ element.id }}
                        <p v-if="element.notes">Заметки: {{ element.notes }}</p>
                        <n-divider />
                        <div class="buttonsGroup">
                            <n-button type="primary" ghost @click="activateDrawerEdit(element.id)">
                                Edit task
                            </n-button>
                            <n-button ghost color="#ff0000" @click="deleteTask(element.id)">
                                Delete task
                            </n-button>
                        </div>
                        <n-drawer v-if="chosenToEditId === element.id" v-model:show="activeDrawerEdit" placement="right">
                            <n-drawer-content title="Редактировать задачу">
                                <edit-task-form @sended="closeFormEdit" :id="element.id"></edit-task-form>
                            </n-drawer-content>
                        </n-drawer>
                    </div>
                </draggable>
            </div>
            <div class="kanbanColumn">
                <h2>Сделано</h2>
                <draggable class="kanbanArea" :list="taskStore.tasksData.done" group="task" @change="updateTasksKanban">
                    <div
                        class="kanbanCard"
                        v-for="element in taskStore.tasksData.done"
                        :key="element.id"
                    >
                        {{ element.title }} #{{ element.id }}
                        <p v-if="element.notes">Заметки: {{ element.notes }}</p>
                        <n-divider />
                        <div class="buttonsGroup">
                            <n-button type="primary" ghost @click="activateDrawerEdit(element.id)">
                                Edit task
                            </n-button>
                            <n-button ghost color="#ff0000" @click="deleteTask(element.id)">
                                Delete task
                            </n-button>
                        </div>
                        <n-drawer v-if="chosenToEditId === element.id" v-model:show="activeDrawerEdit" placement="right">
                            <n-drawer-content title="Редактировать задачу">
                                <edit-task-form @sended="closeFormEdit" :id="element.id"></edit-task-form>
                            </n-drawer-content>
                        </n-drawer>
                    </div>
                </draggable>
            </div>
        </div>
    </n-message-provider>
</template>

<style scoped>
    .buttonsGroup {
        display: flex;
        justify-content: space-between;
    }
    .kanbanColumn {
        border: 1px solid rgb(123, 205, 238);
        border-radius: 10px;
        padding: 10px;
        min-height: 300px;
        gap: 10px;
        display: flex;
        flex-direction: column;
    }
    .kanbanArea {
        min-height: 300px;
        height: 100%;
        cursor: pointer;
        gap: 20px;
        display: flex;
        flex-direction: column;
    }
    .kanbanCard {
        border: 1px solid rgb(66, 180, 123);
        border-radius: 10px;
        min-height: 100px;
        box-sizing: border-box;
        padding: 10px;
    }
    .box {
        width: 990px;
        margin: 10px auto 0;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 10px;
    }
    .container {
        width: 990px;
        margin: 0 auto;
        padding: 10px;
        box-sizing: border-box;
        display: flex;
        gap: 15px;
        align-items: center;
        border-bottom: 1px solid rgb(123, 205, 238);
    }
    h1 {
        font-size: 30px;
    }
</style>
