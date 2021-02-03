// add libraries
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// add css
import 'bootstrap/dist/css/bootstrap.css'
// import 'bootswatch/dist/sketchy/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css'
import GlobalMixin from '@/mixins/global-mixin'

// add libraries to vue context
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueAxios, axios)

Vue.config.productionTip = false
Vue.mixin(GlobalMixin)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
