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

    var token = 'T1==cGFydG5lcl9pZD00NTkzMTM4MiZzaWc9NGY4NDQyMzc5ZDNiZTczNmFiYWI3OTljMmUxZjQxNjEzYWFmYjlmNTpzZXNzaW9uX2lkPTFfTVg0ME5Ua3pNVE00TW41LU1UVXdNVGd5TXpnd01USXpNbjVTYXpWYUwwMHZkRUpGVmpsRU5sYzJlRXhKTUd0R2FrOS1VSDQmY3JlYXRlX3RpbWU9MTUwMTgyMzgwMSZyb2xlPXB1Ymxpc2hlciZub25jZT0xNTAxODIzODAxLjMzMDIxODY1NDYzODE2';
    var session_key = '1_MX40NTkzMTM4Mn5-MTUwMTgyMzgwMTIzMn5SazVaL00vdEJFVjlENlc2eExJMGtGak9-UH4';
    var api_key = '45931382';

   // var pubOptions = {publishAudio:true, publishVideo:false};

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
        height: '100%'
    });

    // if we have any connection error let's put an alert box
    session.connect(token, function(error) {
        var publisher = OT.initPublisher('camera');
        session.publish(publisher, function() {
            screenshare();
        });
        if (error) {
            alert(error.message);
        } else {
            session.publish(publisher);
        }
    });

    OT.registerScreenSharingExtension('chrome', extensionId, 2);

    function screenshare() {
        OT.checkScreenSharingCapability(function(response) {
            if (!response.supported || response.extensionRegistered === false) {
                alert('This browser does not support screen sharing.');
            } else if (response.extensionInstalled === false) {
                alert('Please install the screen sharing extension and load your app over https.');
            } else {
                // Screen sharing is available. Publish the screen.
                var screenSharingPublisher = OT.initPublisher('screen-preview', {videoSource: 'screen'});
                session.publish(screenSharingPublisher, function(error) {
                    if (error) {
                        alert('Could not share the screen: ' + error.message);
                    }
                });
            }
        });
    }

</script>
</body>
</html>