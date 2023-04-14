<?php

/**
 * Read CSV file to array
 *
 * @param string $csvFile
 * @return array|false
 */
function csvToArray($csvFile)
{
	$file_to_read = fopen($csvFile, 'r');

	while (!feof($file_to_read)) {
		$lines[] = fgetcsv($file_to_read, 1000, ',');
	}

	fclose($file_to_read);
	array_pop($lines);
	return $lines;
}

function import_csv($csvFile)
{
	// 0 => string 'Dirección'
	// 1 => string 'Tiltes buenos'

	$csvFile = __DIR__  . '/data/nueva_titles.csv';

	//read the csv file into an array
	$csv = csvToArray($csvFile);
	// //render the array with print_r
	// echo '<pre>';
	// print_r($csv);
	// echo '</pre>';
	// die();

	$count = 0;
	foreach ($csv as $item) {

		$count++;
		if ($count == 1) continue;
		
		$id = url_to_postid($item[0]);
		update_post_meta($id, 'rank_math_title', $item[1]);

	}
}

add_action( 'init', 'import_csv');
