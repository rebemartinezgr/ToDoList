<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/Model/Item.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/Model/DB/Connection.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/Model/DB/Transaction.php";

/**
 * Item List Collection Class
 */
class ItemList
{
    /**
     * @var array
     */
    private $items = [];
    /**
     * @var Connection
     */
    private $connection;
    private $transaction;

    /**
     * @param array $items
     */
    public function __construct(
        array $items = []
    ) {
        $this->items = $items;
        $this->connection = new Connection();
        $this->transaction = new Transaction();
    }

    /**
     * Get Items list
     *
     * @return array
     */
    public function getItems(): array
    {
        $this->transaction->createTable();
        $this->transaction->selectAll();
        if ($this->items === null) {
            //TODO load from database
        }
        return $this->items;
    }

    /**
     * Set Items
     *
     * @param array $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    /**
     * Add Item to the list
     *
     * @param $value
     * @param $status
     * @return Item
     */
    public function addItem($value, $status): Item
    {
        $n = rand();
        //TODO save on database and return assigned id
        return new Item($n, $value, (bool)$status);
    }

    /**
     * Update item on the list
     *
     * @param $id
     * @param $value
     * @param $status
     * @return Item
     */
    public function updateItem($id, $value, $status): Item
    {
        //TODO update on database
        return new Item($id, $value, (bool)$status);
    }

    /**
     * Delete item from the list
     *
     * @param $id
     */
    public function deleteItem($id): void
    {
        //TODO delete on database
    }
}
