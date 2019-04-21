<template>

    <v-layout row>
      <v-flex xs12>
        <v-tabs
          v-model="active">
          <v-tab :key="'Person'"  >
            ประวัติส่วนตัว
          </v-tab>
          <v-tab-item :key="'Person'">
            <Person  header="ประวัติส่วนตัว"/>
          </v-tab-item>
          <v-tab :key="'Import'" >
            บิดา และ มารดา
          </v-tab>
          <v-tab-item :key="'Import'">
            <Import header=" บิดา และ มารดา"/>
          </v-tab-item>

          <v-tab :key="'Son'">
            บุตร
          </v-tab>
          <v-tab-item :key="'Son'">
            <Son header="บุตร"/>
          </v-tab-item>

        </v-tabs>
      </v-flex >
    </v-layout>


</template>

<script>
// ประวัติส่วนตัว
import { mapState, mapGetters, mapActions } from 'vuex'
import Person from './Person.vue'
// การศึกษา
import Edu from './edu.vue'
// ประวัติการทำงาน
import Career from './CareerHis.vue'
// หนังสือสำคัญ
import Import from './Important.vue'
// ข้อมูลคู่สมรส
import Son from './Marryy.vue'
// vuex

export default {
  name: 'Profile',
  data() {
    return {
      active: null,
      button: 'ถัดไป',
    }
  },
  computed: {
    ...mapState({
      Pid: store => store.XUser.pid,
    }),
  },
  components: {
    Person,
    Edu,
    Career,
    Import,
    Son,
  },
  // mounted() {
  //   let url = "../marry.json";
  //   axios({
  //     method: "get",
  //     url: url,
  //     dataType: "json",
  //     headers: { "X-Requested-With": "XMLHttpRequest" }
  //   })
  //     .then(function(res) {
  //       console.log("Data", res.data);
  //     })
  //     .catch(function(error) {
  //       console.log("Error", error);
  //     });
  // },
  methods: {
    handleTabClick(e) {
      console.log(e)
    },
    submit() {
      alert('333')
    },

    next() {
      const active = parseInt(this.active)
      // alert(active);
      if (active === 1) {
        this.$data.button = 'บันทึก'
      }
      if (active === 2) {
        this.submit()
        // alert("sucess!!!");
      } else {
        this.active = active + 1
      }
    },
  },
}
</script>
