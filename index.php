<?php
function __autoload($class)
{
    require_once "classes/$class.php";
}

$table = new Product;
$table->checkTable();

if (isset($_GET['del'])) {
    $id = $_GET['del'];
}

$product = new Product();
$product->delete($id);

require_once "header.php";
?>

<!--Table-->
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <h4 class="mb-4">Product list</h4>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($table->checkTable())
                    $product = new Product();
                    $rows = $product->selectMany();
                    foreach ($rows as $row): ?>
                    <tr>
                        <th scope="row"><?= $row['ID'] ?></th>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['descr'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><a class="btn btn-sm btn-primary" href="edit.php?id=<?= $row['ID'] ?>">Edit</a>
                            <a class="btn btn-sm btn-danger" href="index.php?del=<?= $row['ID'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<!--Table ends-->
</body>
</html>