<?php
	$numberToMonth  = array(1=> "Jan", 2=>"Feb",  3=>"Mar" ,4=>"Apr", 5=>"May" , 6=> "Jun", 7=>"Jul" ,8 => "Aug" , 9=>"Sep" , 10 => "Oct", 11=>"Nov" , 12 =>"Dec");
function handleTime($time){
	$year = substr($time,0, 4);
	$month = substr($time,4, 2);
	$day = substr($time,6, 2);
	$hourmin = substr($time, 9, 5);
	return array("year"=> $year,
		"month" => $month,
		"day" => $day,
		"hourmin" => $hourmin);
}

?>