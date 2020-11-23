<template>

     
     
           <!--  -->

<div class="content">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Surveys List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">surveys list</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>




      <div class="container-fluid">
        <div class="row">


            <!-- /.row -->

            
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">surveys  List</h3>
               
                <div class="card-tools">
                   <div class="card-tools">

                    <button @click="displayCreateSurvey"   class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Start date</th>
                        <th>End Date</th>
                        <th>Modify</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="survey in overlaydata" :key="survey.id">
                      <td>{{survey.id}}</td>
                      <td>{{survey.code}}</td>
                      <td>{{survey.description}}</td>
                      <td>{{survey.start_date}}</td>
                      <td>{{survey.end_date}}</td>
                    <td>
                        <a :href="toLink(survey.id)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a :href="toReportLink(survey.id)">
                          <i class="fas fa-align-justify"></i>
                            <!--
                            <i class="fa fa-trash red"></i>
                            -->
                        </a>

                         /
                        <a href="#">
                            <i class="fa fa-trash red"></i>
                            <!--
                            <i class="fa fa-trash red"></i>
                            -->
                        </a>

                    </td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        
       
    </div>
             <!-- modal -->
    <survey-dialog-create-new-survey v-if ="displayModalAddSurvey" 
                   @clickedSubmit="clickedConfig"></survey-dialog-create-new-survey>
    <!-- modal -->
        </div>
        <!-- /.row -->




     


           <!-- -->





</template>

<script>
import Constants from './Constants.js'

    export default {
        mounted() {
           this.callApi()
        },
        data () {
    return {
      displayModalAddSurvey :false,
      overlaydata :{}
         }
        },
        props :["surveys"],
         methods: {
            callApi() {
              axios.get(Constants.BASE_URL+"ad-api/surveys").then(response => {
                this.overlaydata = response.data;
                console.log(response.data);
            });
            },
           toLink (txt) {
      return  Constants.BASE_URL+"survey/"+txt+"/edit";
    },
     toReportLink (txt) {
      return  Constants.BASE_URL+"survey/"+txt+"/report";
    },
    displayCreateSurvey () {
      this.displayModalAddSurvey=true
    },
    clickedConfig () {
            this.displayModalAddSurvey=false;
           this.callApi()
           window.location.href = Constants.BASE_URL+"surveys";

    }
    },
    
    }
</script>
