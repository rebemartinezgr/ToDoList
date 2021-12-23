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
     * @return mysqli
     * @throws Exception
     */
    public function connect(): mysqli
    {
        $this->mysqli = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE);
        if ($this->mysqli->connect_error) {
            throw new \Exception("No es posible establecer conexión con la base de datos");
        }
        return $this->mysqli;
    }
}
