<template>
  <Navbar />
  <div class=" task card-body ms-5 me-5">

    <h3>Tasks -
      <button v-if="!showForm" @click="toggleForm"> click here to add a new task <font-awesome-icon
          :icon="['fas', 'plus']" /></button>
      <button v-else @click="toggleForm">minimize new task box <font-awesome-icon :icon="['fas', 'minus']" /></button>
    </h3>

    <task-form v-if="showForm" mode="create" @submit="createTask" />

    <div class="card mt-3 ">
      <h3>Tasks List</h3>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">
                  #
                </th>
                <th>
                  Task title
                </th>
                <th>
                  Tasks description
                </th>
                <th>
                  dt create
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in Tasks" v-bind:key="task.id">
                <td>
                  {{ task.id }}
                </td>
                <td>
                  {{ task.title }}
                </td>
                <td>
                  {{ task.description }}
                </td>
                <td>
                  {{ task.created_at }}
                </td>
                <td>
                  <a class="icon">
                    <i>
                      <font-awesome-icon :icon="['fa', 'fa-star']">
                      </font-awesome-icon>
                    </i>


                  </a>

                  <a class="icon">
                    <i v-on:click="onDelete(task.id)">
                      <font-awesome-icon :icon="['fa', 'fa-trash']"></font-awesome-icon>
                    </i>

                  </a>
                  <router-link
                   :to="{ name: 'TaskEdit',params: { id: task.id, taskData: task }}
                  " class="icon">
                    <i>
                      <font-awesome-icon :icon="['fa', 'fa-pencil']"></font-awesome-icon>
                    </i>
                  </router-link>
                </td>

              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <div>
  </div>

  <Footer />

</template>
<script>
/* eslint-disable */

import Navbar from './Navbar.vue'
import Footer from './Footer.vue'
import TaskForm from '@/components/TaskForm.vue';

import TaskService from '../services/TaskService';
import { showConfirmation, showError, showSuccess } from '@/components/utils/alertHandler.js'


export default {
  name: 'Tasks',
  components: {
    Navbar,
    Footer,
    TaskForm
  },
  data() {
    return {
      showForm: true,
      Tasks: []
    }
  },
  created() {
    TaskService.fetchTasks()
      .then(response => {
        console.log(response.data.data);
        this.Tasks = response.data.data;
      })

  },
  methods: {
    async onDelete(id) {

      const confirmed = await showConfirmation('Are you sure you want to perform this action?');

      if (confirmed) {
        TaskService.deleteTask(id)
          .then(response => {
            console.log('Tarefa criada:', response.data);
            this.Tasks = this.Tasks.filter(task => task.id !== id);
            showSuccess('Task deleted')
          })
          .catch(error => {
            console.error('Erro ao criar a tarefa:', error);
            showError('Deleted fail')
          });
      } 


    },
    toggleForm() {
      this.showForm = !this.showForm;
    },
    createTask(taskData) {
      console.log('executando butao')

      try {
        // Chamando o método createTask do seu serviço de tarefas
        TaskService.createTask(taskData)
          .then(response => {
            console.log('Tarefa criada:', response.data);
          })
          .catch(error => {
            console.error('Erro ao criar a tarefa:', error);
          });
      } catch (error) {
        console.error('Erro ao criar a tarefa:', error);
      }
    },
    provide() {
      //sending data to any child component
      return {
        posts: this.Tasks,
      };
    },

  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin-left: 20px;
  margin-top: 30px;
  margin-bottom: 20px;
}

.icon {
  margin-right: 10px;
}

.icon i {
  cursor: pointer;
}

.task {
  height: 100vh;
}

button {
  background: transparent;
  border: none;
  padding: 0;
  font: inherit;
  cursor: pointer
}
</style>