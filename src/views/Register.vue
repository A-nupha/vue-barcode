<template>
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
              <form @submit.prevent="onSignup">
                <v-layout row>
                  <v-flex xs12>
                    <!-- <v-select class="selectTest" :items="items">
                    </v-select> -->
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
                  <v-flex xs12>
                    <v-btn color="blue" dark large block :loading="loadingbtn"
                    type="submit" @click="dataInsert()">Register</v-btn>
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
  data() {
    return {
      selected: '',
      confirmPassword: '',
      LastName: '',
      username: '',
      password: '',
      email: '',
      fname: '',
      lname: '',
      tname: 'Mr.',
      pid: '',
      loadingbtn: null,
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
    dataInsert() {
      this.loadingbtn = true
      console.log('this.loading ', this.loadingbtn )
      const obj = {
        username: this.username,
        password: this.password,
        email: this.email,
        fname: this.fname,
        lname: this.lname,
        tname: this.tname,
        pid: this.pid,
      }
      console.log('obj', obj)
      controlData.save(obj)
      console.log('store.state.msgErrorLogin', store.state.msgErrorLogin)
      if (store.state.msgErrorLogin == 'บันทึกล้มเหลวกรุณาตรวจสอบ') {
        // console.log('store.state.msgErrorLogin')
        // const menu = 'LoginApp'
        // this.setDataLogin(menu);
        alert('บันทึกล้มเหลวกรุณาตรวจสอบ')
        this.loadingbtn = false
      } else {
        console.log('else')
        this.loadingbtn = false
        // this.loading = false
      }
      // "bdate=undefined&email=scvsd%40gmail.com&flag_id=undefined&fname=anupha&index1=dfbdfb&index2=123&lname=ssdsfff&now_date=undefined&pid=1759900252522&rcode_id=undefined&tel=undefined&tname=Mr."
    },
  },
}
</script>
