<template>
          <div>
    <v-content>
      <v-container>
        <v-layout align-center justify-center>
             <v-flex  class="grey lighten-4">
        <v-container>
          <v-card flat>
            <v-card-title primary-title>
              <h4>Login</h4>
            </v-card-title>
            <v-form>
            <v-text-field prepend-icon="mdi-check-circle-outline" name="Username" label="Username"></v-text-field>
            <v-text-field prepend-icon="mdi-lock" name="Password" label="Password" type="password"></v-text-field>
            <v-card-actions>
              <v-btn color="blue" dark large block @click="setData()">Login</v-btn>
              <v-btn color="primary" dark large block>Register</v-btn>
            </v-card-actions>
            </transition>
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
// import tab from './tab.vue'

export default {
  name: 'Login',
  components: {
    // tab,
  },
  data() {
    return {
      z: '',
    }
  },
  methods: {
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    setData() {
      this.setDataLogin(true);
    },
  },
}
</script>
