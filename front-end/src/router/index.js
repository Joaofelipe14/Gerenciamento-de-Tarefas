import { createRouter, createWebHistory } from 'vue-router'
import Tasks from '@/components/Tasks'
import LoginPage from '@/components/LoginPage'
import TaskEdit from '@/components/TaskEdit'
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
    component: Tasks,
    props: true,
    meta: { requiresAuth: true }


  },
  {
    path: '/TaskEdit/:id',
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