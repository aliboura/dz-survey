@extends('layouts.guest-survey')
@section('content')
<?php
$site_title =__('messages.title');
$site_subtitle =__('messages.subtitle');
$participate =__('messages.participate');

 if (LaravelLocalization::getCurrentLocale()=='fr' ):
    $suivant ="Suivant";
    $precedent ="Precédent";
    $terminer ="Terminer";

 elseif (LaravelLocalization::getCurrentLocale()=='ar') :

     $suivant ="التالي";
     $precedent ="السابق";
     $terminer ="إرسال";
    endif;

?>
<template>

    <v-system-bar
    dark
    color={{$color}}
  >


  <span> Numéro vert  : </span>
  <v-icon> mdi-phone</v-icon>


  <span> 3030 </span>

    <v-spacer></v-spacer>
     <!--
    <v-icon>mdi-email</v-icon>
    <span>convid19@sante.gov.dz </span>
    -->
    <v-spacer></v-spacer>
       <!--
    <v-icon>mdi-facebook</v-icon>
    <v-icon>mdi-twitter</v-icon>
    <v-icon>mdi-google-plus</v-icon>
    -->

   <span>
    <v-breadcrumbs>
      <v-breadcrumbs-item class="white-link"
      href="{{ LaravelLocalization::getLocalizedURL("fr", null, [], true) }}"

      >
        Français
      </v-breadcrumbs-item>
      <v-breadcrumbs-item class="white-link"
        href="{{ LaravelLocalization::getLocalizedURL("ar", null, [], true) }}"

      >
      عربي
      </v-breadcrumbs-item>
  </v-breadcrumbs>

   </span>






  </v-system-bar>

<div class="flex-center position-ref full-height">
          <user-survey-vuetify survey_id={{$survey_id}} lang={{LaravelLocalization::getCurrentLocale()}} flt="right" shape={{$shape}}  color={{$color}} surveytitle={{$surveytitle}} surveysubtitle={{$surveysubtitle}}
site_title="{{$site_title}}"
         site_subtitle="{{$site_subtitle}}" participate="{{$participate}}"
         suivant ="{{$suivant}}"  precedent ="{{$precedent}}"   terminer ="{{$terminer}}"
         >
        </user-survey-vuetify>



</div>

</template>

@endsection

