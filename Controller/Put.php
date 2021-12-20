<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/Model/Collection/ItemList.php";
include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/View/Block/ItemRenderer.php";
include_once "AbstractController.php";

/**
 * Put controller class
 */
class Put extends AbstractController
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
        $id = $_REQUEST['id'] ?? null;
        $status = $_REQUEST['status'] ?? null;
        $value = $_REQUEST['value'] ?? null;
        $list = new ItemList();
        $item = $this->edit($id, $value, $status, $list);
        $result[$item->getId()] = $block->renderItem($item);

        return $result;
    }

    /**
     * Edit item action
     *
     * @param $id
     * @param $status
     * @param $value
     * @param $list
     * @return Item
     * @throws Exception
     */
    private function edit($id, $value, $status, $list): Item
    {
        if ($id === null || $status === null) {
            throw new \Exception("No es posible actualizar el estado del item");
        }
        return $list->updateItem($id, $value, $status);
    }
}

//Create the object
$controller = new Put();
echo $controller->getResponse();