<template>
    <v-app id="inspire">
        <v-row justify="end">
            <v-dialog
                v-model="dialog"
                
                max-width="92%"
                transition="dialog-right-transition">

             
                <v-card>
                  <v-card-title> 
                      <v-row>
                          <v-col>
                      
                     Edit Response ( :{{response}} )
                          </v-col>
                          <v-col  md="1" sm="1"
        offset-md="6" offset-sm="6" >
                                                

                                        <v-btn  @click="edit(3)" text color="primary">
                                            <span></span>

                                            <v-icon class="danger">      mdi-comment-remove-outline
                                            </v-icon>
                                        </v-btn>
                                        </v-col>
                      </v-row>

                  </v-card-title>
                    <v-card-text>
                        <v-container>
                           <!-- form -->
  <div class="form-wrapper">
    <FormulateForm
      v-model="formData"
          @submit="submitHandler"

    >
  
<v-row>
<v-col cols="12" sm="12" md="12" >
    <FormulateInput
  type="text"
  name="text_fr"
  label="Response French"
  validation="required"
  error-behavior="live"
/>
</v-col>

<v-col cols="12" sm="12" md="12" >
    <FormulateInput
  type="text"
  name="text_ar"
  label="Response Arabic "
  validation="required"
  error-behavior="live"
/>
</v-col>


</v-row>

<v-row>
<v-col cols="2" sm="2" md="2" >
    <FormulateInput
  name="is_true"
  type="checkbox"
  label="Is Correct ?"
/>
</v-col>
<v-col cols="2" sm="2" md="2" >
    <FormulateInput
  name="hasNote"
  type="checkbox"
  label="has Note ?"
/>
</v-col>
</v-row>


<v-row>
<v-col cols="3" sm="3" md="3" >
     <FormulateInput
  type="number"
  name="note"
  label="Note"
/>
</v-col>
<v-col cols="3" sm="3" md="3" >
     <FormulateInput
  type="number"
  name="complete_note"
  label="Complete Note"
/>
</v-col>

<v-col cols="3" sm="3" md="3" >
     <FormulateInput
  type="number"
  name="order"
  label="Order"
/>
</v-col>
</v-row>


      <FormulateInput
        type="submit"
        label="Update Response "
      />
          </FormulateForm>

      </div>
      <!--
    <code class="code code--block">{{ formData }}</code>
  
      -->
                           <!--end form -->
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn
                            color="red darken-1"
                            text
                            @click="deleteResponse(response)"
                        >
                            Delete Response
                        </v-btn>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="edit(3)"
                        >
                            Close
                        </v-btn>
                       
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </v-app>
</template>

<script>
import Constants from './Constants.js'

    export default {
        mounted() {
            this.callApi();
    // value="One time initial value"

          //  http://localhost:8000/question/15/edit
        },
        data () {
            return {
                dialog: true,
                formData: {},

            }
        },
        props: ['response'] ,

        methods :{

           callApi() {
              axios.get(Constants.BASE_URL+"ad-api/simple-response/"+this.response).then(response => {
                this.formData = response.data;
                console.log(response.data);
            });
            },
            deleteResponse(index) {
             //  alert (index);
               axios.get(Constants.BASE_URL+'ad-api/response/delete/'+index)
                .then(function (response) {
                   // console.log(response.data.success);
                    console.log("success");

                })
                .catch(function (error) {
                    console.log("err");
                });

                this.dialog =!this.dialog
                this.$emit('clickedEditResponse', false)
            },

            edit(index) {
                // this.words.splice(index,1)
              //  alert(index);
                this.dialog =!this.dialog
                this.$emit('clickedEditResponse', false)

                /*
                 window.location.href = "http://localhost:8000/tabs";
                 */


            },
            submitHandler() {
                let currentObj = this;

                axios.post(Constants.BASE_URL+'ad-api/response/update/'+this.response, this.formData )
                .then(function (response) {
                   // console.log(response.data.success);
                    console.log("success");

                })
                .catch(function (error) {
                    console.log("err");
                });


                this.$emit('clickedEditResponse', false)
                this.dialog =!this.dialog

            }
        }
    }
</script>

<style>

/******form ************ */


label:not(.form-check-label):not(.custom-file-label) {
    font-weight: 500;
    color: black !important;
}



/********************** */
    .v-application--wrap {
        flex: 1 1 auto;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        display: flex;
        flex-direction: column;
        min-height: 10vh;
        max-width: 100%;
        position: relative;
    }
    .v-dialog:not(.v-dialog--fullscreen) {
        bottom: 0 !important;
        right: 0 !important;
        position: absolute !important;
    }

    .v-dialog:not(.v-dialog--fullscreen) {
        max-height: 90%;
    }

    .v-dialog {
        border-radius: 4px;
        margin: 2em 0.5em 0.5em 6em;
        overflow-y: auto;
        pointer-events: auto;
        transition: .3s cubic-bezier(.25,.8,.25,1);
        width: 100%;
        z-index: 100;
        box-shadow: 0 11px 15px -7px rgba(0,0,0,.2), 0 24px 38px 3px rgba(0,0,0,.14), 0 9px 46px 8px rgba(0,0,0,.12);
    }
    .text_ar {
        direction:rtl;
    }
/*
    .v-dialog>.v-card>.v-card__title {
    font-size: 1.25rem;
    font-weight: 500;
    letter-spacing: .0125em;
    padding: 6px 2px 0px 20px;
    
}
*/
</style>
