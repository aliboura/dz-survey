<template>
    <v-app id="inspire">
        <v-row justify="end">
            <v-dialog
                v-model="dialog"
                
                max-width="95%"
                transition="dialog-right-transition">

               

                <v-card>
                  <v-card-title> 
                      <v-row>
                          <v-col>
                      
                      Create Question (page :{{page}} )
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
    <FormulateInput
  type="hidden"
  name="page_id"
  :value="page"
/>
<v-row>
<v-col cols="4" sm="4" md="4" >
    <FormulateInput
  type="text"
  name="name_fr"
  label="Question French name"
  placeholder="Question French name"
  help="Question French name"
  validation="required"
  error-behavior="live"
/>
</v-col>
<v-col cols="4" sm="4" md="4" >
    <FormulateInput
  type="text"
  name="name_ar"
  label="Question Arabic name"
  placeholder="Question Arabic name"
  help="Question Arabic name"
  validation="required"
  error-behavior="live"
  
/>
</v-col>
<v-col cols="2" sm="2" md="2" >
    <FormulateInput
  type="number"
  name="order"
  label="Order"
  placeholder="100"
  help="Order"
  validation="required"
  error-behavior="live"
/>
</v-col>
<v-col cols="2" sm="2" md="2" >
<FormulateInput
  name="rules"
  :options="{required: 'required',no: 'not required'}"
  type="select"
  label="Is required" 
/>
</v-col>

</v-row>

<v-row>
<v-col cols="4" sm="4" md="4" >

<FormulateInput
  name="withNote"
  type="checkbox"
  label="Has Note ?"
/>
</v-col>



</v-row>

 <FormulateInput
  type="textarea"
  name="text_fr"
  label="Question French text"
  placeholder="Question French text"
  help="Question French text"
  validation="required"
  error-behavior="live"
  
/>
 <FormulateInput
 class="text_ar"
  type="textarea"
  name="text_ar"
  label="Question Arabic text"
  placeholder="Question Arabic text"
  help="Question Arabic text"
  validation="required"
  error-behavior="live"
  
/>

<v-row>
<v-col cols="4" sm="4" md="4" >

<FormulateInput
  name="type"
  :options="{TEXT: 'TEXT', TEXTAREA: 'TEXTAREA', RADIO: 'RADIO', RATING: 'RATING'}"
  type="select"
  placeholder="Select an option"
  label="What is the reponse type ?"
/>
</v-col>
</v-row>

      <FormulateInput 

          v-if="formData.type === 'RADIO'"

        type="group"
        name="responses"
        :repeatable="true"
        label="Please give reponses in "
        add-label="+ Add Response"
        validation="required"
      >
        <div class="attendee">
          <FormulateInput
            name="reponse_fr"
            validation="required"
            label="Response FR"
          />
          <FormulateInput
            type="text"
            name="response_ar"
            label="Response Arabic"
          />
        </div>
      </FormulateInput>
      
      <FormulateInput
        type="submit"
        label="Save question "
      />
    </FormulateForm>
    <code class="code code--block">{{ formData }}</code>
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
                        <!--
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="edit(3)"
                        >
                            Save
                        </v-btn>
                        -->
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
            console.log('Component mounted.')
        },
        data () {
            return {
                dialog: true,
                formData: {},

            }
        },
        props: ['page'] ,

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

                axios.post(Constants.BASE_URL+'ad-api/questions', this.formData )
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



body {
  font-family: 'Open Sans';
}

pre {
  background-color: #282c34;
  padding: 1em;
  border-radius: .5em;
  color: #e2777a;
  font-size: 1.1em;
}

.survey-form {
/*  padding: 4em 2em;*/

  border-bottom: 0.5px solid #a8a8a8;
 /* border-radius: .5em;*/
  width: 100%;
  /*box-sizing: border-box; */
}

.survey-input {
/*line-height: 1.2;*/
    line-height: 1.3;
    font-size: 1.1em;
    font-weight: 400;
 /*   margin-bottom: 1.1em;*/
  border-bottom: 0.5px solid #a8a8a8;
 /* box-sizing: border-box;*/
  box-sizing: border-box;
    padding: 0.5em 0em;
}


.formulate-input-label {
    padding: 0.5em  0em;
    margin :0;
}

.survey-input-text {
    display: block;
    line-height: 1.3;
    font-size: 1.1em;
    font-weight: 400;
    margin-bottom: 1.1em;
     border-bottom: 1px solid #a8a8a8;
  box-sizing: border-box;

}

.survey-input-text  {
    /* border-bottom: 1px solid #a8a8a8; */
    box-sizing: border-box;
    padding: 2em 1em;
}


.form-title {
  margin-top: 0;
}

 .formulate-input .formulate-input-element {
    max-width: 100% !important;

}

.formulate-input[data-classification=box] .formulate-input-element input[type=radio]:checked ~ .formulate-input-element-decorator::before {
    background-color: #E71722;
}

.formulate-input[data-classification=box] .formulate-input-element input[type=radio]:checked ~ .formulate-input-element-decorator {
    border-color: #E71722;/* #41b883;*/
}

.formulate-input[data-classification=text] input:focus {
    outline: 0;
    border: 1px solid #3490dc /*#41b883*/;
}

.formulate-input[data-classification=box] .formulate-input-label--after {
    /* margin-left: 0em; */
    margin: 0em 0.5em;
    padding-bottom: 1.3em;
}

label:not(.form-check-label):not(.custom-file-label) {
    font-weight: 600;
}
.formulate-input .formulate-input-label--after  {
    display: block;
    line-height: 0.5em;
    font-size: 1em;
    font-weight: 600;
    margin-bottom: 0.1em;
}


.formulate-input .formulate-input-label--before {
    display: block;
    line-height: 1.5em;
    font-size: 1em;
    font-weight: 600;
    margin-bottom: 0.1em;
}

label:not(.form-check-label):not(.custom-file-label) {
    font-size: 1.1rem;
    font-weight: 400;
    letter-spacing: .0115em;
    line-height: 1.3rem;
    word-break: break-all;
}

</style>
