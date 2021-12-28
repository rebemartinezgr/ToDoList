<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
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
     * Process put request
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
        try {
            $item = $this->edit($id, $status);
            $result[$item->getId()] = $block->renderItem($item);
        } catch (\Exception $e) {
            $result['status']  = false;
            $result['msg']  = "No es posible actualizar el estado de la tarea: " . $e->getMessage();
        }

        return $result;
    }

    /**
     * Edit item action
     *
     * @param $id
     * @param $status
     * @return Item
     * @throws Exception
     */
    private function edit($id, $status): Item
    {
        if ($id === null || !($id > 0) || $status === null || !in_array($status, [0,1])) {
            throw new \Exception("Datos inválidos");
        }
        $list = new ItemList();
        return $list->updateItem($id, (int)$status);
    }
}

$controller = new Put();
echo $controller->getResponse();
