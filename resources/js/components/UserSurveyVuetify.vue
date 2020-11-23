<template>
    <div>
        <!-- Content Header (Page header) -->


    <v-container fill-height>
      <v-layout align-center>
        <v-flex rightflex>
          <h3 class="display-2">
         {{site_title}}

          </h3>
          <!--
          <span class="subheading">
         {{site_subtitle}}

            </span>
            -->

     <!--


          <v-divider class="my-3"></v-divider>




<v-row align="center">

      <v-col
        class="d-flex"
        cols="12"
        sm="4"
      >

      <div class="title mb-3">{{participate}}</div>
      </v-col>
      <v-col>


      </v-col>
    </v-row>

-->


        </v-flex>
      </v-layout>
    </v-container>

                    <!-- /.col -->

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <!--
<video width="320" height="240" controls>
  <source src="upload/v2.mp4" type="video/mp4">
Your browser does not support the video tag.
</video>

<img :src="'../storage/img/logo.png'">

-->



        <v-form ref="form" v-model="valid" lazy-validation  >

    <form-wizard title =""  subtitle=""
                @on-complete="onComplete"
                :next-button-text="suivant"
                :back-button-text="precedent"
                :finish-button-text="terminer"
                transition="bounce"
                 :color=color
                 :shape =shape>

        <tab-content v-for="tab in overlaydata.pages"
            :key="tab.page_id"
            :title="tab.page"
            :icon="concatIcon(tab.page_icone)">
                   <div  v-for="question in tab.questions"
                        :key="question.question_id"
                        >



  <v-container fluid>

         <v-row  align="center" v-if='question.type=="RADIO"'>
           <v-col

        >
          <v-card   elevation="2"   outlined  shaped >
            <v-card-title class="special-title">{{question.question_name}}</v-card-title>

    <v-divider class="mx-4"></v-divider>
              <v-card-text>
     <v-radio-group  v-model="formData[question.question_code]"
:rules="[v => !!v || errorMessage()]"
          required  
>
      <v-radio  color="red"
        v-for="option in question.responses"
        :key="option.id"
        :label="`${option.text}`"
        :value="option.code"

            
      ></v-radio>
    </v-radio-group>
              </v-card-text>
     </v-card>
           </v-col>
         </v-row>


         <v-row  align="center"   v-if='question.type=="TEXT"'>
           <v-col class="d-flex"
        cols="12"
        sm="12" >
          <v-card   elevation="2"   outlined  shaped >
            <v-card-title>{{question.question_name}}</v-card-title>

    <v-divider class="mx-4"></v-divider>
                  <v-card-text>

         <v-text-field v-if='question.type=="TEXT"'
          v-model="formData[question.question_code]"
          :rules="[v => !!v || errorMessage()]"
           required

          outlined
        ></v-text-field>
                  </v-card-text>
          </v-card>
           </v-col>
        </v-row>


         <v-row  align="center"   v-if='question.type=="SELECT"'>
           <v-col
        >
          <v-card   elevation="2"   outlined  shaped >
            <v-card-title>{{question.question_name}}</v-card-title>

    <v-divider class="mx-4"></v-divider>
     <v-card-text>
    <v-row  align="center" >
       <v-col  class="d-flex"   cols="12"
        sm="6"

      >
        <v-select
          v-model="formData[question.question_code]"
           :rules="[v => !!v || errorMessage()]"
           required      

          :items="question.responses"
            item-text="text"
            item-value="code"
          filled
          dense
        ></v-select>
      </v-col>
 </v-row>
     </v-card-text>
          </v-card>
           </v-col>
         </v-row>



      <v-row  align="center"   v-if='question.type=="TEXTAREA"'>
          <v-col
          >
              <v-card   elevation="2"   outlined  shaped >
                  <v-card-title>{{question.question_name}}</v-card-title>

                  <v-divider class="mx-4"></v-divider>
                  <v-card-text>
                      <v-row  align="center" >
                          <v-col  class="d-flex"   cols="12"


                          >

                              <v-textarea
                                  solo
                                  v-model="formData[question.question_code]"

                              ></v-textarea>

                          </v-col>
                      </v-row>
                  </v-card-text>
              </v-card>
          </v-col>
      </v-row>








       </v-container>

                        </div>



            </tab-content>
               <!--
                <code class="code code--block">
            {{dataToPost}}

                </code>
             -->


               <!--
            <pre v-if ="valid !=true">you have erros </pre>
                -->


        </form-wizard>
        </v-form>



        </div>
        </div>
        </div>
        </div>
        </div>
                <!-- /.row -->
        </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->



        <!--dialod -->
      <survey-dialog-client  v-if ="displayModal"   :note="note"  :total ="total_notes" :survey_id="survey_id"
                             @clickedChild="onClickChild" :language="lang"></survey-dialog-client>
        <!--end dialog -->
    </div>
