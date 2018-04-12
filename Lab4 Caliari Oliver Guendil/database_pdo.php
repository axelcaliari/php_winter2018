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
		try{			
			$link = new PDO('mysql:host=localhost;dbname=lightmvctestdb', 'lightmvctestdb', 'testpass');
		}catch(PDOException $e){
			echo "Error" . $e->getMessage();
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
		$link->connection = NULL;
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
    $link = getConnection();
	$reponse = $link->query($query, PDO::FETCH_ASSOC);

	return $reponse->fetch();
}

$myArray = getCustomers(array('id' => '3'));
closeConnection();

$htmlOut = "<!DOCTYPE html>\n<html>\n<head>\n</head>\n<body>\n<table>\n";

foreach ($myArray as $key => $value) {
    $htmlOut .= "\t<tr>\n";	
    $htmlOut .= "\t\t<td align=\"center\">$key : $value</td>\n";
    $htmlOut .= "\t</tr>\n";
}

$htmlOut .= "</table>\n</body>\n</html>";

echo $htmlOut;
