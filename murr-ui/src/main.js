// add libraries
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Vuelidate from 'vuelidate';
import vuelidateErrorExtractor, { templates } from "vuelidate-error-extractor";

// add css
import 'bootstrap/dist/css/bootstrap.css'
// import 'bootswatch/dist/sketchy/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css'

// add libraries to vue context
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueAxios, axios)

Vue.config.productionTip = false
Vue.use(Vuelidate);

Vue.use(vuelidateErrorExtractor, {
  template: templates.multiErrorExtractor.foundation6,
  messages: { firstName: "First Name must not exceed 20 characters",
    lastName: "Last Name must not exceed 20 characters",
    address: "Address must not exceed 50 characters",
    city: "City must not exceed 30 characters",
    province: "Province must not exceed 2 characters",
    postalCode: "Postal Code must follow the format ‘L#L#L#’"
  }
});

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')



