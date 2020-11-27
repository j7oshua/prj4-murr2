import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/profile',
    name: 'profile',
    component: () => import(/* webpackChunkName: "home" */ '@/views/Profile.vue')
  }
]

const router = new VueRouter({
  routes
})

export default router
