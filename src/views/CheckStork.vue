<template>
<div>
    <v-content>
        <v-container>
            <v-layout align-center justify-center>
                <v-flex class="grey lighten-4">
                    <v-container>
                        <v-card flat>
                            <div>
                                <v-toolbar flat color="white">
                                    <v-toolbar-title>
                                        <v-flex xs12 subheader class="blue--text" ma-1>
                                            Stork
                                        </v-flex>
                                    </v-toolbar-title>
                                    <v-spacer></v-spacer>
                              <v-text-field
                                v-model="search"
                                append-icon="mdi-magnify"
                                label="Search"
                                single-line
                                hide-details
                              ></v-text-field>
                                </v-toolbar>
                                <v-data-table :headers="headers" :items="desserts" :search="search" class="elevation-1">
                                    <template slot="items" slot-scope="props">
                                        <td class="text-xs-center">{{ props.item.Barcode }}</td>
                                        <td class="text-xs-center">{{ props.item.protein }}</td>
                                        <td class="text-xs-center">{{ props.item.fat }}</td>
                                        <td class="text-xs-center">{{ props.item.carbs }}</td>
                                        
                                    </template>
                                    <template slot="no-data">
                                        <v-btn color="primary" @click="initialize">
                                            Reset</v-btn>
                                    </template>
                                </v-data-table>
                            </div>
                        </v-card>
                    </v-container>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    <v-snackbar :vertical="true" v-model="snackฺฺฺBarBool" color="orange" :timeout="timeout" bottom>
        <v-flex>{{msgSnackBar}}</v-flex>
        <v-layout>
            <v-flex>
                <v-btn color="white" flat @click="snackฺฺฺBarBool = false ">
                    no
                </v-btn>
            </v-flex>
            <v-flex>
                <v-btn color="white" flat @click="deleteItemS()">
                    yes
                </v-btn>
            </v-flex>
        </v-layout>

    </v-snackbar>
</div>
</template>

<script>
import {
  mapActions,
} from 'vuex'

export default {
  name: 'Request',
  components: {
    // tab,
  },
  data: () => ({
    search: '',
    timeout: 5000,
    confirm: false,
    snackฺฺฺBarBool: false,
    msgSnackBar: '',
    dialog: false,
    headers: [{
      text: 'Barcode',
      align: 'center',
      sortable: false,
      value: 'name',
    },
    {
      text: 'name',
      value: 'fat',
      sortable: false,
      align: 'center',
    },
    {
      text: 'Category',
      value: 'name',
      sortable: false,
      align: 'center',
    },
    {
      text: 'Qty',
      value: 'protein',
      align: 'center',
      sortable: false,
    },
    // {
    //   text: 'Delete',
    //   value: 'name',
    //   sortable: false,
    //   align: 'center',
    // },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
    defaultItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
  }),
  computed: {},
  watch: {
    dialog(val) {
      val || this.close()
    },
  },
  created() {
    this.initialize()
  },
  methods: {
    ...mapActions({
      // SetDataMenuRequest: 'getApi/SetDataMenuRequest',
      setDataLogin: 'getApi/setDataLogin',
    }),

    initialize() {
      this.desserts = [{
        Barcode: '12345678910115',
        calories: 'งามวงวาล',
        fat: 'อาหารและเครื่องดืม',
        carbs: 24,
        protein: 'โค๊ก',
      },
      {
        Barcode: '12365498798788',
        calories: 'พญาไท',
        fat: 'อาหารและเครื่องดืม',
        carbs: 37,
        protein: 'น้ำเปล่า',
      },
      {
        Barcode: '12365498798788',
        calories: 'ดินแดง',
        fat: 'อาหารและเครื่องดืม',
        carbs: 23,
        protein: 'ดินสอ',
      },
      {
        Barcode: '12365412398788',
        calories: 'เสื้อผ้า',
        fat: 'เสื้อผ้า',
        carbs: 67,
        protein: 'เมาส์',
      },
      {
        Barcode: '12367892398118',
        calories: 'เสื้อผ้า',
        fat: 'เสื้อผ้า',
        carbs: 49,
        protein: 'ปากกา',
      },
      ]
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },
    deleteItem(item) {
      this.getdataTable = item
      this.msgSnackBar = 'Are you sure you want to delete this item?'
      this.snackฺฺฺBarBool = true
    },
    deleteItemS() {
      const index = this.desserts.indexOf(this.getdataTable)
      this.desserts.splice(index, 1)
      this.snackฺฺฺBarBool = false
    },

    close() {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
        this.desserts.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>

<style>
.theme--light .v-datatable thead th.column,
.theme--light .v-datatable thead th.column.sortable.active,
.theme--light .v-datatable thead th.column.sortable:hover,
.theme--light .v-datatable thead th.column.sortable.active i {
    color: white;
    background-color: #0091ea;
    font-size: 16px;
}

.table.v-table thead td:not(:nth-child(1)),
table.v-table tbody td:not(:nth-child(1)),
table.v-table thead th:not(:nth-child(1)),
table.v-table tbody th:not(:nth-child(1)),
table.v-table thead td:first-child,
table.v-table tbody td:first-child,
table.v-table thead th:first-child,
table.v-table tbody th:first-child {
    padding: 0 7px;
    font-size: 13px;
}
</style>
