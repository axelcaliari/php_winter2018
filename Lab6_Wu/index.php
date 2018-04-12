<?php

/*
 * Create a simple API that will count every HTTP request that is sent to it and return the
 * value in JSON format. Also, create a simple JS periodical updater function that will send
 * AJAX requests to it and display the result as a string in the Web page.
 */

if(isset($_SERVER['REQUEST_METHOD'])) {

    $requestCount = array(
        "GET count" => 0,
        "POST count" => 0,
        "PUT count" => 0,
        "PATCH count" => 0,
        "DELET count" => 0,
    );

    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': $requestCount['GET count']++; break;
        case 'POST': $requestCount['PATCH count']++; break;
        case 'PUT': $requestCount['PUT count']++; break;
        case 'PATCH': $requestCount['PATCH count']++; break;
        case 'DELET': $requestCount['DELET count']++; break;
    }

    echo json_encode($requestCount);
}
?>
<html lang="en">
<head>
    <title>Simple API</title>
</head>
<body>
    <div style="margin: 0 auto; width: 450px; height: auto; position: relative; top: 20%; border: #2aabd2 solid; padding: 20px; text-align: center;">
        <pre id="result"></pre>
        <button class="btn btn-primary" onclick="updater()">Start sending requests</button>
    </div>
</body>
<script>
    var updater = function () {

        /*new Ajax.PeriodicalUpdater('datetime', 'index.php', {
            method: 'get', frequency: 2, decay: 0
        });*/

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("result").innerHTML =
                    JSON.stringify(this.responseText);
            }
        };
        xhttp.open("POST", "index.php", true);
        xhttp.send();

    }
</script>
</html>

