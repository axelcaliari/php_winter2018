<?php

/*
 * Re-create the same database operations that you can find in the 'database_1.php' file,
 * but by using the PDO classes.
 * http://php.net/manual/en/book.pdo.php
 */

class pdo
{
	// Declaration des variables
private $user = 'lightmvcuser';
private $pass = 'testpass';
private $dsn = 'mysql:host=localhost;port:8889;dbname=lightmvctestdb';
private $db= null;
private static $instance = null;
	
	
	private function pdo::__construct(){
		try{
			this->$db = new PDO($dsn, $user, $pass);
    }
		}catch(PDOException $e){
			print "Error!" . $e->getMessage() . "<br>";
			die();
		}
	}

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
      
        $query = this->$db->prepare($query);
        $query->execute($query);
      
        $result = $query;
        $query = null;
        
        return $result->fetchAll();
    }

}

$db_pdo = pdo();

$myArray = $db_pdo->getCustomers(array('id' => '3'));

$db_pdo = null;

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