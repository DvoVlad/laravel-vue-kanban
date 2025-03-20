import { defineStore } from 'pinia'
import { ref } from 'vue';

export const useTasksStore = defineStore('tasks', () => {
    const tasksData = ref(
        {
            created: [
                { name: 'John', id: 1 },
                { name: 'Joao', id: 2 },
                { name: 'Jean', id: 3 },
                { name: 'Gerard', id: 4 },
            ],
            inwork: [
                { name: 'John2', id: 1 },
                { name: 'Joao2', id: 2 },
                { name: 'Jean2', id: 3 },
                { name: 'Gerard2', id: 4 },
            ],
            onreview: [
                { name: 'John3', id: 1 },
                { name: 'Joao3', id: 2 },
                { name: 'Jean3', id: 3 },
                { name: 'Gerard3', id: 4 },
            ],
            done: [
                { name: 'John4', id: 1 },
                { name: 'Joao4', id: 2 },
                { name: 'Jean4', id: 3 },
                { name: 'Gerard4', id: 4 },
            ]
        }
    );

    return { tasksData }
  })
