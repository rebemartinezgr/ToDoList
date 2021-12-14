<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

include_once "../Model/Collection/ItemList.php";
include_once "../View/Block/ItemRenderer.php";
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
        $category = $_REQUEST['category'] ?? null;
        $date = $_REQUEST['date'] ?? null;
        $list = new ItemList();
        $item = $this->add($value, $status, $list);
        $result[$item->getId()] = $block->renderItem($item);

        return $result;
    }

    /**
     * Add Item action
     *
     * @param $value
     * @param $status
     * @param $list
     * @return Item
     * @throws Exception
     */
    private function add($value, $status, $list): Item
    {
        if ($value === null) {
            throw new \Exception("No es posible crear el item");
        }

        return $list->addItem($value, $status);
    }
}

//Create the object
$controller = new Post();
$controller->getResponse();
header('Location: /view');