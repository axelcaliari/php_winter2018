<?php

/*
 * Re-create the same database operations that you can find in the 'database_1.php' file,
 * but by using the PDO classes.
 * http://php.net/manual/en/book.pdo.php
 */

class database_pdo
{
    // pdo instance
    private $db = null;
    // database_pdo instance (singleton)
    private static $instance = null;

    private $user = "lightmvcuser";
    private $pass = "testpass";

    private function __construct()
    {
        try
        {
            $this->db = new PDO('mysql:host=localhost;port=3307;dbname=lightmvctestdb', $this->user, $this->pass);
        }catch(PDOException $e)
        {
           echo $e->getMessage();
        }
    }

    //singleton
    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new database_pdo();
        }
        return self::$instance;
    }

    public static function closeInstance()
    {
        self::$instance = null;
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

        // NOTE: By default, PDO fetches both numeric and associative keys.
        return $query->fetchAll(PDO::FETCH_NUM);
    }
}


$database_pdo = database_pdo::getInstance();

$myArray = $database_pdo->getCustomers(array('id' => '3'));

$database_pdo->closeInstance();

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
