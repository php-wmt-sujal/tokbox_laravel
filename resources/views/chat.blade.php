<html>
<head>
    <title> OpenTok Getting Started </title>
    <script src="https://static.opentok.com/v2/js/opentok.js"></script>
</head>
<body>

{{--<div>SessionKey: {{ $session_id }}</div>--}}
<div id="videos">
    <div id="subscriber"></div>
    <div id="publisher"></div>
</div>

<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
<script type="text/javascript">

    var token = '{{ $token }}';
    var session_key = '{{ $session_id }}';
    var api_key = '{{ $api_key }}';

    var pubOptions = {publishAudio:true, publishVideo:false};

    // connect to open tok api using client side library
    var session = OT.initSession(api_key, session_key);

    // when other user is connected we want to show them
    // in subscriber div element
    session.on('streamCreated', function(event) {
        session.subscribe(event.stream, 'subscriber', {
            insertMode: 'append',
            width: '100%',
            height: '100%'
        });
    });

    // when first user loads this page we want him to
    // be shown in publisher div element
    var publisher = OT.initPublisher('publisher', {
        insertMode: 'append',
        width: '100%',
        height: '100%',
        publishAudio:false,
        publishVideo:false
    });

    sess

    // if we have any connection error let's put an alert box
    session.connect(token, function(error) {
        if (error) {
            alert(error.message);
        } else {
            session.publish(publisher);
        }
    });

</script>
</body>
</html>