<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/Model/Collection/ItemList.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/View/Block/ItemRenderer.php";
include_once "AbstractController.php";

/**
 * Post controller class
 */
class Post extends AbstractController
{
    const HTTP_METHOD = 'POST';

    /**
     * Process post request
     *
     * @return false|string
     * @throws Exception
     */
    public function execute(): array
    {
        $result = [];
        $block = new ItemRenderer();
        $status = $_REQUEST['status'] ?? 0;
        $value = $_REQUEST['value'] ?? null;
        $category = (int) $_REQUEST['category'] ?? null;
        $date = $_REQUEST['date'] ?? null;
        $list = new ItemList();
        $item = new Item(null, $value, $status,  $category, $date);
        $item = $list->addItem($item);
        if ($item->getId()) {
            $result[$item->getId()] = $block->renderItem($item);
        }
        return $result;
    }
}

//Create the object
$controller = new Post();
$controller->getResponse();
header('Location: /ToDoList');