<?php
function __autoload($class)
{
    require_once "classes/$class.php";
}

if (isset($_POST['submit'])) {
    $fields = [
        'title' => $_POST['title'],
        'descr' => $_POST['descr'],
        'price' => $_POST['price']
    ];
    $product = new Product();
    $product->insert($fields);
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
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </form>

            </div>
        </div>
    </div>
</div>
<!--Form ends-->
</body>
</html>