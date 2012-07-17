<?php

include_once '../mysql.php';

//

if( isset( $_GET[ 'id' ] ) ) { // && is_int( $_GET[ 'film_id' ] )
	$film_id = $_GET[ 'id' ];
} else {
	$film_id = 0;
}

header('Content-type: application/json');

$people = array();

// $query = mysql_query( "SELECT p.id AS pid, p.name AS pname, r.id AS rid FROM people p, rels_people_films r WHERE r.film_id = $film_id AND p.id = r.person_id ORDER BY pid ASC", $mysql );

if( $film_id == 0 ) {
	$query = mysql_query( "SELECT p.id AS pid, p.name AS pname, COUNT( p.name ) AS numconnections, pr.colour AS colour, pr.id AS rid FROM people p, rels_people_films r, roles pr INNER JOIN rels_people_people rp WHERE r.film_id > 0 AND rp.film_id = r.film_id AND p.id = r.person_id AND ( rp.person_a_id = p.id OR rp.person_b_id = p.id ) AND pr.id = p.role_id GROUP BY p.name ORDER BY numconnections DESC", $mysql );
} else {
	$query = mysql_query( "SELECT p.id AS pid, p.name AS pname, COUNT( p.name ) AS numconnections, pr.colour AS colour, pr.id AS rid FROM people p, rels_people_films r, roles pr INNER JOIN rels_people_people rp WHERE r.film_id = $film_id AND rp.film_id = r.film_id AND p.id = r.person_id AND ( rp.person_a_id = p.id OR rp.person_b_id = p.id ) AND pr.id = p.role_id GROUP BY p.name ORDER BY numconnections DESC", $mysql );
}

$id = 0;
$ids = array();

while( $result = mysql_fetch_array( $query ) ) {

	$ids[ $result[ 'pid' ] ] = $id;

	$people[] = array( 
		"name" => htmlentities( stripslashes( $result[ 'pname' ] ) ),
		"pid" => $id,
		"rid" => $result[ 'rid' ],
		"color" => $result[ 'colour' ],
		"numconnections" => $result[ 'numconnections' ]
	);

	// "pid" => result[ 'pid' ]

	$id += 1;

}

$relationships = array();

if( $film_id == 0 ) {
	$query = mysql_query( "SELECT *, SUM( weight ) AS sumweight, COUNT( weight ) AS countweight FROM rels_people_people WHERE film_id > 0 GROUP BY person_a_id, person_b_id", $mysql );
} else {
	$query = mysql_query( "SELECT *, SUM( weight ) AS sumweight, COUNT( weight ) AS countweight FROM rels_people_people WHERE film_id = $film_id GROUP BY person_a_id, person_b_id", $mysql );
}

$relationships = array();

while( $result = mysql_fetch_array( $query ) ) {

	$relationships[] = array( 
		"source" => $ids[ $result[ 'person_a_id' ] ],
		"target" => $ids[ $result[ 'person_b_id' ] ],
		"value" => $result[ 'sumweight' ],
		"thickness" => $result[ 'countweight' ]
	);

}

$json = array();
$json[ 'nodes' ] = $people;
$json[ 'links' ] = $relationships;

echo json_encode( $json );

?>