</template>

<script>

  import {FormWizard, TabContent} from 'vue-form-wizard'
  import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Constants from './Constants.js'


export default {
    mounted() {
      console.log("==>",Constants.CARRIER)

        axios.get(Constants.BASE_URL+"pages/"+this.survey_id).then(response => {
            this.overlaydata = response.data;
            this.total_notes=response.data.total_notes;


        });

            this.dataToPost.formData=this.formData;
            this.dataToPost.user="anonymous";
            this.dataToPost.survey_id=this.survey_id;
    },
    data() {
        return {
            //
            displayModal:false,
            total_notes :1,
            note :0,
            //
            hasErrors :false,
            dataToPost :{},
                  languages: ['Arabe', 'Français'],

            validation: {},
            overlaydata: {},
            formErrors: [],
            inputErrors: {},
            float: "right",

            formData: {},
            aln: "right",
            responses: {},

             valid: true,


        };
    },
    props: [ "flt","survey_id","shape",
        "color","surveytitle","surveysubtitle",
        "site_title","site_subtitle","participate",
         "suivant" ,"precedent","terminer","lang"
    ],

    methods: {

       concatIcon(txt) {
         if (! this.overlaydata.using_icons) {
         return null
         }
         return "mdi mdi-36px "+txt
       },
       errorMessage() {
         if (this.lang=='ar')  {
          return "هذا الحقل اجباري" ;
         } else {
           return "ce champ est obligatoire" ;
         }


       },

        onClickChild() {
            this.displayModal=false

        },
        onComplete() {
            // alert('Yay. Done!');

            // if (!this.hasErrors) {
                let currentObj = this;
             //   let formData = new FormData();
             //   formData.append('responses', this.responses);

           //  console.log(this.$refs.form.validate())
            this.dataToPost.formData=this.formData;
            this.dataToPost.user="anonymous";
            this.dataToPost.survey_id=this.survey_id;

            //currentObj.displayModal = true;


             if (this.$refs.form.validate()) {
                             console.log("inside")

               axios.post(Constants.BASE_URL+'submit', this.dataToPost)
                .then(function (response) {

                    if (response.data.success =='yes')  {

                        currentObj.note=response.data.note;
                        currentObj.displayModal = true;

                    }

                })
                .catch(function (error) {
                   console.log("error");
                });

                  }





        },
           
        toObj: function(txt) {
            console.log(titles);

            var titles = txt.split("|");
            var myObj = {};
            for (var i = 0; i < titles.length; i++) {
                myObj[titles[i].split(",")[0]] = titles[i].split(",")[1];
            }

            return myObj;
        },
        arrayToObj: function(arr) {
            var result = {};
            for (var i = 0; i < arr.length; i++) {
                result[arr[i].code] = arr[i].text;
            }
            return result;
        },
        async checkValidation () {
       this.hasErrors = await this.$refs.form.hasValidationErrors()
    }
    },

    computed: {
        userStyle() {
            return {
                "--float-right": "right"
            };
        }
    }
};
</script>

<style>
label:not(.form-check-label):not(.custom-file-label) {
       font-size: 1.1rem;
    font-weight: 200;
    letter-spacing: .0115em;
    line-height: 1.3rem;
    word-break: break-all;

}

.v-card__title.special-title {
    align-items: center;
    display: flex;
    flex-wrap: wrap;
    font-size: 1.2rem;
    font-weight: 500;
    letter-spacing: .0115em;
    line-height: 1.5rem;
    word-break: break-all;
}

.toggle.v-input--is-disabled.v-text-field--outline .v-input__slot {
  border-color: #00000061;
}

.v-card__title {
    align-items: center;
    display: flex;
    flex-wrap: wrap;
    font-size: 1.25rem;
    font-weight: 500;
    letter-spacing: .0125em;
    line-height: 2rem;
    word-break: break-all;
}

.white-link a{
  color: #fff !important;
}

</style>

