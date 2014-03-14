<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
	<div class="wrapper">
		<div class="row">
			<div class="col-md-12">
				<h1 id="welkomsbericht">Dit is dummy tekst, deze tekst wordt dynamish aangepast</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div id="dag"></div>
		<div id="maand"></div>
		<img id="icoon"/>
		<div id="weer"></div>
		<div id="omschrijving"></div>
		<div id="min"></div>
		<div id="max"></div>


			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p>
					Ga je binnekort verder studeren en wil jij ner als ons niets liever doen dan knappe websites, mobile apps en webapplicaties bouwen? Dan ben jij een perfecte kandidaat voor onze opleiding interactieve multimedia design.
				</p>
				<p>
					Kom mee een teraske doen aan onze Creativity Gym en neem meteen een kijkje on onze opleiding aan de Thomas More hogeschool in Mechelen.
				</p>
				<p>
					Laat je email adres achter en we mailen de exacte datum, locatie en tijdstip naar je door.
				</p>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				
			</div>
			<div class="col-md-8">
				<div class="input-group input-group-lg">
  					<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
  					<input type="text" class="form-control" placeholder="Example@example.ext">
				</div>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<p>Dit zijn der 8</p>
			</div>
			<div class="col-md-4">
				<p>Dit zijn er 4</p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		//dag en maand
		var day=document.getElementById('dag');
		var m=document.getElementById('maand');

		//weervariabelen
		var w=document.getElementById('weer');
		var om=document.getElementById('omschrijving');
		var ico=document.getElementById('icoon');

		day.innerHTML = new Date().getDate()+1;
		month = new Date().getMonth()+1;

		switch (month){
			case 1:
				m.innerHTML = 'JANUARY';
				break;
			case 2:
				m.innerHTML = 'FEBRUARY';
				break;
			case 3:
				m.innerHTML = 'MARCH';
				break;
			case 4:
				m.innerHTML = 'APRIL';
				break;
			case 5:
				m.innerHTML = 'MAY';
				break;
			case 6:
				m.innerHTML = 'JUNE';
				break;
			case 7:
				m.innerHTML = 'JULY';
				break;
			case 8:
				m.innerHTML = 'AUGUST';
				break;
			case 9:
				m.innerHTML = 'SEPTEMBER';
				break;
			case 10:
				m.innerHTML = 'OCTOBER';
				break;
			case 11:
				m.innerHTML = 'NOVEMBER';
				break;
			case 12:
				m.innerHTML = 'DECEMBER';
				break;
		}

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
					w.innerHTML = Math.round((response.currently.temperature - 32)/1.8) + " <strong>&degC</strong>";
					om.innerHTML = response.daily.data[1].summary;
					min.innerHTML = "Min: " + Math.round((response.daily.data[1].temperatureMin-32)/1.8) + " &degC";
					max.innerHTML = "Max: " + Math.round((response.daily.data[1].temperatureMax-32)/1.8)+ " &degC";

					var i = response.currently.icon;
					switch(i){
						case "clear-day":
							ico.src="http://www.iconsdb.com/icons/preview/black/sun-xxl.png";
							break;

						case "clear-night":
							ico.src="http://www.iconsdb.com/icons/preview/black/moon-xxl.png";
							break;

						case "partly-cloudy-day":
							ico.src="http://www.iconsdb.com/icons/preview/black/partly-cloudy-day-xxl.png";
							break;

						case "partly-cloudy-night":
							ico.src="http://www.iconsdb.com/icons/preview/black/partly-cloudy-night-xxl.png";
							break;

						case "wind":
							ico.src="http://www.iconsdb.com/icons/preview/black/little-rain-xxl.png";

						default:
							ico.src="http://www.iconsdb.com/icons/preview/black/clouds-xxl.png";
					}
	   			}
			});
	 	}
	</script>
</body>
</html>