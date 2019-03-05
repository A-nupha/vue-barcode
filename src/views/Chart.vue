<template>
  <section class="container">
    <!-- <ul>
      <li><router-link to="/">Home</router-link></li>
      <li><router-link to="/chartjs">vue-chartjs</router-link></li>
      <li><router-link to="/charts">vue-charts</router-link></li>
      <li><router-link to="/chartkick">vue-chartkick</router-link></li>
    </ul> -->
    <h1>Demo examples of vue-chartjs</h1>
    <div class="columns">
      <div class="column">
        <h3>Line Chart</h3>
        <!-- <line-chart></line-chart> -->
      </div>
      <div class="column">
        <h3>Bar Chart</h3>
        <!-- <bar-chart></bar-chart> -->
      </div>
    </div>

  </section>
</template>

<script>
// import LineChart from './LineChart.vue'
// import BarChart from './BarChart.vue'
// import BubbleChart from './BubbleChart.vue'
// import Reactive from '@/components/Reactive'

export default {
  name: 'VueChartJS',
  components: {
    // LineChart,
    // BarChart,
    // BubbleChart,
  },
  data() {
    return {
      datacollection: null,
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
