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

                     Edit Question (question :{{question}} )
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

          v-if="formData.type === 'RADIO' || formData.type === 'SELECT'"

        type="group"
        name="responses"
        :repeatable="true"
        label="Please give reponses in "
        add-label="+ Add Response"
        validation="required"
      >
        <div class="attendee">
          <FormulateInput
            name="text_fr"
            validation="required"
            label="Response FR"
          />
          <FormulateInput
            type="text"
            name="text_ar"
            label="Response Arabic"
          />
        </div>
      </FormulateInput>

      <FormulateInput
        type="submit"
        label="Update question "
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

        },
        data () {
            return {
                dialog: true,
                formData: {},

            }
        },
        props: ['question'] ,

        methods :{

           callApi() {
              axios.get(Constants.BASE_URL+"ad-api/question/"+this.question+"/edit").then(response => {
                this.formData = response.data;
                console.log(response.data);
            });
            },

            edit(index) {
                // this.words.splice(index,1)
              //  alert(index);
                this.dialog =!this.dialog
                this.$emit('clickedUpdate', false)

                /*
                 window.location.href = "http://localhost:8000/tabs";
                 */


            },
            submitHandler() {
                let currentObj = this;

                axios.post(Constants.BASE_URL+'ad-api/questions/'+this.question, this.formData )
                .then(function (response) {
                   // console.log(response.data.success);
                    console.log("success");

                })
                .catch(function (error) {
                    console.log("err");
                });


                this.dialog =!this.dialog
                this.$emit('clickedUpdate', false)
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
