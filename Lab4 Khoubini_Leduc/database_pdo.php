<?php

/*
 * Re-create the same database operations that you can find in the 'database_1.php' file,
 * but by using the PDO classes.
 * http://php.net/manual/en/book.pdo.php
 */

// Cannot declare again the PDO class!
class customPDO
{
	// Declaration des variables
    private $user = 'lightmvcuser';
    private $pass = 'testpass';
    private $dsn = 'mysql:host=localhost;port=3307;dbname=lightmvctestdb';
    private $db= null;
    private static $instance = null;
	
	
	public function __construct()
    {
		try{
			$this->db = new PDO($this->dsn, $this->user, $this->pass);
		} catch(PDOException $e) {
			print "Error!" . $e->getMessage() . "<br>";
			die();
		}
	}

    public function getCustomers(array $where = array(), $andOr = 'AND')
    {
        $query = 'SELECT `id`,`firstname`,`lastname` FROM `customers`';
        if ($where) {
            $query .= ' WHERE ';
            foreach ($where as $column => $value) {
                $query .= $column . ' = ' . $this->db->quote($value) . ' ' . $andOr;
            }
            $query = substr($query, 0, -(strlen($andOr)));
        }
      
        $query = $this->db->prepare($query);

        $query->execute();
      
        return $query->fetchAll(PDO::FETCH_NUM);
    }

}

$db_pdo = new customPDO();

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