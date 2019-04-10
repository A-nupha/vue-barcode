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
import Axios from 'axios';
import Scan from './Scan.vue'
import Branch from './Branch.vue'
import Syn from './Syn.vue'

// import controlData from './getApiData/controlData'


export default {
  name: 'tab',
  data() {
    return {
      active: 0,
      button: 'ถัดไป',
      Store: this.$store.state,
    }
  },
  components: {
    Scan,
    Branch,
    Syn,

  },
  watch: {
    active() {
      if (Number(this.active) === 2) {
        this.button = 'บันทึก'
      } else {
        this.button = 'ถัดไป'
      }
    },
  },
  methods: {
    insert() {
      const api = 'https://a-nuphasupit58.000webhostapp.com/insertItems.php';
      const dataParams = new URLSearchParams();
      const dataInsert = JSON.stringify(this.Store.dataScan)
      dataParams.append('dataInsert', dataInsert)
      Axios.post(api, dataParams)
        .then((response) => {
          console.log('-=-=-==-')
          console.log(response.data)
        })
    },
    next() {
      const active = Number(this.active);
      if (Number(this.active === 2)) {
        alert('ยังไม่เสร็จ')
        this.insert()
      } else {
        this.active = active + 1;
      }
    },
  },
}
</script>
