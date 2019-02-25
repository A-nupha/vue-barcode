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
                      name="password"
                      label="Username"
                      id="name"
                      type="name"
                      v-model="username"
                      required>
                    </v-text-field>
                  
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-lock-question"
                      name="password"
                      label="Password"
                      id="password"
                      v-model="password"
                      type="password"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon= "mdi-alert-octagon"
                      name="confirmPassword"
                      label="Validate Password"
                      id="confirmPassword"
                      v-model="confirmPassword"
                      type="password"
                      :rules="[comparePasswords]"></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-email"
                      name="email"
                      label="Your E-mail"
                      id="email"
                      v-model="email"
                      type="email"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                      prepend-icon="mdi-account"
                      name="First Name"
                      label="First Name"
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
                      name="Last Name"
                      label="Last Name"
                      id="LastName"
                      v-model="lname"
                      type="text"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs12>
                    <v-text-field
                    prepend-icon="mdi-account-card-details"
                      name="password"
                      label="Pid"
                      id="password"
                      v-model="pid"
                      type="Pid"
                      mask="#-####-#####-##-#"
                      required></v-text-field>
                  </v-flex>
                </v-layout>
              <v-layout wrap>
              <v-flex xs12>
                <!-- <v-combobox prepend-icon=" " v-model="select" :items="items" label="Title name" /> -->
                <v-radio-group v-model="tname" row>
                  <v-radio required prepend-icon=" "  color="blue" label="Mr." value="Mr."/>
                  <v-radio required prepend-icon=" "  color="blue" label="Mrs." value="Mrs."/>
                  <v-radio required prepend-icon=" "  color="blue" label="Ms." value="Ms."/>
                </v-radio-group>
                <!-- {{tname}} -->
              </v-flex>
              </v-layout>
              <v-layout>
                  <v-flex xs12>
                    <v-btn color="blue" dark large block
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
import controlData from './getApiData/controlData.js'

export default {
  data() {
    return {
      selected: '',
      items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
      confirmPassword: '',
      LastName: '',

      username: '',
      password: '',
      email: '',
      fname: '',
      lname: '',
      tname: 'Mr.',
      pid: '',
    }
  },
  computed: {
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
      // "bdate=undefined&email=scvsd%40gmail.com&flag_id=undefined&fname=anupha&index1=dfbdfb&index2=123&lname=ssdsfff&now_date=undefined&pid=1759900252522&rcode_id=undefined&tel=undefined&tname=Mr."
      const menu = 'LoginApp'
      this.setDataLogin(menu);
    },
  },
}
</script>
