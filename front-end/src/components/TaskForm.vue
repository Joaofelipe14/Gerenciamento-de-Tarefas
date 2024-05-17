<template>
  <div class="card">
    <div class="card-header">
      {{ formTitle }}
    </div>
    <div class="card-body">
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label for="taskTitle">Title</label>
          <input   :value="mode === 'edit' ? Task[0].title : ''"  type="text" class="form-control" id="taskTitle" name="taskTitle" required>
        </div>
        <div class="form-group">
          <label for="taskDescription">Description</label>
          <input :value="mode === 'edit' ? Task[0].description : ''" type="text" class="form-control" id="taskDescription"
            name="taskDescription" required>
        </div>
        <div class="text-right mt-3">
          <button type="submit" class="btn btn-primary">{{ submitButtonText }}</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    Task: {
      type: Object, 
    },
    mode: {
      type: String,
      default: 'create'
    },
  
  },
  data() {
    return {
      editedTask:[],
    };
  },
  computed: {
    formTitle() {
      return this.mode === 'create' ? 'Add a New Task' : 'Edit Task';
    },
    submitButtonText() {
      return this.mode === 'create' ? 'Add' : 'Save';
    }
  },
  methods: {
    handleSubmit() {
      this.$emit('submit', this.Task);
    }
  },

};
</script>

<style scoped></style>
