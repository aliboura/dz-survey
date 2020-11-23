<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Go check</title>
    <!-- web fonts -->
   <!-- web fonts -->
   <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
   <link href="//fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet">
   <!-- //web fonts -->
    <!-- //web fonts -->
    <!-- Template CSS -->

    <link rel="stylesheet" href="{{ asset('public/assets/css/style-starter.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/index-custom.css')}}">



  </head>
  <body>

  <?php  if (LaravelLocalization::getCurrentLocaleDirection()=='rtl' ) :

  ?>
  <style>
      .heading h3 {
          font-size: 36px;
          line-height: 42px;
          color: var(--title-color);
          font-weight: 600;
          text-align: right;
      }

      .special {
          font-size: 36px;
          line-height: 42px;
          color: var(--title-color);
          font-weight: 600;
          text-align: center !important;
      }
      .w3l-index6 .features-with-17_sur p {
          margin: 12px 0 0;
          font-style: normal;
          /* font-weight: normal; */
          font-size: 20px;
          line-height: 26px;
          color: var(--text-color);
          text-align: right;
      }
      .btn-group, .btn-group-vertical {
          position: relative;
          display: inherit !important;
          text-align: right;

      }

      .w3l-features-4 .feature-gd p {
          max-width: 450px;
         /* direction: rtl;*/
          text-align: right !important;
      }

      .w3l-features-4 .features h5 {
          font-size: 20px;
          line-height: 30px;
          color: var(--title-color);
          font-weight: 700;
          margin-bottom: 12px;
          text-align: right;
          direction: rtl;
      }




  </style>
  <?php endif;?>
  <?php  if (LaravelLocalization::getCurrentLocaleDirection()=='rtl' ) :
      $gotoUrl ="http://covid19.sante.gov.dz/%d8%a3%d8%b3%d8%a6%d9%84%d8%a9-%d8%b4%d8%a7%d8%a6%d8%b9%d8%a9/";
  else :
      $gotoUrl="http://covid19.sante.gov.dz/fr/faq-2/";
 endif;?>

  <!-- Top Menu 1 -->
<section class="w3l-top-menu-1">
	<div class="top-hd">
		<div class="container">
	<header class="row top-menu-top">
		<div class="accounts col-md-7 col-6">

				<li class="top_li"><span class="fa fa-phone"></span><a href="tel:+142 5897555">3030</a> </li>
			<!--	<li class="top_li1"><span class="fa fa-envelope-o"></span> <a href="mailto:education-mail@support.com" class="mail"> covid19@sante.gov.dz</a>	</li> -->
		</div>
		<div class="social-top col-md-5 col-6">
			<div>
               
                <a  class="main-social-head-link" href="{{ LaravelLocalization::getLocalizedURL("fr", null, [], true) }}" >Français</a>
                <a  class="main-social-head-link" href="#" > |</a>

                <a class="main-social-head-link"
                   href="{{ LaravelLocalization::getLocalizedURL("ar", null, [], true) }}" class="instagram">عربي</a>

            </div>

        </div>








	</header>
</div>
</div>
</section>


<section class="w3l-contact-breadcrum">
    <div class="breadcrum-bg">
        <div class="container py-5">

          
        </div>
    </div>
</section>
 <!--  services section -->
<section class="w3l-index6" id="service">
  <div class="features-with-17_sur py-5">
    <div class="container py-lg-5 nopadding">
      <div class="heading text-left mx-auto">
				<h3 class="head"> {{__('messages.title_index') }}
                </h3>
				<p class="my-3 head">
                  {{__('messages.text_index')}}


                </p>
          <a class="btn btn-secondary btn-theme2   btn btn-danger btn-sm"
             href="{{ env('SITE_URL') }}{{LaravelLocalization::getCurrentLocale()}}/client-survey/1/show" role="button">                  {{__('messages.start_test_index')}}
          </a>

          <!--
          <div class="btn-group">

              <button type="button" class="btn btn-secondary btn-theme2   btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{__('messages.start_test_index')}}


              </button>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="http://localhost:8000/fr/client-survey/1/show">                  {{__('messages.french_index')}}
                      </a>
                  <a class="dropdown-item" href="http://localhost:8000/ar/client-survey/1/show">
                      {{__('messages.arab_index')}}
                      </a>

              </div>
          </div>
          -->
          <!--

          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

              <p> Selectionnez votre langue et </p>


              <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Commencer

                  </button>
                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <a class="dropdown-item" href="#">Français</a>
                      <a class="dropdown-item" href="#">Arabe</a>
                  </div>
              </div>
          </div>
               -->

      </div>

    </div>
  </div>
