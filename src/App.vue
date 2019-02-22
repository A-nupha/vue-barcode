<template>
  <div id="app" dark>
       <v-toolbar
      color="blue lighten-1"
      dark
      tabs
    >
   <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>
      <div>Inventory Control</div>
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
        width ='170'
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

          <v-list-tile>
            <v-list-tile-action>
              <v-icon>mdi-apps</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <!-- <v-list-tile-title>Menu</v-list-tile-title> -->
              <v-btn flat block color="blue" @click="navigationtab()">Menu</v-btn>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile>
            <v-list-tile-action>
              <v-icon>mdi-logout</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <!-- <v-list-tile-title>Logout</v-list-tile-title> -->
              <v-btn flat block color="blue">Logout</v-btn>
            </v-list-tile-content>
          </v-list-tile>
      </v-navigation-drawer>
    </v-layout>
  </div>
</template>
<script>
import {
  mapState, mapActions,
} from 'vuex'
import moment from 'moment'
import Scan from './views/Scan.vue'
import Branch from './views/Branch.vue'
import Syn from './views/Syn.vue'
import tab from './views/tab.vue'
import LoginApp from './views/Login.vue'
import Menu from './views/menu.vue'
import request from './views/Request.vue'
import Register from './views/Register.vue'

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

    }
  },
  computed: {
    ...mapState({
      login: store => store.getApi.login,
      setMenuRequest: store => store.getApi.setMenuRequest,
    }),
  },
  components: {
    Scan,
    request,
    Branch,
    Syn,
    tab,
    LoginApp,
    Menu,
    moment,
    Register,
  },
  mounted() {

  },
  watch: {
    login() {
      if (this.login === 'Menu') { this.z = 'Menu' }
      if (this.login === 'request') { this.z = 'request' }
      if (this.login === 'tab') { this.z = 'tab' }
      if (this.login === 'Register') { this.z = 'Register' }
    },
  },
  methods: {
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
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
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
    width: 450px !important;
    top: 0 !important;
}
#nav a.router-link-exact-active {
  color: #42b983;
}
#background{
color: #0D47A1 ;
}
</style>
