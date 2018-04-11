<?php

$htmlOut = '<!DOCTYPE html>';
$htmlOut .= '<html>';
$htmlOut .= '<head>';
$htmlOut .= '<title>Your Home Page</title>';
$htmlOut .= '</head>';
$htmlOut .= '<body>';
$htmlOut .= '<div id="profile">';
$htmlOut .= '<b id="welcome">Welcome : </b>';
$htmlOut .= '<b id="logout"><a href="htmllogin.php">Log Out</a></b>';
$htmlOut .= '</div>';
$htmlOut .= '</body>';
$htmlOut .= '</html>';

echo $htmlOut;
