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
                                        <td class="text-xs-center">{{ props.item.name }}</td>
                                        <td class="text-xs-center">{{ props.item.cate_name }}</td>
                                        <td class="text-xs-center">{{ props.item.quantity_stock }}</td>
                                        <td class="text-xs-center">
                                          <v-btn icon>
                                            <v-icon color="green" @click="openDtail(props.item)"
                                            >mdi-arrow-up-bold-box</v-icon>
                                            </v-btn>
                                        </td>
                                    </template>
                                    <template slot="no-data">
                                        <v-btn color="primary" @click="desserts">
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
    <v-dialog v-model="dialogDtail"  fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-toolbar dark color="blue">
            <v-btn icon dark @click="closeDialog()">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Settings</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn dark flat @click="putdata()">Save</v-btn>
            </v-toolbar-items>
            </v-toolbar>
      <v-card>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-layout>
            <v-flex>
              <v-layout>
      <v-flex xs10>
        <v-text-field type="number" prepend-icon=" " label="Barcode" v-model="getdataStork.barcode" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="Name" v-model="getdataStork.name" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" "
        type="number"
        suffix="Baht"  name="input-7-4" label="Price"></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" "
        type="number"
        suffix="Baht"  name="input-7-4" label="Cost"></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field type="number"
        prepend-icon=" " label="Qty" suffix="Piece" required/>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-textarea prepend-icon=" " v-model="getdataStork.desc"
        box name="input-7-4" label="Description" auto-grow></v-textarea>
      </v-flex>
    </v-layout>
            </v-flex>
          </v-layout>
        </v-card-actions>
      </v-card>
    </v-dialog>
</div>
</template>

<script>
import {
  mapActions,
} from 'vuex'
import moment from 'moment'
import Axios from 'axios';
import {
  sync,
} from 'vuex-pathify'
import functions from '../plugins/functions'
import store from '../store/store'


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
    headers: [
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
      {
        text: 'detail',
        value: 'protein',
        align: 'center',
        sortable: false,
      },
    ],
    dialogDtail: false,
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
    dataStork: [],
    getdataStork: null,
  }),
  computed: {
    ...sync('*'),
  },
  watch: {
  },
  async created() {
    await this.getdataReq()
  },
  methods: {
    ...mapActions({
      // SetDataMenuRequest: 'getApi/SetDataMenuRequest',
      setDataLogin: 'getApi/setDataLogin',
    }),
    openDtail(data) {
      this.getdataStork = data
      console.log('this.getdataStork', this.getdataStork)
      this.dialogDtail = true
    },
    closeDialog() {
      this.dialogDtail = false
    },
    async getdataReq() {
      console.log('data login', store.state.dataLogin[0].rcode_id)
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/selectStork.php';
      const params = new URLSearchParams();
      params.append('branch_id', Number(store.state.dataLogin[0].rcode_id))
      const response = await Axios.post(api, params)
      console.log('response', response.data)
      this.desserts = response.data
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
