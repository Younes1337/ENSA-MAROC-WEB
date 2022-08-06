import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import { mdiAccount } from '@mdi/js'
import '@mdi/font/css/materialdesignicons.css'


Vue.use(Vuetify, {
  theme: {
    primary: '#83253D',
    secondary: '#E74B22',
    anyColor: '#0000'
  }
})

const opts = {
  icons: {
    iconfont: 'mdiSvg',
  },
}

export default new Vuetify(opts)