<?php
$title='test 1';
$judul=$title;
$url='test-1';
$fileJs='test-1Js';
$tipe=(isset($_GET['tipe']))?$_GET['tipe']:'pilih tipe';
$jn_rs=(isset($_GET['jn_rs']))?$_GET['jn_rs']:'pilih jenis rumah sakit';
$nm_rs = (isset($_GET['nm_rs'])) ? $_GET['nm_rs'] : 'pilih rumah sakit';


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
<form>
<div class="row">
			<?=input_hidden('halaman',$url)?>

        <div class="col-md-4">
			<?=input_text('latNow','')?>
		</div>
		<div class="col-md-4">
			<?=input_text('lngNow','')?>
		</div>
		<div class="col-md-4">
			<button type="button" class="dariSini btn btn-info"><i class="fa fa-map-marker"></i> Mulai dari Posisi Kita</button>
		</div>
        </div>

</form>
<hr>
<form>
  <div class="row">
    <?= input_hidden('halaman', $url) ?>
    <div class="col-md-3">
      <?php
      $op3 = null;
      $op3['pilih rumah sakit'] = 'pilih rumah sakit';
      $db->where('tipe', '%' . $tipe, 'LIKE');
      $db->where('jn_rs', '%' . $jn_rs, 'LIKE');
      $users = $db->getValue('rs', 'nm_rs', null);
      if ($db->count > 0) {
        foreach ($users as $user) {
          // echo "$value <br>";
          $op3[$user] = $user;
        }
      }
      $db->where('nm_rs', $nm_rs);
      $row = $db->ObjectBuilder()->getOne('rs');
      if ($db->count > 0) {
        $tipe = $row->tipe;
        $jn_rs = $row->jn_rs;
        $nm_rs = $row->nm_rs;
        $op3[$row->nm_rs] = $row->nm_rs;
      }
      ?>
      <?= select('nm_rs', $op3, $nm_rs) ?>
    </div>
    <div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-info">Cari</button>
      </div>
    </div>
    <?php
    if ($nm_rs != 'pilih rumah sakit') { ?>
      <div class="col-md-2">
        <button type="button" class='btn btn-info' onclick='return keSini(<?= $row->lat ?>,<?= $row->lng ?>)'>Mulai</button>
      </div>
    <?php
    }
    ?>
    <div class="col-md-2">
      <input type="text" class="form-control" name="jarak" id="">
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control" name="waktu" id="">
    </div>
  </div>
</form>
<hr>
<div id="mapid"></div>
<?=content_close()?>   