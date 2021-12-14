<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 *
 * Controller for get request
 */

include_once "../Model/Collection/ItemList.php";
include_once "../Model/Item.php";
include_once "../View/Block/ItemRenderer.php";
include_once "AbstractController.php";

/**
 * Get controller class
 */
class Get extends AbstractController
{
    const HTTP_METHOD = 'GET';

    /**
     * Process get request.
     * Return the rendered items list as array
     *
     * @return false|string
     */
    public function execute(): array
    {
        $result = [];
        $list = new ItemList($this->getDummyData());
        $block = new ItemRenderer();
        $items = $list->getItems();
        foreach ($items as $k => $item) {
            $result[$k] = $block->renderItem($item);
        }
        return $result;
    }

    /**
     * @return array
     */
    private function getDummyData(): array
    {
        /* This is an example as there is no database connected at this moment */
        return [
            1 => new Item(1, "   esto es una prueba de tarea pendiente",false),
            2 => new Item(2, "      esto es una prueba de tarea realizada",true)
        ];
    }
}