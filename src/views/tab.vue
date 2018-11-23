<template>
<div>
    <v-card >
    <v-layout md12>
      <v-flex xs12>
        <v-tabs
        color="blue lighten-1"
        dark
        slider-color="yellow"
          v-model="active">
          <v-tab :key="'About'"  >
            CONFIG
          </v-tab>
           <v-tab-item :key="'About'">
            <About/>
          </v-tab-item>
          <v-tab :key="'HOME'" >
            SCAN
          </v-tab>
             <v-tab-item :key="'HOME'">
            <HOME/>
          </v-tab-item>
          <v-tab :key="'Syn'">
            ITEM
          </v-tab>
            <v-tab-item :key="'Syn'">
            <Syn/>
          </v-tab-item>
        </v-tabs>
      </v-flex >
    </v-layout>
    </v-card>
  </div>
</template>
<script>
import HOME from './Home.vue'
import About from './About.vue'
import Syn from './menu.vue'


export default {
  name: 'tab',
  data() {
    return {
      active: null,
      button: 'ถัดไป',
    }
  },
  components: {
    HOME,
    About,
    Syn,

  },
}
</script>
