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
                throw new \Exception("Valores requeridos: texto, categoría y fecha");
            }

            $list = new ItemList();
            $item = new Item(null, $value, $status,  $category, $date);

            if (!$item->validateDate()) {
                throw new \Exception("Fecha no válida");
            }
            if (!$item->validateCategory()) {
                throw new \Exception("Categoría no válida");
            }

            $list->addItem($item);
        } catch (\Exception $e) {
            session_start();
            $result['status']  = false;
            $_SESSION["error-msg"] = "No es posible añadir la tarea: " . $e->getMessage();
        }
        return $result;
    }
}

$controller = new Post();
$controller->getResponse();
// Redirect to index
header('Location: /ToDoList');
