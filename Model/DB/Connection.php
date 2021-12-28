<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
 */

/**
 * Connection class.
 * Establish and close connection
 */
class Connection {

    private $mysqli = null;

    const HOST = '127.0.0.1';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DATABASE = 'database';

    /**
     * Close connection
     */
    public function disconnect(): void
    {
        $this->mysqli->close();
    }

    /**
     * Open connection
     *
     * @param bool $useDataBase
     * @return mysqli
     * @throws Exception
     */
    public function connect(bool $useDataBase = true): mysqli
    {
        $this->mysqli = $this->createConnection($useDataBase);
        return $this->mysqli;
    }

    /**
     * @param bool $useDataBase
     * @return mysqli
     * @throws Exception
     */
    private function createConnection(bool $useDataBase): mysqli
    {
        try {
            if ($useDataBase) {
                $conn = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE);
            } else {
                $conn = new mysqli(self::HOST, self::USERNAME, self::PASSWORD);
            }

            if ($conn->connect_error) {
                throw new \Exception("No es posible establecer conexión con la base de datos");
            }
        }
        catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $conn;
    }
}
