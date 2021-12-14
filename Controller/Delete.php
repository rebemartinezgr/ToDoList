<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

include_once "../Model/Collection/ItemList.php";
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
        if ($id === null) {
            throw new \Exception("No es posible eliminar el item");
        }
        $list->deleteItem($id);
        return $result;
    }
}

//Create the object
$controller = new Delete();
echo $controller->getResponse();