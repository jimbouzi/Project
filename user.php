<?php
session_start();
if(!isset($_SESSION['sesusername'])){
  header("Location: ../index.php");
  exit();
}
require 'actions/chartaction.php';
?>




<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>User Page</title>
    <link rel="stylesheet" href="fontawesome-5.5/css/all.min.css" />
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/templatemo-style.css" />
	<link rel="stylesheet" href="leaflet/leaflet.css"/>
	<link rel="stylesheet" href="css/button1.css" />
	<link rel="stylesheet" href="css/button2.css" />
	<link rel="stylesheet" href="css/filters.css" />
  <!--For leaflet.draw -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css"/>
  
	   <style>
              #mapid {height: 70%;
                      width: 70%;
                      margin: "auto"

					  }
                      table, th, td {
                      border: 1px solid black;
                      border-collapse: collapse;
                      padding: 5px;
                      text-align: center;
                      }
        </style>
		<style>
              #leaves {
				  position: relative;
				  bottom: 500px;
				  left: 700px;
			  }



		</style>

	<style>

	#title1{

		background-color: #ffffff;
		  border: 3px solid #73AD21;

	}

	</style>


  </head>
  <body>


    <section id="hero" class="text-white tm-font-big tm-parallax">

      <nav class="navbar navbar-expand-md tm-navbar" id="tmNav">
        <div class="container">


          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars navbar-toggler-icon"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">

          </div>

        </div>
      </nav>

      <div class="text-center tm-hero-text-container">
        <div class="tm-hero-text-container-inner">
            <h2 class="tm-hero-title" id="title1" style="color:green; "><b>Ecoapp<b></h2>

        </div>
      </div>

      <div class="tm-next tm-intro-next">
        <a href="#introduction" class="text-center tm-down-arrow-link">
          <i class="fas fa-3x fa-caret-down tm-down-arrow"></i>
        </a>
      </div>
    </section>

 <section id="introduction" class="tm-section-pad-top">
      <div class="container">

        <div class="row">

          <div class="col-lg-6" style="font-family:Comic Sans MS; color:green">
            <div class="tm-intro-text-container">
			 <i class="fas fa-4x fa-bicycle text-center tm-icon"></i>
                <h2 class="tm-text-primary mb-4 tm-section-title" style="color:green" >How it works</h2>
                <p class="mb-4 tm-intro-text" >
                  Ecoapp is an application that lets you know how <strong>ecofriendly</strong> you are.All you have to do is
				  upload a json file of your google location history and we will show you the results!

            </div>

          </div>

        </div>

<br>
		<br>
