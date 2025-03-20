import { defineStore } from 'pinia'
import { ref } from 'vue';

export const useTasksStore = defineStore('tasks', () => {
    const tasksData = ref(
        {
            created: [
                { title: 'John', id: 1 },
                { title: 'Joao', id: 2 },
                { title: 'Jean', id: 3 },
                { title: 'Gerard', id: 4 },
            ],
            inwork: [
                { title: 'John2', id: 1 },
                { title: 'Joao2', id: 2 },
                { title: 'Jean2', id: 3 },
                { title: 'Gerard2', id: 4 },
            ],
            onreview: [
                { title: 'John3', id: 1 },
                { title: 'Joao3', id: 2 },
                { title: 'Jean3', id: 3 },
                { title: 'Gerard3', id: 4 },
            ],
            done: [
                { title: 'John4', id: 1 },
                { title: 'Joao4', id: 2 },
                { title: 'Jean4', id: 3 },
                { title: 'Gerard4', id: 4 },
            ]
        }
    );

    return { tasksData }
  })
