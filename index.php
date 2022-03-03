  <html>
<head>
<title>Bill's Cars Web Service</title>
<style>
    body {font-family:georgia;}
    .cars{
      border:1px solid #E77DC2;
      border-radius: 5px;
      padding: 5px;
      margin-bottom:5px;
      position:relative;   
    }
   
    .pic{
      position:absolute;
      right:10px;
      top:10px;
    }

  .pic img{
    max-width:200px;
  }
</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

  function billcarsTemplate(cars){
    return `<div class="cars">
      <b>Car: </b> ${cars.Car}<br />
      <b>Horsepower: </b> ${cars.Horsepower}<br />
      <b>Topspeed: </b> ${cars.Topspeed}<br />
      <b>Year: </b> ${cars.Year}<br />
      <b>Designer: </b> ${cars.Designer}<br />
      <b>Brand: </b> ${cars.Brand}<br />
      <b>Budget: </b> ${cars.Budget}<br />
      <div class="pic"><img src="thumbnails/${cars.Image}" />
</div>
    </div>`;
  }
  
$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL

        var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
    });
    request.done(function( data ) {
     console.log(data)
      $("#carstitle").html(data.title);

      //clears the previous films
      $("#cars").html("");
      //loops through films 
      $.each(data.cars,function(key,value){
        let str = billcarsTemplate(value);

        $("<div></div>").html(str).appendTo("#cars");
        
      });
      //view JSON as string
      /*
      let myData = JSON.stringify(data, null, 4);
      myData = "<pre>" + myData + "</pre>";
      $("#output").html(myData);
      */
      
    });
    request.fail(function( jqXHR, textStatus ) {
     alert( "Request failed: " + textStatus );
    });

	});
});	

</script>
</head>
	<body>
	<h1>Bill's Cars Web Service</h1>
		<a href="speed" class="category">Bill's Cars By Topspeed</a><br />
		<a href="year" class="category">Bill's Cars by years</a>
		<h3 id="carstitle">Title Will Go Here</h3>
		<div id="cars">
			<p>Cars will go here</p>
		</div>
    <!--
    <div class="film">
      <b>Film: </b> 1<br />
      <b>Title: </b> Dr. Yes<br />
      <b>Year: </b> 1962<br />
      <b>Director: </b> Terence Young<br />
      <b>Producers: </b> Harry Saltzman and Albert R. Broccoli<br />
      <b>Writers: </b> Richard Maibaum, Johanna Harwood and Berkely Mather<br />
      <b>Composer: </b> Monty Norman<br />
      <b>Bond: </b> Sean Connery<br />
      <b>Budget: </b> $1,000,000.00<br />
      <b>BoxOffice: </b> $59,567,035.00<br />
      <div class="pic"><img src="thumbnails/dr-no.jpg"/></div>
    -->
    </div>
		<div id="output">Results go here</div>
	</body>
</html>