<template>
  <div id="app" dark>
       <v-toolbar
      color="cyan"
      dark
      tabs
    >
   <v-toolbar-side-icon></v-toolbar-side-icon>
    <v-toolbar-title>Nav-Link</v-toolbar-title>


   </v-toolbar>
   <LoginApp/>
     <!-- <tab/> -->
   
    
  </div>
</template>
<script>
import HOME from './views/Home.vue'
import About from './views/About.vue'
import Syn from './views/Syn.vue'
import tab from './views/tab.vue'
import LoginApp from './views/Login.vue'

export default {
  name: 'Profile',
  data() {
    return {
      active: null,
      button: 'ถัดไป',
    }
  },
  computed: {
    // ...mapState({
    //   Pid: store => store.XUser.pid,
    // }),
  },
  components: {
    HOME,
    About,
    Syn,
    tab,
    LoginApp,
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
  // },
  methods: {
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
