<?php

include_once '../mysql.php';

if( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'add' ) {

	if( $_POST[ 'selectPersonA' ] != $_POST[ 'selectPersonB' ] && $_POST[ 'selectPersonA' ] != "-" && $_POST[ 'selectPersonB' ] != "-" && $_POST[ 'film' ] != "-"  ) {

		/*
		$query = mysql_query( "SELECT * FROM rels_people_people WHERE ( person_a_id = ".$_POST[ 'selectPersonA' ]." AND person_b_id = ".$_POST[ 'selectPersonB' ]." ) OR ( person_a_id = ".$_POST[ 'selectPersonB' ]." AND person_b_id = ".$_POST[ 'selectPersonA' ]." )", $mysql );

		if( mysql_num_rows( $query ) > 0 ) {
			$msg = "Already added to database";
		} else {

			$query = mysql_query( "INSERT INTO relationships ( person_a_id, person_b_id ) VALUES( ".$_POST[ 'selectPersonA' ].", ".$_POST[ 'selectPersonB' ]." )");

			$query = mysql_query( "INSERT INTO relationships ( person_a_id, person_b_id ) VALUES( ".$_POST[ 'selectPersonB' ].", ".$_POST[ 'selectPersonA' ]." )");

			$msg = "Adding relationship to database: ".$_POST[ 'selectPersonA' ]." + ".$_POST[ 'selectPersonB' ];

		}
		*/

		$person_a_id = $_POST[ 'selectPersonA' ];
		$person_b_id = $_POST[ 'selectPersonB' ];
		$film = $_POST[ 'film' ];
		$weight = $_POST[ 'weight' ];
		if( isset( $_POST[ 'flashback' ] ) && $_POST[ 'flashback' ] == 'on' ) {
			$flashback = 1;
		} else {
			$flashback = 0;
		}
		$comment = addslashes( $_POST[ 'comment' ] );

		// $msg = "INSERT INTO rels_people_people ( person_a_id, person_b_id, film_id, weight, flashback, comment ) VALUES( $person_a_id, $person_b_id, $film, $weight, $flashback, '$comment' )";

		$query = mysql_query( "INSERT INTO rels_people_people ( person_a_id, person_b_id, film_id, weight, flashback, comment ) VALUES( $person_a_id, $person_b_id, $film, $weight, $flashback, '$comment' )", $mysql );

	}

}

$query = mysql_query( "SELECT * FROM people ORDER BY name ASC", $mysql );

$people = array();
$people[] = array( 'id' => '-', 'name' => 'Select a person' );

while( $results = mysql_fetch_array( $query ) ) {

	$people[] = array( 'id' => $results[ 'id' ], 'name' => $results[ 'name' ] );

}

$query = mysql_query( "SELECT * FROM films WHERE id < 8 ORDER BY id ASC", $mysql );

$films = array();
$films[] = array( 'id' => '-', 'name' => 'Select a film' );

while( $results = mysql_fetch_array( $query ) ) {

	$films[] = array( 'id' => $results[ 'id' ], 'name' => $results[ 'name' ] );

}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add connection</title>
		<meta charset="utf-8" />
	</head>
	<body>
		<div id="container">
			<?php

			if( isset( $msg ) ) {

				echo '<p>'.$msg.'</p>';

			}

			?>
			<form action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>" method="post">
				<fieldset>
					<legend>Add Connection</legend>
					<label for"selectPersonA">Person A</label>
					<select id="selectPersonA" name="selectPersonA" value="<?php if( isset( $_POST[ 'selectPersonA' ] ) ) { echo $_POST[ 'selectPersonA' ]; } else { echo '-'; } ?>">
						<?php

							for( $i = 0; $i < sizeOf( $people ); $i++ ) {

								echo '<option value="'.$people[ $i ][ 'id' ].'"';

								if( isset( $_POST['selectPersonA' ] ) && $_POST['selectPersonA' ] == $people[ $i ][ 'id' ] ) {
									echo ' selected="selected"';
								}

								echo '>'.htmlentities( stripslashes( $people[ $i ][ 'name' ] ) )."</option>\n";

							}

						?>
					</select>
					<label for"selectPersonB">Person B</label>
					<select id="selectPersonB" name="selectPersonB" value="<?php if( isset( $_POST[ 'selectPersonB' ] ) ) { echo $_POST[ 'selectPersonB' ]; } else { echo '-'; } ?>">
						<?php

							for( $i = 0; $i < sizeOf( $people ); $i++ ) {

								echo '<option value="'.$people[ $i ][ 'id' ].'"';

								if( isset( $_POST['selectPersonB' ] ) && $_POST['selectPersonB' ] == $people[ $i ][ 'id' ] ) {
									echo ' selected="selected"';
								}

								echo '>'.htmlentities( stripslashes( $people[ $i ][ 'name' ] ) )."</option>\n";

							}

						?>

					</select>
					<label for"film">Film</label>
					<select id="film" name="film" value="<?php if( isset( $_POST[ 'film' ] ) ) { echo $_POST[ 'film' ]; } else { echo '-'; } ?>">
						<?php

							for( $i = 0; $i < sizeOf( $films ); $i++ ) {

								echo '<option value="'.$films[ $i ][ 'id' ].'"';

								if( isset( $_POST['film' ] ) && $_POST['film' ] == $films[ $i ][ 'id' ] ) {
									echo ' selected="selected"';
								}

								echo '>'.htmlentities( stripslashes( $films[ $i ][ 'name' ] ) )."</option>\n";

							}

						?>

					</select>
					<label for"flashback">Flashback</label>
					<input id="flashback" name="flashback" <?php if( isset( $_POST[ 'flashback' ] ) && $_POST[ 'flashback' ] ) { echo ' checked="checked"'; } ?> type="checkbox" />
					<label for"weight">Weight</label>
					<input name="weight" value="<?php if( isset( $_POST[ 'weight' ] ) && $_POST[ 'weight' ] ) { echo $_POST[ 'weight' ]; } else { echo 1; }  ?>" type="text" />
					<label for"comment">Comment</label>
					<textarea id="comment" name="comment"><?php if( isset( $_POST[ 'comment' ] ) && $_POST[ 'comment' ] ) { echo $_POST[ 'comment' ]; } ?></textarea>
					<input name="action" value="add" type="hidden" />
					<button type="submit">Submit</button>
					<button type="reset">Reset</button>
				</fieldset>
			</form>
		</div>
	</body>
</html>