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
      <h1>Vizsaw</h1>
      <ol id="filmsList" class="clearfix">
        <li><a href="?film_id=1">Saw</a></li>
        <li><a href="?film_id=2">Saw II</a></li>
        <li><a href="?film_id=3">Saw III</a></li>
        <li><a href="?film_id=4">Saw IV</a></li>
        <li><a href="?film_id=5">Saw V</a></li>
        <li><a href="?film_id=6">Saw VI</a></li>
        <li><a href="?film_id=7">Saw 3D</a></li>
        <li><a href="?film_id=0">Show all</a></li>
      </ol>
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
      <!-- Placed at the end of the document so the pages load faster -->
      <script data-main="js/main" src="js/libs/requirejs/require.js"></script>
  </body>
</html>