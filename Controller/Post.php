<?php
/*
 * @author Rebeca Martinez Garcia
 * @author Evelyn Bayas Meza
 * @author Daniel Hernández Arcos
 * @author Teodoro Tovar de la Hija
 */

/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 */

include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/Model/Collection/ItemList.php";
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
        try {
            $result = [];
            $status = $_REQUEST['status'] ?? 0;
            $value = $_REQUEST['value'] ?? null;
            $category = $_REQUEST['category'] ?? null;
            $date = $_REQUEST['date'] ?? null;

            if (empty($value) || empty($category) || empty($date)) {
                throw new \Exception("No es posible añadir la tarea");
            }

            $list = new ItemList();
            $item = new Item(null, $value, $status,  $category, $date);

            if (!$item->validateDate()) {
                throw new \Exception("No es posible añadir la tarea. Fecha no válida");
            }
            if (!$item->validateCategory()) {
                throw new \Exception("No es posible añadir la tarea. Categoría no válida");
            }

            $list->addItem($item);
        } catch (\Exception $e) {
            $result['status']  = false;
            $result['msg']  = "No es posible añadir la tarea: " . $e->getMessage();
        }
        return $result;
    }
}

//Create the object
$controller = new Post();
$controller->getResponse();
header('Location: /ToDoList');