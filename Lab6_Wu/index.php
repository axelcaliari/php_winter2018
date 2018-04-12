<html lang="en">
<head>
    <title>Simple API</title>
</head>
<body>
    <div style="margin: 0 auto; width: 550px; height: auto; position: relative; top: 20%; border: #2aabd2 solid; padding: 20px; text-align: center;">
        <p id="result"></p>
        <button class="btn btn-primary" onclick="updater()">Start sending requests</button>
    </div>
</body>
<script>
    function updater() {

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("result").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "requestCountAPI.php", true);
        xhttp.send(null);

    });
//    setInterval(function(){
//        updater();
//    },2000);
</script>
</html>

