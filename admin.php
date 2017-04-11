<?php
  include "templates/db.php";
  session_start();
  $page = "login";
  if(isset($_GET['act'])){
    if($_GET['act']=="login"){
      if($_POST['login']=="admin"&&$_POST['password']=="admin"){
        $_SESSION['admin']=true;
        header("Location:admin.php");
      }else{
        header("Location:admin.php?error=1");
      }
    }
  }
  if(isset($_SESSION['admin'])){
    $page = "edit";
    if(isset($_GET['act'])){
      if($_GET['act']=="upload"){
        $file = $_FILES['pic'];
        $name = $_POST['name'];
        $cat = $_POST['categ'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $descr = $_POST['descr'];
        $count = $_POST['count'];
        $a = $price+1;
        $b = $count+1;
        if(is_int($a)&&is_int($b)){
          $connection->query("INSERT INTO items VALUES(NULL,\"$name\",$cat,$brand,\"$descr\",$price,0,NULL,$count)");
          $query = $connection->query("SELECT MAX(id) AS id FROM items");
          if($row = $query->fetch_object()){
            $file_name = (($row->id).".jpg");
            move_uploaded_file($_FILES['pic']['tmp_name'],"img/$file_name");
            $connection->query("INSERT INTO pictures VALUES(NULL,$row->id,\"$file_name\",NULL)");
            header("Location:admin.php");
          }
        }
      }else if($_GET['act']=="uploadBrand"){
        $name = $_POST['name'];
        $connection->query("INSERT INTO brands VALUES(NULL,\"$name\")");
      }else if($_GET['act']=="uploadCat"){
        $name = $_POST['name'];
        $connection->query("INSERT INTO item_categories VALUES(NULL,\"$name\")");
      }
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin </title>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  </head>
  <body style="background-color: #E2E2E2;">
<?php
    if($page=="login"){
?>
    <section class="login-form-wrap">
      <h1>Admin</h1>
      <form class="login-form" action="?act=login" method="post">
        <label>
          <input type="text" style="width: 300px" name="login" required placeholder="Login">
        </label>
        <label>
          <input type="password" style="width: 300px" name="password" required placeholder="Password">
        </label>
        <input type="submit" value="Login">
      </form>
    </section>
<?php
    }else if($page=="edit"){
?>
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header" style="text-align: center;">Бренды<small></small></h1>
      </div>
      <form style="text-align: center;" class="form-inline" action = "?act=uploadBrand" method = "post">
          <div class="form-group" style="margin-bottom: 5%;">
              <input required type="text" class="form-control" placeholder="Название" name="name" style="margin-top: 2%"/><br>
              <input style="margin-top: 2%" type="submit" value="Загрузить" class="btn btn-success"/>
          </div>
      </form>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header" style="text-align: center;">Категории<small></small></h1>
      </div>
      <form style="text-align: center;" class="form-inline" action = "?act=uploadCat" method = "post">
          <div class="form-group" style="margin-bottom: 5%;">
              <input required type="text" class="form-control" placeholder="Название" name="name" style="margin-top: 2%"/><br>
              <input style="margin-top: 2%" type="submit" value="Загрузить" class="btn btn-success"/>
          </div>
      </form>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header" style="text-align: center;">Товары<small> Размер картины - 1900x1080</small></h1>
      </div>
      <form style="text-align: center;" class="form-inline" action = "?act=upload" method = "post" enctype = "multipart/form-data">
          <div class="form-group" style="margin-bottom: 5%;">
              <input style="background-color: #3B5999;" type="file" name="pic" value="Choose image" class="btn btn-info"/>
              <input required type="text" class="form-control" placeholder="Название" name="name" style="margin-top: 2%"/><br>
              <textarea class="form-control" style="margin-top: 2%;" placeholder="Описание" name="descr"></textarea><br>
              <input required type="text" class="form-control" placeholder="Цена" name="price" style="margin-top: 2%"/><br>
              <input required type="text" class="form-control" placeholder="Кол-во" name="count" style="margin-top: 2%"/><br>
              <select name="brand" class="form-control" style="margin-top: 2%">
                <option disabled selected>Выберите бренд</option>
                <?php
                  $query = $connection->query("SELECT * FROM brands");
                  while($row=$query->fetch_object()){
                ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                <?php
                  }
                ?>
              </select><br>
              <select name="categ" class="form-control" style="margin-top: 2%">
                <option disabled selected>Выберите категорию</option>
                <?php
                  $query = $connection->query("SELECT * FROM item_categories");
                  while($row=$query->fetch_object()){
                ?>
                  <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                <?php
                  }
                ?>
              </select><br>
              <input style="margin-top: 2%" type="submit" value="Загрузить" class="btn btn-success"/>
          </div>
      </form>
    </div>
<?php
    }
?>
    <?php
    if(isset($_GET['error'])){
      if($_GET['error']==1){
    ?>
        <div class="row" style="text-align: center; color: red;">
          <label for="urs">Wrong login or password</label>
        </div>
    <?php
      }
    }
    ?>
  <script>
    var modal = document.getElementById("modal");
    var span = document.getElementById("close");

    function show(){
      modal.style.display = "block";
    }

    span.onclick = function () {
      modal.style.display = "none";
    }

  </script>

  </body>
</html>
