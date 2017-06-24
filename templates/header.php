<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?page=main">myStore</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="?page=search">Товары</a>
                </li>
                <li>
                    <a href="?page=payment">Корзина</a>
                </li>
                    <?php
                    if(isset($_SESSION['online'])&&isset($_SESSION['id'])){
                      if($_SESSION['online']){
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php
                              $id_check = $_SESSION['id'];
                              $query_log = $connection->query("SELECT * FROM users WHERE id  = $id_check");
                              if($row_log = $query_log->fetch_object()){
                                echo $row_log->login;
                              }
                            ?>
                          <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="?action=logout">Выйти</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                      }else{
                    ?>
                    <li><a href="?page=login">Войти</a></li>
                    <?php
                      }
                    }else{
                    ?>
                    <li><a href="?page=login">Войти</a></li>
                    <?php
                    }
                    ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
