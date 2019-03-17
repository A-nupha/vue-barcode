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
                                <v-data-table :headers="headers"
                                :items="user" class="elevation-1">
                                    <template slot="items" slot-scope="props">
                                        <td class="text-xs-center">{{  digit.getFormat(props.item.pid, DigitType.PID, FormatType.AUTO) }}</td>
                                        <td class="text-xs-center">{{ props.item.fname }}</td>
                                        <td class="text-xs-center">{{ props.item.branch_id }}</td>
                                        <td class="text-xs-center">
                                            <v-btn icon>
                                            <v-icon color="orange"
                                            @click="editItem(props.item)">mdi-border-color</v-icon>
                                            </v-btn>
                                        </td>

                                        <td class="text-xs-center">
                                           <v-btn icon>
                                            <v-icon color="red"
                                            @click="deleteItem(props.item)">mdi-delete</v-icon>
                                            </v-btn>
                                        </td>


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
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

        <v-toolbar dark color="blue">
            <v-btn slot="activator" color="blue" dark class="mb-2">
                <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn dark flat @click="dialog = false;save()">Save</v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <span class="blue--text subheadline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 sm6 md4>
                            <v-text-field disabled v-model="getdataTable.pid"
                            label="pid"></v-text-field>
                        </v-flex>
                         <v-flex xs12 sm6 md4>
                            <v-text-field v-model="getdataTable.fname"
                            label="name"></v-text-field>
                        </v-flex>
                        <!--<v-flex xs12 sm6 md4>
                            <v-text-field disabled v-model="editedItem.fat"
                            label="Status"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field  v-model="editedItem.carbs"
                            label="Quanity"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field disabled v-model="editedItem.protein"
                            label="Name"></v-text-field>
                        </v-flex> -->
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>

            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-snackbar
    :vertical="true"
    v-model="snackฺฺฺBarBool"
    color="orange"
    :timeout="timeout"
    bottom>
    <v-flex >{{msgSnackBar}}</v-flex>
    <v-layout><v-flex><v-btn
        color="white"
        flat
        @click="snackฺฺฺBarBool = false "
      >
        no
      </v-btn></v-flex>
    <v-flex><v-btn
        color="white"
        flat
        @click="deleteItemS()"
      >
        yes
      </v-btn></v-flex></v-layout>


  </v-snackbar>
</div>
</template>

<script>
import digit, {
  DigitType,
  FormatType,
} from '@cdglib/js-moi-xid'
import controlData from './getApiData/controlData'

export default {
  name: 'Request',
  components: {
    // tab,
  },
  data() {
    return {
    // DigitType,
    // test: digit.getFormat(props.item.pid, DigitType.PID, FormatType.AUTO),
    // FormatType,
      DigitType,
      FormatType,
      digit,
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
      },
      {
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
      desserts: [],
      editedIndex: -1,
      editedItem: null,
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
      user: null,
      getdataTable: [],
    }
},
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    },
  },
  watch: {
    dialog(val) {
      val || this.close()
    },
  },
  created() {
    this.initialize()
    controlData.search().then((response) => {
      const retData = response.data
      this.user = retData
      //   retData.forEach((k, v) => {
      //     let pid = k.pid
      //     console.log(pid)
      if (retData.length < 0) {
        alert('ไม่พบผู้ใช้งานนี้ในระบบ')
      }
    //   });
    });
  },
  methods: {
    initialize() {
      this.desserts = [{
        Barcode: '12345678910115',
        calories: 'งามวงวาล',
        fat: 'ชำรุด',
        carbs: 24,
        protein: 'โค๊ก',
      },
      {
        Barcode: '12365498798788',
        calories: 'พญาไท',
        fat: 'สูญหาย',
        carbs: 37,
        protein: 'น้ำเปล่า',
      },
      {
        Barcode: '12365498798788',
        calories: 'ดินแดง',
        fat: 'สูญหาย',
        carbs: 23,
        protein: 'ดินสอ',
      },
      {
        Barcode: '12365412398788',
        calories: 'สุขุมวิท',
        fat: 'ชำรุด',
        carbs: 67,
        protein: 'เมาส์',
      },
      {
        Barcode: '12367892398118',
        calories: 'อโศก',
        fat: 'ชำรุด',
        carbs: 49,
        protein: 'ปากกา',
      },
      ]
    },
    editItem(item) {
      this.getdataTable = item
      console.log('this.getdataTable', this.getdataTable)
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
