import { createRouter, createWebHistory } from 'vue-router'
import AboutView from '@/views/AboutView.vue'
import DashboardView from '@/views/DashboardView.vue'
import FaqView from '@/views/FaqView.vue'
import LoginView from '@/views/LoginView.vue'
import SignUpView from '@/views/SignUpView.vue'

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
    component: DashboardView
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
  }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
