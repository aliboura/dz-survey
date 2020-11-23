<template>
<v-container>
    <div>

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Survey Reports</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item">Survey Resport</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>




        <v-bottom-navigation
            color="primary"
            horizontal

        >
            <v-btn @click="reportByNote">
                <span>By Question</span>

                <v-icon>fas fa-list</v-icon>
            </v-btn>

            <v-btn @click="resportAll()">
                <span>All Questions</span>

                <v-icon>fas fa-list</v-icon>
            </v-btn>

            <v-btn @click="reportSpecial">
                <span>By results</span>

                <v-icon>fas fa-list</v-icon>
            </v-btn>









        </v-bottom-navigation>


        <v-spacer></v-spacer>
        <v-divider></v-divider>
      <!--   -->
  <div v-if="report_by_question">
        <v-expansion-panels>
            <v-expansion-panel
                v-for="question in overlaydata.questions"
                :key="question.question_id"
            >
                <v-expansion-panel-header>
                    {{question.question_name_fr}}

                </v-expansion-panel-header>
                <v-expansion-panel-content>

                    <v-card-text>
                        <v-col >
                        {{question.question_text}}
                        </v-col>



                    </v-card-text>


                    <v-row no-gutters>

                        <v-col
                            cols="12"
                            sm="12" md="12"
                        >
                            <v-card
                                class="pa-2"
                                outlined
                                tile
                            >

                                <v-simple-table>
                                    <template v-slot:default>
                                        <thead>
                                        <tr>
                                            <th class="text-left">
                                                Note
                                            </th>
                                            <th class="text-left">
                                                Reponse
                                            </th>

                                            <th class="text-left">
                                                Number
                                            </th>
                                            <th class="text-left">
                                                %
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr
                                            v-for="response in question.results"
                                            :key="response.id"
                                        >
                                            <td>{{ response.note }}</td>

                                            <td>{{ response.text_fr }}</td>

                                            <td>{{ response.nbr }}</td>
                                            <td> {{ ((response.nbr /question.question_total_result) *100).toFixed(2) }} %</td>
                                        </tr>


                                        <tr>

                                            <td></td>
                                            <td>Total</td>

                                            <td>{{question.question_total_result}}</td>
                                            <td> </td>
                                        </tr>
                                        </tbody>
                                    </template>
                                </v-simple-table>
<!--
                                <v-row>
                                    <v-col>
                                        <v-card>

                                            <chart-pie :width="200" :height="200" :key="question.id"
                                                       :labels='objToArray(question.results,"text_fr")'
                                                       :data-prop='objToArray(question.results,"nbr")' >
                                            </chart-pie>
                                        </v-card>
                                    </v-col>
                                </v-row>
-->


                            </v-card>
                        </v-col>
                    </v-row>








                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <!--
                        <survey-dialog v-if ="displayModal"
                            @clicked="onClickChild" :question="question.question_id"></survey-dialog>
                          -->

                        <v-btn text color="primary" @click="objToArray(question.results,'text_fr','nbr')">
                            Details
                        </v-btn>




                    </v-card-actions>
                </v-expansion-panel-content>
            </v-expansion-panel>
        </v-expansion-panels>

  </div>
        <!--  -->

        <div v-if="report_all">


            <v-row no-gutters>

                <v-col
                    cols="12"
                    sm="12" md="12"
                >
                    <v-card
                        class="pa-2"
                        outlined
                        tile
                    >

                        <v-simple-table>
                            <template v-slot:default>
                                <thead>
                                <tr>
                                    <th class="text-left">
                                        Note
                                    </th>


                                    <th class="text-left">
                                        Number
                                    </th>
                                    <th class="text-left">
                                        %
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr
                                    v-for="response_note in dataNotes.report_by_note"
                                    :key="response_note.note"
                                >
                                    <td>{{ response_note.note }}</td>


                                    <td>{{ response_note.nbr }}</td>
                                    <td> {{ ((response_note.nbr /dataNotes.total) *100).toFixed(2) }} %</td>
                                </tr>


                                <tr>

                                    <td>Total</td>

                                    <td>{{ dataNotes.total }}</td>
                                    <td> </td>
                                </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                        <!--
                                                        <v-row>
                                                            <v-col>
                                                                <v-card>

                                                                    <chart-pie :width="200" :height="200" :key="question.id"
                                                                               :labels='objToArray(question.results,"text_fr")'
                                                                               :data-prop='objToArray(question.results,"nbr")' >
                                                                    </chart-pie>
                                                                </v-card>
                                                            </v-col>
                                                        </v-row>
                        -->


                    </v-card>
                </v-col>
            </v-row>



        </div>

      <div v-if="report_special">
          <v-form>
              <v-container>
          <v-layout row wrap>

              <v-flex xs4>
                  <v-text-field
                      v-model="value1"
                      label="Minimum"

                  ></v-text-field>
              </v-flex>
              <v-flex xs4>
                  <v-text-field
                      v-model="value2"
                      label="Maximum"
                  ></v-text-field>
              </v-flex>

          <v-flex xs2>
              <v-btn class="spacial-btn"
                  @click="handleForm"

              >
                  Envoyer
              </v-btn>
          </v-flex>

          </v-layout>
              </v-container>
          </v-form>



          <v-row no-gutters>

              <v-col
                  cols="12"
                  sm="12" md="12"
              >
                  <v-card
                      class="pa-2"
                      outlined
                      tile
                  >

                      <v-simple-table v-if="displayTable">
                          <template v-slot:default>
                              <thead>
                              <tr>
                                  <th class="text-left">
                                      Number
                                  </th>


                                  <th class="text-left">
                                      Total
                                  </th>
                                  <th class="text-left">
                                      %
                                  </th>

                              </tr>
                              </thead>
                              <tbody>

                              <tr>
                                  <td>{{dataFormToTable.report_all.nbr}}</td>


                                  <td>{{dataFormToTable.total}}</td>



                                  <td>{{((dataFormToTable.report_all.nbr/dataFormToTable.total)*100).toFixed(2)}} %</td>
                              </tr>


                              </tbody>
                          </template>
                      </v-simple-table>
                      <!--
                                                      <v-row>
                                                          <v-col>
                                                              <v-card>

                                                                  <chart-pie :width="200" :height="200" :key="question.id"
                                                                             :labels='objToArray(question.results,"text_fr")'
                                                                             :data-prop='objToArray(question.results,"nbr")' >
                                                                  </chart-pie>
                                                              </v-card>
                                                          </v-col>
                                                      </v-row>
                      -->


                  </v-card>
              </v-col>
          </v-row>



      </div>




        </div>

    <dialog-report  v-if ="displayModal"   :labels_="labels"  :dataprops_ ="dataProps"
                    @clickedChild="onClickChild"></dialog-report>
