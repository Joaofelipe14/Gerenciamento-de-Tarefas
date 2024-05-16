import { createRouter, createWebHistory } from 'vue-router'
import Tasks from '@/components/Tasks'
import LoginPage from '@/components/LoginPage'
import TaskEdit from '@/components/TaskEdit'


const routes = [
    {
      path: '/',
      name: 'LoginPage',
      component: LoginPage
    },
    {
        path: '/tasks',
        name: 'Tasks',
        component: Tasks,
        props:true

      },
      {
        path: '/TaskEdit/:id',
        name: 'TaskEdit',
        component: TaskEdit,
        props:true

      }
  
  ]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
  })
  
  export default router