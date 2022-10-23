<?php

$conn = new mysqli( "MYSQL", "user", "password", "appDB");

$title = $category = $price = "";
$title_error = $category_error = $price_error = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $category = trim($_POST["category"]);
    if (empty($category)) {
        $category_error = "category is required";
    } elseif (!filter_var($category, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $category_error = "category is invalid";
    } else {
        $category = $category;
    }

    $title = trim($_POST["title"]);
    if (empty($title)) {
        $title_error = "title is required";
    } elseif (!filter_var($title, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $title_error = "title is invalid";
    } else {
        $title = $title;
    }

    $price = trim($_POST["price"]);
    if (empty($price)) {
        $price_error = "price is required";
    } else {
        $price = $price;
    }

    if (empty($category_error) && empty($title_error) && empty($price_error)) {

        $sql = "UPDATE feed SET category='$category', title='$title', price='$price' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM feed WHERE ID = '$id'");

        if ($feed = mysqli_fetch_assoc($query)) {
            $category   = $feed["category"];
            $title    = $feed["title"];
            $price       = $feed["price"];
        } else {
            echo "Something went wrong. mistake 1.";
//            header("location: update.php");
            exit();
        }
        mysqli_close($conn);
    }  else {
        echo "Something went wrong. mistake 2.";
//        header("location: update.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="pprice-header">
                    <h2>Update</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>

                    <div class="form-group <?php echo (!empty($category_error)) ? 'has-error' : ''; ?>">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control" value="<?php echo $category; ?>">
                        <span class="help-block"><?php echo $category_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($title_error)) ? 'has-error' : ''; ?>">
                        <label>title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                        <span class="help-block"><?php echo $title_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($price_error)) ? 'has-error' : ''; ?>">
                        <label>price</label>
                        <input type="number" name="price" class="form-control" value="<?php echo $price; ?>">
                        <span class="help-block"><?php echo $price_error;?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.html" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>


