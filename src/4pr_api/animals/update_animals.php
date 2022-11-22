<?php
$conn = new mysqli( "MYSQL", "user", "password", "appDB");
$nickname = $category = $age = "";
$nickname_error = $category_error = $age_error = "";

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

    $nickname = trim($_POST["nickname"]);
    if (empty($nickname)) {
        $nickname_error = "nickname is required";
    } elseif (!filter_var($nickname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nickname_error = "nickname is invalid";
    } else {
        $nickname = $nickname;
    }

    $age = trim($_POST["age"]);
    if (empty($age)) {
        $age_error = "age is required";
    } elseif (!filter_var($age, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $age_error = "age is invalid";
    } else {
        $age = $age;
    }

    if (empty($category_error) && empty($nickname_error) && empty($age_error)) {

        $sql = "UPDATE animals SET category='$category', nickname='$nickname', age='$age' WHERE id='$id'";

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
        $query = mysqli_query($conn, "SELECT * FROM animals WHERE ID = '$id'");

        if ($animal = mysqli_fetch_assoc($query)) {
            $category   = $animal["category"];
            $nickname    = $animal["nickname"];
            $age       = $animal["age"];
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
                <div class="page-header">
                    <h2>Update</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>

                    <div class="form-group <?php echo (!empty($category_error)) ? 'has-error' : ''; ?>">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control" value="<?php echo $category; ?>">
                        <span class="help-block"><?php echo $category_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($nickname_error)) ? 'has-error' : ''; ?>">
                        <label>Nickname</label>
                        <input type="text" name="nickname" class="form-control" value="<?php echo $nickname; ?>">
                        <span class="help-block"><?php echo $nickname_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($age_error)) ? 'has-error' : ''; ?>">
                        <label>Age</label>
                        <input type="text" name="age" class="form-control" value="<?php echo $age; ?>">
                        <span class="help-block"><?php echo $age_error;?></span>
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

