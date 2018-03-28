<?php
	include_once('library/simple_html_dom.php');
	//Getting the page
	$html = file_get_html("http://www.airport-jfk.com/arrivals.php");
	
	// Now Finding the Six Required Columns
	$part1 = $html->find('div.flights_scroll_nou div[id=flight_detail_junt]');
	$part2 = $html->find('div.flights_scroll_nou div[id=flight_detail_junt2]');
	
	// Making Result
	$resultsArray = array();
	$resultCount = count($part1);
	$index = 0;
	for($i = 1 ; $i < $resultCount ; $i++){ // Skipping first index as it contains headings
		$resultsArray[$index] = array();
		$resultsArray[$index]["origin"]   = $part1[$i]->children(0)->plaintext;
		$resultsArray[$index]["airline"]  = $part1[$i]->children(1)->plaintext;
		$resultsArray[$index]["flight"]   = $part1[$i]->children(2)->plaintext;
		$resultsArray[$index]["arrival"]  = $part2[$i]->children(0)->plaintext;
		$resultsArray[$index]["terminal"] = $part2[$i]->children(2)->plaintext;
		$resultsArray[$index]["status"]   = $part2[$i]->children(4)->plaintext;
		$index = $i;
	}
	echo json_encode($resultsArray);

?>
