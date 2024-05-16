<template>
  <Navbar />
  <div class=" task card-body ms-5 me-5">

    <h3>Tasks -
       <button v-if="!showForm" @click="toggleForm"> click here to add a new task <font-awesome-icon   :icon="['fas', 'plus']" /></button>
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
              <tr v-for="Tasks in sortedTasks" v-bind:key="Tasks.id">
                <td>
                  {{ Tasks.id }}
                </td>
                <td>
                  {{ Tasks.title }}
                </td>
                <td>
                  {{ Tasks.description }}
                </td>
                <td>
                  {{ Tasks.created_at }}
                </td>
                <td>

                  <a href="#" class="icon">
                    <i v-on:click="onDelete(Tasks.id)">
                      <font-awesome-icon :icon="['fa', 'fa-trash']"></font-awesome-icon>
                    </i>

                  </a>
                  <router-link :to="{
                    name: 'TaskEdit',
                    params: { id: Tasks.id }
                  }" class="icon">
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

export default {
  name: 'Tasks',
  components: {
    Navbar,
    Footer,
    TaskForm
  },
  data() {
    return {
      showForm: false,
      TasksData: {
        'id': '',
        'title': '',
        'description': '',
        'created_at': ''
      },
      Tasks: [
        {
          "id": 1,
          "title": "Task 1",
          "description": "Description of task 1",
          "created_at": "2024-05-15 10:00:00",
          "updated_at": "2024-05-15 10:00:00"
        },
        {
          "id": 2,
          "title": "Task 2",
          "description": "Description of task 2",
          "created_at": "2024-05-15 11:00:00",
          "updated_at": "2024-05-15 11:00:00"
        }]
    }
  },
  computed: {
    sortedTasks() {
      return this.Tasks;
    }
  },
  methods: {
    onSubmit() {
      this.TasksData.id = ''
      this.TasksData.title = ''
      this.TasksData.description = ''

    },
    onDelete(id) {
      console.log('deleta')

    },
    toggleForm() {
      this.showForm = !this.showForm;
    },
    createTask(taskData) {
    }
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