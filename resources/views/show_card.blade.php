<!DOCTYPE html>
<head>
  <title>Card Viewer</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  <script src='/js/jquery-3.4.1.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  

  <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
  <script src='/js/mustache.3.0.1.js'></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('4fdeafbb25f448a6b3ab', {
      cluster: 'us3',
      forceTLS: true
    });

    var channel = pusher.subscribe('{{$channel_id}}');
    channel.bind('show_this_card', function(data) {

		var scryfall_url = 'https://api.scryfall.com/cards/multiverse/' + data['multiverse_id'];

		var tpl = "<h1>@{{name}} </h1> <p> @{{oracle_text}} </p> <img src='@{{image_uris.large}}'>";
		var tpl = "<div class='row'> <div class='col-6''> <img src='@{{image_uris.art_crop}}'> </div> <div class='col-6'> <h1>@{{name}} </h1> <p> @{{oracle_text}} </p> </div> </div>";
//		var tpl = "<h1>@{{name}} </h1> <p> @{{oracle_text}} </p>";

		fetch(scryfall_url)
			.then(function(response) {
    				return response.json();
  			})
  			.then(function(myData) {
				var card_html = Mustache.to_html(tpl, myData);
				$('#cardView').html(card_html);
			});
    	});
  </script>
</head>
<body>
<h3> Delver URL: https://lore.ft1.us/changeCard/{{$channel_id}}/$multiverse_id </h3>
<div id='cardView' class='container-fluid'>

</div>
</body>

