<?php
include "templates/db.php";
$data = array(); // в этот массив запишем то, что выберем из базы
if(isset($_GET['q'])){
  $key = $_GET['q'];
  $ta = $connection->query("SELECT * FROM items i, pictures p WHERE i.id = p.item_id AND name LIKE('%$key%')"); // сделаем запрос в БД
  while($row = $ta->fetch_object()){ // оформим каждую строку результата
                                        // как ассоциативный массив
      $data[] = $row; // допишем строку из выборки как новый элемент результирующего массива
  }
  echo '{ "items": '.json_encode($data).'}'; // и отдаём как json
}else{
  $ta = $connection->query("SELECT * FROM items i, pictures p WHERE i.id = p.item_id"); // сделаем запрос в БД
  while($row = $ta->fetch_object()){ // оформим каждую строку результата
                                        // как ассоциативный массив
      $data[] = $row; // допишем строку из выборки как новый элемент результирующего массива
  }
  echo '{ "items": '.json_encode($data).'}'; // и отдаём как json
}
?>
