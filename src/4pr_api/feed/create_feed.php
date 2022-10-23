<?php
$conn = new mysqli("MYSQL", "user", "password", "appDB");
$title = $category = $price = "";
$title_error = $category_error = $price_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $stmt = $conn->prepare("INSERT INTO feed (category, title, price) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $category, $title, $price);
        $stmt->execute();
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create animal</title>
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
                <div class="page-header">
                    <h2>Create Animal</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="form-group <?php echo (!empty($category_error)) ? 'has-error' : ''; ?>">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control" value="">
                        <span class="help-block"><?php echo $category_error; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($title_error)) ? 'has-error' : ''; ?>">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="">
                        <span class="help-block"><?php echo $title_error; ?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($price_error)) ? 'has-error' : ''; ?>">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" value="">
                        <span class="help-block"><?php echo $price_error; ?></span>
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




