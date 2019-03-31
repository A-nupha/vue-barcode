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
                                            USER
                                        </v-flex>
                                    </v-toolbar-title>
                                    <v-divider class="mx-2" inset vertical></v-divider>
                                    <v-spacer></v-spacer>
                                </v-toolbar>
                                <v-data-table :headers="headers" :items="Store.dataUserApi"
                                rows-per-page-text="จำนวนต่อหน้า"
                                class="elevation-1">
                                    <template slot="items" slot-scope="props">
                                        <td class="text-xs-center"> {{props.item.index2Edit}}</td>
                                        <td class="text-xs-center">{{ props.item.fname }}</td>
                                        <td class="text-xs-center">{{ props.item.branch_id }}</td>
                                        <td class="text-xs-center">
                                            <v-btn slot="activator" icon>
                                                <v-icon color="orange"
                                                @click="editItem(props.item)">mdi-pencil</v-icon>
                                            </v-btn>
                                            <v-dialog v-model="dialog" fullscreen hide-overlay
                                            transition="dialog-bottom-transition">
                                                <v-toolbar dark color="blue">
                                                    <v-spacer></v-spacer>
                                                    <v-toolbar-items>
                                                        <v-btn dark flat
                                                        @click="save()">Save</v-btn>
                                                    </v-toolbar-items>
                                                </v-toolbar>
                                                <v-card>
                                                    <v-card-text>
                                                        <v-container grid-list-md>
                                                            <v-layout wrap>
                                                                <v-flex xs12 sm6 md4>
                                                                    <v-text-field disabled
                                                                    v-model="index.pid"
                                                                    mask="#-####-#####-##-#"
                                                                    label="Id number">
                                                                    </v-text-field>
                                                                </v-flex>
                                                                <v-flex xs6 sm6 md6>
                                                                    <v-text-field disabled
                                                                    v-model="index.fname"
                                                                    label="First Name">
                                                                    </v-text-field>
                                                                </v-flex>
                                                                <v-flex xs6 sm6 md6>
                                                                    <v-text-field disabled
                                                                    v-model="index.lname"
                                                                    label="last Name">
                                                                    </v-text-field>
                                                                </v-flex>
                                                                <v-flex xs6 sm6 md6>
                                                                    <v-text-field disabled
                                                                    v-model="index.index1"
                                                                    label="User"></v-text-field>
                                                                </v-flex>
                                                                <v-flex xs6 sm6 md6>
                                                                    <v-text-field v-model="index.index2Edit"
                                                                    label="Password">
                                                                    </v-text-field>
                                                                </v-flex>
                                                            </v-layout>
                                                        </v-container>
                                                    </v-card-text>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn color="blue darken-1"
                                                        flat @click="dialog = false">Cancel</v-btn>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                        </td>
                                        <td>
                                          <v-btn slot="activator" icon>
                                                <v-icon color="red"
                                                >mdi-delete</v-icon>
                                            </v-btn>
                                        </td>
                                    </template>
                                </v-data-table>
                            </div>
                        </v-card>
                    </v-container>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    {{Store.dataUserApi}}
</div>
</template>

<script>
import controlData from './getApiData/controlData'

export default {
  name: 'Request',
  components: {},
  data() {
    return {
      Store: this.$store.state,
      timeout: 10000,
      index: '',
      confirm: false,
      snackฺฺฺBarBool: '',
      msgSnackBar: '',
      dialog: false,
      headers: [{
        text: 'User',
        align: 'center',
        sortable: false,
        value: 'name',
      },
      {
        text: 'name',
        value: 'fat',
        sortable: false,
        align: 'center',
      }, {
        text: 'branch',
        value: 'protein',
        align: 'center',
        sortable: false,
      },
      {
        text: 'Edit',
        value: 'name',
        sortable: false,
        align: 'center',
      },
      {
        text: 'Delete',
        value: 'name',
        sortable: false,
        align: 'center',
      },
      ],
    }
  },
  computed: {},
  watch: {},
  created() {
    controlData.search().then((response) => {
      const retData = response.data
      this.Store.dataUserApi = retData
      console.log('daTAaPIsERCH', this.Store.dataUserApi)
      for (let i = 0; i < this.Store.dataUserApi.length; i += 1) {
        this.$set(this.Store.dataUserApi, i, {
          ...this.Store.dataUserApi[i],
          indexLog: i,
        })
        this.$set(this.Store.dataUserApi, i, {
          ...this.Store.dataUserApi[i],
          index2Edit: this.Store.dataUserApi[i].index2,
        })
      }
      console.log(this.Store.dataUserApi)
    });
  },
  methods: {
    editItem(value) {
      console.log('เข้า', value.indexLog);
      this.index = value
      this.dialog = true
    },
    save() {
      console.log('this.Store.dataUserApi[this.index.indexLog].index2Edit=>', this.Store.dataUserApi[this.index.indexLog])
      this.Store.dataUserApi[this.index.indexLog].index2Edit = this.index.index2Edit
      console.log('this.Store.dataUserApi[this.index.indexLog].index2Edit=>', this.Store.dataUserApi[this.index.indexLog])
      this.dialog = false;
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
    font-size: 14px;
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
