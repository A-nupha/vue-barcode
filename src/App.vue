<template>
  <div id="app" dark>
       <v-toolbar
      color="blue lighten-1"
      dark
      tabs
    >
   <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>
      <!-- <v-flex>{{time}}</v-flex> -->
      <!-- <span>{{ moment().format('MMMM Do YYYY, h:mm:ss a') }}</span> -->
      </v-toolbar-title>
   </v-toolbar>
   <!-- <LoginApp/> -->
   <transition name="component-fade" mode="out-in">
              <component v-bind:is="z"></component>
  </transition>
     <v-layout
      wrap
      style="height: 50px;"
    >
<v-navigation-drawer
        height="100%"
        width ='200'
        v-model="drawer"
        absolute
        temporary
      >
        <v-list class="pa-1">
          <v-list-tile avatar>
            <v-list-tile-avatar>
              <img src="https://image.ibb.co/mwBrhf/13123.jpg">
            </v-list-tile-avatar>
            <v-list-tile-content>
              <v-list-tile-title>A-nupha.sup</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>


<v-list-tile @click="navigationtab()" ripple>
        <v-list-tile-action>
          <v-icon>mdi-apps</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>Menu</v-list-tile-title>
      </v-list-tile>

<v-list-tile @click="logout()" ripple>
        <v-list-tile-action>
          <v-icon>mdi-logout</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>LOGOUT</v-list-tile-title>
      </v-list-tile>


      </v-navigation-drawer>
    </v-layout>
    <!-- <SnackBar/> -->
  </div>
</template>
<script>
import {
  mapState, mapActions,
} from 'vuex'
import moment from 'moment'
import { sync } from 'vuex-pathify'
import store from './store/store'
import Scan from './views/Scan.vue'
import Branch from './views/Branch.vue'
import Syn from './views/Syn.vue'
import tab from './views/tab.vue'
import LoginApp from './views/Login.vue'
import Menu from './views/menu.vue'
import request from './views/Request.vue'
import Register from './views/Register.vue'
import chart from './views/Chart.vue'
import User from './views/User.vue'

// import LineChart from './lineChart'
// import SnackBar from './views/SnackBar.vue'
// import login from './views/Login.vue'

export default {
  name: 'Profile',
  data() {
    return {
      z: 'LoginApp',
      tab: 'tab',
      active: null,
      button: 'ถัดไป',
      drawer: null,
      items: [
        { title: 'Menu', icon: 'mdi-apps' },
        { title: 'Logout', icon: 'mdi-logout' },
      ],
      time: 'Inventory Control',

    }
  },
  computed: {
    ...mapState({
      login: store => store.getApi.login,
      setMenuRequest: store => store.getApi.setMenuRequest,
    }),
    ...sync('*'),
  },
  components: {
    chart,
    Scan,
    request,
    Branch,
    Syn,
    tab,
    LoginApp,
    Menu,
    moment,
    Register,
    User,

  },
  mounted() {

  },
  watch: {
    login() {
      if (this.login === 'Menu') { this.z = 'Menu' }
      if (this.login === 'request') { this.z = 'request' }
      if (this.login === 'tab') { this.z = 'tab' }
      if (this.login === 'Register') { this.z = 'Register' }
      if (this.login === 'LoginApp') { this.z = 'LoginApp' }
      if (this.login === 'chart') { this.z = 'chart' }
      if (this.login === 'User') { this.z = 'User' }
    },
  },
  methods: {
    logout() {
      store.state.userName = null
      store.state.passWord = null
      const menu = 'LoginApp'
      this.setDataLogin(menu);
    },
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    navigationtab() {
      const menu = 'Menu'
      this.setDataLogin(menu);
    },
  },
}
</script>
<style>
/* #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  height: 100vh;
  overflow: auto;
  text-align: center;
  color: #2c3e50;
}
#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}
.viewport canvas[data-v-047f45f1], .viewport video[data-v-047f45f1] {
    position: absolute !important;
    left: 0 !important;
    width: 400px !important;
    height: 520px !important;
    top: 0 !important;
}
#nav a.router-link-exact-active {
  color: #42b983;
}
#background{
color: #0D47A1 ;
}
.selectTest .v-menu__content {
  top: 35px !important;
  left: 0px !important;
} */
</style>