</section>
 <!--  //services section -->
<!-- customers4 block -->

    <!-- Products4 block -->

    <!-- Products4 block -->
</div>

<section class="w3l-features-4">
	<!-- /features -->
		<div class="features py-5" id="features">
            <div class="container py-md-3">
			<div class="heading text-center mx-auto">
				<h3 class="special">{{ __('messages.questions_index') }}</h3>
				<p class="my-3 head">{{ __('messages.questions_text') }}</p>
			  </div>
			<div class="fea-gd-vv row mt-5 pt-3">
			   <div class="float-lt feature-gd col-md-6">
					 <div class="icon"> <span class="fa fa-leaf" aria-hidden="true"></span></div>
					 <div class="icon-info">
						<h5><a href="#{{$gotoUrl}}">{{__('messages.question1')}}</a></h5>



                         <p> {{ substr(__('messages.response1'),0,550)}} </p>
						<a href="{{$gotoUrl}}" class="red mt-3">{{__('messages.plus_index') }} </a>
					</div>


				</div>
				<div class="float-mid feature-gd col-md-6 mt-md-0 mt-5">
					 <div class="icon"> <span class="fa fa-thumbs-up" aria-hidden="true"></span></div>
					 <div class="icon-info">
						<h5><a href="{{$gotoUrl}}">{{__('messages.question2')}}</a></h5>
						<p> {{ substr(__('messages.response2'),0,550)}} </p>
						<a href="{{$gotoUrl}}" class="red mt-3">
                            {{__('messages.plus_index') }}
                        </a>
					</div>
			 </div>
				<div class="float-rt feature-gd col-md-6 mt-5">
					 <div class="icon"> <span class="fa fa-heartbeat" aria-hidden="true"></span></div>
					 <div class="icon-info">
						<h5><a href="{{$gotoUrl}}">{{__('messages.question3')}}</a></h5>
						<p> {{ substr(__('messages.response3'),0,550)}} </p>
						<a href="{{$gotoUrl}}" class="red mt-3">                   {{__('messages.plus_index') }}
                        </a>
					</div>
			 </div>
			 <div class="float-lt feature-gd col-md-6 mt-5">
					 <div class="icon"> <span class="fa fa-heart" aria-hidden="true"></span></div>
					 <div class="icon-info">
						<h5><a href="{{$gotoUrl}}">{{__('messages.question4')}}</a>
						</h5>
						<p> {{ substr(__('messages.response4'),0,550)}} </p>
						<a href="{{$gotoUrl}}" class="red mt-3">                   {{__('messages.plus_index') }}
                            <span class="fa fa-angle-right pl-1"></span></a>
					</div>

				</div>


		  </div>
		 </div>
	   </div>
   <!-- //features -->
</section>
<!-- grids block 5 -->
<section class="w3l-footer-29-main">
  <div class="footer-29">
      <div class="container">
         


        
          <div class="d-grid grid-col-2 bottom-copies">
              <p class="copy-footer-29">© 2020 Ministére de la santé. All rights reserved | Designed by <a href="#">Algeria Dev Group </a></p>
               <ul class="list-btm-29">
                      <li><a href="#link">Privacy policy</a></li>
                      <li><a href="#link">Terms of service</a></li>

                  </ul>
          </div>
      </div>
  </div>
  <!-- move top -->
  <button onclick="topFunction()" id="movetop" title="Go to top">
    <span class="fa fa-angle-up"></span>
  </button>
  <script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetop").style.display = "block";
      } else {
        document.getElementById("movetop").style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
  </script>
  <!-- /move top -->
</section>
<!-- //footer-28 block -->
</section>



</body>

</html>
<!-- // grids block 5 -->
