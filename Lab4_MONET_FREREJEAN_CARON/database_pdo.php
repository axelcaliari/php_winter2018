<?php

/*
 * Re-create the same database operations that you can find in the 'database_1.php' file,
 * but by using the PDO classes.
 * http://php.net/manual/en/book.pdo.php
 */


function getConnection()
{

    if (!isset($conn)) {
        static $conn = NULL;
    }

    if ($conn === NULL) {
        $servername = "localhost";
        $username = "lightmvcuser";
        $password = "testpass";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=lightmvctestdb", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    return $conn;

}

function closeConnection()
{

    if (!isset($conn)) {
        static $conn = NULL;
        return FALSE;
    } else {
        $conn = null;
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
    $conn = getConnection();

    $query = 'SELECT `id`,`firstname`,`lastname` FROM `customers`';


    if ($where) {
        $query .= ' WHERE ';
        foreach ($where as $column => $value) {
            $query .= $column . ' = ' . getQuote() . $value . getQuote() . ' ' . $andOr;
        }
        $query = substr($query, 0, -(strlen($andOr)));
        //var_dump($query);
    }


    $stmt = $conn->prepare($query);
    $stmt->execute();
    //var_dump($stmt);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);;
    //var_dump($result);
    return $result;

}

$myArray = getCustomers(array('id' => '3'));

closeConnection();

$htmlOut = "<!DOCTYPE html>\n<html>\n<head>\n</head>\n";
echo "<body >";

foreach ($myArray as $element) {
    echo $element["id"]." ";
    echo $element["firstname"]." ";
    echo $element["lastname"]." ";

    echo "<br /><br />";
}
echo "</body>";



echo $htmlOut;


