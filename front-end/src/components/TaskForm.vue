<template>
  <div class="card">
    <div class="card-header">
      {{ formTitle }}
    </div>
    <div class="card-body">
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label for="taskTitle">Title</label>
          <input v-model="editedTask.title" type="text" class="form-control" id="taskTitle" name="taskTitle" required>
        </div>
        <div class="form-group">
          <label for="taskDescription">Description</label>
          <input v-model="editedTask.description" type="text" class="form-control" id="taskDescription"
            name="taskDescription" required>
        </div>
        <div class="text-right mt-3">
          <button type="submit" class="btn btn-primary">{{ submitButtonText }}</button>
          <router-link v-if="mode === 'edit'" to="/tasks" class="btn btn-dark ms-3">Back</router-link>

        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    Task: {
      type: Array,
      default: () => []
    },
    mode: String
  },
  data() {
    return {
      editedTask: {
        title: this.Task.length> 0 ? this.Task[0].title : '',
        description: this.Task.length> 0 ? this.Task[0].description : ''
      }
    };
  },
  computed: {
    formTitle() {
      return this.mode === 'edit' ? 'Edit Task' : 'Add a New Task';
    },
    submitButtonText() {
      return this.mode === 'edit' ? 'Save' : 'Add';
    }
  },
  methods: {
    handleSubmit() {
       this.$emit('form-submitted', this.editedTask);
    },

  }
};
</script>
