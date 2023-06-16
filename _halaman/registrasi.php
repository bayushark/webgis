<?php
$setTemplate=false;
if (isset($_POST['registrasi'])) {
$nm_pengguna=$_POST['nm_pengguna'];
$kt_sandi=$_POST['kt_sandi'];
$db->where("nm_pengguna",$nm_pengguna);
$db->where("kt_sandi",$kt_sandi);
$data=$db->ObjectBuilder()->getOne("pengguna");
    if($db->count>0){
        ?>
        <script type="text/javascript">
         window.alert('gagal disimpan');
         window.location.href="<?=url('registrasi')?>";
         </script>
         <?php
    }else {
        $data['nm_pengguna']=$_POST['nm_pengguna'];
        $data['kt_sandi']=$_POST['kt_sandi'];
        $data['level']=$_POST['level'];
        $db->insert("pengguna", $data); 
        ?>
        <script type="text/javascript">
         window.alert('berhasil disimpan');
         window.location.href="<?=url('registrasi')?>";
         </script>
         <?php  
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Registrasi</title>
<?php include '_layouts/head.php'?>
<link rel="stylesheet" href="<?=templates()?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-logo">
<a href="#"><b>Registrasi</b>WEBGIS</a>
</div>

<div class="card">
<div class="card-body login-card-body">
<p class="login-box-msg">Silahkan Registrasi Untuk Daftar Aplikasi</p>
<form  method="post">
<input type="hidden" name="level" value="User" >
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
<button type="submit" name="registrasi" class="btn btn-primary btn-block">Registrasi</button>
<a href="<?=url('login')?>" class="btn btn-warning btn-block">Login</a>

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