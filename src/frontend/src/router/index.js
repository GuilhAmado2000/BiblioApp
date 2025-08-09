import { createRouter, createWebHistory } from 'vue-router'
import AboutView from '@/views/AboutView.vue'
import DashboardView from '@/views/DashboardView.vue'
import FaqView from '@/views/FaqView.vue'
import LoginView from '@/views/LoginView.vue'
import SignUpView from '@/views/SignUpView.vue'
import StatisticsView from '@/views/StatisticsView.vue'
import BookManagementView from '@/views/BookManagementView.vue'

const routes = [
  {
    path: '/refresh-temp',
    name: 'RefreshTemp',
    component: {
      template: '<div></div>'
    }
  },
  {
    path: '/',
    name: 'Dashboard',
    component: DashboardView,
    meta: { requiresAuth: true },
  },
  {
    path: '/about',
    name: 'About',
    component: AboutView
  },
  {
    path: '/faq',
    name: 'Faq',
    component: FaqView
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginView
  },
  {
    path: '/sign_up',
    name: 'SignUp',
    component: SignUpView
  },
  {
    path: '/book-management',
    name: 'BookManagement',
    component: BookManagementView,
    meta: { requiresAuth: true },
  },
  {
    path: '/statistics',
    name: 'Statistics',
    component: StatisticsView,
    meta: { requiresAuth: true },
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
