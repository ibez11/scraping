<?php


require  "/home/comnimon/public_html/main/android/post_data/PHPExcel/Classes/PHPExcel.php";

include '/home/comnimon/public_html/main/android/post_data/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';

$url1 = "https://investor-api.realestate.com.au/v2/states/VIC/property_types/house/bedrooms/3.json";
$url2 = "https://investor-api.realestate.com.au/v2/states/NSW/property_types/house/bedrooms/3.json";
$url3 = "https://investor-api.realestate.com.au/v2/states/SA/property_types/house/bedrooms/3.json";
$url4 = "https://investor-api.realestate.com.au/v2/states/TAS/property_types/house/bedrooms/3.json";
$url5 = "https://investor-api.realestate.com.au/v2/states/NT/property_types/house/bedrooms/3.json";
$url6 = "https://investor-api.realestate.com.au/v2/states/ACT/property_types/house/bedrooms/3.json";
$url7 = "https://investor-api.realestate.com.au/v2/states/QLD/property_types/house/bedrooms/3.json";
$url8 = "https://investor-api.realestate.com.au/v2/states/WA/property_types/house/bedrooms/3.json";

$values1 = file_get_contents($url1);
$values2 = file_get_contents($url2);
$values3 = file_get_contents($url3);
$values4 = file_get_contents($url4);
$values5 = file_get_contents($url5);
$values6 = file_get_contents($url6);
$values7 = file_get_contents($url7);
$values8 = file_get_contents($url8);

$all_array = array_merge(json_decode($values1,true),json_decode($values2,true), json_decode($values3,true), json_decode($values4,true), json_decode($values5,true), json_decode($values6,true), json_decode($values7,true), json_decode($values8,true));
$data_array = array();
foreach($all_array as $result_value) {
	$data_array[] = array(
		'url'			=> 'https://www.realestate.com.au/neighbourhoods/'.str_replace(' ', '%20', $result_value['details']['suburb_name']).'-'.$result_value['details']['postcode'].'-'.$result_value['details']['state'],
		'suburb_name'	=> $result_value['details']['suburb_name'],
		'postcode'		=> $result_value['details']['postcode'],
		'state'			=> $result_value['details']['state']
	);
}

        $file = new PHPExcel();
	$file->getProperties()->setCreator ( "ibEz" );

        $file->getProperties()->setLastModifiedBy( "Testing Code" );
	$file->getProperties()->setTitle( "Coding Test" );
	$file->getProperties()->setSubject( "Inheritance " );
	$file->getProperties()->setDescription( "Data Inheritance" );
	$file->getProperties()->setKeywords( "Coding Test" );
	$file->getProperties()->setCategory( "Coding Test" );
	$file->setActiveSheetIndex( 0 );
$file->getActiveSheet()->setCellValue('A1', "A");
$file->getActiveSheet()->setCellValue('B1', "B");
$file->getActiveSheet()->setCellValue('C1', "C");
$file->getActiveSheet()->setCellValue('D1', "D");
	$file->getActiveSheet()->setTitle( "Coding Test" );

//print_r(count($data_array));
$nomor= 1;
foreach($data_array as $result) {

      $file->getActiveSheet()->setCellValue('A'.$nomor, $result['url'] )
->setCellValue( "B".$nomor, $result['suburb_name'] )
      ->setCellValue("C".$nomor,$result['postcode'] )
				->setCellValue ( "D".$nomor, $result['state'] );
      $nomor++;

}

//	$file->setActiveSheetIndex( 0 );



        $writer = PHPExcel_IOFactory::createWriter($file,'Excel2007');
  $writer->save(str_replace('.php', '.xlsx', __FILE__));
//$writer->save ( 'php://output' );
	$writer = PHPExcel_IOFactory::load ( 'scraping.xlsx', 'Excel2007' );
$file_url = "https://www.niagamonster.com/android/post_data/scraping.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"" . basename($file_url) . "\"");
header("Cache-Control: max-age=0");
readfile($file_url);
