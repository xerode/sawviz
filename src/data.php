<?php

include_once 'mysql.php';

//

$film_id = 1;

if( isset( $_GET[ 'film_id' ] ) && is_int( $_GET[ 'film_id' ] ) ) {
	$film_id = $_GET[ 'film_id' ];
} else {
	$film_id = 1;
}

header('Content-type: application/json');

$people = array();

$query = mysql_query( "SELECT p.id AS pid, p.name AS pname, r.id AS rid FROM people p, rels_people_films r WHERE r.film_id = $film_id AND p.id = r.person_id ORDER BY p.name ASC", $mysql );

$id = 0;
$ids = array();

while( $result = mysql_fetch_array( $query ) ) {

	$ids[ $result[ 'pid' ] ] = $id;

	$people[] = array( 
		"name" => htmlentities( stripslashes( $result[ 'pname' ] ) ),
		"pid" => $result[ 'pid' ],
		"color" => "#cc3333"
	);

	$id += 1;

}

$relationships = array();

$json = array();
$json[ 'nodes' ] = $people;
$json[ 'links' ] = $relationships;

echo json_encode( $json );

?>