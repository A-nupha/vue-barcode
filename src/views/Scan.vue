<template>
  <div>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="barcode" v-model="databarcode" />
      </v-flex>
      <!-- {{dialogScan}}
      {{databarcode}} -->
      {{dataScan}}
      <v-btn icon @click="openQuagga()">
        <v-icon color="blue">mdi-barcode-scan</v-icon>
      </v-btn>
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
        <v-text-field prepend-icon=" " label="Barcode" v-model="databarcode" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="Qty" v-model="qty" required/>
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
  </div>
</template>

<script>
import {
  QuaggaScanner,
} from 'vue-quaggajs';
import Quagga from 'quagga';
import swal from 'sweetalert';
import { sync } from 'vuex-pathify'
import store from '../store/store'

// import js from './js/index.js';
// import Quagga from 'quagga';
export default {
  name: 'VueBarcodeTest',
  data() {
    return {
      qty: null,
      detailItems: null,
      dialogScan: false,
      model: 'tab-2',
      text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
      decoder: {
        readers: ['ean_reader', 'ean_8_reader', 'code_39_reader', 'code_39_vin_reader', 'codabar_reader', 'upc_reader', 'upc_e_reader', 'i2of5_reader', '2of5_reader', 'code_93_reader'],
      },
      databarcode: null,
      readerSize: {
        width: 50,
        height: 100,
      },
      detecteds: [],
    };
  },
  components: {
    QuaggaScanner,
  },
  computed: {
    ...sync('*'),
  },
  methods: {
    bottonNext() {
      this.$router.push(`/${  this.items[indexMenu].click}`)
    },
    putdata() {
      const databarcode = this.databarcode
      const dataScan = store.state.dataScan
      console.log('databarcode', databarcode)
      console.log('dataScan', dataScan);
      const obj = {
        databarcode: this.databarcode,
        qty: this.qty,
        detailItems: this.detailItems,
      }
      dataScan.push(obj)
      this.dialogScan = false
    },
    openQuagga() {
      this.dialogScan = true
      this.databarcode = null
      Quagga.start()
    },
    logIt(data) {
      // console.log('detectedbarcode', data.codeResult.code)
      // alert(data.codeResult.code)
      this.databarcode = data.codeResult.code
      // swal({
      //   title: this.databarcode,
      //   icon: 'success',
      //   buttons: {
      //     next: {
      //       text: 'ถัดไป',
      //       value: 'next',
      //     },
      //     el: {
      //       text: 'ยกเลิก',
      //       value: 'cancel',
      //       color: 'red',
      //     },
      //   },
      // })
      //   .then((res) => {
      //     Quagga.stop();
      //     switch (res) {
      //       case 'next':
      //         // this.setemp(data);
      //         this.dialogScan = false
      //         this.putdata();
      //         break;
      //       case 'cancel':
      //         // this.setemp(data);
      //         alert("res")
      //         this.dialogScan = false
      //         break;

      //       default:
      //         this.dialog = false;
      //     }
      //     // if (willDelete) {
      //     //   swal('success', {
      //     //     icon: 'success',
      //     //   });
      //     //   Quagga.stop();
      //     //   this.dialogScan = false
      //     // } else {
      //     //   this.databarcode = null;
      //     //   // Quagga.start()
      //     // }
      //   });
    },
  },
}
</script>
<style>


</style>
