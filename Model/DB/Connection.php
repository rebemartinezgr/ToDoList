<?php

class Connection {

    private $mysqli = null;

    const HOST = '127.0.0.1';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DATABASE = 'database';


    public function close() :void
    {
        $this->mysqli->close();
    }

    /**
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