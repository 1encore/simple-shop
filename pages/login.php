<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Войти
        </h1>
        <ol class="breadcrumb">
            <li><a href="?page=main">Главная</a>
            </li>
            <li class="active">Войти</li>
        </ol>
    </div>
</div>
<div class="row">
    <form method="post" action="?action=login">
      <div class="col-lg-12">
        <center>
        <div class="form-group" style="width: 500px">
          <center>
              <input type="text" class="form-control" placeholder="Логин" name="login" <?php if(isset($_GET['log'])){echo 'value='.$_GET['log'].'';} ?> required><br>
              <input type="password" class="form-control" placeholder="Пароль" name="pass" required><br>
							<?php
								if(isset($_GET['error'])){
									if($_GET['error']==1){
							?>
							<p style="color: red">Неверный логин или пароль!</p>
							<?php
									}
								}
							?>
          </center>
        </div>
      </center>
    </div>
    <center>
      <div class="col-lg-6">
        <button type="submit" style="float: right; width: 42%;" class="btn btn-success">войти</button>
      </div>
      <div class="col-lg-6">
        <a href="?page=reg" style="float: left; width: 42%;" class="btn btn-primary">зарегестрироваться</a>
      </div>
    </center>
  </form>
</div>
