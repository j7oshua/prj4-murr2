import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: () => import(/* webpackChunkName: "home" */ '@/views/Home.vue')
  },
  {
    path: '/educational-information',
    name: 'Educational Information',
    component: () => import(/* webpackChunkName: "educational-information" */ '@/views/EducationalInformation.vue')
  }
]

const router = new VueRouter({
  routes
})

export default router
