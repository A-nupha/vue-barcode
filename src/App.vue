<template>
  <v-app id="app" >
    <!-- {{login}} -->
       <v-toolbar
      color="blue lighten-1"
      dark
      tabs
    >
   <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>
      <!-- <span>{{ moment().format('MMMM Do YYYY, h:mm:ss a') }}</span> -->
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <!-- <v-icon>mdi-account</v-icon>
      <div>{{userName}}</div> -->
      <v-btn icon @click="drawerS = true">
      <v-icon>mdi-dots-vertical</v-icon>
    </v-btn>
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
            <!-- <v-list-tile-avatar> -->
              <v-avatar color="blue">
              <span class="white--text headline">{{String(userName).substring(0,1)}}</span>
              </v-avatar>
            <!-- </v-list-tile-avatar> -->
            <v-list-tile-content>
              <v-list-tile-title>{{userName}}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>


<v-list-tile @click="navigationtab()" ripple>
        <v-list-tile-action>
          <v-icon>mdi-apps</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>Menu</v-list-tile-title>
      </v-list-tile>
<v-divider/>
<v-list-tile @click="logout()" ripple>
        <v-list-tile-action>
          <v-icon>mdi-logout</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>LOGOUT</v-list-tile-title>
      </v-list-tile>


      </v-navigation-drawer >
    </v-layout>
    <!-- <v-navigation-drawer v-model="drawerS" absolute
        temporary
        right
        width ='200'>
      <v-list dense>
        <v-list-tile @click="openDialogContext()" ripple>
        <v-list-tile-action>
          <v-icon>mdi-settings-outline</v-icon>
        </v-list-tile-action>
        <v-list-tile-title>contact</v-list-tile-title>
      </v-list-tile>
      </v-list>
    </v-navigation-drawer> -->
    <v-dialog v-model="openDialog" persistent max-width="400px">
        <v-card>
          <v-flex>
          <v-card-title
          :class="'blue'"
          primary-title
          flat>
          <v-icon class="mr-3" color="white">mdi-information</v-icon>
          <v-flex class=""><v-flex class="white--text">contact</v-flex></v-flex>
        </v-card-title>
          <v-card-title>
            <v-layout justify-center><span>Line:@inventoryControl</span></v-layout>
            <v-layout justify-center><img src="./assets/about.jpg" contain width="220" height="250"></v-layout>
             <!-- <v-layout justify-center><span>Line:@inventoryControl</span></v-layout> -->
          </v-card-title>
          </v-flex>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="openDialog = false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>


    <!-- <SnackBar/> -->
  </v-app>
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
import Stork from './views/CheckStork.vue'
import deleteStork from './views/deleteStock.vue'

// import LineChart from './lineChart'
// import SnackBar from './views/SnackBar.vue'
// import login from './views/Login.vue'

export default {
  name: 'Profile',
  data() {
    return {
      openDialog: false,
      drawerS: false,
      Store: this.$store.state,
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
      role: '',

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
    Stork,
    deleteStork,
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
      if (this.login === 'Stork') { this.z = 'Stork' }
      if (this.login === 'deleteStork') { this.z = 'deleteStork' }
    },
    

  },
  created() {
    // this.validate()
  },
  methods: {
    openDialogContext() {
      // this.drawerS = false
      this.openDialog = true
    },
    toggleNavigationDrawer() {
      this.drawer = !this.drawer;
    },
    logout() {
      store.state.userName = null
      store.state.passWord = null
      const menu = 'LoginApp'
      this.setDataLogin(menu);
      this.$store.commit('resetState');
    },
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    navigationtab() {
      console.log('this.Store.dataLogin[0].rcode_id', this.Store.dataLogin[0].rcode_id)
      if (this.Store.dataLogin[0].rcode_id !== null || this.Store.dataLogin[0] !== '') {
        const menu = 'Menu'
        this.setDataLogin(menu);
      }
    },
  },
}
</script>
<style>
  /* .selectCtrl .v-select>.v-input__control>.v-input__slot{
    height:28px !important ;
  } */

  /* .selectCtrl2 .v-select>.v-input__control>.v-input__slot{
    height:28px !important ;
    width: 15rem;
  } */
/* #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  height: 100vh;
  overflow: auto;
  text-align: center;
  color: #2c3e50;
} */
/* #nav {
  padding: 30px;
} */

/* #nav a {
  font-weight: bold;
  color: #2c3e50;
} */
/* .v-menu__content {
  top: 50px !important;
  left: 0px !important;
} */

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
/* #background{
color: #0D47A1 ;
} */
/* .selectTest .v-menu__content {
  top: 35px !important;
  left: 0px !important;
} */
</style>