<br>
<br>





	  <div id="leaves">
	  <img src="img/leaves.gif" >

	  </div>

        <!--Ayta einai den fainontai sth selida --> 
        <select name="dayFrom" id="dayFrom" style="visibility: hidden">
          <option value=-1>-1 </option>        
        </select>
        <select name="dayTo" id="dayTo" style="visibility: hidden">
          <option value=-1>-1 </option>        
        </select>
        <select name="hourfrom" id="hourFrom" style="visibility: hidden">
          <option value=-1>-1 </option>
        </select>
        <select name="hourTo" id="hourTo" style="visibility: hidden">
          <option value=-1>-1 </option>
        </select>
        <input type='checkbox' id='stillValue' name='movementCheckbox' style="visibility: hidden"></input>
        <input type='checkbox' id='tiltingValue' name='movementCheckbox' style="visibility: hidden"></input>
        <input type='checkbox' id='onFootValue' name='movementCheckbox' style="visibility: hidden"></input>
        <input type='checkbox' id='inVehicleValue' name='movementCheckbox' style="visibility: hidden"></input>
        <input type='checkbox' id='onBicycleValue' name='movementCheckbox' style="visibility: hidden"></input>
        <input type='checkbox' id='unknownValue' name='movementCheckbox' style="visibility: hidden"></input>
        <!--Xreiazetai na mh fainontai gia na leitoyrgei to map.js -->

	  	<div id="mapid" style="border:7px solid green"></div>
		<br>
    <div class="Filters">
      <form  name="Filter" style="font-family:Comic Sans MS; color:green" >
        <label for="yearFrom" >Year from:</label>
        <select name="yearFrom" id="yearFrom">
        </select>

        <label for="yearTo">Year to:</label>
        <select name="yearTo" id="yearTo">
        </select>


        <br>

        <label for="monthFrom">Month from:</label>
        <select name="monthFrom" id="monthFrom">
          <option value=1>January </option>
          <option value=2>February </option>
          <option value=3>March </option>
          <option value=4>April </option>
          <option value=5>May </option>
          <option value=6>June </option>
          <option value=7>July </option>
          <option value=8>August </option>
          <option value=9>September </option>
          <option value=10>October </option>
          <option value=11>November </option>
          <option value=12>December </option>
        </select>

        <label for="monthTo">Month To:</label>
        <select name="monthTo" id="monthTo">
          <option value=1>January </option>
          <option value=2>February </option>
          <option value=3>March </option>
          <option value=4>April </option>
          <option value=5>May </option>
          <option value=6>June </option>
          <option value=7>July </option>
          <option value=8>August </option>
          <option value=9>September </option>
          <option value=10>October </option>
          <option value=11>November </option>
          <option value=12>December </option>
        </select>
		
        <input type='button' id="bt1"  onclick = "ajaxCall()" value='Apply Filters'>
      </form>
    </div>

    <form action="actions/uploadaction.php" method="POST" enctype="multipart/form-data">
          <input type="file" name="jsonfile" id="myFile">
          <button type="submit" id="bt1" name="uploadsubmit" >Upload your json file!</button>
      </form>

    <div id="analysisTable" class="tables"></div>

	  <script src="javascript/yearDropDown.js"></script>
    <script src="leaflet/leaflet.js"></script>
    <!--leaflet.draw, prepei na einai meta to leaflet kai prin to heatmap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
    <!-- --> 
    <script src="heatmap/heatmap.js-master/build/heatmap.js"></script>
    <script src="heatmap/heatmap.js-master/plugins/leaflet-heatmap/leaflet-heatmap.js"></script>
    <script src="leaflet/map.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    
    <br>
    <form action="actions/logoutaction.php" method="POST">
      <button type="submit" class="button red" id="bt2" name="logoutsubmit">Logout</button>
    </form>

	<div class="tables" style="font-family:Impact; color:black;">
    <h3>Κορυφαίοι Χρήστες</h3>
    <table style = "width:40%">
      <tr>
        <th>Όνομα</th>
        <th>Score</th>
      </tr>
      <?php require 'actions/leaderaction.php'; ?>
      </table>
    </div>

    <p  style="color:green;"> Το συνολικό σας score είναι: <?= $wholescore ?> <p>
    <p style="color:green;"> Η περίοδος που καλύπτουν οι εγγραφές σας είναι από <?= $mintimestamp ?> μέχρι <?= $maxtimestamp ?>. </p>
    <!-- To parapanw prepei na einai meta to leaderboard gia na exei ginei to require 'actions/leaderboard' kai na blepei tis metavlites-->
    <p style="color:green;"> Το τελευταίο σας upload έγινε στις <?= $lastupload ?>.</p>
    <canvas id="chart" style="border:5px solid green" width="500" height="150"></canvas>
    <script type="text/javascript">

    new Chart(document.getElementById("chart"), {
      type: 'line',
      data: {
        labels: <?= json_encode($monthlabels); ?>,
        datasets: [{
            data: <?= json_encode($chartdata); ?>,
            borderColor: "#3e95cd",
            fill: false
          }
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Μηνιαίο Score'
        },
        legend: {
          display: false
        }
      }
    });

    </script>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>














	<div style="background-image: url('img/the-town-bg-02.jpg');  ">


    <section id="work" class="tm-section-pad-top">
      <div class="container tm-container-gallery">
        <div class="row">

          <div class="text-center col-12">
              <h2 class="tm-text-primary tm-section-title mb-4" style="color:red;">The Creators</h2>
              <p class="mx-auto tm-work-description">
                Below you can see the creators of this amazing application that will save the world!
              </p>
          </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="mx-auto tm-gallery-container">

                    <div class="grid tm-gallery">

                      <a href="img/gallery-tn-01.png">
                        <figure class="effect-honey tm-gallery-item">

                          <img src="img/gallery-tn-01.png" alt="Image" class="img-fluid">
                          <figcaption>
                            <h2><i>The <span>Memer</span></i></h2>
                          </figcaption>
                        </figure>
						The absolute memer.This guy lives only to make memes.
                      </a>
                      <a href="img/gallery-tn-02.png">
                        <figure class="effect-honey tm-gallery-item">
                          <img src="img/gallery-tn-02.png" alt="Image" class="img-fluid">
                          <figcaption>
                            <h2><i>The <span>Athlete</span></i></h2>
                          </figcaption>
                        </figure>
					100 meters in 10.91 seconds, 200 meters in 20.95...Do i have
						to say more?
                      </a>
                      <a href="img/gallery-tn-03.jpg">
                        <figure class="effect-honey tm-gallery-item">
                          <img src="img/gallery-tn-03.jpg" alt="Image" class="img-fluid">
                          <figcaption>
                            <h2><i>Drummer</i></h2>
                          </figcaption>
                        </figure>

						Picture says it all...The guy is like "fuck my life with this retarded school"
                      </a>


                    </div>
                </div>
            </div>
          </div>
      </div>
    </section>



    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="slick/slick.min.js"></script>
    <script src="magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.singlePageNav.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/up_button.js"></script>


    <script>

      function getOffSet(){
        var _offset = 450;
        var windowHeight = window.innerHeight;

        if(windowHeight > 500) {
          _offset = 400;
        }
        if(windowHeight > 680) {
          _offset = 300
        }
        if(windowHeight > 830) {
          _offset = 210;
        }

        return _offset;
      }

      function setParallaxPosition($doc, multiplier, $object){
        var offset = getOffSet();
        var from_top = $doc.scrollTop(),
          bg_css = 'center ' +(multiplier * from_top - offset) + 'px';
        $object.css({"background-position" : bg_css });
      }

      // Parallax function
      // Adapted based on https://codepen.io/roborich/pen/wpAsm
      var background_image_parallax = function($object, multiplier, forceSet){
        multiplier = typeof multiplier !== 'undefined' ? multiplier : 0.5;
        multiplier = 1 - multiplier;
        var $doc = $(document);
        // $object.css({"background-attatchment" : "fixed"});

        if(forceSet) {
          setParallaxPosition($doc, multiplier, $object);
        } else {
          $(window).scroll(function(){
            setParallaxPosition($doc, multiplier, $object);
          });
        }
      };

      var background_image_parallax_2 = function($object, multiplier){
        multiplier = typeof multiplier !== 'undefined' ? multiplier : 0.5;
        multiplier = 1 - multiplier;
        var $doc = $(document);
        $object.css({"background-attachment" : "fixed"});
       
      };

      $(function(){
        // Hero Section - Background Parallax
        background_image_parallax($(".tm-parallax"), 0.30, false);
        background_image_parallax_2($("#contact"), 0.80);

        // Handle window resize
        window.addEventListener('resize', function(){
          background_image_parallax($(".tm-parallax"), 0.30, true);
        }, true);

        // Detect window scroll and update navbar
        $(window).scroll(function(e){
          if($(document).scrollTop() > 120) {
            $('.tm-navbar').addClass("scroll");
          } else {
            $('.tm-navbar').removeClass("scroll");
          }
        });

        // Close mobile menu after click
        $('#tmNav a').on('click', function(){
          $('.navbar-collapse').removeClass('show');
        })

        // Scroll to corresponding section with animation
        $('#tmNav').singlePageNav();

        // Add smooth scrolling to all links
        // https://www.w3schools.com/howto/howto_css_smooth_scroll.asp
        $("a").on('click', function(event) {
          if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;

            $('html, body').animate({
              scrollTop: $(hash).offset().top
            }, 400, function(){
              window.location.hash = hash;
            });
          } // End if
        });

        // Pop up
        $('.tm-gallery').magnificPopup({
          delegate: 'a',
          type: 'image',
          gallery: { enabled: true }
        });

        // Gallery
        $('.tm-gallery').slick({
          dots: true,
          infinite: false,
          slidesToShow: 5,
          slidesToScroll: 2,
          responsive: [
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
        });
      });
    </script>
  </body>
</html>
