<template>
  <div>
    <v-layout row>
      <v-flex xs12 >
        <!-- <v-card> -->
          <v-toolbar flat>
            <v-toolbar-title>Menu</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <!-- <v-subheader>May</v-subheader> -->
          <v-container >
            <v-layout wrap>
              <v-flex  xs6 pa-2>
                <v-card dark color="#1565C0" class="text-xs-center" style="padding-top:50px;padding-bottom:20px;">
                  <v-icon >mdi-truck</v-icon>
                  <v-card-text>Good Receipt</v-card-text>
                  <v-card-actions class="text-xs-center">
                       <v-layout row>
                           <v-flex xs-4 class="text-xs-center">
                                <v-btn  color="blue darken-1" @click="click='scan'">Go</v-btn>
                           </v-flex>
                       </v-layout>
                    </v-card-actions>
                </v-card>
              </v-flex>
               <v-flex  xs6 pa-2>
                <v-card dark color="#1565C0" class="text-xs-center" style="padding-top:50px;padding-bottom:20px;">
                  <v-icon >mdi-truck-delivery</v-icon>
                  <v-card-text>Good Return</v-card-text>
                   <v-card-actions class="text-xs-center">
                       <v-layout row>
                           <v-flex xs-4 class="text-xs-center">
                                <v-btn  color="blue darken-1" @click="click='scan'">Go</v-btn>
                           </v-flex>
                       </v-layout>
                    </v-card-actions>
                </v-card>
              </v-flex>
            </v-layout>
             <v-layout wrap>
              <v-flex  xs6 pa-2>
                <v-card dark color="#1565C0" class="text-xs-center" style="padding-top:50px;padding-bottom:20px;">
                  <v-icon >mdi-sync-alert</v-icon>
                  <v-card-text>Good Transfer</v-card-text>
                  <v-card-actions class="text-xs-center">
                       <v-layout row>
                           <v-flex xs-4 class="text-xs-center">
                                <v-btn  color="blue darken-1" @click="click='scan'">Go</v-btn>
                           </v-flex>
                       </v-layout>
                    </v-card-actions>
                </v-card>
              </v-flex>
               <v-flex  xs6 pa-2>
                <v-card dark color="#1565C0" class="text-xs-center" style="padding-top:50px;padding-bottom:20px;">
                  <v-icon >mdi-pencil</v-icon>
                  <v-card-text>Physical Count</v-card-text>
                  <v-card-actions class="text-xs-center">
                       <v-layout row>
                           <v-flex xs-4 class="text-xs-center">
                                <v-btn  color="blue darken-1" @click="click='scan'">GO</v-btn>
                           </v-flex>
                       </v-layout>
                    </v-card-actions>
                </v-card>
              </v-flex>
              
            </v-layout>
          </v-container>
        
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
export default {
  
  name: 'menu',
  data () {
    return {
      click:null
    }
  },

  methods: {
   
  },
  mounted () {
    // console.log(AdminMenuList)
  }
}
</script>