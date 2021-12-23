<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
 */

include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/Collection/ItemList.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/Item.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/View/Block/ItemRenderer.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Model/Source/Category.php";
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
        $list = new ItemList();
        $block = new ItemRenderer();
        $items = $list->getItems();
        foreach ($items as $item) {
            $result[$item->getId()] = $block->renderItem($item);
        }
        return $result;
    }

    /**
     * Return category options in array with the structure
     * ['label' =>  , 'value' => ]
     *
     * @return array
     */
    public function getCategoryOptions(): array
    {
        $categoryModel = new Category();
        return $categoryModel->getOptions();
    }
}