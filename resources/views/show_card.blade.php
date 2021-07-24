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
  

  <script src="/js/pusher-7.0.min.js"></script>
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

			$.get('/templates/cardview.template.html', function(templates) {
				var tpl = $(templates).filter('#tpl-cardview').html();
				//var tpl = "<h1>@{{name}}</h1>";	
		
				fetch(scryfall_url)
					.then(function(response) {
    						return response.json();
  					})
  					.then(async function(myData) {
						//console.log('before get_illustration');
						var ill_img_list = await get_illustration_array(myData);
						var rulings_list = await get_rulings_array(myData);
						await sleep(2000); //doing this as the simplest way to ensure that my ill_img_list is really set
						myData.ill_img_list = ill_img_list;
						myData.rulings_list = rulings_list;
						myData.source_scryfall_url = scryfall_url
						//console.log('before mustache to_html');
						//console.log(myData);
						var card_html = Mustache.to_html(tpl, myData);
						console.log('before html');
						$('#cardView').html(card_html);

						//now we sort out the background color
							//defaul tis...
						back_color = 'goldenrod'; //asume multi colored
						if(myData.color_identity.length == 0){
							back_color = 'lightgrey'; //grey for no color
						}	

						if(myData.color_identity.length > 1){
							//do nothing keep the default...
							
						}else{
							card_color = myData.color_identity[0];
				
							switch(card_color){
								case 'W': 
									back_color = 'white';
									break;
								case 'R':
									back_color = 'salmon';
									break;
								case 'B':
									back_color = 'lightgrey';
									break;
								case 'G':
									back_color = 'green';
									break;
								case 'U':
									back_color = 'lightskyblue';
									break;	
							}

						}

						document.body.style.background = back_color;

					});
			}); // end get template
		});  //end pusher channel bind

	//get the rulings requires another API call..
	async function get_rulings_array(card_data){

		rulings_list = [];

		fetch(card_data.rulings_uri)
			.then(function(response){
				 return response.json();
				})
			.then(function(rulings_data){
				rulings_data.data.forEach(function(this_ruling) {
					rulings_list.push(this_ruling);
				});			
			});

		return(rulings_list);

	}


	// looks inside the card for the prints_search_url, and returns the list of images 
	// from the various prints...
	async function get_illustration_array(card_data){

		img_list = [];

		fetch(card_data.prints_search_uri)
			.then(function(response){
				 return response.json();
				})
			.then(function(cards_data){
				cards_data.data.forEach(function(this_card) {
					img_list.push(this_card['image_uris']['large']);
				});			
			});

		return(img_list);

	}



function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

function toggleFullScreen(elem) {
    // ## The below if statement seems to work better ## if ((document.fullScreenElement && document.fullScreenElement !== null) || (document.msfullscreenElement && document.msfullscreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
        if (elem.requestFullScreen) {
            elem.requestFullScreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullScreen) {
            elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
}


  </script>
</head>
<body>
<div id='cardView' class='container-fluid' style='padding: 3% 3%;background-color: light-grey;' >
<h1> Welcome to Lore Card Show </h1>
<p>
This is a simple webpage that allows you turn your android phone into a MTG card data display.
The system works by using a websocket to modify this webpage after the 
<a target='_blank' href='https://play.google.com/store/apps/details?id=delverslab.delverlens&hl=en_US'>Delver Android App</a>
is used to send a 
<a target='_blank' href='https://scryfall.com/docs/api/cards/multiverse'>multiverse id</a>
to the ShowCard URL. If you would like you can test this interface out without using delver by visiting the
<a target='_blank' href='/changeCard/fredTV/469857'> ShowCard URL with the multiverse id for Concordia Pegasus</a>. After
visiting that page, return to this one to see how it has changed!!
<br>
Debugging tips. If you have trouble, click the 'reload card view template' button to get the latests js template loaded. 
Also, if you are using <a target='_blank' href='https://privacybadger.org/'>Privacy Badger</a> (which you should be) or an ad blocker, you will need to approved the domain api.scryfall.com which is where all of the data for card show comes from!

</p>
<h3> Enter the following into Delver: {{$base_url}}/changeCard/{{$channel_id}}/$multiverseid </h3>
<a href='/templates/cardview.template.html'>reload card view template</a>
<input type="button" value="click to toggle fullscreen" onclick="toggleFullScreen(document.body)">
<br>
Thanks to <a target='_blank' href='https://scryfall.com'>ScryFall</a> for the amazing API and image database that makes this possible, as well as to WotC whose generous policies with fan content make both this site and ScryFall possible. 

<br><br>
<h4>Testing</h4>
<p>You can use the following urls to test this system without delver lens..</p>
<ul>
@foreach ($demo_card_list as $card)
<li>
	<a target='_blank' href='/changeCard/fredTV/{{$card->multi_id}}'>{{ $card->name }}</a>
</li>
@endforeach
</ul>
</div>
</body>

