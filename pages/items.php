<!-- Page Heading/Breadcrumbs -->
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
<!-- /.row -->

<?php
    $query = $connection->query("SELECT * FROM item");
    while($row = $query->fetch_object()){
        if($row->active){
            $query_img = $connection->query("SELECT * FROM photo WHERE id = $row->photo_id");
            if($row_img = $query_img->fetch_object()){
?>
<!-- Project One -->
<hr>
<div class="row">
    <div class="col-md-7">
        <a href="portfolio-item.html">
            <img class="img-responsive img-hover" src='img/<?php echo $row_img->name;?>' alt="img_item">
        </a>
    </div>
    <div class="col-md-5">
        <h3><?php echo $row->name; ?></h3>
        <h4>ID: <?php echo $row->id; ?></h4>
        <p><?php echo $row->descr; ?></p>
        <a class="btn btn-success" href="https://goo.gl/forms/Ksgkp26abEhyFlwq2" target="_blank">Заказать</i></a>
    </div>
</div>
<!-- /.row -->

<?php
            }
        }
    }
?>