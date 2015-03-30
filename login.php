<?php 
include_once "init.php";
unset($_SESSION["cliente"]);
?>

    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Consulta de COVES
    </a>
    <form class="form-signin" action="log.php" method="post">
    <input id="inputCliente" name="inputCliente" type="text" class="form-control" placeholder="Cliente" required autofocus>
    <input id="inputPassword" name="inputPassword" type="password" class="form-control" placeholder="Clave" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">
        Acceder</button>
    </form>
 <?php 
include_once "fin.php";
 ?>
