<!DOCTYPE html>

<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;

                var pusher = new Pusher('51a5148e64ad9676d4e9', {
                cluster: 'ap2'
                });

                var channel = pusher.subscribe('room.1');
                channel.bind('room.1', function(data) {
                alert(JSON.stringify(data));
                });
    </script>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>
</body>
