<template>
  <div>
    <v-layout>
<v-layout>
  <v-flex >
  <v-flex >
 <v-btn
      large
      block
      color="blue-grey"
      class="white--text"
      @click="openQuagga()"
    >
      Scan
      <v-icon right dark>mdi-barcode-scan</v-icon>
    </v-btn>
    </v-flex>
    <v-toolbar flat color="white">
                                    <v-toolbar-title>
                                        <v-flex xs12 subheader class="blue--text" ma-1>
                                            sale
                                        </v-flex>
                                    </v-toolbar-title>
                                    <v-divider class="mx-2" inset vertical></v-divider>
                                    <v-spacer></v-spacer>
                                    <div v-if="dataScanOut != ''">
                                    <v-btn class="white--text" color="blue" @click="confirm()">confirm</v-btn>
                                    </div>
                                </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="dataScanOut"
      :loading="true"
      class="elevation-1"
    >
      <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
      <template slot="items" slot-scope="props">
        <td>{{ props.item.databarcode }}</td>
        <td class="text-xs-center">{{ props.item.name }}</td>
        <td class="text-xs-center">{{ props.item.qty }}</td>
        <td><v-btn icon>
        <v-icon color="red" @click="deleteItem(props.item)">mdi-delete</v-icon>            </v-btn></td>
      </template>
    </v-data-table>
    </v-flex>
</v-layout>

    </v-layout>
<v-dialog v-model="dialogScan"  fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-toolbar dark color="blue">
            <v-btn icon dark @click="dialogScan = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Settings</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn dark flat @click="putdata()">Save</v-btn>
            </v-toolbar-items>
            </v-toolbar>
      <v-card>
        <v-card-text>
          <quagga-scanner v-if="!databarcode"
            :onDetected="logIt" class="videoo" :readerSize="readerSize" :readerType="'ean_reader'">
            <video class="videoo" ></video>
            </quagga-scanner>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-layout>
            <v-flex>
              <v-layout>
      <v-flex xs10>
        <v-text-field type="number" prepend-icon=" " label="Barcode" v-model="databarcode" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="Name" v-model="name" />
      </v-flex>
    </v-layout>
    <!-- <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " v-model="price" suffix="Baht"  name="input-7-4" label="Price"></v-text-field>
      </v-flex>
    </v-layout> -->
    <!-- <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " v-model="cost" suffix="Baht"  name="input-7-4" label="Cost"></v-text-field>
      </v-flex>
    </v-layout> -->
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="Qty" suffix="Piece" v-model="qty" required/>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-combobox
          v-model="select"
          :items="items"
          prepend-icon=" "
          label="Event"
        ></v-combobox>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-textarea prepend-icon=" " v-model="detailItems" box name="input-7-4" label="Description" auto-grow></v-textarea>
      </v-flex>
    </v-layout>
            </v-flex>
          </v-layout>
        </v-card-actions>
      </v-card>
    </v-dialog>
     <v-dialog v-model="openDialog" persistent max-width="400px">
        <v-card>
          <v-flex>
          <v-card-title
          :class="'green'"
          primary-title
          flat>
          <v-icon class="mr-3" color="white">mdi-information</v-icon>
          <v-flex class=""><v-flex class="white--text">INFORMATION</v-flex></v-flex>
        </v-card-title>
          <v-card-title>
            <v-layout justify-center><span>success</span></v-layout>
          </v-card-title>
          </v-flex>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="openDialog = false">Close</v-btn>
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
    <!-- {{dataScanOut}} -->
  </div>
</template>

<script>
import {
  QuaggaScanner,
} from 'vue-quaggajs';
import Quagga from 'quagga';
// import swal from 'sweetalert';
import { sync } from 'vuex-pathify'
// import store from '../store/store'

// import js from './js/index.js';
// import Quagga from 'quagga';
export default {
  name: 'VueBarcodeTest',
  data() {
    return {
      timeout: 5000,
      select: 'ขาย',
      openDialog: false,
      items: [
        'ขาย',
        'สูญหาย',
        'ชำรุด',
      ],
      headers: [
        {
          text: 'Barcode',
          align: 'center',
          sortable: false,
          value: 'name',
        },
        {
          text: 'name', value: 'calories', align: 'center', sortable: false,
        },
        {
          text: 'QTY', value: 'calories', align: 'center', sortable: false,
        },
        {
          text: 'Delete', value: 'calories', align: 'center', sortable: false,
        },
      ],
      cost: null,
      price: null,
      qty: null,
      detailItems: null,
      dialogScan: false,
      databarcode: null,
      readerSize: {
        width: 50,
        height: 100,
      },
      detecteds: [],
      getdataTable: [],
      msgSnackBar: '',
      snackฺฺฺBarBool: false,
      Store: this.$store.state,
      confirmData: '',
    };
  },
  components: {
    QuaggaScanner,
  },
  computed: {
    ...sync('*'),
  },
  methods: {
    putdata() {
      if (String(this.select) === 'สูญหาย' || String(this.select) === 'ชำรุด') {
        this.confirmData = '99'
      }
      if (String(this.select) === 'ขาย') {
        this.confirmData = '00'
      }
      const obj = {
        databarcode: this.databarcode,
        qty: this.qty,
        name: this.name,
        Event: this.select,
        detailItems: this.detailItems,
        price: this.price,
        cost: this.cost,
        confirm: Number(this.confirmData),
      }
      this.$store.state.dataScanOut.push(obj)
      this.dialogScan = false
    },
    openQuagga() {
      this.dialogScan = true
      this.databarcode = null
      Quagga.start()
    },
    logIt(data) {
      this.databarcode = data.codeResult.code
    },
    deleteItem(item) {
      this.getdataTable = item
      this.msgSnackBar = 'Are you sure you want to delete this item?'
      this.snackฺฺฺBarBool = true
    },
    deleteItemS() {
      const index = this.Store.dataScanOut.indexOf(this.getdataTable)
      this.Store.dataScanOut.splice(index, 1)
      this.snackฺฺฺBarBool = false
    },
    confirm() {
      this.openDialog = true
      alert('นี้ก็ยังม่ายเสร็จ')
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
