<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel = "icon" type = "image/png" href = "mvc/views/frontend/images/logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/shopping/" >
    <!-- <link href="mvc/views/frontend/bootstrap/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="mvc/views/frontend/bootstrapV5/css/bootstrap.min.css" rel="stylesheet">
    <link href="mvc/views/frontend/css/style.css" rel="stylesheet">
    <link href="mvc/views/frontend/css/Responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>ShoppingTech</title>
</head>
<body>
            

  
  <?php require_once "mvc/views/frontend/include/header.php" ?>
   
  <?php require_once "mvc/views/frontend/".$data['page'].".php" ?>

  <?php require_once "mvc/views/frontend/include/footer.php" ?>




        <script src="mvc/views/frontend/bootstrap/jquery/dist/jquery.min.js"></script>
        <!-- <script src="mvc/views/frontend/bootstrap/bootstrap/dist/js/bootstrap.bundle.min.js"></script>   -->
        <script src="mvc/views/frontend/bootstrapV5/js/bootstrap.bundle.min.js"></script>  
</body>
</html>