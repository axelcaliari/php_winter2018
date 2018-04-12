<html lang="en">
<head>
    <title>Simple API</title>
</head>
<body>
    <div id="result" style="margin: 0 auto; width: 600px; height: 500px; position: relative;
    top: 20%; border: #2aabd2 solid; padding: 20px; text-align: center; overflow: scroll">
        <button class="btn btn-primary" onclick="startTimer();">Start sending requests</button>
        <button class="btn btn-primary" onclick="stopTimer();">Stop</button>
    </div>
</body>
<script>

     var timer;

     function startTimer() {
         timer = setInterval(function(){
             var xhttp = new XMLHttpRequest();
             var p = document.createElement("p");

             xhttp.onreadystatechange = function () {
                 var content = document.createTextNode(this.response);
                 p.appendChild(content);
                 if (this.readyState == 4 && this.status == 200) {
                     document.getElementById("result").appendChild(p);
                 }
             };
             xhttp.open("GET", "requestCountAPI.php?id=6", true);
             xhttp.send(null);
         }, 1000);
     }

     var stopTimer = function() {
         clearInterval(timer);
     }

</script>
</html>

