<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
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

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->conn = new Connection();
        $this->createDatabase();
        $this->createTable();
    }

    /**
     * Create database
     *
     * @throws Exception
     */
    public function createDatabase()
    {
        $conn = $this->conn->connect(false);
        $sql = "CREATE DATABASE IF NOT EXISTS `" . Connection::DATABASE . "`";
        $conn->query($sql);
        $conn->close();
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
            throw new \Exception("Error al crear la tabla en base de datos");
        }
        $this->conn->disconnect();
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function select($id): array
    {
        $newConn = $this->conn->connect();
        $query = "SELECT * FROM " . self::TABLE;
        $query .= " WHERE `id` = " . $id . ";";
        $mysqlResult = $newConn->query($query);
        if (!$mysqlResult) {
            throw new \Exception("Error al leer el elemento en base de datos");
        }
        $result = $mysqlResult->fetch_assoc();
        $this->conn->disconnect();
        return $result;
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
        if (!$mysqlResult) {
            throw new \Exception("Error al leer elementos en base de datos");
        }
        while ($row = $mysqlResult->fetch_assoc()) {
            $result[] = $row;
        }
        $this->conn->disconnect();
        return $result;
    }

    /**
     * @param $text
     * @param $category
     * @param $date
     * @return bool
     * @throws Exception
     */
    public function insert($text, $category, $date): bool
    {
        $newConn = $this->conn->connect();
        $query = "INSERT INTO " . self::TABLE . "(`text`, `category`, `date`)";
        $query .= " VALUES ('" . $text . "'," . $category . ",'" . $date . "');";
        $mysqlResult = $newConn->query($query);
        if (!$mysqlResult) {
            throw new \Exception("Error al añadir el elemento en base de datos");
        }
        $this->conn->disconnect();
        return (bool) $mysqlResult;
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws Exception
     */
    public function update($id, $status): bool
    {
        $newConn = $this->conn->connect();
        $query = "UPDATE " . self::TABLE . " SET `status` = " . $status;
        $query .= " WHERE `id` = " . $id . ";";
        $mysqlResult = $newConn->query($query);
        if (!$mysqlResult) {
            throw new \Exception("Error al actualizar elemento en base de datos");
        }
        $this->conn->disconnect();
        return (bool) $mysqlResult;
    }

    /**
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function delete($id): bool
    {
        $newConn = $this->conn->connect();
        $query = "DELETE FROM " . self::TABLE;
        $query .= " WHERE `id` = " . $id . ";";
        $mysqlResult = $newConn->query($query);
        if (!$mysqlResult) {
            throw new \Exception("Error al borrar el elemento en base de datos");
        }
        $this->conn->disconnect();
        return (bool) $mysqlResult;
    }
}