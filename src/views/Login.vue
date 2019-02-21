<template>
    <div>
      <!-- <span class="bg"></span> -->
        <v-content>
            <v-container>
                <v-layout align-center justify-center>
                    <v-flex class="grey lighten-4">
                        <v-container>
                            <v-card flat>
                                <v-card-title>
                                <v-toolbar color="blue lighten-2" dark>
          <v-toolbar-title>Login</v-toolbar-title>
        </v-toolbar>
                                </v-card-title>
                                <v-form>
                                    <v-layout>
                                        <v-flex ma-1 pr-5>
                                            <v-text-field prepend-icon="mdi-check-circle-outline"
                                            name="Username" label="Username"></v-text-field>
                                            <v-text-field prepend-icon="mdi-lock" name="Password"
                                            label="Password" type="password"></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                    <v-card-actions>
                                        <v-btn color="blue" dark large block
                                        @click="setData(datainsert)">Login</v-btn>
                                        <v-btn color="blue" dark large block
                                        @click="Register()">Register</v-btn>
                                    </v-card-actions>
                                </v-form>
                            </v-card>
                        </v-container>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <!-- {{data}} -->
    </div>
</template>
<script>
import axios from 'axios'
// import VueAxios from 'vue-axios'
import {
  mapActions,
} from 'vuex'
// eslint-disable-next-line import/extensions
import getData from './getApiData/getApiData.js'

// import tab from './tab.vue'
export default {
  name: 'Login',
  components: {
    // tab,
  },
  data() {
    return {
      data: [],
      z: '',
      datainsert: {
        pid: '1199900388175',
        fname: 'arada',
        lname: 'suf',
        tname: 'asd',
        bdate: '25620202',
        email: 'adaf@gmail.com',
        tel: '0882881878',
        flag_id: '0',
        now_date: '22560202',
        rcode_id: '7704',
        index1: '123',
        index2: '123',
      },

    }
  },
  async created() {
    await this.getdata()
  },
  mounted() {
    getData.getApiData()
  },
  methods: {
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    setData(data) {
      getData.sendData(data)
      // const menu = 'Menu'
      // this.setDataLogin(menu);
    },
    Register() {
      const Register = 'Register'
      this.setDataLogin(Register);
    },
    async getdata() {
      // alert('testFN')
      await axios.get('https://jsonplaceholder.typicode.com/posts/42')
        .then((response) => {
          this.data = response.data
          this.alert = this.data
        })
        .catch(() => {
          this.alert = 'ไม่พบข้อมูล'
        })
    },
  },
}
</script>
<style>
/* .bg {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background-color: red;
    transform: scale(1.1);
  } */
</style>
