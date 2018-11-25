<template>
    <div>
           <v-data-table
      :headers="headers"
      :items="desserts"
      :loading="true"
      class="elevation-1"
    >
      <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>
        <td class="text-xs-right">{{ props.item.calories }}</td>
         <td class="text-xs-right"><v-icon>mdi-delete</v-icon></td>
      </template>
      
    </v-data-table>
    <v-btn color="blue" dark="">sync</v-btn>
    </div>
</template>
<script>
export default {
  data() {
    return {
      headers: [
        {
          text: 'Barcode',
          align: 'left',
          sortable: false,
          value: 'name',
        },
        { text: 'QTY', value: 'calories' },
        { text: 'Delete', value: 'calories' },
       
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
}
</script>
