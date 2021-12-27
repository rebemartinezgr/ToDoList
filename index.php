<?php
session_start();
?>
<!--
@author Rebeca Martinez Garcia
@author Evelyn Bayas Meza
@author Daniel Hernández Arcos
@author Teodoro Tovar de la Hija
  -->
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/ToDoList/Controller/Get.php"; ?>
<?php $controller = new Get(); ?>
<!doctype html>
<html lang="en">
<head>
    <title>My To Do List</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./View/web/css/custom.css">
    <title>My To Do List</title>
    <script src="./View/web/js/init.js"></script>
</head>
<body>
<script type="application/javascript">
    <?php $lastMsg = $controller->getErrorMsg();
        if ($lastMsg) {
            echo "alert('{$lastMsg}');";
            $controller->resetMsg();
        }
    ?>
</script>

<div class="container">
    <h1 class="title">My To Do List</h1>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <p>Add pending tasks using <strong>+</strong> icon</p>
                <p>Mark completed tasks clicking the item <strong>checkbox</strong></p>
                <p>Delete tasks using <strong>X</strong> icon</p>
            </div>
        </div>
        <div class="col-sm-2">
        </div>

    </div>
    <!-- Form -->
    <form id="task-form" action="Controller/Post.php" method="post">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="task-text" name="value" placeholder="New Task">
                            <label for="task-text">New Task</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="form-control add-button btn btn-primary"><i
                                        class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                            <label for="date">Date</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="category" name="category">
                                <option selected value=''>Choose a category</option>
                                <?php foreach ($controller->getCategoryOptions() as $option) {
                                    echo "<option value='{$option['value']}'>{$option['label']}</option>";
                                }
                                ?>
                            </select>
                            <label for="category">Category</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </form>
    <!-- End Form -->
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-7">
            <ul id="list" class="mylist list-group">
                <?php
                foreach ($controller->execute() as $k => $item):
                    echo "<li class='list-group-item' id='{$k}'> {$item}</li>";
                endforeach;
                ?>
            </ul>
        </div>
        <div class="col-sm-1">
        </div>
    </div>
</div>
</body>
</html>