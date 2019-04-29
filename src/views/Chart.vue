<template>
  <div>
    <div>
    <v-flex>
    </v-flex></div>
                <v-subheader>date in</v-subheader>
              <v-flex md3>
        <GlobalDate :value.sync="Store.aDateIn" />
      </v-flex>
        <v-subheader>date out</v-subheader>
              <v-flex md3>
        <GlobalDate  :value.sync="Store.aDateOut" />
      </v-flex>
      <v-flex ma-1>
        <v-layout justify-end>
        <v-btn dark color="blue" @click="getdataReport()">submit
        </v-btn>
      </v-layout>
      </v-flex>
    <v-flex v-if="this.chart == true">
    <donut-chart
      id="donut"
      :data="donutData"
      colors='[ "#FF6384", "#36A2EB", "#FFCE56" ]'
      resize="true">
    </donut-chart>
    <cerprint/>
    </v-flex>
    <!-- {{dataTranIn}}
    =========================================
    {{dataStock}} -->

  </div>
</template>

<script>
import Raphael from 'raphael/raphael'
import Axios from 'axios';
import { sync } from 'vuex-pathify'
import { DonutChart } from 'vue-morris'
import cerprint from './cer.vue'
import store from '../store/store'


global.Raphael = Raphael

export default {
  name: 'VueChartJS',
  msgSnackBar: 'test',
  components: {
    cerprint,
    DonutChart,
  },
  data() {
    return {
      dataTranIn: [],
      dataStock: [],
      openDialog: true,
      chart: false,
      Store: this.$store.state,
      dialog: true,
      donutData: [
        { label: 'Input', value: 50 },
        { label: 'Output', value: 40 },
        { label: 'Stock', value: 40 },
      ],
    }
  },
  watch: {
  },
  computed: {
    ...sync('*'),
  },
  methods: {
    test() {
      this.chart = true
    },
    async getdataReport() {
      this.chart = true
      // ============================Tran-In==============================
      const apiTranin = 'https://a-nuphasupit58.000webhostapp.com/php/getdataReportTranin.php';
      const paramsTranin = new URLSearchParams();
      paramsTranin.append('date_in', this.Store.aDateIn)
      paramsTranin.append('date_out', this.Store.aDateOut)
      paramsTranin.append('branch_id', Number(store.state.dataLogin[0].rcode_id))
      const responseTranin = await Axios.post(apiTranin, paramsTranin)
      this.dataTranIn = responseTranin.data
      for (let i = 0; i < this.dataTranIn.length; i += 1) {
        this.$set(this.dataTranIn, i, { ...this.dataTranIn[i], totol: Number(this.dataTranIn[i].price) * Number(this.dataTranIn[i].quantity) })
      }
      console.log('----Get_API--TRANIN----', responseTranin.data)
      // =============================Tran-Out=============================
      // const apiTranout = 'https://a-nuphasupit58.000webhostapp.com/php/getdataReportTranout.php';
      // const paramsTranout = new URLSearchParams();
      // paramsTranout.append('date_in', this.Store.aDateIn)
      // paramsTranout.append('date_out', this.Store.aDateOut)
      // paramsTranout.append('branch_id', Number(store.state.dataLogin[0].rcode_id))
      // const responseTranout = await Axios.post(apiTranout, paramsTranout)
      // console.log('----Get_API--TRANOUT---', responseTranout.data)
      // =============================Stock================================
      const apiStock = 'https://a-nuphasupit58.000webhostapp.com/php/getdataReportStock.php';
      const paramsStock = new URLSearchParams();
      paramsStock.append('branch_id', Number(store.state.dataLogin[0].rcode_id))
      const responseStock = await Axios.post(apiStock, paramsStock)
      this.dataStock = responseStock.data
      console.log('----Get_API--STOCK---', responseStock.data)
    },
  },
}
</script>

<style scoped>
  ul {
    list-style-type: none;
    padding: 0;
  }

  li {
    display: inline-block;
    margin: 0 10px;
  }

  a {
    color: #42b983;
  }
</style>
