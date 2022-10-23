<?php
$conn = new mysqli( "MYSQL", "user", "password", "appDB");

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    $id = trim($_GET["id"]);
    $query = mysqli_query($conn, "SELECT * FROM animals WHERE ID = '$id'");

    if ($animals = mysqli_fetch_assoc($query)) {
        $category = $animals["category"];
        $nickname = $animals["nickname"];
        $age = $animals["age"];
    } else {
        echo "Something went wrong. mistake 1.";
        exit();
    }
    mysqli_close($conn);
} else {
    echo "Something went wrong. mistake 2.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
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
                    <h1> Read</h1>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <p class="form-control-static"><?php echo $category ?></p>
                </div>
                <div class="form-group">
                    <label>Nickname</label>
                    <p class="form-control-static"><?php echo $nickname ?></p>
                </div>
                <div class="form-group">
                    <label>Age</label>
                    <p class="form-control-static"><?php echo $age ?></p>
                </div>
                <div class="form-group">
                    <label>Id</label>
                    <p class="form-control-static"><?php echo $id ?></p>
                </div>
                <p><a href="index.html" class="btn btn-primary">Back</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>