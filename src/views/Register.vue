<template>
<div>
  <v-container>
    <v-layout row v-if="error">
      <v-flex xs12 sm6 offset-sm3>
        <app-alert @dismissed="onDismissed" :text="error.message"></app-alert>
      </v-flex>
    </v-layout>
    <v-layout row>
      <v-flex xs12 sm6 offset-sm3>
        <v-card>
          <v-card-text>
            <v-container>
              <form>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-account-box"
                      name="Username"
                      label="Username"
                      v-model="username"
                      required>
                    </v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-lock-question"
                      v-model="password"
                      label="password"
                      type="password"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon= "mdi-alert-octagon"
                      label="Validate Password"
                      v-model="confirmPassword"
                      type="password"
                      :rules="[comparePasswords]"></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-email"
                      label="Your E-mail"
                      v-model="email"
                      type="email"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-account"
                      name="FirstName"
                      label="FirstName"
                      id="name"
                      v-model="fname"
                      type="text"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon=" "
                      label="LastName"
                      v-model="lname"
                      type="text"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                    prepend-icon="mdi-account-card-details"
                      label="Pid"
                      v-model="pid"
                      mask="#-####-#####-##-#"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                    prepend-icon="mdi-account-card-details"
                      label="id branch"
                      v-model="branch"
                      mask="####"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout>
                  <v-flex>
                 <v-text-field
                    prepend-icon="mdi-account-card-details"
                      label="Name branch"
                      v-model="branchName"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
              <v-layout wrap>
              <v-flex xs12>

                <v-radio-group v-model="tname" row>
                  <v-radio required prepend-icon=" "  color="blue" label="Mr." value="Mr."/>
                  <v-radio required prepend-icon=" "  color="blue" label="Mrs." value="Mrs."/>
                  <v-radio required prepend-icon=" "  color="blue" label="Ms." value="Ms."/>
                </v-radio-group>

              </v-flex>
              </v-layout>
              <v-layout>
                <v-radio-group v-model="select" row>
                  <v-radio required prepend-icon=" "  color="blue" label="Manager" value="01"/>
                  <v-radio required prepend-icon=" "  color="blue" label="Empooyee" value="02"/>
                </v-radio-group>
              </v-layout>
              <v-layout ma-0>
                  <v-flex xs12 ma-0>
                    <v-btn color="blue" dark large block :loading='loadingbtn'
                    @click="dataInsert()">Register</v-btn>
                  </v-flex>
                </v-layout>
                <v-flex xs12>
                </v-flex>
              </form>
            </v-container>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
  <v-layout row justify-center>
      <v-dialog v-model="snackฺฺฺBarBool" persistent max-width="400px">
        <v-card>
          <v-flex>
          <v-card-title
          :class='color'
          primary-title
          flat>
          <v-icon class="mr-3" color="white">mdi-information</v-icon>
          <v-flex class=""><v-flex class="white--text">INFORMATION</v-flex></v-flex>
        </v-card-title>
          <v-card-title>
            <v-layout justify-center><span>{{msgSnackBar}}</span></v-layout>
          </v-card-title>
          </v-flex>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="success()">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>
</div>
</template>

<script>
import {
  mapActions,
} from 'vuex'
import {
  sync,
} from 'vuex-pathify'
import moment from 'moment'
import controlData from './getApiData/controlData'
import store from '../store/store'
import functions from '../plugins/functions'


export default {
  data() {
    return {
      color: '',
      branchName: '',
      snackฺฺฺBarBool: null,
      timeout: 10000,
      select: '02',
      items: [
        'Empooyee',
        'Manager',
      ],
      selected: '',
      confirmPassword: '',
      LastName: '',
      username: '',
      password: '',
      email: '',
      fname: '',
      lname: '',
      tname: 'Mr.',
      branch: '',
      pid: '',
      msgSnackBar: '',
      loadingbtn: null,
      // nowDate: functions.moment('YYYYMMDD'),
      nowDate: functions.moment(moment().format('YYYYMMDD')),
    }
  },
  computed: {
    ...sync('*'),
    comparePasswords() {
      return this.password !== this.confirmPassword ? 'Passwords do not match.' : true
    },
    user() {
      return this.$store.getters.user
    },
    error() {
      return this.$store.getters.error
    },
    loading() {
      return this.$store.getters.loading
    },
  },
  watch: {
    user(value) {
      if (value !== null && value !== undefined) {
        this.$router.push('/')
      }
    },
  },
  methods: {
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    onSignup() {
      this.$store.dispatch('signUserUp', { email: this.email, password: this.password, username: this.username })
    },
    onDismissed() {
      this.$store.dispatch('clearError')
    },
    async dataInsert() {
      if (this.username || this.password || this.fname || this.pid) {
        this.loadingbtn = true
        const obj = {
          username: this.username,
          password: this.password,
          email: this.email,
          fname: this.fname,
          lname: this.lname,
          tname: this.tname,
          pid: this.pid,
          flag_id: this.select,
          now_date: this.nowDate,
          rcode_id: this.branch,
          role_id: this.select,
        }
        console.log('obj', obj)
        await controlData.save(obj)
        const objBranch = {
          branchName: this.branchName,
          branch: this.branch,
        }
        await controlData.insertBranchName(objBranch)
        await this.awitData()
      } else {
        this.snackฺฺฺBarBool = true
        this.msgSnackBar = 'กรุณากรอกให้ครบสิคะ ไปทำมาใหม่นะ'
        this.color = 'red'
      }
    },
    awitData() {
      if (Boolean(store.state.msgSave) === false && Boolean(store.state.msginsertBranch) === false) {
        console.log('msgErrorLogin', store.state.msgSave)
        this.loadingbtn = false
        this.snackฺฺฺBarBool = true
        this.msgSnackBar = 'unsuccessful'
        this.color = 'red'
      } else {
        this.loadingbtn = false
        this.snackฺฺฺBarBool = true
        this.msgSnackBar = 'success'
        this.color = 'green'
      }
    },
    success() {
      this.snackฺฺฺBarBool = false
      const menu = 'Menu'
      this.setDataLogin(menu);
    },
  },
}
</script>
