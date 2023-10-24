<!DOCTYPE html>
<html>
<head>
</head>
<body>
<h1>
    qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq
</h1>

<script type="text/javascript">
    // console.log("qqq");
    // const sse = new EventSource("http://127.0.0.1:9009/.well-known/mercure");
    // sse.addEventListener("message", (e) => {
    //     console.log(e);
    // });

    //const url = new URL("http://127.0.0.1:9009/.well-known/mercure");
    const url = new URL("http://apisscreen.selectedstartups.com:9009/.well-known/mercure");
    url.searchParams.append('topic', 'screen_added');
    const es = new EventSource(url, {withCredentials: false});
    es.onmessage = (msg) => {
        console.log(msg.data);
    }
</script>
</body>
</html>


