<?php
$title='Menu Informasi Detail';
$judul=$title;
$url='Menu-Informasi-Detail';

    


?>

<?=content_open('Data Rumah Sakit')?>

<hr> 

<div class="container">
<div class="row" id="load_data">
<?php
$id_rs="";
$id_kecamatan="";
$nm_rs="";
$alamat="";
$tipe="";
$jn_rs="";
$pelayanan="";
if( isset($_GET['id'])){
    $id=$_GET['id'];
    $db->where('id_rs',$id);
    $row=$db->ObjectBuilder()->getOne('rs');
    if($db->count>0){
        $id_rs=$row->id_rs;
        $id_kecamatan=$row->id_kecamatan;
        $nm_rs=$row->nm_rs;
        $alamat=$row->alamat;
        $tipe=$row->tipe;
        $jn_rs=$row->jn_rs;
        $pelayanan=$row->pelayanan;
    }
} 
?>
<?php


    $db->join('m_kecamatan b','a.id_kecamatan=b.id_kecamatan','LEFT');
    $getdata=$db->ObjectBuilder()->get('rs a');
    foreach ($getdata as $row) {
       
    
        ?> 
<div class="col-sm-3 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?=$row->nm_rs; ?></h5>
              <p class="card-text"><?=$row-> alamat; ?></p>
              <p class="card-text"><?=$row->tipe; ?></p>
              <p class="card-text"><?=$row-> jn_rs; ?></p>
              <p class="card-text"><?=$row-> pelayanan; ?></p>
            </div>  
            </div>    
        
                 
   </div>
   <?php   
    }
    ?>
<?=content_close()?>
