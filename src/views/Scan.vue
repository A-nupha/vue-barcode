<template>
  <div>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="barcode" v-model="databarcode" />
      </v-flex>
      {{dialogScan}}
      {{databarcode}}
      <v-btn icon @click="openQuagga()">
        <v-icon color="blue">mdi-barcode-scan</v-icon>
      </v-btn>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-text-field prepend-icon=" " label="Qty" v-model="databarcode" />
      </v-flex>
    </v-layout>
    <v-layout>
      <v-flex xs10>
        <v-textarea prepend-icon=" " box name="input-7-4" label="Description" auto-grow></v-textarea>
      </v-flex>
    </v-layout>

    <!-- <quagga-scanner v-if="!databarcode"
            :onDetected="logIt" :readerSize="readerSize" :readerType="'ean_reader'">
            <video></video>
            </quagga-scanner> -->

    <v-dialog v-model="dialogScan"  fullscreen hide-overlay transition="dialog-bottom-transition">
      <v-toolbar dark color="blue">
            <v-btn icon dark @click="dialogScan = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Settings</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <v-btn dark flat @click="dialogScan = false">Save</v-btn>
            </v-toolbar-items>
            </v-toolbar>
      <v-card>
        <!-- <v-card-title class="blue " primary-title>
          <v-icon color="white">mdi-information</v-icon>
          <v-flex class="white--text">scanbarcode</v-flex>
          <div class="pl-1"> </div>
        </v-card-title> -->

        <v-card-text>
          <quagga-scanner v-if="!databarcode"
            :onDetected="logIt" class="videoo" :readerSize="readerSize" :readerType="'ean_reader'">
            <video class="videoo" ></video>
            </quagga-scanner>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <!-- <v-btn color="blue darken-1" flat="flat" @click="dialogScan = false">
            ปิด
          </v-btn>
          <v-btn class="white--text" color="blue darken-1" @click="dialogScan = false">
            บันทึก
          </v-btn> -->
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

// import js from './js/index.js';
// import Quagga from 'quagga';
export default {
  name: 'VueBarcodeTest',
  data() {
    return {
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
  methods: {
    openQuagga() {
      this.dialogScan = true
      Quagga.start()
    },
    logIt(data) {
      console.log('detectedbarcode', data.codeResult.code)
      // alert(data.codeResult.code)
      this.databarcode = data.codeResult.code
      swal({
        title: 'Are you sure?',
        text: this.databarcode,
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            swal('success', {
              icon: 'success',
            });
            Quagga.stop();
            this.dialogScan = false
          } else {
            this.databarcode = null;
            // Quagga.start()
          }
        });
    },
  },
}
</script>
<style>



</style>

