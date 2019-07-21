<?php
function __autoload($class)
{
    require_once "classes/$class.php";
}

if (isset($_POST['submit'])) {
    $fields = [
        'title' => htmlspecialchars($_POST['title']),
        'descr' => htmlspecialchars($_POST['descr']),
        'price' => htmlspecialchars($_POST['price'])
    ];

    if (!in_array("", $fields)) {
        $product = new Product();
        $product->insert($fields);
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
                <h4 class="mb-4">Add product</h4>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descr">Description</label>
                        <input type="text" name="descr" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control">
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