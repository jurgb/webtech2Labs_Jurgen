<?php
	if(!empty($_POST))
		{

			$file = fopen('mailadressen.txt', "a+");//openen

			fwrite($file, $_POST['email'] . ";\n");//wegschrijven

			fclose($file);//sluiten
		}
?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Terrappke</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" href="css/screen.css">
</head>
<body onload="getLocation();">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12 bottom"><h1>Een passie voor het web & apps?</h1></div>
			<h1><div id="tekstFeedback" class="col-md-12 col-xs-12 bottom2"></div></h1>
		</div>

		<div class="row bottom2">
			<div class="col-md-4 col-xs-4">
				<h2 id="weer"></h2>
			</div>
			<div class="col-md-4 col-xs-4">
				<canvas id="icoon" width="128" height="128"></canvas>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<p>Ga je binnekort studeren en wil jij net als ons niets liever doen dan knappe websites, mobile apps en webapplicaties bouwen?</br>
				Dan ben jij een perfecte kandiditaat voor onze opleiding <a target="_blank" href="http://www.thomasmore.be/interactive-multimedia-design-imd">Interactive Multimedia Design</a>.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<p>Kom mee een terraske doen aan onze <a target="_blank" href="http://www.thecreativitygym.be/">Creativity Gym</a> en neem meteen een kijkje in onze opleiding aan de Thomas More hogeschool in Mechelen.</p>
			</div>
		</div>

		<div class="row bottom">
			<div class="col-md-12">
				<p>Laat je email adres achter en we mailen de exacte datum, locatie en tijdstip naar je door.</p>
			</div>
		</div>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6 col-xs-6">
					<div class="input-group">
	  					<span class="input-group-addon">@</span>
	  					<input type="text" name="email" class="form-control" placeholder="example@example.com">
					</div>
				</div>
				<div class="col-md-6 col-xs-6">
					<input type="submit" value="Schijf je in!" class="btn btn-default"></button>
				</div>
			</div>
		</form>

	</div>

	<SCRIPT TYPE="text/javascript">
		var w=document.getElementById('weer');

		function getLocation()
		{
			if(navigator.geolocation)
			{
	    		navigator.geolocation.getCurrentPosition(getWeather);
			}
			else
			{
				alert("Geolocation is not supported by this browser.");
			}
		}

		function getWeather(position){
	  		$.ajax({
	  			url:"https://api.forecast.io/forecast/3e5beed1dc0749ae29a685ea773f3d6f/" + position.coords.latitude + "," + position.coords.longitude,
	  			dataType:"jsonp",
				success: function(response) {
					var graden = Math.round((response.currently.temperature - 32)/1.8)
					w.innerHTML = graden + " <strong>&degC</strong>";

					var i = response.currently.icon;
					var skycons = new Skycons({"color":"black"});
					skycons.set("icoon", i);
					skycons.play();

					switch(true){
						case graden <= 5:
							$('body').css("background-color","#C5EFF7");
							$('#tekstFeedback').html("Het is spijtig genoeg nog veel te koud om een terrappke te doen!")
							break;
						case graden <= 10:
							$('body').css("background-color","#6BB9F0");
							$('#tekstFeedback').html("Het weer begint te beteren, maar nog steeds niet warm genoeg om een terrapke te doen!")
							break;
						case graden <= 15:
							$('body').css("background-color","#2ECC71");
							$('#tekstFeedback').html("Nog een paar graden en dan is het tijd om een terrappke te doen!")
							break;
						case graden <= 20:
							$('body').css("background-color","#F4D03F");
							$('#tekstFeedback').html("Eindelijk is het zover! Tijd voor een terrappke!")
							break;
						case graden <= 25:
							$('body').css("background-color","#F39C12");
							$('#tekstFeedback').html("Nu is het warm genoeg om in t-shirt een terrappke te doen!")
							break;
						default:
							$('body').css("background-color","#D35400");
							$('#tekstFeedback').html("Vergeet zeker geen zwembroek mee te nemen voor dit terrappke!")
					}
				}
			});
		}
	</SCRIPT>

	<script src="js/skycons.js"></script>
</body>
</html>