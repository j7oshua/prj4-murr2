import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// creates the routes to the different pages
const routes = [
  {
    path: '/',
    redirect: '/login'
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../views/Login.vue')
  },
  {
    path: '/points/:id',
    name: 'Points',
    component: () => import('../views/Points.vue')
  },
  {
<<<<<<< HEAD
=======
    path: '/DriverCollection',
    name: 'DriverCollection',
    component: () => import('../views/DriverCollection.vue')
  },
  {
>>>>>>> master
    path: '/edu',
    name: 'RecyclingArticles',
    component: () => import('../views/RecyclingArticles')
  },
  {
    path: '/edu/articles/:id',
    name: 'Article',
    component: () => import('../views/Article')
<<<<<<< HEAD
  },
  {
    path: '/DriverCollection',
    name: 'Driver Collection',
    component: () => import('../views/DriverCollection')
=======
>>>>>>> master
  }
]
const router = new VueRouter({
  routes
})

export default router
