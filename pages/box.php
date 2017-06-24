<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Корзина
        </h1>
        <ol class="breadcrumb">
            <li><a href="?page=main">Главная</a>
            </li>
            <li class="active">Корзина</li>
        </ol>
    </div>
</div>
<div class="row">
<?php
		if(isset($_SESSION['box'])){
?>
	<div class="col-lg-12">
<?php
      $item_box = $_SESSION['box'];
      for($i = 0; $i<count($item_box); $i++){
        $query = $connection->query("SELECT * FROM items WHERE id = $item_box[$i]");
        if($row = $query->fetch_object()){
  	      $query_img = $connection->query("SELECT * FROM pictures WHERE item_id = $item_box[$i]");
  	      if($row_img = $query_img->fetch_object()){
  ?>
  	    <div class="col-md-4 col-sm-6">
  	        <a href="?page=item&id=<?php echo $row_img->item_id?>">
  	            <img class="img-responsive img-portfolio img-hover" src="img/<?php echo $row_img->url?>" alt="img_item">
  	        </a>
  	    </div>
  <?php
  	      }
        }
	    }
?>
	</div>
		<center>
			<a href="?page=payment" class="btn btn-success">Перейти к оплате</a>
		</center>
<?php
			}
?>
</div>
