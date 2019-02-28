<template>
<div>
    <v-content>
        <v-container>
            <v-layout align-center justify-center>
                <v-flex class="grey lighten-4">
                    <v-container>
                        <v-card flat>
                            <!-- <v-form>
                                                        <v-layout>
                                                            <v-flex ma-1 pr-5>
                                                                <v-text-field prepend-icon="mdi-account" name="Username" label="Username" v-model="userName"></v-text-field>
                                                                <v-text-field prepend-icon="mdi-lock" name="Password" label="Password" type="password" v-model="passWord"></v-text-field>
                                                            </v-flex>
                                                        </v-layout>
                                                        <v-card-actions>
                                                            <v-btn color="blue" :loading="loading" dark large block @click="login()">Login</v-btn>
                                                            <v-btn color="blue" dark large block @click="Register()">Register</v-btn>
                                                        </v-card-actions>
                                                        <li>{{userName}}</li>
                                                    </v-form> -->
                            <div>
                                <v-toolbar flat color="white">
                                    <v-toolbar-title>
                                        <v-flex xs12 subheader class="blue--text" ma-1>
                                            การแจ้งสินค้ามีปัญหา
                                        </v-flex>
                                    </v-toolbar-title>
                                    <v-divider class="mx-2" inset vertical></v-divider>
                                    <v-spacer></v-spacer>
                                </v-toolbar>
                                <v-data-table :headers="headers" :items="desserts" class="elevation-1">
                                    <template slot="items" slot-scope="props">
                                        <td class="text-xs-center">{{ props.item.name }}</td>
                                        <!-- <td class="text-xs-center">{{ props.item.calories }}</td> -->
                                        <td class="text-xs-center">{{ props.item.fat }}</td>
                                        <!-- <td class="text-xs-center">{{ props.item.carbs }}</td> -->
                                        <td class="text-xs-center">{{ props.item.carbs }}</td>
                                        <td class="justify-center layout px-0">                                            
                                            <v-btn icon>
                                            <v-icon color="orange" @click="editItem(props.item)">mdi-border-color</v-icon>
                                            </v-btn>
                                            <!-- <v-btn icon>
                                            <v-icon color="red" @click="deleteItem(props.item)">mdi-delete</v-icon>
                                            </v-btn> -->
                                        </td>
                                    </template>
                                    <template slot="no-data">
                                        <v-btn color="primary" @click="initialize">
                                            Reset</v-btn>
                                    </template>
                                </v-data-table>
                            </div>
                        </v-card>
                    </v-container>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

        <v-toolbar dark color="blue">
            <v-btn slot="activator" color="blue" dark class="mb-2">
                <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn dark flat @click="dialog = false">Save</v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card>
            <v-card-title>
                <span class="blue--text subheadline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedItem.name" label="Barcode"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedItem.calories" label="Branch"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedItem.fat" label="Status"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedItem.carbs" label="Quanity"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 md4>
                            <v-text-field v-model="editedItem.protein" label="Name"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                <v-btn color="red darken-1" dark @click="deleteItem(props.item)">Delete</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</div>
</template>

<script>
export default {
  name: 'Request',
  components: {
    // tab,
  },
  data() {
    return {
      dialog: false,
      headers: [{
        text: 'Barcode',
        align: 'center',
        sortable: false,
        value: 'name',
      },
      {
        text: 'Status',
        value: 'fat',
        sortable: false,
        align: 'center',
      },
      {
        text: 'Quantity',
        value: 'protein',
        align: 'center',
        sortable: false,
      },
      {
        text: 'Edit',
        value: 'name',
        sortable: false,
        align: 'center',
      },
      ],
      desserts: [],
      editedIndex: -1,
      editedItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
      defaultItem: {
        name: '',
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
    }
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    },
  },
  watch: {
    dialog(val) {
      val || this.close()
    },
  },
  created() {
    this.initialize()
  },
  methods: {
    initialize() {
      this.desserts = [{
        name: '12345678910115',
        calories: 'งามวงวาล',
        fat: 'ชำรุด',
        carbs: 24,
        protein: 'โค๊ก',
      },
      {
        name: '12365498798788',
        calories: 'พญาไท',
        fat: 'สูญหาย',
        carbs: 37,
        protein: 'น้ำเปล่า',
      },
      {
        name: '12365498798788',
        calories: 'ดินแดง',
        fat: 'สูญหาย',
        carbs: 23,
        protein: 'ดินสอ',
      },
      {
        name: '12365412398788',
        calories: 'สุขุมวิท',
        fat: 'ชำรุด',
        carbs: 67,
        protein: 'เมาส์',
      },
      {
        name: '12367892398118',
        calories: 'อโศก',
        fat: 'ชำรุด',
        carbs: 49,
        protein: 'ปากกา',
      },
      ]
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },
    deleteItem(item) {
      const index = this.desserts.indexOf(item)
      confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
    },
    close() {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
        this.desserts.push(this.editedItem)
      }
      this.close()
    },
  },
}
</script>

<style>
.theme--light .v-datatable thead th.column,
.theme--light .v-datatable thead th.column.sortable.active,
.theme--light .v-datatable thead th.column.sortable:hover,
.theme--light .v-datatable thead th.column.sortable.active i {
    color: white;
    background-color: #0091ea;
    font-size: 16px;
}

.table.v-table thead td:not(:nth-child(1)),
table.v-table tbody td:not(:nth-child(1)),
table.v-table thead th:not(:nth-child(1)),
table.v-table tbody th:not(:nth-child(1)),
table.v-table thead td:first-child,
table.v-table tbody td:first-child,
table.v-table thead th:first-child,
table.v-table tbody th:first-child {
    padding: 0 7px;
    font-size: 13px;
}
</style>
