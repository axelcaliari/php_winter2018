<?php

// BEWARE!!! This script is unsafe!!!

function getConnection()
{
    if (!isset($link)) {
        static $link = NULL;
    }
    
    if ($link === NULL) {
        $link = mysqli_connect('localhost', 'lightmvcuser', 'testpass', 'lightmvctestdb');
    }
    return $link;    
}

function closeConnection()
{
    if (!isset($link)) {
        static $link = NULL;
        return FALSE;
    } else {
        mysqli_close($link);
        return TRUE;
    }
}

function getQuote()
{
    return "'";
}

// SELECT `id`,`firstname`,`lastname` FROM `customers` WHERE x=y 
// $where = [key = column name, value = data]
// $andOr = AND | OR
function getCustomers()
{
    $id = isset($_GET['id']) ? $_GET['id'] : '1';
    $query = 'SELECT `id`,`firstname`,`lastname` FROM `customers` WHERE id = ' . $id;
    $link = getConnection();
    $result = mysqli_query($link, $query);
    return mysqli_fetch_all($result);
}

$myArray = getCustomers();

closeConnection();

$htmlOut = "<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<table>\n";

foreach ($myArray as $tableRow) {
    $htmlOut .= "\t<tr>\n";
    foreach ($tableRow as $tableCol) {
        $htmlOut .= "\t\t<td align=\"center\">$tableCol</td>\n";
    }
    $htmlOut .= "\t</tr>\n";
}

$htmlOut .= "</table>\n</body>\n</html>";

echo $htmlOut;
