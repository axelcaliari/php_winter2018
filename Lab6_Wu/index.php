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
             xhttp.onreadystatechange = function () {
                 if (this.readyState == 4 && this.status == 200) {
                     var pre = document.createElement("pre");
                     var content = document.createTextNode(this.response);
                     pre.appendChild(content);
                     document.getElementById("result").appendChild(pre);
                 }
             };
             var value = parseInt(Math.random()*100 + "", 10);
             xhttp.open("GET", "requestCountAPI.php?value=" + value, true);
             xhttp.send(null);
         }, 1000);
     }

     var stopTimer = function() {
         clearInterval(timer);
     }

</script>
</html>

