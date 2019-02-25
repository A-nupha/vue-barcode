<template>
    <div>
           <v-data-table
      :headers="headers"
      :items="dataScan"
      :loading="true"
      class="elevation-1"
    >
      <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
      <template slot="items" slot-scope="props">
        <td>{{ props.item.databarcode }}</td>
        <td class="text-xs-center">{{ props.item.qty }}</td>
        <td class="text-xs-center">{{ props.item.detailItems }}</td>
      </template>
    </v-data-table>
    {{dataScan}}
    </div>
</template>
<script>
import { sync } from 'vuex-pathify'
import controlData from './getApiData/controlData.js'
import store from '../store/store'

export default {
  data() {
    return {
      headers: [
        {
          text: 'Barcode',
          align: 'center',
          sortable: false,
          value: 'name',
        },
        { text: 'QTY', value: 'calories', align: 'center' },
        { text: 'Delete', value: 'calories', align: 'center' },
       
      ],
      desserts: [
        {
          value: false,
          name: '8851019010137',
          calories: 2,
         
        },
        {
          value: false,
          name: '8854747474747',
          calories: 1,
        
        },
        {
          value: false,
          name: '8854747854037',
          calories: 1,
         
        },
        {
          value: false,
          name: '8851019010137',
          calories: 3,
        
        },
        {
          value: false,
          name: '8851019010137',
          calories: 1,
      
        },
        {
          value: false,
          name: '8851019010137',
          calories: 375,
      
        },
        {
          value: false,
          name: '8851019010137',
          calories: 392,
       
        },
        {
          value: false,
          name: '8851019010137',
          calories: 408,
        
        },
        {
          value: false,
          name: '8851019010137',
          calories: 452,
        
        },
        {
          value: false,
          name: '8851019010137',
          calories: 518,
         
        },
      ],
    }
  },
  computed: {
    ...sync('*'),
  },

}

</script>
