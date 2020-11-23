<template>
<div>


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                 <!--   <h1 class="m-0 text-dark">Survey Management  -->
                       
             
          
                           <v-btn :href=toClientLink(survey_id) 
                           target="_blank"
      class="ma-2"
      outlined
      color="indigo"
    >
      Preview
    </v-btn>
   

             <!--       </h1>  -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Survey Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <v-card>
        <v-tabs
            v-model="tab"
            background-color="primary" color="red"

        >
            <v-tab
                v-for="item in overlaydata.pages"
                :key="item.page_id"
            >
                {{ item.page }}
            </v-tab>
        </v-tabs>

        <v-tabs-items v-model="tab">
            <v-tab-item
                v-for="item in overlaydata.pages"
                :key="item.page_id"
            >
                <v-card flat>
                    <v-card-text>


                        <!-- modal button  -->

                        <!-- end modal button   -->




                        <v-bottom-navigation
                            :value="item.page_id"
                            color="primary"
                            horizontal 
                            
                        >
                            <v-btn @click="addQuestion(item.page_id)">
                                <span>Add Question</span>

                                <v-icon>      mdi-message-text
                                </v-icon>
                            </v-btn>

                            <v-btn @click="editPage(item.page_id)">
                                <span>Edit Page</span>

                                <v-icon>      mdi-message-text
                                </v-icon>
                            </v-btn>


                           

                            <v-btn :href="toLink(survey_id)">
                                <span>Organize Pages</span>

                                <v-icon>fas fa-list</v-icon>
                            </v-btn>

                            <v-btn @click="surveyConfig(survey_id)">
                                <span>Configuration</span>

                                <v-icon> mdi-wrench</v-icon>
                            </v-btn>

                          <!--
                            <v-btn>
                                <span>New Survey</span>

                                <v-icon>fas fa-tachometer-alt</v-icon>
                            </v-btn>
                          -->


                        </v-bottom-navigation>
                        <v-expansion-panels>
                            <v-expansion-panel
                                v-for="question in item.questions"
                                :key="question.question_id"
                            >
                                <v-expansion-panel-header>
                                    {{question.question_name}}

                                </v-expansion-panel-header>
                                <v-expansion-panel-content>

                                    <v-card-text>

                                                    {{question.question_text}}




                                    </v-card-text>





                                    <v-card
                                        class="mx-auto"

                                        tile
                                    >
                                    <v-list-item v-for="response in question.responses" :key="response.code">
                                        <v-list-item-content>
                                            <v-list-item-title>
                                           
                                        <v-btn text color="blue darken-2"  @click="editResponse(response.id)">

                                            <v-icon       color="blue darken-2">      mdi-open-in-new
                                            </v-icon>
                                        </v-btn>

                                         +  {{response.text_fr}}

                                                 </v-list-item-title>

                                        </v-list-item-content>
                                    </v-list-item>
                                    </v-card>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <!--
                                        <survey-dialog v-if ="displayModal"
                                            @clicked="onClickChild" :question="question.question_id"></survey-dialog>
                                          -->

                                        <v-btn text color="primary" @click="edit(question.question_id)">
                                            Edit
                                        </v-btn>

                                        <v-btn text color="primary" @click="deleteQuestion(question.question_id)">

                                            <v-icon class="danger">      mdi-comment-remove-outline
                                            </v-icon>
                                        </v-btn>


                                    </v-card-actions>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>


                    </v-card-text>
                </v-card>
            </v-tab-item>
        </v-tabs-items>
    </v-card>


    <!-- Modal -->
    <survey-dialog v-if ="displayModal"
                   @clickedUpdate="onClickChild" :question="questiontoEdit"></survey-dialog>


    <!-- modal -->
    <survey-dialog-create v-if ="displayModalAddQuestion" :page="createInPage"
                   @clickedSubmit="childCreateClose"></survey-dialog-create>
    <!-- modal -->

        <survey-config v-if ="displayModalConfigSurvey" :survey="survey_id"
                   @clickedConfig="childConfigClicked"></survey-config>
    <!-- modal -->
<page-edit-dialog v-if ="displayModalEditPage"
                   @clickedEditPage="onClickChildEdit" :page="page_to_edit"></page-edit-dialog>

<response-edit-dialog v-if ="displayModalEditResponse"
                   @clickedEditResponse="onClickChildResponseEdit" :response="response_to_edit"></response-edit-dialog>

    <survey-dialog-preview v-if ="displayModalPreview"
                   @clickedPreview="onClickChild" :survey="survey_id"></survey-dialog-preview>



</div>

</template>

<script>
import Constants from './Constants.js'

    export default {
        mounted() {
           this.callApi();
           url=Constants.BASE_URL
        },
        props :["survey_id"],
       data () {
    return {
        url:'',
        overlaydata: {},
        displayModal :false,
        displayModalAddQuestion:false,
        displayModalConfigSurvey:false,
        displayModalEditPage :false,
        displayModalPreview :false,
        questiontoEdit :0,
        page_to_edit:0,
        createInPage :0,
        tab: null,
        
        displayModalEditResponse:false,
        response_to_edit:0


  }},
        methods: {
            callApi() {
              axios.get(Constants.BASE_URL+"ad-api/pages/"+this.survey_id).then(response => {
                this.overlaydata = response.data;
                console.log(response.data);
            });
            },
            add() {
                this.words.push(this.newWord);
                this.newWord='';
            },
            edit(index) {
               // this.words.splice(index,1)
               // alert(index);
                this.displayModal =true;
                this.questiontoEdit=index;
              //  alert(this.questiontoEdit);

            },
            surveyConfig(index) {
            this.displayModalConfigSurvey=true;

            },
            addQuestion(index) {
                this.displayModalAddQuestion =true;
                this.createInPage=index;

            },
            editPage(index) {
             this.displayModalEditPage=true
             this.page_to_edit=index;
            },
            onClickChildEdit(index) {
             this.displayModalEditPage=false
             this.callApi();

            },
            onClickChildResponseEdit(index) {
             this.displayModalEditResponse=false
             this.callApi();

            },
            childConfigClicked(index) {
                this.displayModalConfigSurvey=false;
                             this.callApi();

            },
             childCreateClose (value) {
               // console.log(value) // someValue
              //  this.callApi();
                this.displayModalAddQuestion =false;
                this.callApi();
                window.location.href = Constants.BASE_URL+"survey/"+survey_id+"/edit";

            },

            onClickChild (value) {
               // console.log(value) // someValue
                this.displayModal =false;
                this.callApi();
            },
             deleteQuestion (value) {
               // console.log(value) // someValue
               axios.get(Constants.BASE_URL+'ad-api/questions/delete/'+value)
                .then(function (response) {
                   // console.log(response.data.success);
                    console.log("success");

                })
                .catch(function (error) {
                    console.log("err");
                });
                this.callApi()
            },
            editResponse(index) {
             
             this.displayModalEditResponse=true
             this.response_to_edit=index;
            },
            clickPreview(index) {
              this.displayModalPreview=true
            },

             toLink (txt) {
      return  Constants.BASE_URL+"survey/"+txt+"/trello";
    }  ,
    toClientLink (txt) {
      //  client-survey/1/show
      return  Constants.BASE_URL+"client-survey/"+txt+"/show";
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

    .success {
        color:aquamarine;
    }

    .mdi-open-in-new::before {
    content: "\F03CC";
    color:#1AA3E9;
}
</style>
