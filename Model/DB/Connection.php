<?php

class Connection {

    private $mysqli = null;

    const HOST = '127.0.0.1';
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
            try {
                $this->mysqli = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE, 33060);
                if ($this->mysqli->connect_error) {
                    throw new \Exception("No es posible establecer conecxión con la base de datos");
                }
            } catch (Exception $exception) {
                die;
            }
        }
        return $this->mysqli;
    }
}