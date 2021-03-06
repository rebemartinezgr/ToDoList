<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/Model/Collection/ItemList.php";
include_once "AbstractController.php";

/**
 * Delete controller class
 */
class Delete extends AbstractController
{
    const HTTP_METHOD = 'POST';

    /**
     * Process delete request
     *
     * @return false|string
     * @throws Exception
     */
    public function execute(): array
    {
        $result = [];
        $id = $_REQUEST['id'] ?? null;
        $list = new ItemList();
        try {
            if ($id === null || !($id > 0)) {
                throw new \Exception("Datos inválidos");
            }
            $list->deleteItem($id);
        } catch (\Exception $e) {
            $result['status']  = false;
            $result['msg']  = "No es posible borrar la tarea: " . $e->getMessage();
        }
        return $result;
    }
}

$controller = new Delete();
echo $controller->getResponse();
