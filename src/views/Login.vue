<template>
  <div>
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
                    <v-flex ma-1 pr-5  >
                      <v-text-field prepend-icon="mdi-account" name="Username" label="Username" v-model="userName"></v-text-field>
                      <v-text-field prepend-icon="mdi-lock" name="Password" label="Password" type="password" v-model="passWord"></v-text-field>
                    </v-flex>
                  </v-layout>
                  <v-card-actions>
                    <v-btn color="blue" :loading="loading"  dark large block @click="login()">Login</v-btn>
                    <!-- <v-btn color="red" dark large block @click="Register()">Register</v-btn> -->
                  </v-card-actions>
                  <!-- <li>{{userName}}</li> -->
                  <!-- <li>{{msg}}</li> -->
                  <!-- {{store.state.msgSnackBar}} -->
                </v-form>
              </v-card>
            </v-container>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
    <v-snackbar
    :vertical="true"
    v-model="snackฺฺฺBarBool"
    color="orange"
    :timeout="timeout"
    bottom>
    <v-flex headline>{{msgSnackBar}}</v-flex>
  </v-snackbar>
  </div>
</template>
<script>

import {
  mapActions,
} from 'vuex'
import {
  sync,
} from 'vuex-pathify'
import controlData from './getApiData/controlData'
import store from '../store/store'

export default {
  name: 'Login',
  components: {
    // tab,
  },
  data() {
    return {
      snackฺฺฺBarBool: null,
      msgSnackBar: null,
      timeout: 5000,
      inputUserName: null,
      inputPassword: null,
      data: [],
      z: '',
      loading: false,
      datainsert: {
        pid: '1759900252875',
        fname: 'A-nupha',
        lname: 'Supreyaporn',
        tname: 'mr.',
        bdate: '25620202',
        email: 'fhj@gmail.com',
        tel: '0882881878',
        flag_id: '0',
        now_date: '22560202',
        rcode_id: '7704',
        index1: '1234',
        index2: '1234',
      },
    }
  },
  computed: {
    ...sync('*'),
  },
  created() {
    // controlData.search().then((response) => {
    //   let retData = response.data
    //   retData.forEach((k, v) => {
    //     let pid = k.pid
    //     if (pid != this.store.state.userName) {
    //       alert('ไม่พบผู้ใช้งานนี้ในระบบ')
    //     }
    //   });
    // });
  },
  methods: {
    async login() {
      this.loading = true
      const userName = store.state.userName
      const passWord = store.state.passWord
      console.log(userName)
      console.log(passWord)
      await controlData.login(userName, passWord)
      // console.log('store.state.msgLogin', store.state.msgLogin.)
      if (store.state.msgLogin[0].index1 == userName) {
        // alert('ถูกต้อง')
        const menu = 'Menu'
        this.setDataLogin(menu);
        this.loading = false
      } if (store.state.msgLogin == 'password is incorrect') {
        const textmsg = 'รหัสผ่านไม่ถูกต้อง'
        const boolmsg = true
        this.msgSnackBar = textmsg
        this.snackฺฺฺBarBool = boolmsg
        console.log(store.state.msgLogin)
        // console.log(textmsg, boolmsg)
        this.loading = false
      }
    },
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    async setData(data) {
      controlData.save(data) // เอาไว้เทสดาต้า
      const menu = 'Menu'
      this.setDataLogin(menu);
      // await this.validatePassword()
    },
    // validatePassword() {
    //   if (Username == this.XXX && this.password == this.yyy) {
    //     const menu = 'Menu'
    //     this.setDataLogin(menu);
    //   }
    // },
    Register() {
      const Register = 'Register'
      this.setDataLogin(Register);
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
