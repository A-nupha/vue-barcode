<template>
  <div>
    <v-content>
      <v-container>
        <v-layout align-center justify-center>
          <v-flex class="grey lighten-4">
            <v-container>
              <v-card flat class="elevation-5">
                <v-card-title primary-title>
                  <div>ผู้เข้าใช้งาน : {{userName}}</div>
                </v-card-title>
                <v-form>
                  <v-layout wrap>
                    <v-flex xs6 pa-2>

                      <!-- <v-card class="elevation-22" dark
                      color="#1565C0" style="padding-top:50px;padding-bottom:20px;">
                        <v-icon x-large dark>mdi-truck</v-icon>
                        <v-card-text>Add items</v-card-text>
                        <v-card-actions class="text-xs-center">
                          <v-layout row>
                            <v-flex xs-4 class="text-xs-center">
                              <v-btn color="blue darken-1" @click="click=setMenuTab()">Go</v-btn>
                            </v-flex>
                          </v-layout>
                        </v-card-actions>
                      </v-card> -->
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setMenuTab()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-truck</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-truck</v-icon>
                        <p class="text-xs-center menuLabel">ADD</p>
                <!-- </div> -->
              </v-card>


                    </v-flex>
                    <v-flex xs6 pa-2>

                      <!-- <v-card dark color="#1565C0" class="elevation-22"
                      style="padding-top:50px;padding-bottom:20px;">
                        <v-icon x-large dark>mdi-truck-delivery</v-icon>
                        <v-card-text>Return</v-card-text>
                        <v-card-actions class="text-xs-center">
                          <v-layout row>
                            <v-flex xs-4 class="text-xs-center">
                              <v-btn color="blue darken-1" @click="click='scan'">Go</v-btn>
                            </v-flex>
                          </v-layout>
                        </v-card-actions>
                      </v-card> -->
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setMenuTab()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-truck-delivery</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-truck-delivery</v-icon>
                        <p class="text-xs-center menuLabel">RETURN</p>
                      </v-card>

                    </v-flex>
                  </v-layout>
                  <v-layout wrap>

                    <v-flex xs6 pa-2>

                      <!-- <v-card dark color="#1565C0" class="elevation-22"
                      style="padding-top:50px;padding-bottom:20px;">
                        <v-icon x-large dark>mdi-sync-alert</v-icon>
                        <v-card-text>Request</v-card-text>
                        <v-card-actions class="text-xs-center">
                          <v-layout row>
                            <v-flex xs-4 class="text-xs-center">
                              <v-btn color="blue darken-1" @click="click=setMenuRequest()">Go</v-btn>
                            </v-flex>
                          </v-layout>
                        </v-card-actions>
                      </v-card> -->
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setMenuRequest()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-sync-alert</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-sync-alert</v-icon>
                        <p class="text-xs-center menuLabel">Request</p>
                      </v-card>
                    </v-flex>
                    <v-flex xs6 pa-2>
                      <v-card
                        dark
                        color="#1565C0"
                        class="text-xs-center menuCard"
                        clickable
                        style="position:relative;"
                        @click.native="click=setMenuChart()"
                        height="100%"
                      >
                        <div class="background-icon">
                          <v-icon class="icon">mdi-chart-areaspline</v-icon>
                        </div>
                        <v-icon style="font-size:100px;">mdi-chart-areaspline</v-icon>
                        <p class="text-xs-center menuLabel">Report</p>
                      </v-card>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-card>
            </v-container>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </div>
</template>

<script>
import {
  mapActions,
} from 'vuex'
import {
  sync,
} from 'vuex-pathify'
import store from '../store/store'

export default {
  data() {
    return {
      click: null,
    }
  },
  mounted() {},
  computed: {
    ...sync('*'),
  },
  methods: {
    ...mapActions({
      // SetDataMenuRequest: 'getApi/SetDataMenuRequest',
      setDataLogin: 'getApi/setDataLogin',
    }),
    setMenuRequest() {
      const menu = 'request'
      this.setDataLogin(menu);
    },
    setMenuTab() {
      const menu = 'tab'
      this.setDataLogin(menu);
    },
    setMenuChart() {
      const menu = 'chart'
      this.setDataLogin(menu);
    },
  },
}
</script>
<style scoped>
.v-card:hover {
  cursor: pointer;
  opacity: 0.85;
}

.menuCard:hover {
  cursor: pointer;
}
.menuCard {
  padding-top: 40px;
  padding-bottom: 30px;
  background-size: 50% auto;
  background-position: right top;
  overflow: hidden;
}

.menuLabel {
  font-size: 22px;
  line-height: 30px;
  margin-top: 10px;
  margin-bottom: 4px;
}

.background-icon {
  position: absolute;
  opacity: 0.075;
  top: 10%;
  left: 15%;
}

.background-icon .icon {
  font-size: 150px;
}
</style>
