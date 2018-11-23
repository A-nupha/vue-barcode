<template>

  <div>
    datatestbarcodeScenner:{{databarcode}}
    <!-- <v-text-field v-model="databarcode"></v-text-field> -->
    <!-- <quagga-scanner v-bind=" readerSize={width:640,height:480}" :onDetected="logIt"></quagga-scanner> -->
    <quagga-scanner v-if="!databarcode"    :onDetected="logIt" :readerSize="readerSize" :readerType="'ean_reader'"></quagga-scanner>
    <!-- <v-flex v-else>
      <v-text-field v-model="databarcode"></v-text-field>
    </v-flex> -->
    <!-- <quagga-scanner v-else="databarcode != null"    :onDetected="logIt" :readerSize="readerSize" :readerType="'ean_reader'"></quagga-scanner> -->
    <!-- <quagga-scanner :onDetected="logIt" :readerSize="readerSize" :readerType="'ean_reader'"></quagga-scanner> -->
  </div>
</template>

<script>
import { QuaggaScanner } from 'vue-quaggajs';
import Quagga from 'quagga';
import swal from 'sweetalert';

// import js from './js/index.js';
// import Quagga from 'quagga';

export default {
  name: 'VueBarcodeTest',
  data() {
    return {
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
    // eslint-disable-next-line vue/no-unused-components
    // Quagga=\63\\,
  },
  methods: {
    
    logIt(data) {


      console.log('detectedbarcode', data.codeResult.code)
      // alert(data.codeResult.code)
      this.databarcode = data.codeResult.code
      swal({
        title: "Are you sure?",
        text: this.databarcode,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("barcode has been deleted!", {
            icon: "success",
          });
          Quagga.stop();
        } else {
          this.databarcode=null; 
          
         

        }
    });
  }
}
}
</script>
