import Vue from 'vue'
import App from './App.vue'
import BootstrapVue from 'bootstrap-vue'
import Router from "./routes";
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './vee-validate';
import axios from 'axios';

Vue.use(BootstrapVue)
// Vue.use(axios)


new Vue({
  el: '#app',
  render: h => h(App),
  router: Router,
})


