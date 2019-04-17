<template>
  <div>
    <div>
    <v-flex>
       <v-dialog
       persistent
      v-model="dialog"
      max-width="400"
      fullscreen
    >
      <v-card tile>
          <v-toolbar card dark color="blue">
            <v-toolbar-title> Please enter period date.</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn dark flat @click="dialog = false"><v-icon>mdi-check-circle</v-icon></v-btn>
            </v-toolbar-items>
          </v-toolbar>
          <v-card-text>
            <v-list three-line subheader>
              <v-subheader>date in</v-subheader>
              <v-flex md3>
        <GlobalDate :value.sync="Store.aDateIn" />
      </v-flex>
      <!-- {{Store.aDateIn}} -->
            </v-list>
            <v-divider></v-divider>
            <v-list three-line subheader>
              <v-subheader>date out</v-subheader>
              <v-flex md3>
        <GlobalDate :value.sync="Store.aDateOut" />
      </v-flex>
      <!-- {{Store.aDateOut}} -->
            </v-list>
          </v-card-text>
      </v-card>
    </v-dialog>
    </v-flex></div>
    <v-flex>
    <donut-chart
      id="donut"
      :data="donutData"
      colors='[ "#FF6384", "#36A2EB", "#FFCE56" ]'
      resize="true">
    </donut-chart>
    <cerprint/>
    </v-flex>

  </div>
</template>

<script>
import Raphael from 'raphael/raphael'
import { DonutChart } from 'vue-morris'
import cerprint from './cer.vue'


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
      openDialog: true,
      Store: this.$store.state,
      dialog: true,
      donutData: [
        { label: 'Input', value: 50 },
        { label: 'Output', value: 40 },
        { label: 'Stock', value: 40 },
      ],
    }
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
