import { defineStore } from 'pinia'
import { ref } from 'vue';

interface ITask {
    id: number;
    title: string;
    status: string;
    notes: string;
    number: number;
}
interface ITasksData {
    created: ITask[];
    inwork: ITask[];
    onreview: ITask[];
    done: ITask[];
}

export const useTasksStore = defineStore('tasks', () => {
    const tasksData = ref<ITasksData>(
        {
            created: [],
            inwork: [],
            onreview: [],
            done: []
        }
    );

    return { tasksData }
  })
