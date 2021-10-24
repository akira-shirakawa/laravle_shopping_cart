require('./bootstrap'); 

import './bootstrap'
import Vue from 'vue'
import Index from './components/index'

const app = new Vue({
  el: '#app',
  components: {
    Index,
  }
})