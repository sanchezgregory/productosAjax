
	<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>..:: Productos Ajax ::..</title>

    <!-- Bootstrap core CSS -->
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
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
            <hr>
              <button class="btn btn-primary" onclick="buscaProducto()"> Consultar </button> 
              <input type="text" minlength="1" maxlength="4" id="idpro" required="" placeholder="escriba el id aqui">
              
              <div class="well" id="exito" style="margin-top: 5px; display: none;">Cargando...</div>
              <div class="well" id="individual" style="margin-top: 5px; display: none;"></div>
              <div class="alert alert-danger" id="notfound" style="margin-top: 5px; display: none;">Registro no encontrado</div>
            <hr>
            <div class="alert alert-warning" align="center"> 
              <button class="btn btn-warning" onclick="loadFileJson()">Ver todos los productos</button> 
            </div>
            <div id="cargando" style="display: none;">Cargando...</div>  
            <div id="borrado" style="display: none;" class="alert alert-success">Producto borrado</div>
            <hr>
            <div id="result"></div>
          </div>
        </div>
        

      </div> <!-- /container -->
    </div>
<!-- Modal -->
<div class="modal fade" id="borraProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Proceso de borrar productos, cuidado!</h4>
      </div>
      <div class="modal-body">
          Estas seguro de borrar el producto: <strong><span id="nameP"></span></strong>
          con sus datos: <br>
          ID:<span id="idP"></span>
          PRECIO: <span id="priceP"></span><p></p>
          <button id="dp" onclick="deleteProducto()" class="btn btn-danger" data-dismiss="modal" >Si, borrar!</button>
      </div>
    </div>
  </div>
</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../resources/js/jquery.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>    
    <script src="../resources/js/validacampo.js"></script>
    <script>
     function cargaJsonFile(tipo){
      $.ajax({
        url:'../controllers/products.php',
        type:'POST',
        data:'op=insertar&file='+tipo
      }).done(function(resp){
          if (resp == '1') alert("Archivo Json cargado");
          else alert('Error al cargar el archivo Json');
      });
    }
    function cargaJsonUrl(tipo){
      $.ajax({
        url:'../controllers/products.php',
        type:'POST',
        data:'op=insertar&file='+tipo
      }).done(function(resp){
          if (resp == '1') alert("Archivo Json cargado");
          else alert('Error al cargar el archivo Json, debido a:'+resp);
      });
    }
    function loadFileJson(){
      $.ajax({
        url:'../controllers/products.php',
        type:'POST',
        data:'op=listar'
      }).done(function(resp){
        var resp = eval(resp);
        $('#cargando').show();
        var delayMillis = 2000; //1 second
        setTimeout(function() {
          $('#cargando').hide();
          var html = "<table class='table table-bordered'<tr><td>id</td><td>Producto</td><td>precio</td><td>Acciones</td></tr>";
          for(var i=0; i<resp.length; i++)
            {
              var datos = resp[i][0]+'*'+resp[i][1]+'*'+resp[i][2];
                html += "<tr><td>"+resp[i][0]+"</td><td>"+resp[i][1]+"</td><td>"+resp[i][2]+"</td><td><button class='btn btn-danger' onclick='borraProducto("+'"'+datos+'"'+")' data-toggle='modal' data-target='#borraProducto'>Del</button></td></tr>";
            }
          html+="</table>";
          $('#result').html(html);
        }, delayMillis);
      });

    }
    function buscaProducto(){
      $('#individual').hide();
      $('#notfound').hide();
      var id = $('#idpro').val();
      $.ajax({
        url:'../controllers/products.php',
        type:'POST',
        data:'op=buscar&id='+id
      }).done(function(resp){
        var resp = eval(resp);
        if (resp != "") {
          $('#exito').show();
          var delayMillis = 2000; //1 second
          setTimeout(function() {
            var html = "<table class='table table-bordered'<tr><td>id</td><td>Producto</td><td>precio</td></tr>";
            for(var i=0; i<resp.length; i++)
              {
                  html += "<tr><td>"+resp[i][0]+"</td><td>"+resp[i][1]+"</td><td>"+resp[i][2]+"</td></tr>";
              }
            html+="</table>";
            $('#exito').hide();
            $('#individual').show();
            $('#individual').html(html);
          }, delayMillis);
        } else $('#notfound').show();
          
      });  
    }
    function borraProducto(datos) 
    {
      var res = datos.split('*');
      $('#idP').html(res[0]);
      $('#nameP').html(res[1]);
      $('#priceP').html(res[2]);
    }
    function deleteProducto() 
    {
      var id = $('#idP').html();
      $.ajax({
        url:'../controllers/products.php',
        type:'POST',
        data:'op=borrar&id='+id
      }).done(function(resp){
        if(resp=="1") {
          $('#borrado').show('slow/400/fast');
          loadFileJson();
        }
      });
      loadFileJson();
    }
    $(function(){
            $('#idpro').validCampoFranz('0123456789-');
        });
    </script>
  </body>
</html>