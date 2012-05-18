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

$query = mysql_query( "SELECT p.id AS pid, p.name AS pname, r.id AS rid FROM people p, rels_people_films r WHERE r.film_id = $film_id AND p.id = r.person_id ORDER BY pid ASC", $mysql );

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

$query = mysql_query( "SELECT * FROM rels_people_people WHERE film_id = $film_id ORDER BY person_a_id ASC", $mysql );

$relationships = array();

while( $result = mysql_fetch_array( $query ) ) {

	$relationships[] = array( 
		"source" => $ids[ $result[ 'person_a_id' ] ],
		"target" => $ids[ $result[ 'person_b_id' ] ],
		"value" => $result[ 'weight' ]
	);

}

$json = array();
$json[ 'nodes' ] = $people;
$json[ 'links' ] = $relationships;

echo json_encode( $json );

?>