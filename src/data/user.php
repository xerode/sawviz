<?php

include_once '../mysql.php';

$json = array();

if( isset( $_GET[ 'id' ] ) ) { // && is_int( $_GET[ 'film_id' ] )
	$user_id = $_GET[ 'id' ];

	$query = mysql_query( "SELECT f.name AS film_name FROM rels_people_films rpf, films f WHERE rpf.person_id = $user_id AND f.id = rpf.film_id ORDER BY rpf.id ASC", $mysql );

	$films = array();

	$json[ 'numfilms' ] = mysql_num_rows( $query );

	while( $results = mysql_fetch_array( $query ) ) {

		$films[] = stripslashes( $results[ 'film_name'] );

	}

	$json[ 'films' ] = $films;

} else {
	echo 'dicks';
}

header('Content-type: application/json');

echo json_encode( $json );

?>