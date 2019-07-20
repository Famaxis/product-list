<?php
function __autoload($class)
{
    require_once "classes/$class.php";
}

if (isset($_GET['id'])) {
    $uid = $_GET['id'];
    $product = new Product();
    $result = $product->selectOne($uid);
}

if (isset($_POST['submit'])) {
    $fields = [
        'title' => $_POST['title'],
        'descr' => $_POST['descr'],
        'price' => $_POST['price']
    ];
    $id = $_POST['ID'];
    $product = new Product();
    $product->update($fields, $id);
}

require_once "header.php";
?>

<!--Form-->
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <h4 class="mb-4">Edit product</h4>

                <form action="" method="post">
                    <input type="hidden" name="ID" value="<?= $result['ID'] ?>">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" name="title" class="form-control" value="<?= $result['title'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="descr">Description</label>
                        <input type="text" name="descr" class="form-control" value="<?= $result['descr'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" value="<?= $result['price'] ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </form>

            </div>
        </div>
    </div>
</div>
<!--Form ends-->
</body>
</html>