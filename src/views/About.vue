<template>
  <div class="about">
    <v-flex ma-1 color="primary">
      <v-card class="elevation-15">
        <v-flex>
          <v-layout><v-flex ma-3> <span>{{ moment().format('MMMM Do YYYY, h:mm:ss a') }}</span></v-flex>
            </v-layout>
          <v-layout align-center justify-center>
            <v-flex xs2>branch</v-flex>
            <v-flex xs5>
              <v-text-field prepend-icon="mdi-city" name="Branch" label="Branch"></v-text-field>
            </v-flex>
            <v-flex xs2>

              <v-icon @click="">mdi-barcode-scan</v-icon>

            </v-flex>
          </v-layout>
          <v-layout align-center justify-center>
            <v-flex xs2>batch</v-flex>
            <v-flex xs5>
              <v-text-field prepend-icon="mdi-check-circle-outline" name="batch" label="batch"></v-text-field>
            </v-flex>
            <v-flex xs2>
              <v-icon>mdi-barcode-scan</v-icon>
            </v-flex>
          </v-layout>
          <v-layout align-center justify-center>
            <v-flex xs2>location</v-flex>
            <v-flex xs5>
              <v-text-field prepend-icon="mdi-map-marker" name="location" label="location"></v-text-field>
            </v-flex>
             <v-flex xs2>
                   <v-icon>mdi-arrow-right-bold-box-outline</v-icon>
                   </v-flex>
          </v-layout>
        </v-flex>
      </v-card>
    </v-flex>
  </div>
</template>

<script>
import moment from 'moment'

export default {
  name: 'abount',
  methods: {
    moment() {
      return moment();
    },
  },
}
</script>
