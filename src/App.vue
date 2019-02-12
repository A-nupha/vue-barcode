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
              <component v-bind:is="this.z"></component>
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
        <v-list class="pt-0" dense>
          <v-divider></v-divider>
          <v-list-tile>
            
            <v-list-tile-content>
              <v-list-tile-title>
                <v-flex xs1>Menu</v-flex>
                </v-list-tile-title>
                <v-list-tile-title>
                  <v-divider></v-divider>
                <v-flex xs1>Logout</v-flex>
                </v-list-tile-title>
            </v-list-tile-content>

            <v-list-tile-action>
             <v-btn icon>
                <v-icon color="blue">mdi-arrow-right-bold-box-outline</v-icon>
              </v-btn>
            </v-list-tile-action>

          </v-list-tile>
        </v-list>
      </v-navigation-drawer>
    </v-layout>
  </div>
</template>
<script>
import {
  mapState,
} from 'vuex'
import HOME from './views/Home.vue'
import Branch from './views/Branch.vue'
import Syn from './views/Syn.vue'
import tab from './views/tab.vue'
import LoginApp from './views/Login.vue'
import Menu from './views/menu.vue'
import moment from 'moment'

export default {
  name: 'Profile',
  data() {
    return {
      z: '',
      tab: 'tab',
      active: null,
      button: 'ถัดไป',
      drawer: null,
      items: [
        { title: 'Menu', icon: 'mdi-apps' },
        { title: 'Logout', icon: 'mdi-logout' }
      ],
    }
  },
  computed: {
    ...mapState({
      login: store => store.getApi.login,
    }),
  },
  components: {
    HOME,
    Branch,
    Syn,
    tab,
    LoginApp,
    Menu,
    moment,
  },
  mounted() {
    this.z = 'LoginApp'
  },
  watch: {
    login() {
      if (this.login) {
        this.z = 'tab'
      }
    },
  },
  methods: {
    handleTabClick(e) {
      console.log(e)
    },
    submit() {
      alert('333')
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

#nav a.router-link-exact-active {
  color: #42b983;
}
#background{
color: #0D47A1 ;
}
</style>
