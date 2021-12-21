<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/Item.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/DB/Connection.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/DB/Transaction.php";

/**
 * Item List Collection Class
 */
class ItemList
{
    /**
     * @var array
     */
    private $items;

    /**
     * @var Transaction
     */
    private $transaction;

    /**
     * @param array|null $items
     */
    public function __construct(
        array $items = null
    ) {
        $this->items = $items;
        $this->transaction = new Transaction();
    }

    /**
     * Get Items list
     *
     * @return array
     */
    public function getItems(): array
    {
        $items = [];
        if ($this->items === null) {
            try {
                $arrayItems = $this->transaction->selectAll();
                foreach ($arrayItems as $arrayItem) {
                    $items[] = new Item(
                        $arrayItem['id'],
                        $arrayItem['text'],
                        $arrayItem['status'],
                        $arrayItem['category'],
                        $arrayItem['date']);
                }
            } catch (Exception $e) {
                $items = [];
            }
            $this->setItems($items);
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
     * @param Item $item
     * @return Item
     */
    public function addItem(Item $item): Item
    {
        $this->transaction->insert($item->getValue(), $item->getCategory(),$item->getDate());
        //TODO save on database and return assigned id
        return $item;
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
