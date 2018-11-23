<template>
  <div class="about">
    <v-flex ma-1 color="primary">
   
          <h1>This is an about page</h1>
          <v-card>
            <v-flex>
              <v-layout align-center justify-center>
             <v-flex  class="grey lighten-4">branch</v-flex>
               <v-text-field prepend-icon="mdi-check-circle-outline" name="Branch" label="Branch"></v-text-field>
             </v-layout>
               <v-layout  align-center justify-center>
                 <v-flex  class="grey lighten-4">batch</v-flex>
                    <v-text-field prepend-icon="mdi-check-circle-outline" name="batch" label="batch"></v-text-field>
               </v-layout>
                <v-layout  align-center justify-center>
                 <v-flex  class="grey lighten-4">location</v-flex>
                    <v-text-field prepend-icon="mdi-check-circle-outline" name="location" label="location"></v-text-field>
               </v-layout>
          </v-flex>
          </v-card>
          
    </v-flex>
  </div>
</template>
