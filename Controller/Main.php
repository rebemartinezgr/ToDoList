<?php
/*
 * @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
 *
 * Main entry point for requests
 */

include_once "Get.php";
include_once "Post.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new Get();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new Post();
}
$result = isset($controller) ? $controller->execute() : [];
echo json_encode($result);