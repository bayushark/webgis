<?php
$title='Rumah Sakit';
$judul=$title;
$url='Rumah-Sakit';
if ($session->get('level')!='Admin'){
    redirect(url('beranda'));
    }

if(isset($_POST['simpan'])){
    if($_POST['id_rs']==""){ 
        $data['id_kecamatan']=$_POST['id_kecamatan'];
        $data['nm_rs']=$_POST['nm_rs'];
        $data['alamat']=$_POST['alamat'];
        $data['tipe']=$_POST['tipe'];
        $data['jn_rs']=$_POST['jn_rs'];
        $data['jml_pelayanan']=$_POST['jml_pelayanan'];
        $data['email']=$_POST['email'];
        $data['no_tlp']=$_POST['no_tlp'];
        $data['lat']=$_POST['lat'];
        $data['lng']=$_POST['lng'];
        $db->insert("rs", $data);
        ?>
        <script type="text/javascript">
         window.alert('sukses disimpan');
         window.location.href="<?=url('Rumah-Sakit')?>";
         </script>
         <?php
    }
    else{
        $data['id_kecamatan']=$_POST['id_kecamatan'];
        $data['nm_rs']=$_POST['nm_rs'];
        $data['alamat']=$_POST['alamat'];
        $data['tipe']=$_POST['tipe'];
        $data['jn_rs']=$_POST['jn_rs'];
        $data['jml_pelayanan']=$_POST['jml_pelayanan'];
        $data['email']=$_POST['email'];
        $data['no_tlp']=$_POST['no_tlp'];
        $data['lat']=$_POST['lat'];
        $data['lng']=$_POST['lng'];
    $db->where('id_rs',$_POST['id_rs']);
    $db->update("rs",$data);
    ?>
    <script type="text/javascript">
     window.alert('sukses diubah');
     window.location.href="<?=url('Rumah-Sakit')?>";
     </script>
     <?php
    }

}

if(isset($_GET['hapus'])){
    $db->where("id_rs",$_GET['id']);
    $db->delete("rs");
    ?>
    <script type="text/javascript">
     window.alert('sukses dihapus ');
     window.location.href="<?=url('Rumah-Sakit')?>";
     </script>
     <?php

 }



if(isset($_GET['tambah']) OR  isset($_GET['ubah'])){
$id_rs="";
$id_kecamatan="";
$nm_rs="";
$alamat="";
$tipe="";
$jn_rs="";
$jml_pelayanan="";
$email="";
$no_tlp="";
$lat="";
$lng="";
if(isset($_GET['ubah']) AND isset($_GET['id'])){
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
        $jml_pelayanan=$row->jml_pelayanan;
        $email=$row->email;
        $no_tlp=$row->no_tlp;
        $lat=$row->lat;
        $lng=$row->lng;
    }
}
?>
<?=content_open('Form Rumah Sakit')?>
  <form method="post" enctype="multipart/form-data">
    <?=input_hidden('id_rs', $id_rs)?>
    <div class="form-group">
        <label>Nama Rumah Sakit</label>
        <div class="row">
	    		<div class="col-md-4">
        <?=input_text('nm_rs',$nm_rs)?>
    </div>
    </div>
	</div>

    <div class="form-group">
        <label>Nama Kecamatan</label>
        <div class="row">
	    		<div class="col-md-6">
        <?php
	    $op['']='Pilih Kecamatan';
	    foreach ($db->ObjectBuilder()->get('m_kecamatan') as $row) {
	    		 $op[$row->id_kecamatan]=$row->nm_kecamatan;
	    				}
	    ?>
	    <?=select('id_kecamatan',$op,$id_kecamatan)?>

    </div>
    </div>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <div class="row">
	    		<div class="col-md-3">
        <?=input_text('alamat',$alamat)?>
    </div>
    </div>
    </div>
    <div class="form-group">
        <label>Tipe</label>
        <div class="row">
	    		<div class="col-md-3">
        <?=input_text('tipe',$tipe)?>
    </div>
    </div>
    </div>
    <div class="form-group">
        <label>Jenis Rumah Sakit</label>
        <div class="row">
	    		<div class="col-md-3">
        <?=input_text('jn_rs',$jn_rs)?>
    </div>
    </div>
    </div>
    <div class="form-group">
        <label>Jumlah Pelayanan</label>
        <div class="row">
	    		<div class="col-md-3">
        <?=input_text('jml_pelayanan',$jml_pelayanan)?>
    </div>
    </div>
    </div>
    <div class="form-group">
        <label>Email</label>
        <div class="row">
	    		<div class="col-md-3">
        <?=input_text('email',$email)?>
    </div>
    </div>
    </div>
    <div class="form-group">
        <label>No Telepon</label>
        <div class="row">
	    		<div class="col-md-3">
        <?=input_text('no_tlp',$no_tlp)?>
    </div>
    </div>
    </div>
    <div class="form-group">
        <label>latitude</label>
        <div class="row">
	    		<div class="col-md-3">
        <?=input_text('lat',$lat)?>
    </div>
    </div>
    </div>
    <div class="form-group">
        <label>longitude</label>
        <div class="row">
	    		<div class="col-md-3">
        <?=input_text('lng',$lng)?>
    </div>
    </div>
    </div>
    <div class="form-group">
        <button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i>Simpan</button>
        <a href="<?=url($url)?>" class="btn btn-danger"><i class="fa fa-reply"></i>Kembali</a>
    </div>
  </form>
<?=content_close()?> 
<?php } else { ?> 

<?=content_open('Data Rumah Sakit')?>
<a href="<?=url($url.'&tambah')?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah</a>
<hr>  
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Rumah Sakit</th>
            <th>Nama Kecamatan</th>
            <th>Alamat</th>
            <th>Tipe</th>
            <th>Jenis Rumah Sakit</th>
            <th>Jumlah Pelayanan</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>latitude</th>
            <th>longitude</th>
            <th>Aksi</th>
        </tr>
</thead>
<tbody>
    <?php
    $no=1;
    $db->join('m_kecamatan b','a.id_kecamatan=b.id_kecamatan','LEFT');
			$getdata=$db->ObjectBuilder()->get('rs a');
			foreach ($getdata as $row) {
				?>

        <tr>
         <td><?=$no?></td> 
         <td><?=$row->nm_rs?></td>  
         <td><?=$row->nm_kecamatan?></td>
         <td><?=$row->alamat?></td>
         <td><?=$row->tipe?></td>
         <td><?=$row->jn_rs?></td>
         <td><?=$row->jml_pelayanan?></td> 
         <td><?=$row->email?></td>
         <td><?=$row->no_tlp?></td> 
         <td><?=$row->lat?></td>   
         <td><?=$row->lng?></td>  
         <td>
         <a href="<?=url($url.'&ubah&id='.$row->id_rs)?>" class="btn btn-info"><i class="fa fa-edit"></i>Ubah</a>
         <a href="<?=url($url.'&hapus&id='.$row->id_rs)?>" class="btn btn-danger"onclick="return confirm('Hapus data?')"><i class="fa fa-trash" ></i>hapus</a>
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