<?php
error_reporting(0);
$jinput = JFactory::getApplication()->input;
$db = JFactory::getDbo();
$query = $db->getQuery(true);

$foo = $jinput->get('id', '0', 'INT');
$string = $jinput->get('string', ' ', 'STRING');
$task = $jinput->get('task', 'propiedad', 'STRING');
$output = $jinput->get('out', 'csv', 'STRING');

switch ($task) {
   
  case 'preciosugerido':
    // echo $foo;
    $db->setQuery("select costo from #__servin_hechuras where id=".$foo);
    $costo=$db->loadResult();
    echo $costo;
  break;
  case 'consultotal':
    // echo $foo;
    $db->setQuery("select precio from #__servin_piezas where id in (".$string.")");
    $result=$db->loadColumn();
    echo round(array_sum($result),2);
  break;
  case 'nuevapieza':
    // echo $foo;
    $db->setQuery("sELECT p.id , concat(h.numero,'|' ,p.descripcion) as descripcion FROM #__servin_piezas as p inner join #__servin_hechuras as h on h.id = p.hechura where p.id > ".$foo);
    $result=$db->loadAssocList('id','descripcion');
    echo json_encode($result); 
  break;
}
function toexcel($array,$file){
  $sufix = date(Ymd);
  header('Content-type: application/x-msdownload; charset=utf-16');
  header('Content-Disposition: attachment; filename='.$file."_" . $sufix . '.xls');
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false); 

  foreach ($array as $data)
  {
    $str = implode("\t",$data);
    $str = str_replace(array("\r\n", "\r", "\n"), "", $str); 
    if (mb_detect_encoding($str ) == 'UTF-8') {
       $str = mb_convert_encoding($str ,  'UTF-16LE', 'UTF-8');
    }
    echo $str . "\r\n";
  }
}
function tocsv(array &$array, $filename){
    $now = gmdate("D, d M Y H:i:s");
    $sufix = date(Ymd);
    header('Content-Encoding: Windows-1252');
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");
    header("Content-Type: application/x-msdownload; charset=Windows-1252");
    header("Content-Disposition: attachment;filename={$filename}_{$sufix}.csv");
    header("Content-Transfer-Encoding: binary");
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');
   //echo "\xEF\xBB\xBF";
   foreach ($array as $row) {
      array_walk($row, 'csv_encode_conv', 'Windows-1252');
      fputcsv($df, $row);
   }
   fclose($df);
   echo ob_get_clean();
}
function csv_encode_conv(&$var, $key, $enc='Windows-1252') {
    $var = htmlentities($var, ENT_QUOTES, 'utf-8');
    $var = html_entity_decode($var, ENT_QUOTES , $enc);
    return $var;
}
?>