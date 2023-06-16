<?php
$title='Kecamatan';
$judul=$title;
$url='kecamatan';
if ($session->get('level')!='Admin'){
redirect(url('beranda'));
}


if(isset($_POST['simpan'])){
    $file=upload('geojson_kecamatan','geojson');
    if($file!=false){
        $data['geojson_kecamatan']=$file;
    }
    if($_POST['id_kecamatan']==""){ 
        
        $data['kd_kecamatan']=$_POST['kd_kecamatan'];
        $data['nm_kecamatan']=$_POST['nm_kecamatan'];
        $db->insert("m_kecamatan", $data);
        ?>
        <script type="text/javascript">
         window.alert('sukses disimpan');
         window.location.href="<?=url('kecamatan')?>";
         </script>
         <?php
    }
    else{
    $data['kd_kecamatan']=$_POST['kd_kecamatan'];
    $data['nm_kecamatan']=$_POST['nm_kecamatan'];
    $db->where('id_kecamatan',$_POST['id_kecamatan']);
    $db->update("m_kecamatan",$data);
    ?>
    <script type="text/javascript">
     window.alert('sukses diubah');
     window.location.href="<?=url('kecamatan')?>";
     </script>
     <?php
    }
}


if(isset($_GET['hapus'])){
    $db->where("id_kecamatan",$_GET['id']);
    $db->delete("m_kecamatan");
    ?>
    <script type="text/javascript">
     window.alert('sukses dihapus');
     window.location.href="<?=url('kecamatan')?>";
     </script>
     <?php

}

   

if(isset($_GET['tambah']) OR  isset($_GET['ubah'])){
$id_kecamatan="";
$kd_kecamatan="";
$nm_kecamatan="";
$geojson_kecamatan="";
$warna_kecamatan="";
if(isset($_GET['ubah']) AND isset($_GET['id'])){
    $id=$_GET['id'];
    $db->where('id_kecamatan',$id);
    $row=$db->ObjectBuilder()->getOne('m_kecamatan');
    if($db->count>0){
        $id_kecamatan=$row->id_kecamatan;
        $kd_kecamatan=$row->kd_kecamatan;
        $nm_kecamatan=$row->nm_kecamatan;
        $geojson_kecamatan=$row->geojson_kecamatan;
        $warna_kecamatan=$row->warna_kecamatan;
    }
}
?>
<?=content_open('Form Kecamatan')?>
  <form method="post" enctype="multipart/form-data">
    <?=input_hidden('id_kecamatan', $id_kecamatan)?>
    <div class="form-group">
        <label>Kode Kecamatan</label>
        <?=input_text('kd_kecamatan',$kd_kecamatan)?>
    </div>
    <div class="form-group">
        <label>Nama Kecamatan</label>
        <?=input_text('nm_kecamatan',$nm_kecamatan)?>
    </div>
    <div class="form-group">
        <label>GeoJSON</label>
        <?=input_file('geojson_kecamatan',$geojson_kecamatan)?>
    </div>
    <div class="form-group">
        <label>Warna Kecamatan</label>
        <?=input_text('warna_kecamatan',$warna_kecamatan)?>
    </div>
    <div class="form-group">
        <button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i>Simpan</button>
        <a href="<?=url($url)?>" class="btn btn-danger"><i class="fa fa-reply"></i>Kembali</a>
    </div>
  </form>
<?=content_close()?> 
<?php } else { ?> 

<?=content_open('Data Kecamatan')?>
<a href="<?=url($url.'&tambah')?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah</a>
<hr>  
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Kecamatan</th>
            <th>GeoJSON</th>
            <th>Warna Kecamatan</th>
            <th>Aksi</th>
        </tr>
</thead>
<tbody>
    <?php
    $no=1;
    $getdata=$db->ObjectBuilder()->get('m_kecamatan');
    foreach ($getdata as $row){
        ?>
        <tr>
         <td><?=$no?></td> 
         <td><?=$row->kd_kecamatan?></td>  
         <td><?=$row->nm_kecamatan?></td>
         <td><?=$row->geojson_kecamatan?></td> 
         <td><?=$row->warna_kecamatan?></td>   
         <td>
         <a href="<?=url($url.'&ubah&id='.$row->id_kecamatan)?>" class="btn btn-info"><i class="fa fa-edit"></i>Ubah</a>
         <a href="<?=url($url.'&hapus&id='.$row->id_kecamatan)?>" class="btn btn-danger"onclick="return confirm('Hapus data?')"><i class="fa fa-trash" ></i>hapus</a>
         </td>    
    </tr>
    <?php
    $no++;
    }
    ?>
</tbody>
</table> 
<?=content_close()?>
<?php } ?>  