<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MyStore</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- database -->
    <?php include "templates/db.php"; ?>
    <?php
      session_start();
      if(!isset($_SESSION['box'])){
        $_SESSION['box'] = array();
      }
    ?>

</head>

<body>
<?php
        if(isset($_GET['action'])){
          if($_GET['action']=="login"){
            $login = $_POST['login'];
            $pass = sha1($_POST['pass']);
            $query = $connection->query("SELECT * FROM users WHERE login = \"$login\" AND password = \"$pass\"");
            if($row = $query->fetch_object()){
              $_SESSION['online'] = true;
              $_SESSION['id'] = $row->id;
              header("Location:index.php?page=main");
            }else{
              header("Location:index.php?page=login&error=1&log=".$login."");
            }
          }else if($_GET['action']=="logout"){
            $_SESSION['online'] = false;
          }else if($_GET['action']=="reg"){
            $login = $_POST['login'];
            $pass = "";
            $name = $_POST['name'];
            $sur = $_POST['sur'];
            if($_POST['pass']!=$_POST['pass_check']){
              header("Location:index.php?page=reg&error=1&log=".$login."&name=".$name."&sur=".$sur."");
            }else{
              $pass = sha1($_POST['pass']);
              $connection->query("INSERT INTO users VALUES(NULL,1,\"$login\",\"$pass\",\"$name\",\"$sur\",1)");
              header("Location:index.php?page=login");
            }
          }else if($_GET['action']=="add"){
            $id = $_GET['id'];
            array_push($_SESSION['box'], $id);
            header("Location:index.php?page=item&id=".$id."");
          }else if($_GET['action']=="delBox"){
            $id = $_GET['id'];
            array_splice($_SESSION['box'], $id, 1);
            header("Location:index.php?page=payment");
          }else if($_GET['action']=="purchase"){
            if(isset($_SESSION['online'])&&isset($_SESSION['id'])){
              if($_SESSION['online']){
          	    $query = $connection->query("SELECT * FROM items");
          	    $count = 0;
                $id = $_SESSION['id'];
          	    while($row = $query->fetch_object()){
                  if(count($_SESSION['box'])!=0&&$_SESSION['box']!=NULL){
            				$item_box = $_SESSION['box'][$count];
            	      $query_img = $connection->query("SELECT * FROM pictures WHERE item_id = $item_box");
            	      if($row_img = $query_img->fetch_object()){
            					$count++;
                      if($row->amounts!=0){
                        $cost = $row->price;
                        $item_id = $row->id;
                        $query_user = $connection->query("SELECT name FROM users WHERE id = $id");
                        if($row_user = $query_user->fetch_object()){
                          $name = $row_user->name;
                          $connection->query("INSERT INTO transactions VALUES(NULL,$id,1,$cost,\"123\",\"$name\",123,$item_id,NULL)");
                          $connection->query("UPDATE items SET amounts=amounts-1 WHERE id = $item_id");
                        }
                      }
            	      }
                  }
          	    }
                $_SESSION['box']=array();
                header("Location:index.php?page=main");
              }else{
          	    $query = $connection->query("SELECT * FROM items");
          	    $count = 0;
                $id = $_SESSION['id'];
          	    while($row = $query->fetch_object()){
                  if(count($_SESSION['box'])!=0&&$_SESSION['box']!=NULL){
            				$item_box = $_SESSION['box'][$count];
            	      $query_img = $connection->query("SELECT * FROM pictures WHERE item_id = $item_box");
            	      if($row_img = $query_img->fetch_object()){
            					$count++;
                      if($row->amounts!=0){
                        $cost = $row->price;
                        $item_id = $row->id;
                        $connection->query("INSERT INTO transactions VALUES(NULL,0,1,$cost,\"123\",\"Anonymous\",123,$item_id,NULL)");
                        $connection->query("UPDATE items SET amounts=amounts-1 WHERE id = $item_id");
                      }
                    }
                  }
                }
                $_SESSION['box']=array();
                header("Location:index.php?page=main");
              }
            }else{
                $count = 0;
                $item_box = $_SESSION['box'][$count];
          	    $query = $connection->query("SELECT * FROM items WHERE id = $item_box");
          	    while($row = $query->fetch_object()){
                  if(count($_SESSION['box'])!=0&&$_SESSION['box']!=NULL){
            					$count++;
                      if($row->amounts!=0){
                        $cost = $row->price;
                        $item_id = $row->id;
                        $connection->query("INSERT INTO transactions VALUES(NULL,0,1,$cost,\"123\",\"Anonymous\",123,$item_id,NULL)");
                        $connection->query("UPDATE items SET amounts=amounts-1 WHERE id = $item_id");
                      }
                  }
                }
                $_SESSION['box']=array();
                header("Location:index.php?page=main");
            }
          }
        }
?>

    <?php include "templates/header.php"?>

    <?php
        $page = "main";
        if(isset($_GET['page'])){
            if($_GET['page']=="main"){
                $page = "main";
            }else if($_GET['page']=="item"){
                $page = "item";
            }else if($_GET['page']=="search"){
                $page = "search";
            }else if($_GET['page']=="login"){
                $page = "login";
            }else if($_GET['page']=="box"){
                $page = "box";
            }else if($_GET['page']=="reg"){
                $page = "reg";
            }else if($_GET['page']=="payment"){
                $page = "payment";
            }else{
                $page = "404";
            }
        }

        if($page=="main"){
            include 'pages/slider.php';
        }
    ?>

    <div class="container">
        <?php
            include 'pages/'.$page.'.php';
            include 'templates/footer.php';
        ?>
    </div>
        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

</body>

</html>
