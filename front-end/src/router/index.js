import { createRouter, createWebHistory } from 'vue-router'
import TasksIndex from '@/components/Task/TasksIndex'
import LoginPage from '@/components/LoginPage'
import TaskEdit from '@/components/Task/TaskEdit'
import { getAuth, onAuthStateChanged } from 'firebase/auth';

const routes = [
  {
    path: '/',
    name: 'LoginPage',
    component: LoginPage
  },
  {
    path: '/Login',
    name: 'LoginPage',
    component: LoginPage
  },
  {
    path: '/tasks',
    name: 'Tasks',
    component: TasksIndex,
    props: true,
    meta: { requiresAuth: true }
  },
  {
    path: '/tasks/:id/edit',
    name: 'TaskEdit',
    component: TaskEdit,
    props: true,
    meta: { requiresAuth: true }
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const auth = getAuth();

  if (requiresAuth) {
    onAuthStateChanged(auth, (user) => {
      if (!user) {
        next('/login');
      } else {
        next();
      }
    });
  } else {
    next();
  }
});

export default router