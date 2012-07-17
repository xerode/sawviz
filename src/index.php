<!DOCTYPE html>
<html>
  <head>
      <title>Visualising relationships between characters in the Saw horror film/movie franchise</title>
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <script>
        var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;

        var film_id = 0;

        if( urlParams.film_id ) {
          film_id = urlParams.film_id;
        }
      </script>
    </head>
    <body>
      <header>
        <h1>Vizsaw</h1>
      </header>
      <nav>
        <ol id="filmsList" class="clearfix">
          <?php

          $films = array( "Show all", "Saw", "II", "III", "IV", "V", "VI", "The Final Chapter" );

          if( isset( $_GET[ 'film_id' ] ) ) { // && is_int( $_GET[ 'film_id' ] )
            $film_id = $_GET[ 'film_id' ];
          } else {
            $film_id = 0;
          }

          for( $i = 0, $m = sizeof( $films ); $i < $m; $i++ ) {

            if( $i != $film_id ) {
              echo '<li><a href="?film_id='.$i.'">'.$films[ $i ].'</a></li>';
            } else {
              echo '<li class="selected">'.$films[ $i ].'</li>';
            }

          }

          ?>
        </ol>
      </nav>
      <div id="graph"></div>
      <div id="person">
        <h2 id="name">Name</h2>
        <p id="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
        <ul id="links">
          <li>Link #1</li>
          <li>Link #2</li>
          <li>Link #3</li>
          <li>Link #4</li>
          <li>Link #5</li>
        </ul>
      </div>
      <footer>
        <p>Blah blah blah footer &copy; etc</p>
      </footer>
      <!-- Placed at the end of the document so the pages load faster -->
      <script data-main="js/main" src="js/libs/requirejs/require.js"></script>
  </body>
</html>