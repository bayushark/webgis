<?php
$title='Menu Informasi';
$judul=$title;
$url='Menu-Informasi';
$fileJs='Menu-InformasiJs';

$tipe=(isset($_GET['tipe']))?$_GET['tipe']:'pilih tipe';
$jn_rs=(isset($_GET['jn_rs']))?$_GET['jn_rs']:'pilih jenis rumah sakit';
?>
<?=content_open($title)?>

<form>
<div class="row">
			<?=input_hidden('halaman',$url)?>

    <div class="col-md-3">
        <?php
        $op=null;
        $op['pilih tipe']='Pilih tipe';
        for ($i='A'; $i <='D';$i++ ){
            $op[$i]=$i;
        }
        $db->where('tipe',$tipe);
        $row=$db->ObjectBuilder()->getOne('rs');
        if($db->count>0){
            $tipe=$row->tipe;  
          
            $op[$row->tipe]=$row->tipe;}
        ?>
           <?=select('tipe',$op,$tipe)?>
         </div>
         <div class="col-md-3">
        <?php
        $op2=null;
        $op2['pilih jenis rumah sakit']='pilih jenis rumah sakit';
        $colors = array("RSU", "RSIA", "RSK");
        foreach ($colors as $value) {
            // echo "$value <br>";
            $op2[$value]=$value;
          }
        $db->where('jn_rs',$jn_rs);
        $row=$db->ObjectBuilder()->getOne('rs');
        if($db->count>0){
            $jn_rs=$row->jn_rs;  
          
            $op2[$row->jn_rs]=$row->jn_rs;}
        ?>
           <?=select('jn_rs',$op2,$jn_rs)?>
         </div>
        <div class="col-md-3">
				<button type="submit" class="btn btn-info">Tampilkan</button>
			</div>
		</div>

</form>
<hr>
<div id="mapid"></div>
<?=content_close()?>        