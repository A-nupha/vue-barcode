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
          <v-tab :key="'Barnch'"  >
            CONFIG
          </v-tab>
           <v-tab-item :key="'Barnch'">
            <Branch/>
          </v-tab-item>
          <v-tab :key="'Scan'" >
            SCAN
          </v-tab>
             <v-tab-item :key="'Scan'">
            <Scan v-if="active==1"/>
          </v-tab-item>
          <v-tab :key="'Syn'">
            ITEM
          </v-tab>
            <v-tab-item :key="'Syn'">
            <Syn v-if="active==2"/>
          </v-tab-item>
        </v-tabs>
      </v-flex >

    </v-layout>
    <v-flex><v-btn dark large @click="next()" block color="blue" >{{button}}</v-btn></v-flex>
    </v-card>
  </div>
</template>
<script>
import Scan from './Scan.vue'
import Branch from './Branch.vue'
import Syn from './Syn.vue'


export default {
  name: 'tab',
  data() {
    return {
      active: 0,
      button: 'ถัดไป',
    }
  },
  components: {
    Scan,
    Branch,
    Syn,

  },
  watch: {
    active() {
      if (this.active == 2) {
        this.button = 'บันทึก'
      } else {
        this.button = 'ถัดไป'
      }
    },
  },
  methods: {
    next() {
      const active = parseInt(this.active);

      if (this.active == 2) {
        alert('5555')
      } else {
        this.active = active + 1;
      }
    },
  },
}
</script>
