<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('4fdeafbb25f448a6b3ab', {
      cluster: 'us3',
      forceTLS: true
    });

    var channel = pusher.subscribe('{{$channel_id}}');
    channel.bind('show_this_card', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>{{$channel_id}}</code>
    with event name <code>show_this_card</code>.
  </p>
</body>

