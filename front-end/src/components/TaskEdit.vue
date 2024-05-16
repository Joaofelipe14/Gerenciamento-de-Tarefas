<template>
  <Navbar />
  <div class="card-body mt-5 ms-5 me-5">
    <div v-if="loaded">
      <h3>Task details</h3>
      
      <div class="card">
        <task-form :task="task" mode="edit" @submit="handleEdit" />
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
      loaded: true
    }
  },
   props: {
    task: Object, // Assuming Tasks is an array of task objects
  },
  methods: {
    handleEdit(editedTask) {
      console.log('Tarefa editada:', editedTask);
    }
  },
  mounted() {
  console.log('Received task:', this.task); // Log the task object
  // ... other initialization code
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