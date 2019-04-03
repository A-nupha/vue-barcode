<template>
  <div>
    <donut-chart
      id="donut"
      :data="donutData"
      colors='[ "#FF6384", "#36A2EB", "#FFCE56" ]'
      resize="true">
    </donut-chart>
    <cerprint/>
  </div>
</template>

<script>
import Raphael from 'raphael/raphael'
import cerprint from './cer.vue'


import { DonutChart } from 'vue-morris'

global.Raphael = Raphael

export default {
  name: 'VueChartJS',
  components: {
    cerprint,
    DonutChart,
  },
  data() {
    return {
      donutData: [
        { label: 'okamoto', value: 300 },
        { label: 'durex', value: 50 },
        { label: 'Yellow', value: 100 },
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
