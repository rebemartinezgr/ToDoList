<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */
include_once "Connection.php";

/**
 * Transaction Class
 * Performs read and write queries to database
 */
class Transaction
{
    /**
     * @var Connection
     */
    private $conn;

    /**
     * Main database table name
     */
    const TABLE = 'items';

    /*public function createDatebase() :void
    {
        $query = "CREATE DATABASE 'database'";
        if(mysqli_query($link, $query)){
            echo "Success";
        } else {
            echo "Failure";
        }
    }*/

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->conn = new Connection();
        $this->createTable();
    }

    /**
     * @throws Exception
     */
    public function createTable(): void
    {
        $newConn = $this->conn->connect();
        $query = "CREATE TABLE IF NOT EXISTS " . self::TABLE;
        $query .= " (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `text` varchar(255) NOT NULL DEFAULT '',
            `status` int(1) NOT NULL DEFAULT 0,
            `category` int(14) DEFAULT NULL,
            `date` date
        );";

        if (!$newConn->query($query)) {
            throw new \Exception("No es posible crear la tabla en base de datos");
        }
        $this->conn->disconnect();
    }

    /**
     * @return array
     * @throws Exception
     */
    public function selectAll(): array
    {
        $result = [];
        $newConn = $this->conn->connect();
        $query = "SELECT * FROM " . self::TABLE;
        $query .= " ORDER BY status ASC, date ASC";
        $mysqlResult = $newConn->query($query);
        if ($mysqlResult) {
            while ($row = $mysqlResult->fetch_assoc()) {
                $result[] = $row;
            }
        }
        $this->conn->disconnect();
        return $result;
    }

    /**
     * @param $text
     * @param $category
     * @param $date
     * @return array
     * @throws Exception
     */
    public function insert($text, $category, $date): array
    {
        $result = [];
        $newConn = $this->conn->connect();
        $query = "INSERT INTO " . self::TABLE . "(`text`, `category`, `date`)";
        $query .= " VALUES ('" . $text . "'," . $category . "," . $date . "');";
        $mysqlResult = $newConn->query($query);
        if (!$mysqlResult) {

        }
        $this->conn->disconnect();
        return $result;
    }
}