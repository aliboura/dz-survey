<template>
    <v-app id="inspire">
        <v-row justify="end">
            <v-dialog
                v-model="dialog"

                max-width="90%"
                transition="dialog-right-transition">

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


                                <chart-pie
                                           :labels=labels_
                                           :data-prop=dataprops_ >
                                </chart-pie>







                   <!-- -->



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
            console.log('Component mounted.')
        },
        data () {
            return {
                dialog: true,
                formData: {},

            }
        },
        props: ['labels_','dataprops_'] ,

        methods :{
            edit(index) {
                // this.words.splice(index,1)
                //  alert(index);
                this.dialog =!this.dialog
                this.$emit('clickedChild', false)

              //  window.location.href = "http://localhost:8000/index";

                /*
                 window.location.href = "http://localhost:8000/tabs";
                 */


            },
           
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

</style>
