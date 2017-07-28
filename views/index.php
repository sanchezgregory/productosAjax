
	<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body onload="loadFileJson()">

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="listaLibros.php">listado</a></li>
              <li><a href="#" onclick="loadFileJson();">Ver Productos</a></li>
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Cerrar session</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
        <br><br>
        <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            desde aqui puede cargar los productos via Json
            <p></p>
            <div class="alert alert-success" align="center">
              <button class="btn btn-primary" onclick="cargaJsonFile('1');">Obtener Json desde Archivo</button> 
              <button class="btn btn-danger" onclick="cargaJsonUrl('2');">Obtener Json desde Url</button>
              <br>
            </div>
            
            <div id="result"></div>
          </div>
        </div>
        

      </div> <!-- /container -->
    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../resources/js/jquery.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>    
    <script>
    function cargaJsonFile(tipo){
      alert(tipo)
      $.ajax({
        url:'../controllers/products.php',
        type:'POST',
        data:'op=insertar&file='+tipo
      }).done(function(resp){
          alert(resp);
      });
    }
    function cargaJsonUrl(tipo){
      $.ajax({
        url:'../controllers/products.php',
        type:'POST',
        data:'op=insertar&file'+tipo
      }).done(function(resp){
          alert(resp);
      });
    }
    function loadFileJson(){
      $.ajax({
        url:'../controllers/products.php',
        type:'POST',
        data:'op=listar'
      }).done(function(resp){
          var resp = eval(resp);
          var html = "<table class='table table-bordered'<tr><td>name</td><td>price</td></tr>";

          for(var i=0; i<resp.length; i++){
            html += "<tr><td>"+resp[i][0]+"</td><td>"+resp[i][1]+"</td></tr>";
          }
          html+="</table>";
          $('#result').html(html);
      });

    }
    </script>
  </body>
</html>