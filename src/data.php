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

// $query = mysql_query( "SELECT p.id AS pid, p.name AS pname, r.id AS rid FROM people p, rels_people_films r WHERE r.film_id = $film_id AND p.id = r.person_id ORDER BY pid ASC", $mysql );

$query = mysql_query( "SELECT p.id AS pid, p.name AS pname, COUNT( p.name ) AS numconnections FROM people p, rels_people_films r INNER JOIN rels_people_people rp WHERE r.film_id = $film_id AND p.id = r.person_id AND ( rp.person_a_id = p.id OR rp.person_b_id = p.id ) GROUP BY p.name", $mysql );

$id = 0;
$ids = array();

while( $result = mysql_fetch_array( $query ) ) {

	$ids[ $result[ 'pid' ] ] = $id;

	$people[] = array( 
		"name" => htmlentities( stripslashes( $result[ 'pname' ] ) ),
		"pid" => $result[ 'pid' ],
		"color" => "#cc3333",
		"numconnections" => $result[ 'numconnections' ]
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