<?php
$setTemplate=false;
if(isset($_POST['login'])){
$nm_pengguna=$_POST['nm_pengguna'];
$kt_sandi=$_POST['kt_sandi'];
$db->where("nm_pengguna",$nm_pengguna);
$db->where("kt_sandi",$kt_sandi);
$data=$db->ObjectBuilder()->getOne("pengguna");
if($db->count>0){
    $session->set("logged",true);
    $session->set("nm_pengguna",$data->nm_pengguna);
    $session->set("id_pengguna",$data->id_pengguna);
    $session->set("level",$data->level);  
}
else{
    $session->set("logged",false); 
}
 redirect(url("beranda"));
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Log in</title>
<?php include '_layouts/head.php'?>
<link rel="stylesheet" href="<?=templates()?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo">
<a href="#"><b>Login</b>WEBGIS</a>
</div>

<div class="card">
<div class="card-body login-card-body">
<p class="login-box-msg">Silahkan Login Untuk Masuk Aplikasi</p>
<form  method="post">
<div class="input-group mb-3">
<input type="text" class="form-control" name="nm_pengguna" placeholder="Nama Pengguna">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-user"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input type="password" class="form-control" name="kt_sandi" placeholder="Kata sandi">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-key"></span>
</div>
</div>
</div>
<div class="row">

<div class="col-12">
<button type="submit" name="login" class="btn btn-primary btn-block">Masuk</button>
<a href="<?=url('registrasi')?>" class="btn btn-warning btn-block">Registrasi</a>
</div>

</div>
</form>

</div>

</div>
</div>
<?php
include '_layouts/javascript.php';
?>
</body>
</html>

