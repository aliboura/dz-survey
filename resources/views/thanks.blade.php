<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
  
  <?php  if (LaravelLocalization::getCurrentLocaleDirection()=='rtl' ) : ?> 
  <style>
    body {
    /*  direction: rtl !important;*/

    }
    .wizard-tab-content {
      direction: rtl !important;
    }
    .flex.rightflex{
      text-align:right !important;
      direction: rtl !important;
    }
    .formulate-input-wrapper {
      text-align:right !important;

    }
  </style>
  <?php endif  ?>
 
  <div id="app">
    <v-app>

      <v-container fill-height>
        <v-layout align-center>
          <v-flex rightflex>
            <h3 class="display-2"> 
           Thanks 
  
            </h3>
  
            <span class="subheading">
          
              
              </span>
  
            <v-divider class="my-3"></v-divider>
  
            
  
             
  <v-row align="center">
   
        <v-col
          class="d-flex"
          cols="12"
          sm="4"
        >
          
        <div class="title mb-3"></div>
        </v-col>
        <v-col>
            
  
        </v-col>
  <!--
         <v-col
          class="d-flex"
          cols="12"
          sm="2"
        >
         
           <div class="form-group">
      <select onchange="location = this.value;">
   <option value="home.html">home</option>
   <option value="team.html">team</option>
   <option value="contact.html">contact</option>
  </select>
    </div>
  
  
  
        </v-col>
        -->
  
   
       
  
        
      </v-row>
  
           
  
            
          </v-flex>
        </v-layout>
      </v-container>
    
  </v-app>
  </div>

    <script src="{{ asset('js/app.js') }}"></script>
   
</body>
</html>
