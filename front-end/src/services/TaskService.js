import axiosInstance from './axiosInstance';

class TaskService {
 
  getHeaders() {
    const token = localStorage.getItem('token');

    return {
      'Authorization': `Bearer ${token}`
    };
  }

  fetchTasks() {
    return axiosInstance.get('/tasks', { headers: this.getHeaders() });
  }

  createTask(taskData) {
    return axiosInstance.post('/tasks', taskData, { headers: this.getHeaders() });
  }

  updateTask(taskId, taskData) {
    return axiosInstance.put(`/tasks/${taskId}`, taskData, { headers: this.getHeaders() });
  }

  deleteTask(taskId) {
    return axiosInstance.delete(`/tasks/${taskId}`, { headers: this.getHeaders() });
  }

  getTaskByTaskyd(taskId) {
    return axiosInstance.get(`/task_id/${taskId}`, { headers: this.getHeaders() });
  }
}

export default new TaskService();
