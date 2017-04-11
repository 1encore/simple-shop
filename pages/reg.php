<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Регистрация
        </h1>
        <ol class="breadcrumb">
            <li><a href="?page=main">Главная</a>
            </li>
            <li class="active">Регистрация</li>
        </ol>
    </div>
</div>
<div class="row">
    <form method="post" action="?action=reg">
      <div class="col-lg-12">
        <center>
        <div class="form-group" style="width: 500px">
          <center>
              <input type="text" class="form-control" placeholder="Логин" name="login" <?php if(isset($_GET['log'])){echo 'value='.$_GET['log'].'';} ?> required><br>
              <input type="password" class="form-control" placeholder="Пароль" name="pass" required><br>
							<input type="password" class="form-control" placeholder="Повторите пароль" name="pass_check" required><br>
              <input type="text" class="form-control" placeholder="Имя" name="name" <?php if(isset($_GET['name'])){echo 'value='.$_GET['name'].'';} ?> required><br>
              <input type="text" class="form-control" placeholder="Фамилия" name="sur" <?php if(isset($_GET['sur'])){echo 'value='.$_GET['sur'].'';} ?> required><br>
							<button type="submit" style="width: 42%;" class="btn btn-success">Готово</button>
							<?php
								if(isset($_GET['error'])){
									if($_GET['error']==1){
							?>
							<p style="color: red">Пароли не совпадают!</p>
							<?php
									}
								}
							?>
          </center>
        </div>
      </center>
    </div>
  </form>
</div>
