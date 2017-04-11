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
			if(count($_SESSION['box'])!=0){
?>
	<div class="col-lg-12">
<?php
	    $query = $connection->query("SELECT * FROM items");
	    $count = 0;
      $count_box = count($_SESSION['box']);
	    while($row = $query->fetch_object()){
        if($count_box!=0){
  				$item_box = $_SESSION['box'][$count];
  	      $query_img = $connection->query("SELECT * FROM pictures WHERE item_id = $item_box");
  	      if($row_img = $query_img->fetch_object()){
  					$count++;
            $count_box--;
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
			}else {
?>
				<div class="col-lg-12"><h3 style="color: gray">Пока нет товаров.</h3></div>
<?php
			}
		}else{
?>
      <div class="col-lg-12"><h3 style="color: gray">Пока нет товаров.</h3></div>
<?php
    }
?>
</div>
