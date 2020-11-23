
<template>

     <div>
          <v-bottom-navigation
                            color="primary"
                            horizontal 
                            
                        >
                            <v-btn @click="addPage(item.page_id)">
                                <span>Add Page</span>

                                <v-icon>      mdi-message-text
                                </v-icon>
                            </v-btn>

                           

                            <v-btn @click="surveyConfig(survey_id)">
                                <span>Edit Page</span>

                                <v-icon> fas fa-list</v-icon>
                            </v-btn>

                          



                        </v-bottom-navigation>                  


    <div class="row">
        <div  v-for="page in overlaydata.pages" :key="page.page_id" class="col-md-3 col-md-offset-1">
            <section class="list">
                <header class="special-header">{{page.page}}
                </header>
                <draggable class="drag-area" :list="page.questions" :options="{animation:200, group:'page.questions.page_id',handle:'.my-handle'}" :element="'article'" @add="onAdd($event, page.page_id)"  @change="update(page.page_id)">
                    <article class="card special" v-for="(task) in page.questions" :key="task.id" :data-id="task.id">
                        <header class="my-handle">
                            {{ task.name_fr }} --{{ task.order }}
                        </header>
        <div class="card-icon flex-fill">
            <i @click="editQuestion" class="mdi mdi-message-text float-right"></i></div>
         
         
         
           <!--
            <div class="d-flex">
              <a href="#" class="btn btn-primary waves-effect waves-light">Buy More Credits</a>
              <a href="#" class="btn btn-light waves-effect waves-light ml-3">Track Your Credits</a>
            </div>
            -->
            
                    </article>

                </draggable>   
            </section>
        </div>

       
    </div>
    

      

    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import Constants from './Constants.js'

    export default {
        mounted() {
           this.callApi()
        },
        props :["survey_id"],
       data () {
    return {
        overlaydata: {},
        questions:[],
        displayModal :false,
        displayModalAddQuestion:false,
        displayModalConfigSurvey:false,
        questiontoEdit :0,
        createInPage :0,
        tab: null,
        items: [
        {
          icon: 'mdi-wifi',
          text: 'Wifi',
        },
        {
          icon: 'mdi-bluetooth',
          text: 'Bluetooth',
        },
        {
          icon: 'mdi-chart-donut',
          text: 'Data Usage',
        },
      ],
      model: 1,
        
        


  }},
        methods: {
            callApi() {
              axios.get(Constants.BASE_URL+"ad-api/survey-pages/"+this.survey_id).then(response => {
                this.overlaydata = response.data;
                console.log(response.data);
            });
            },
            editQuestion() {
                alert("yes");
            },

              onAdd(event, status) {
                let id = event.item.getAttribute('data-id');



 axios.post(Constants.BASE_URL+'ad-api/questions/modif-page/'+id+'/'+status )
                .then(function (response) {
                   // console.log(response.data.success);
                    console.log("success");

                })
                .catch(function (error) {
                    console.log("err");
                });
               /*
               axios.patch('/demos/tasks/' + id, {
                    status: status
                }).then((response) => {
                    console.log(response.data);
                }).catch((error) => {
                    console.log(error);
                })
                */
              // console.log(id);
              // console.log("page :",status);
            },
            update(page_id) {
              
              /*
                this.tasksNotCompletedNew.map((task, index) => {
                    task.order = index + 1;
                });

                this.tasksCompletedNew.map((task, index) => {
                    task.order = index + 1;
                });

                let tasks = this.tasksNotCompletedNew.concat(this.tasksCompletedNew);
             
                axios.put('/demos/tasks/updateAll', {
                    tasks: tasks
                }).then((response) => {
                    console.log(response.data);
                }).catch((error) => {
                    console.log(error);
                })
                */
               console.log("update" +page_id)
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

    

    .list {
    background-color: #EFF1F4  !important;
    border-radius: 3px;
    margin: 5px 5px;
    padding: 10px;
    width: 100%;
}

.list>header {
    font-weight: bold;
    color: black !important;
    text-align: center;
    font-size: 20px;
    line-height: 28px;
    cursor: -webkit-grab;
    cursor: grab;
}
.my-handle {
  cursor:move !important;
}

.list .card.special{
    background-color: #FFF;
    border-bottom: 1px solid #CCC;
    padding: 15px 10px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
}
.list>header.special-header {
    font-weight: normal;
    color: black !important;
    text-align: center;
    font-size: 20px;
    line-height: 28px;
    cursor: -webkit-grab;
    cursor: grab;
}
</style>