</v-container>




</template>

<script>
import Constants from './Constants.js'

    export default {
        mounted() {
           this.callApi() ;
            this.callApiNotes();
        },
        props :["survey_id"],
       data () {
    return {
        dataFormToTable:{"total": 0,
            "report_all": {
                "nbr": 0
            }},
        displayTable :false,
        value1 :'',
        value2 :'',
        overlaydata: {},
        dataNotes :{},
        operations: [
            'superieur',
            'inferieur',
            'egale',

        ],
        report_by_question :true,
        report_all :false,
        report_special :false,
        valid: true,
        labels :'',
        dataProps:'',
        displayModal :false,
        displayModalAddQuestion:false,
        displayModalConfigSurvey:false,
        displayModalEditPage :false,
        questiontoEdit :0,
        page_to_edit:0,
        createInPage :0,
        tab: null,




  }},
        methods: {
            callApi() {
              axios.get(Constants.BASE_URL+"ad-api/survey-reports/"+this.survey_id).then(response => {
                this.overlaydata = response.data;
                console.log(response.data);
            });
            },
            callApiNotes() {
                axios.get(Constants.BASE_URL+"ad-api/survey-reports/note/"+this.survey_id).then(response => {
                    this.dataNotes = response.data;
                });

            },

            edit(index) {
               // this.words.splice(index,1)
               // alert(index);
                this.displayModal =true;
                this.questiontoEdit=index;
              //  alert(this.questiontoEdit);

            },
            handleForm() {
                axios.get(Constants.BASE_URL+"ad-api/survey-reports/all/"+this.survey_id+"/"+this.value1+"/"+this.value2).then(response => {
                    this.dataFormToTable = response.data;
                });
                this.displayTable =true;

            }

            ,

            onClickChild (value) {
               // console.log(value) // someValue
                this.displayModal =false;
                this.callApi();
            },

             toLink (txt) {
      return  "http://localhost:8000/survey/"+txt+"/report";
    }  ,
            resportAll() {
                this.report_by_question =false;
                this.report_special=false;

                this.report_all=true;
            },
            reportByNote() {
                this.report_by_question =true;
                this.report_all=false;
                this.report_special=false;

            },
            reportSpecial() {
                this.report_by_question =false;
                this.report_all=false;
                this.report_special=true;
            }

       , objToArray(arr,label,props) {
                var arr1=arr;
                var labels = arr.map(function(item) {
                    return item[label];
                });

                var dataProps_ = arr1.map(function(item1) {
                    return item1[props];
                });
            //  return  JSON.stringify(names);



                this.labels =JSON.stringify(labels);
                this.dataProps=JSON.stringify(dataProps_);
                this.displayModal=true;
            //   var namesStr ='['+names.toString()+']';
            //   return  namesStr;
            },
            objToArrayNbr(arr) {
                // let arr1=JSON.parse(arr)

                var names = arr.map(function(item) {
                    return item['nbr'];
                });
            //  return names
                // var namesStr ='['+names.toString()+']';
                return  JSON.stringify(names);

            }

        },




}

</script>

<style>



    .v-tabs:not(.v-tabs--vertical) .v-tab {
        white-space: normal;
    }
    .v-tabs-bar.accent .v-tab, .v-tabs-bar.accent .v-tabs-slider, .v-tabs-bar.error .v-tab, .v-tabs-bar.error .v-tabs-slider, .v-tabs-bar.info .v-tab, .v-tabs-bar.info .v-tabs-slider, .v-tabs-bar.primary .v-tab, .v-tabs-bar.primary .v-tabs-slider, .v-tabs-bar.secondary .v-tab, .v-tabs-bar.secondary .v-tabs-slider, .v-tabs-bar.success .v-tab, .v-tabs-bar.success .v-tabs-slider, .v-tabs-bar.warning .v-tab, .v-tabs-bar.warning .v-tabs-slider {
        color: #643c3c;
    }

    .content-header {
        padding: 2px 0rem;
    }



    .v-btn>.v-btn__content .v-icon.danger {
        color: #a8324c !important;
    }


    .spacial-btn {
        height: 26px !important;
        min-width: 54px !important;;
        padding: 16px !important;
        margin-top :16px !important;
    }
</style>
