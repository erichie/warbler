// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import axios from 'axios'
import App from './App'
import router from './router'
import VueSession from 'vue-session'
import bootstrap from 'bootstrap'

// Warbler Components
import WarblerNav from '@/components/WarblerNav'
import WarblerWarble from '@/components/WarblerWarble'

Vue.config.productionTip = false
Vue.prototype.$http = axios.create({
  // baseURL: './server', // prod url
  baseURL: 'http://localhost:8888/dgm3790/warbler/server/', // dev url
  headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
})

Vue.use(VueSession)
Vue.use(bootstrap)

Vue.component('wblr-nav', WarblerNav)
Vue.component('wblr-warble', WarblerWarble)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
