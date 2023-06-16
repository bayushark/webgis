<?php
$title='Menu Mencari Jarak';
$judul=$title;
$url='Menu-Mencari-Jarak';
$fileJs='Menu-Mencari-JarakJs';
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
			<button type="button" class="dariSini btn btn-info">Mulai dari Posisi Kita</button>
		</div>
        </div>

</form>

<hr>
<form>
  <div class="row">
    <?= input_hidden('halaman', $url) ?>
    <div class="col-md-3">
      <?php
        $op3 = [];
       
        if ($tipe == 'pilih tipe' & $jn_rs == 'pilih jenis rumah sakit') {
          $db->get('rs');
          $users = $db->getValue('rs', 'nm_rs', null);
        } else if ($tipe == 'pilih tipe' & $jn_rs != 'pilih jenis rumah sakit') {
          $db->where('jn_rs', '%' . $jn_rs, 'LIKE');
          $users = $db->getValue('rs', 'nm_rs', null);
        } else if ($tipe != 'pilih tipe' & $jn_rs == 'pilih jenis rumah sakit') {
          $db->where('tipe', '%' . $tipe, 'LIKE');
          $users = $db->getValue('rs', 'nm_rs', null);
        } else {
          $db->where('tipe', '%' . $tipe, 'LIKE');
          $db->where('jn_rs', '%' . $jn_rs, 'LIKE');
          $users = $db->getValue('rs', 'nm_rs', null);
        }
       
        if ($db->count > 0) {
          for ($i = 0; $i < count($users); $i++) {
            $op3[$i] = $users[$i];
          }
        }
        $db->where('nm_rs', $nm_rs);
        
        $row = $db->ObjectBuilder()->getOne('rs');
       
  
        if ($db->count > 0) {
          $op3 = [];
          $op3[0] = $row->nm_rs;
        }
       
        ?>
        <select name="nm_rs" id="namars" class="form-control"  >
          <?php
          
          for ($i = 0; $i < count($op3); $i++) {
             ?>
            <option value="<?php echo $op3[$i] ?>"><?php echo $op3[$i] ?></option>
          
          <?php
          }
          ?>
        </select>

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