<template>
  <Navbar />
  <div class="card-body mt-5 ms-5 me-5">
    <div v-if="loaded">
      <h3>Task details</h3>

      <div class="card">
        <task-form :Task="Task" mode="edit" @submit="handleEdit" />
      </div>
    </div>
    <div v-else>
      <h3>Loading...</h3>
    </div>
  </div>

  <Footer />\

</template>

<script>

import Navbar from './Navbar.vue'
import Footer from './Footer.vue'
import TaskForm from '@/components/TaskForm.vue';
import TaskService from '../services/TaskService';


export default {
  /* eslint-disable */
  name: 'TaskEdit',
  components: {
    Navbar,
    Footer,
    TaskForm
  },
  data() {
    return {
      productId: '',
      productName: '',
      productPrice: '',
      loaded: true,
      Task: []
    }
  },
  props: {
    id: String
  },
  methods: {
    handleEdit(editedTask) {
      console.log('Tarefa editada:', editedTask);
    }
  },
  created() {
    const taskId = this.$route.params.id;

    TaskService.getTaskByTaskyd(taskId)
      .then(response => {
        this.Task = response.data.data;
      }).catch(error => {
        console.error('Erro ao criar a tarefa:', error);
      });
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>