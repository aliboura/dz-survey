<template>
    <v-app id="inspire">
        <v-row justify="end">
            <v-dialog
                v-model="dialog"

                fullscreen
                hide-overlay
                transition="dialog-bottom-transition" >



                <v-card>
                    <v-toolbar
                        dark
                        color="#AB1E32"
                    >
                        <v-btn
                            icon
                            dark
                            @click="edit(3)"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Co Check</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn
                                dark
                                text
                                @click="edit(3)"
                            >
                                Fermer
                            </v-btn>
                        </v-toolbar-items>
                    </v-toolbar>






                            <v-parallax
                                dark
                                src="/public/assets/images/Co-check_Djezzy_970x240.png"
                                height ="280"


                            >

                            </v-parallax>


                   <!-- -->

                    <v-timeline

                        dense
                    >
                        <v-timeline-item color="#AB1E32"

                        >



                            <v-card v-if="language==='fr'" class="elevation-2">
                                <v-card-title class="headline">
<p>
Votre score est  {{((note/total)*100).toFixed(0)}}  %


                                    si votre score est  inférieur à 80%  merci de refaire le test en cliquant
                                     <a :href="toLink('ar')" >ici</a>

</p>
                                </v-card-title>
                                <!--
                                <v-card-text>
                                    si votre score est  inférieur à 80%  merci de refaire le test en cliquant
                                    <a href="http://localhost:8000/fr/client-survey/1/show" >ici</a>
                                </v-card-text>
                                -->
                            </v-card>

                            <v-card v-else class="elevation-2 ar">
                                <v-card-title class="headline">
                                    <p>
                                    لقد تحصلت على نتيجة {{((note/total)*100).toFixed(2)}}  %


                                    إذا كانت درجاتك أقل من 80٪ ، يرجى إعادة الاختبار بالنقر فوق
                                    <a :href="toLink('ar')" >هنا</a>

                                    </p>

                                </v-card-title>
                                <!--
                                <v-card-text class="ar">
                                    إذا كانت درجاتك أقل من 80٪ ، يرجى إعادة الاختبار بالنقر فوق
                                    <a href="http://localhost:8000/ar/client-survey/1/show" >هنا</a>
                                </v-card-text>
                                -->
                            </v-card>
                        </v-timeline-item>
                    </v-timeline>


                    <!--  -->






                    <!-- -->

                    <v-card-title>
                        <v-row>
                            <v-col>

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

                    </v-card-text>

                </v-card>
            </v-dialog>
        </v-row>
    </v-app>
</template>

<script>

import Constants from './Constants.js'

    export default {
        mounted() {
            this.url=Constants.BASE_URL;
        },
        data () {
            return {
                dialog: true,
                formData: {},
                url:''

            }
        },
        props: ['note','total','language','survey_id'] ,

        methods :{
            edit(index) {
                // this.words.splice(index,1)
                //  alert(index);
                this.dialog =!this.dialog
                this.$emit('clickedChild', false)

                window.location.href = Constants.BASE_URL+"index";

                /*
                 window.location.href = "http://localhost:8000/tabs";
                 */


            },
        toLink (language) {

      return  Constants.BASE_URL+language+"/client-survey/"+this.survey_id+"/show";
    } ,
            
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



    .v-dialog--fullscreen{
        border-radius: 4px;
        margin: 0px !important;
        overflow-y: auto;
        pointer-events: auto;
        transition: .3s cubic-bezier(.25,.8,.25,1);
        width: 100%;
        z-index: 100;
        box-shadow: 0 11px 15px -7px rgba(0,0,0,.2), 0 24px 38px 3px rgba(0,0,0,.14), 0 9px 46px 8px rgba(0,0,0,.12);
    }

    .v-dialog.v-dialog--fullscreen {
        max-height: 100%;
    }

 .ar {
     direction: rtl !important;

 }

    .v-card-ar {
        direction: rtl;
        border-bottom-left-radius: inherit;
        border-bottom-right-radius: inherit;
        direction: rtl;
        text-align: right !important;
        font-size: 18px;
    }


</style>
