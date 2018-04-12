<?php

/*
 * Re-create the same database operations that you can find in the 'database_1.php' file,
 * but by using the PDO classes.
 * http://php.net/manual/en/book.pdo.php
 */
 
function getConnection()
{
    if (!isset($link)) {
        static $link = NULL;
    }
    
    if ($link === NULL) {
        try {
			$link = new PDO('mysql:host=localhost;dbname=lightmvctestdb', 'lightmvcuser', 'testpass');
			foreach($link->query('SELECT * from `customers`') as $row) {
				print_r($row);
			}
			$link = NULL;
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
    }
    return $link;    
}

function closeConnection()
{
    if (!isset($link)) {
        static $link = NULL;
        return FALSE;
    } else {
        $link = NULL;
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
        foreach ($where->query($query) as $column => $value) {
            $query .= $column . ' = ' . $where->quote($value) . ' ' . $andOr;
        }
        $query = substr($query, 0, -(strlen($andOr)));
    }
    $link = getConnection();
	//$result = mysqli_query($link, $query); supposed to be mysqli_query($query,$link)?
	$result = $link->query($query);

	// This should be PDO!
    return mysqli_fetch_all($result);
}

$myArray = getCustomers(array('id' => '3'));

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
