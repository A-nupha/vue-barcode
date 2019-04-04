<template>
  <div>
    <v-layout>
<v-layout>
  <v-flex ma-4>
  <v-flex ma-5 pa-5>
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
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " v-model="price"
        suffix="Baht"  name="input-7-4" label="Price"></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " v-model="cost"
        suffix="Baht"  name="input-7-4" label="Cost"></v-text-field>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="Qty" suffix="Piece" v-model="qty" required/>
      </v-flex>
    </v-layout>
    <v-layout>
      <v-combobox
      :items="getCate[0].cate_name"
      prepend-icon=" "
      label="category"
      >
      </v-combobox>

      <!-- <v-flex xs10>
        <v-combobox
          disabled
          v-model="select"
          :items="items"
          prepend-icon=" "
          label="Event"
        ></v-combobox>
      </v-flex> -->

    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-textarea prepend-icon=" " v-model="detailItems"
        box name="input-7-4" label="Description" auto-grow></v-textarea>
      </v-flex>
    </v-layout>
            </v-flex>
          </v-layout>
        </v-card-actions>
      </v-card>
    </v-dialog>
    {{getCate}}
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
import controlData from './getApiData/controlData'

// import js from './js/index.js';
// import Quagga from 'quagga';
export default {
  name: 'VueBarcodeTest',
  data() {
    return {
      select: 'ขาย',
      items: [
        'ขาย',
        'สูญหาย',
        'ชำรุด',
      ],
      cost: null,
      price: null,
      qty: null,
      detailItems: null,
      dialogScan: false,
      model: 'tab-2',
      decoder: {
        readers: ['ean_reader', 'ean_8_reader', 'code_39_reader', 'code_39_vin_reader', 'codabar_reader', 'upc_reader', 'upc_e_reader', 'i2of5_reader', '2of5_reader', 'code_93_reader'],
      },
      databarcode: null,
      readerSize: {
        width: 50,
        height: 100,
      },
      detecteds: [],
      getCate: null,
    };
  },
  components: {
    QuaggaScanner,
  },
  computed: {
    ...sync('*'),
  },
  mounted() {
    console.log('test')
    controlData.getCate().then((response) => {
      const retData = response.data
      this.getCate = retData
      console.log('daTAaPIsERCH', this.getCate)
    });
  },
  created() {
  },
  methods: {
    putdata() {
      const obj = {
        databarcode: this.databarcode,
        qty: this.qty,
        name: this.name,
        Event: this.select,
        detailItems: this.detailItems,
        price: this.price,
        cost: this.cost,

      }
      this.$store.state.dataScan.push(obj)
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
  },
}
</script>
<style>


</style>
