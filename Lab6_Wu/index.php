<?php
if (!isset($_COOKIE["request"]) || empty($_COOKIE["request"])) {
    setcookie("request", json_encode(array(
        "GET count" => 0,
        "POST count" => 0,
        "PUT count" => 0,
        "PATCH count" => 0,
        "DELETE count" => 0,
        "GET" => [],
        "POST" => [],
        "PUT" => [],
        "PATCH" => [],
        "DELETE" => []
    )),time() + 3600);
}
?>
<html lang="en">
<head>
    <title>Simple API</title>
</head>
<body>
    <div style="margin: 0 auto; width: 600px; height: 500px; position: relative;
    top: 20%; border: #2aabd2 solid; padding: 20px; text-align: center; overflow: scroll">
        <button class="btn btn-primary" onclick="startTimer();">Start sending requests</button>
        <button class="btn btn-primary" onclick="stopTimer();">Stop</button>
        <div id="result" style="text-align: justify"></div>
    </div>
</body>
<script>

     var timer;

     function startTimer() {
         timer = setInterval(function(){
             var xhttp = new XMLHttpRequest();
             var pre = document.createElement("pre");

             xhttp.onreadystatechange = function () {
                 var content = document.createTextNode(this.response);
                 pre.appendChild(content);
                 if (this.readyState == 4 && this.status == 200) {
                     document.getElementById("result").appendChild(pre);
                 }
             };
             var value = parseInt(Math.random()*100 + "", 10);
             var httpType = getHTTPType(value);
             xhttp.open(httpType, "requestCountAPI.php?value=" + value, true);
             xhttp.send(null);
         }, 2000);
     }

     var stopTimer = function() {
         clearInterval(timer);
     }

     function getHTTPType(value) {
         if (value <= 20)
             return "GET";
         else if (value > 20 && value <= 40)
             return "POST";
         else if (value > 40 && value <= 60)
             return "PUT";
         else if (value > 60 && value <= 80)
             return "PATCH";
         else
             return "DELETE";
     }

</script>
</html>

