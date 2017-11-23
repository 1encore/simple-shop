<!-- Portfolio Section -->
<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Товары</h2>
    </div>
<?php
    $query = $connection->query("SELECT * FROM items");
    $count = 0;
    while($row = $query->fetch_object()){
      $query_img = $connection->query("SELECT * FROM pictures WHERE item_id = $row->id");
      if($row_img = $query_img->fetch_object()){
        $count++;
        if($count==7){
            break;
        }
?>
    <div class="col-md-4 col-sm-6">
        <a href="?page=item&id=<?php echo $row->id?>">
            <img style="width: 350px; height: 350px" class="img-responsive img-portfolio img-hover" src="img/<?php echo $row_img->url?>" alt="img_item">
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
?>
</div>
<!-- /.row -->
