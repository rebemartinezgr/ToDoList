<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/Item.php";
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
     * @param int $id
     * @return Item
     * @throws Exception
     */
    public function getItem(int $id) : Item
    {
        $arrayItem = $this->transaction->select($id);
        return new Item(
            $arrayItem['id'],
            $arrayItem['text'],
            $arrayItem['status'],
            $arrayItem['category'],
            $arrayItem['date']
        );
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
     * @param Item $item
     * @return Item
     * @throws Exception
     */
    public function addItem(Item $item): Item
    {
        $this->transaction->insert($item->getValue(), $item->getCategory(),$item->getDate());
        return $item;
    }

    /**
     * @param $id
     * @param $status
     * @return Item
     * @throws Exception
     */
    public function updateItem($id, $status): Item
    {
        $this->transaction->update($id, $status);

        return $this->getItem($id);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function deleteItem($id): void
    {
        $this->transaction->delete($id);
    }
}
