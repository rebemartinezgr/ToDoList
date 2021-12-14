<?php

class Connection {

    private $mysqli = null;

    const HOST = 'db';
    const USERNAME = 'user';
    const PASSWORD = 'password';
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
        if ($this->mysqli == null) {
            $this->mysqli = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE);
            if ($this->mysqli->connect_error) {
                throw new \Exception("No es posible establecer conexión con la base de datos");
            }
        }
        return $this->mysqli;
    }
}