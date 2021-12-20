<!--
  ~ @author Rebeca Martinez Garcia <r.martinezgr@gmail.com>
  -->
  <?php include_once $_SERVER['DOCUMENT_ROOT']."/ToDoList/Controller/Get.php"; ?>
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
    <form action="Controller/Post.php" method="post">
    <div class="row">
        <div class="col-sm-2">
        </div>
        <!-- Form -->
            <div class="col-sm-7">
                <div class="form-group">
                    <input class="form-control input-lg" id="new-item" name="value" type="text"/>
                </div>
                <div class="form-group">
                    <label for="date">Fecha vencimiento</label>
                    <input class="form-control input-lg" id="date" name="date" type="date"/>
                </div>
                <div class="form-group">
                    <label for="category">Categoría</label>
                    <input class="form-control input-lg" id="category" name="category" type="text"/>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    <button type="submit" class="form-control add-button btn btn-primary"><i
                                class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
       <!-- End Form -->
        <div class="col-sm-2">
        </div>
    </div>
    </form>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-7">
            <ul id="list" class="mylist list-group">
                <?php 
                    $controller = new Get();
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