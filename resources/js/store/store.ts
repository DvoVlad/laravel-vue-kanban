import { defineStore } from 'pinia'
import { ref } from 'vue';

export const useTasksStore = defineStore('tasks', () => {
    const tasksData = ref(
        {
            created: [],
            inwork: [],
            onreview: [],
            done: []
        }
    );

    return { tasksData }
  })
