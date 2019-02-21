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
                                        <v-toolbar-title>Register</v-toolbar-title>
                                    </v-toolbar>
                                </v-card-title>
                                <v-form>
                                    <v-layout>
                                        <v-flex ma-1 pr-5>
                                            <v-text-field prepend-icon="mdi-check-circle-outline" label="First Name"></v-text-field>
                                            <v-text-field prepend-icon="mdi-lock" label="Last Name"></v-text-field>
                                            <v-text-field prepend-icon=" " label="Passwors" type="password"></v-text-field>
                                                        <v-combobox prepend-icon=" " v-model="select" :items="items" label="Title Name"></v-combobox>
                                            <v-text-field prepend-icon=" " label="Your Email" type="mail"></v-text-field>
                                            <v-text-field prepend-icon=" " label="Your Phone" type="mail"></v-text-field>
                                            <v-text-field prepend-icon=" " label="Your Phone" type="mail"></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                    <v-card-actions>
                                        <v-btn color="blue" dark large block @click="">Login</v-btn>
                                        <v-btn color="blue" dark large block @click="">Register</v-btn>
                                    </v-card-actions>
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
export default {
  data() {
    return {
      select: 'นาย',
      items: [
        'Programming',
        'Design',
        'Vue',
        'Vuetify',
      ],
    }
  },
}
</script>
<style>
  /* html, body {
    margin: 0 !important;
    height: 100% !important;
    overflow: hidden !important
  }
  @font-face{
    font-family: 'CSChatThaiUI';
    src: url('./fonts/CSChatThaiUI.woff') format("woff");
  }
  *{
    font-family: 'CSChatThaiUI';
    font-size: 14px;
  }
  body::-webkit-scrollbar { display: none;  }
  html, body { -ms-overflow-style: none; overflow: auto; }
  label,.v-input--selection-controls.v-input .v-label{
    color:#673AB7; font-weight: bold;font-size: 14px;
  }
  .component-fade-enter-active, .component-fade-leave-active {
    transition: opacity .2s ease;
  }
  .component-fade-enter, .component-fade-leave-to {
    opacity: 0;
  }

  hr {
    background-color: #673AB7; height: 2px; border: none;
  }
  .v-input input, .v-menu__activator{
    max-height: 25px;
  }
  .v-tabs__div {
    color: #ffffff !important;
    height: 30px;

  }
  .v-tabs__bar{
    background-color: #7954b8 !important;
    height: 30px;
  }
  .v-tabs__slider-wrapper {
    height: 18px;
    border-color: #673AB7 !important
  }
  .v-tabs__bar .v-tabs__item--active{
    background-color: #8363b9 !important;
    color: #ffffff !important;
    height: 30px !important;
  }
  .v-input .v-label {
    width: auto;
    font-size: 14px;
    color:#673AB7;
  }
  .v-text-field .v-label {
    width: auto;
    color:#673AB7;
    font-size: 14px;
    line-height: 26px;
    height: auto;
  }
  .v-text-field .v-label--active{
    max-width :none;
    font-size:18px;
  }
  .v-textarea.v-text-field--box.v-text-field--single-line .v-text-field__prefix,
  .v-textarea.v-text-field--box.v-text-field--single-line textarea,
  .v-textarea.v-text-field--enclosed.v-text-field--single-line
  .v-text-field__prefix, .v-textarea.v-text-field--enclosed.v-text-field--single-line textarea {
    margin-top: 0px;
  }
  .v-input--radio-group .v-input__control .v-input__slot{
    margin-bottom: 0px
  }
  .v-radio{
    align-items:flex-start
  }
  .v-icon .v-input__icon{
    font-size: 30px !important
  }
  .v-text-field .v-input__control .v-text-field__details,
  .v-messages{
     display: none;
  }
  .select-label .v-select__selection{
    color:#673AB7;
  }
  .selectCtrl .v-select>.v-input__control>.v-input__slot{
    height:28px !important;
  }

  .selectCtrl2 .v-select>.v-input__control>.v-input__slot{
    height:28px !important;
    width: 15rem;
  }
  .datePicker .v-icon.material-icons{
   padding-top: 1.5rem;
   font-size: 25px !important;
  }

  .active  {
    background: linear-gradient(to right, rgba(95, 212, 241, 0.5), rgba(136, 83, 228, 0.53));
    color: rgb(95, 10, 175);
  }
  textarea{
    margin-top:0px!important;
  }
  .v-textarea textarea{
    padding-bottom: 1 px;
    padding-top: 1px;
  }
  .v-input--selection-controls:not(.v-input--hide-details) .v-input__slot{
    margin-bottom:4px;
  }
  .v-input--radio-group--column .v-radio:not(:last-child):not(:only-child) {
    margin-bottom: 0px
  } */

</style>
