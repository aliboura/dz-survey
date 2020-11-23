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
                      
                     Create survey 
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
<v-col cols="3" sm="3" md="3" >
    <FormulateInput
  type="text"
  name="name"
  label="Survey name"
  placeholder="Survey name"
  help="Survey name"
  validation="required"
  error-behavior="live"
/>
</v-col>
<v-col cols="4" sm="4" md="4" >
    <FormulateInput
  type="text"
  name="title"
  label="Title"
  placeholder="Title"
  help="Title"
  validation="required"
/>
</v-col>

<v-col cols="5" sm="5" md="5" >


<FormulateInput
  type="text"
  name="subtitle"
  label="Sub Title"
  placeholder="Sub Title"
  help="Sub Title"
 validation="required"
  
/>
</v-col>

</v-row>
 

<v-row>
<v-col cols="2" sm="2" md="2" >

<FormulateInput
  name="using_icons"
  type="checkbox"
  label="Use icons"
/>
</v-col>

<v-col cols="2" sm="2" md="2" >

<FormulateInput
  name="active"
  type="checkbox"
  label="Active ?"
/>
</v-col>




<v-col cols="3" sm="3" md="3" >

<FormulateInput
  name="with_auth"
  type="checkbox"
  label="With Authentication"
/>
</v-col>

<v-col cols="2" sm="2" md="2" >

<FormulateInput
  name="has_notes"
  type="checkbox"
  label="Has Note ?"
/>
</v-col>
</v-row>   

<v-row>

<v-col cols="2" sm="2" md="2">


<FormulateInput
  type="number"
  name="total_notes"
  label="Total Notes"
  help="for example 50 "
  
/>
</v-col> 



<v-col cols="2" sm="2" md="2" >

<FormulateInput
  name="shape"
  :options="{circle: 'circle',square: 'square', tab: 'tab'}"
  type="select"
  placeholder="Select a shape"
  label="Select a shape" 
  validation="required"
/>
</v-col>

<v-col cols="2" sm="2" md="2" >
<FormulateInput
  type="color"
  name="color"
  label="Theme Color"
  placeholder="Theme Color"
  help="Theme Color"
  validation="required"
/>
</v-col>

</v-row>



<v-row>
 
 <v-col cols="12" sm="12" md="12" >

 <FormulateInput
  type="textarea"
  name="description"
  label="Description"
  placeholder="Description"
  help="Description"
  error-behavior="live"
  
/>
 </v-col>
</v-row>


      <FormulateInput 

        type="group"
          validation="required"

        name="pages"
        :repeatable="true"
        label="Please give pages "
        add-label="+ Add Page "
      >
        <div class="attendee">
          <FormulateInput
            name="name_fr"
            type="text"
            label="Page name french"
          />
          <FormulateInput
            type="text"
            name="name_ar"
            label="Page Name Arabic"
          />
        </div>
      </FormulateInput>
      
      <FormulateInput
        type="submit"
        label="Create Survey "
      />
    </FormulateForm>
    <!--
    <code class="code code--block">{{ formData }}</code>

    -->
  </div>

                           <!--end form -->
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
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
           // this.callApi();
    // value="One time initial value"

          //  http://localhost:8000/question/15/edit
        },
        data () {
            return {
                dialog: true,
                formData: {},

            }
        },
      

        methods :{

          

            edit(index) {
                // this.words.splice(index,1)
              //  alert(index);
                this.dialog =!this.dialog
                this.$emit('clickedSubmit', false)

                /*
                 window.location.href = "http://localhost:8000/tabs";
                 */


            },
            submitHandler() {
                let currentObj = this;
                axios.post(Constants.BASE_URL+'ad-api/surveys', this.formData )
                .then(function (response) {
                   // console.log(response.data.success);
                    console.log("success");

                })
                .catch(function (error) {
                    console.log("err");
                });


                this.dialog =!this.dialog
                this.$emit('clickedSubmit', false)
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

label:not(.form-check-label):not(.custom-file-label) {
    font-size: 1.1rem;
    font-weight: 400 !important;
    letter-spacing: .0115em;
    line-height: 1.3rem;
    word-break: break-all;
}
</style>
