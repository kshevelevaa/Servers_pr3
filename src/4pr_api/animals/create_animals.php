<?php
$conn = new mysqli("MYSQL", "user", "password", "appDB");
$nickname=$category=$age="";
$nickname_error=$category_error=$age_error="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $category = trim($_POST["category"]);
    if (empty($category)){
        $category_error = "category is required";
    }elseif (!filter_var($category, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $category_error = "category is invalid";
    } else{
        $category = $category;
    }

    $nickname = trim($_POST["nickname"]);
    if (empty($nickname)){
        $nickname_error = "nickname is required";
    }elseif (!filter_var($nickname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nickname_error = "nickname is invalid";
    } else{
        $nickname = $nickname;
    }

    $age = trim($_POST["age"]);
    if (empty($age)){
        $age_error = "age is required";
    }elseif (!filter_var($age, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $age_error = "age is invalid";
    } else{
        $age = $age;
    }

    if (empty($category_error) && empty($nickname_error) && empty($age_error)){
        $stmt=$conn->prepare("INSERT INTO animals (category, nickname, age) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $category, $nickname, $age);
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
                        <span class="help-block"><?php echo $category_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($nickname_error)) ? 'has-error' : ''; ?>">
                        <label>Nickname</label>
                        <input type="text" name="nickname" class="form-control" value="">
                        <span class="help-block"><?php echo $nickname_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($age_error)) ? 'has-error' : ''; ?>">
                        <label>Age</label>
                        <input type="text" name="age" class="form-control" value="">
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




