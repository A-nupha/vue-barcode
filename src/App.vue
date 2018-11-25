<template>
  <div id="app" dark>
       <v-toolbar
      color="blue lighten-1"
      dark
      tabs
    >
   <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>Nav-Link</v-toolbar-title>


   </v-toolbar>
   <!-- <LoginApp/> -->
   <transition name="component-fade" mode="out-in">
              <component v-bind:is="this.z"></component>
  </transition>
  <!-- {{login}}22 -->
    <!-- <v-btn color="blue" dark large block @click="setData()">Login</v-btn> -->
    <!-- <tab/> -->
    <!-- {{}} -->
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
  
          <v-list-tile
            v-for="item in items"
            :key="item.title"
            @click=""
          >
            <v-list-tile-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-tile-action>
  
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
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
import About from './views/About.vue'
import Syn from './views/Syn.vue'
import tab from './views/tab.vue'
import LoginApp from './views/Login.vue'
import Menu from './views/menu.vue'

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
    About,
    Syn,
    tab,
    LoginApp,
    Menu,
  },
  // mounted() {
  //   let url = "../marry.json";
  //   axios({
  //     method: "get",
  //     url: url,
  //     dataType: "json",
  //     headers: { "X-Requested-With": "XMLHttpRequest" }
  //   })
  //     .then(function(res) {
  //       console.log("Data", res.data);
  //     })
  //     .catch(function(error) {
  //       console.log("Error", error);
  //     });
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
  // },
  methods: {
    // setData() {
    //   this.z = tab
    // },
    handleTabClick(e) {
      console.log(e)
    },
    submit() {
      alert('333')
    },

    next() {
      const active = parseInt(this.active)
      // alert(active);
      if (active === 1) {
        this.$data.button = 'บันทึก'
      }
      if (active === 2) {
        this.submit()
        // alert("sucess!!!");
      } else {
        this.active = active + 1
      }
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
</style>
