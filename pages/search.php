<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Товары
        </h1>
        <ol class="breadcrumb">
            <li><a href="?page=main">Главная</a>
            </li>
            <li class="active">Товары</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <center>
        <div class="form-group">
          <center>
            <form action="?page=search&act=search" method="post">
              <input name="name" type="text" class="form-control" placeholder="Название товара (Air Jordan, Mercurial и. т. д.)"><br>
              <select name="brand" class="form-control">
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
              <select name="categ" class="form-control">
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
              <input value="найти" type="submit" class="btn btn-primary">
          </form>
        </center>
        </div>
      </center>
      <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-6" style="margin-left: 25%;">
<?php
    if(isset($_GET['act'])){
      $name = $_POST['name'];
      if(isset($_POST['brand'])){
        $brand = $_POST['brand'];
      }else{
        $brand = "-";
      }
      if(isset($_POST['categ'])){
        $cat = $_POST['categ'];
      }else{
        $cat = "-";
      }
      if($name!="" && $brand!="-" && $cat!="-"){
        $query = $connection->query("SELECT * FROM items WHERE name LIKE('%$name%') OR brand_id = $brand OR category_id = $cat");
      }else if($name!="" && $brand!="-" && $cat=="-"){
        $query = $connection->query("SELECT * FROM items WHERE name LIKE('%$name%') OR brand_id = $brand");
      }else if($name!="" && $brand=="-" && $cat !="-"){
        $query = $connection->query("SELECT * FROM items WHERE name LIKE('%$name%') OR category_id = $cat");
      }else if($name!="" && $brand=="-" && $cat=="-"){
        $query = $connection->query("SELECT * FROM items WHERE name LIKE('%$name%')");
      }else if($name=="" && $brand!="-" && $cat!="-"){
        $query = $connection->query("SELECT * FROM items WHERE brand_id = $brand OR category_id = $cat");
      }else if($name=="" && $brand!="-" && $cat=="-"){
        $query = $connection->query("SELECT * FROM items WHERE brand_id = $brand");
      }else if($name=="" && $brand=="-" && $cat !="-"){
        $query = $connection->query("SELECT * FROM items WHERE category_id = $cat");
      }else if($name=="" && $brand=="-" && $cat=="-"){
        $query = $connection->query("SELECT * FROM items");
      }
      while($row = $query->fetch_object()){
        $query_img = $connection->query("SELECT * FROM pictures WHERE item_id = $row->id");
        if($row_img = $query_img->fetch_object()){
?>
      <div class="col-md-4 col-sm-6">
          <a href="?page=item&id=<?php echo $row->id?>">
              <img class="img-responsive img-portfolio img-hover img-thumbnail" src="img/<?php echo $row_img->url?>" alt="img_item">
              <center><?php echo $row->name?></center>
          </a>
      </div>
<?php
        }
      }
    }else{
      $query = $connection->query("SELECT * FROM items");
      $count = 0;
      while($row = $query->fetch_object()){
        $query_img = $connection->query("SELECT * FROM pictures WHERE item_id = $row->id");
        if($row_img = $query_img->fetch_object()){
          $count++;
  ?>
      <div class="col-md-4 col-sm-6">
          <a href="?page=item&id=<?php echo $row->id?>">
              <img class="img-responsive img-hover img-thumbnail" src="img/<?php echo $row_img->url?>" alt="img_item">
          </a>
      </div>
  <?php
        }
      }
      if($count==0){
  ?>
        <h3 style="color: gray">Пока нет товаров.</h3>
  <?php
      }
    }
?>
    </div>
</div>
