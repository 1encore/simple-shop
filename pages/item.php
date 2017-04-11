<?php
    $id = $_GET['id'];
    $query = $connection->query("SELECT * FROM items WHERE id = $id");
    if($row = $query->fetch_object()){
        $query_img = $connection->query("SELECT * FROM pictures WHERE item_id = $row->id");
        if($row_img = $query_img->fetch_object()){
?>
<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $row->name?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="?page=main">Главная</a></li>
            <li><a href="?page=search">Товары</a></li>
            <li class="active"><?php echo $row->name; ?></li>
        </ol>
    </div>
</div>
<!-- /.row -->

<!-- Portfolio Item Row -->
<div class="row">

    <div class="col-md-8">
        <img class="img-responsive img-portfolio img-hover" src="img/<?php echo $row_img->url?>" alt="img_item">
    </div>

    <div class="col-md-4">
        <h3><?php echo $row->name?></h3>
        <p><?php echo $row->descr?></p>
        <p>Кол-во: <?php echo $row->amounts?></p>
        <h3>Цена: <?php echo $row->price?> KZT</h3>
        <a href="?action=add&id=<?php echo $row->id?>" class="btn btn-success">Добавить в корзину</a>
    </div>

</div>
<!-- /.row -->

<!-- Related Projects Row -->
<div class="row">

    <div class="col-lg-12">
        <h3 class="page-header">Рекомендации</h3>
    </div>
<?php
  $sum = 0;
  $query_rec = $connection->query("SELECT * FROM items WHERE category_id = $row->category_id AND id!=$row->id");
  while($row_rec = $query_rec->fetch_object()){
    $query_rec_img = $connection->query("SELECT * FROM pictures WHERE item_id = $row_rec->id");
    if($row_rec_img = $query_rec_img->fetch_object()){
?>
    <div class="col-sm-3 col-xs-6">
        <a href="?page=item&id=<?php echo $row_rec->id?>">
            <img class="img-responsive img-hover img-related" src="img/<?php echo $row_rec_img->url ?>" alt="">
        </a>
    </div>
<?php
            $sum++;
          }
        }
        if($sum==0){
          echo '<center><p>Похожих товаров не найдено.</p></center>';
        }
?>
</div>
<!-- /.row -->
<?php
      }
    }
?>
