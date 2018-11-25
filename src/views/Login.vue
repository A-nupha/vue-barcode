<template>
    <div>
        <v-content>
            <v-container>
                <v-layout align-center justify-center>
                    <v-flex class="grey lighten-4">
                        <v-container>
                            <v-card flat class="elevation-20">
                                <v-card-title primary-title>
                                    <h4>Login</h4>
                                </v-card-title>
                                <v-form>
                                    <v-layout>
                                        <v-flex ma-1>
                                            <v-text-field prepend-icon="mdi-check-circle-outline" name="Username" label="Username"></v-text-field>
                                            <v-text-field prepend-icon="mdi-lock" name="Password" label="Password" type="password"></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                    <v-card-actions>
                                        <v-btn color="blue" dark large block @click="setData()">Login</v-btn>
                                        <v-btn color="blue" dark large block>Register</v-btn>
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
    }
  },
  async created() {
    await this.getdata()
  },
  methods: {
    ...mapActions({
      setDataLogin: 'getApi/setDataLogin',
    }),
    setData() {
      this.setDataLogin(true);
    },
    async getdata() {
      alert('testFN')
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
