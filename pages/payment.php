<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Оплата</h1>
		</div>
</div>
<?php
	if(count($_SESSION['box'])!=0){
?>
 <table class="table table-striped">
    <thead>
      <tr>
        <th>Название</th>
        <th>Цена</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php
      $count = 0;
      $sum = 0;
      $item_box = $_SESSION['box'][$count];
	    $query = $connection->query("SELECT * FROM items WHERE id = $item_box");
	    while($row = $query->fetch_object()){
?>
      <tr>
        <td><?php echo $row->name?></td>
        <td><?php echo $row->price?></td>
        <td><a href="?action=delBox&id=<?php echo $count?>" class="btn btn-danger">удалить</a></td>
      </tr>
<?php
					$count++;
					$sum+=$row->price;
	    }
?>
			<tr>
				<td>Общая сумма:</td>
				<td></td>
				<td><?php echo $sum;?>KZT</td>
			</tr>
    </tbody>
  </table>
<center>
	<a href="?action=purchase" class="btn btn-success">Купить</a>
</center>
<?php
}else{
?>
<div class="col-lg-12"><h3 style="color: gray">Пока нет товаров.</h3></div>
<?php
}
?>
