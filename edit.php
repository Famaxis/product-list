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
        'title' => htmlspecialchars($_POST['title']),
        'descr' => htmlspecialchars($_POST['descr']),
        'price' => htmlspecialchars($_POST['price'])
    ];
    $id = $_POST['ID'];

    if (!in_array("", $fields)) {
        $product = new Product();
        $product->update($fields, $id);
    } else {
        $error = "All fields are required";
    }
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
                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            <?= $error; ?>
                        </div>
                    <?php } ?>
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </form>

            </div>
        </div>
    </div>
</div>
<!--Form ends-->
</body>
</html>