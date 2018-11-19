<template>
  <div id="app" dark>

      <v-layout ma-1 md12>
        <v-flex justify-center>
      <v-toolbar
        color="blue darken-1"
        dark
        tabs
      >
        <v-toolbar-side-icon></v-toolbar-side-icon>

        <v-toolbar-title>NAV LINK</v-toolbar-title>

        <v-spacer></v-spacer>

        <!-- <v-btn icon>
          <v-icon>search</v-icon>
        </v-btn> -->

        <!-- <v-btn icon>
          <v-icon>more_vert</v-icon>
        </v-btn> -->

        <v-tabs
          slot="extension"
          v-model="model"
          centered
          color="blue darken-2"
          slider-color="yellow"
        >
          <v-tab
            v-for="i in 3"
            :key="i"
            :href="`#tab-${i}`"
          >
            Item {{ i }}
          </v-tab>
        </v-tabs>
      </v-toolbar>

      <v-tabs-items v-model="model">
        <v-tab-item
          v-for="i in 3"
          :id="`tab-${i}`"
          :key="i"
        >
          <v-card flat>
            <v-card-text v-text="text"></v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
      </v-flex>
      </v-layout>
    <router-view/>
  </div>
</template>
<script>
import HOME from './views/Home.vue'

export default {
  data() {
    return {
      model: 'tab-1',
      componen: HOME,
    }
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
