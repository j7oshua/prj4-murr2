import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  }
  // {
  //   name: 'ProgressPoints',
  //   component: () => import(/* webpackChunkName: "home" */ '../components/ProgressPoints.vue')
  // }
]

const router = new VueRouter({
  routes
})

export default router
