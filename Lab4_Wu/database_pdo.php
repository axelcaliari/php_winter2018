<?php

/*
 * Re-create the same database operations that you can find in the 'database_1.php' file,
 * but by using the PDO classes.
 * http://php.net/manual/en/book.pdo.php
 */

function getConnection()
{

    if (!isset($pdo)) {
        static $pdo = NULL;
    }

    if ($pdo === NULL) {

        $type = "mysql";
        $host = "localhost";
        $username = "lightmvcuser";
        $pwd = "testpass";
        $dbname = "lightmvctestdb";
        $dsn = "$type:host=$host;dbname=$dbname";

        $pdo = new PDO($dsn, $username, $pwd);
    }
    return $pdo;
}

function closeConnection()
{
    if (!isset($pdo)) {
        static $pdo = NULL;
        return FALSE;
    } else {
        $pdo = null;
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
function getCustomers(array $where = array(), $andOr = 'AND')
{
    $query = 'SELECT `id`,`firstname`,`lastname` FROM `customers`';
    if ($where) {
        $query .= ' WHERE ';
        foreach ($where as $column => $value) {
            $query .= $column . ' = ' . getQuote() . $value . getQuote() . ' ' . $andOr;
        }
        $query = substr($query, 0, -(strlen($andOr)));
    }
    $pdo = getConnection();
    $result = $pdo->prepare($query);
    $result->execute();
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

$myArray = getCustomers();

closeConnection();

$htmlOut = "<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<table align='center'>\n";

foreach ($myArray as $tableRow) {
    $htmlOut .= "\t<tr>\n";
    foreach ($tableRow as $tableCol) {
        $htmlOut .= "\t\t<td align=\"center\"><h1>$tableCol</h1></td>\n";
    }
    $htmlOut .= "\t</tr>\n";
}

$htmlOut .= "</table>\n</body>\n</html>";

echo $htmlOut;


