<?php
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
		'url'			=> 'https://www.realestate.com.au/neighbourhoods/'.$result_value['details']['suburb_name'].'-'.$result_value['details']['postcode'].'-'.$result_value['details']['state'],
		'suburb_name'	=> $result_value['details']['suburb_name'],
		'postcode'		=> $result_value['details']['postcode'],
		'state'			=> $result_value['details']['state']
	);
}
?>
<table border="1">
	<tr>
		<td>A</td>
		<td>B</td>
		<td>C</td>
		<td>D</td>
	</tr>
<?php
print_r(count($data_array));
foreach($data_array as $result) {
	?>
	<tr>
		<td><?php echo $result['url']; ?></td>
		<td><?php echo $result['suburb_name']; ?></td>
		<td><?php echo $result['postcode']; ?></td>
		<td><?php echo $result['state']; ?></td>
	</tr>
<?php 
}
?>
</table>

