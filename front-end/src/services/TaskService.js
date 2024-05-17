import axiosInstance from './axiosInstance';

const headers = {
  'Authorization': `Bearer ${localStorage.getItem('token')}`
};

class TaskService {
 
  fetchTasks() {
    return axiosInstance.get('/tasks', { headers });
  }

  createTask(taskData) {
    console.log( 'executando ...')
    return axiosInstance.post('/tasks', taskData, { headers });
  }

  updateTask(taskId, taskData) {
    return axiosInstance.put(`/tasks/${taskId}`, taskData, { headers });
  }

  deleteTask(taskId) {
    return axiosInstance.delete(`/tasks/${taskId}`, { headers });
  }

  getTaskByTaskyd(taskId) {
  console.log(taskId)
    return axiosInstance.get(`/task_id/${taskId}`, { headers });
  }
}

export default new TaskService();
