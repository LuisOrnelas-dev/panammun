<?php
function authenticate(){
if ((!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']))||($_SERVER['PHP_AUTH_USER']!=='admin' && $_SERVER['PHP_AUTH_PW']!=='admin')){
    header('WWW-Authenticate: Basic realm="UP Panammun"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Acceso denegado';
    exit;
}
}
authenticate();
?>

<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Panammun</title>
</head>
<body>

    <div class="container">
   <!--          </div>

            <div class="container2"> -->
            <div class="col-md-12">
                <div class="card mt-4">
                  <div class="card-header">
                        <h4  style="text-align:center;color:#F2F2F0;font-family: 'prataregular'; font-weight:bold; font-style:normal;" >Alumnos registrados Panammun 2022 </h4>
                        <div id="containerimg">
                          <img id="imagenlogo"src="img/escudoinver.png">
                        </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                            <div class="inputclass">
                                <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Buscar por nombre..">

                            </div>
                        </div>
                        <br>
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center">ID</th>
                                    <th align="center">Nombre</th>
                                    <th align="center">Email</th>
                                    <th align="center">Colegio</th>
                                    <th align="center">Comité</th>
                                    <th align="center">País</th>
                                    <th align="center">Pago</th>
                                    <th align="center">Estatus</th>
                                    <th align="center">Postura 1</th>
                                    <th align="center">Postura 2</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    require_once('./mysqli_connect.php');

                                    //$comites = $conn->prepare("SELECT comite FROM comites");
                                    //$comites->execute();
                                    //$comites = $comites->fetchAll();
                                    $query="SELECT comite FROM comites";
                                    $comites = mysqli_query($con, $query);

                                    $query = "SELECT id,name,email,colegio,comite,pais,pago,estatus,doc1,doc2 FROM users";
                                    $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td valign="middle" align="center"><?= $items['id']; ?></td>
                                                    <td valign="middle" align="center"><?= $items['name']; ?></td>
                                                    <td valign="middle" align="center"><?= $items['email']; ?></td>
                                                    <td valign="middle" align="center"><?= $items['colegio']; ?></td>
                                                    <td valign="middle" align="center"><?= $items['comite']; ?></td>
                                                    <td valign="middle" align="center"><?= $items['pais']; ?></td>
                                                    <td valign="middle" align="center"><a href="https://uppanammun.s3.amazonaws.com/<?= $items['pago']; ?>">
                                                      <img src="https://uppanammun.s3.amazonaws.com/<?= $items['pago']; ?>" height=50 width=50 >
                                                    </a></td>
                                                    <?php
                                                    if ($items['estatus']==0){
                                                    ?>
                                                    <td valign="middle" align="center"><button class ="btn" onclick="btn_accept('<?= $items['id']?>', '<?=$items['comite']; ?>','<?=addcslashes($items['pais'], "'"); ?>')"><i class="fa fa-check"></i> Aceptar</button><button class ="btn" onclick="btn_deny('<?= $items['id']; ?>')"><i class="fa fa-close"></i>Rechazar</button></td>
                                                    <?php
                                                  } 
                                                    if ($items['estatus']==1){
                                                    ?>
                                                     <td  valign="middle"align="center"><i class="fa fa-check"></i></td>
                                                    <?php
                                                  } 
                                                  if ($items['estatus']==2){
                                                    ?>
                                                     <td  valign="middle"align="center"><i class="fa fa-times"></i></td>
                                                    <?php
                                                  } 
                                                  if ($items['doc1']!=""){
                                                  ?>
                                                <td valign="middle" align="center"><a href="https://uppanammun.s3.amazonaws.com/<?= $items['doc1']; ?>"><?= $items['doc1']; ?></a></td>
                                                <?php
                                                  }
                                                  else {
                                                    ?>
                                                    <td valign="middle" align="center">No se ha subido postura 1</td>
                                                    <?php
                                                  }
                                                   if ($items['doc2']!=""){
                                                    ?>
                                                    <td valign="middle" align="center"><a href="https://uppanammun.s3.amazonaws.com/<?= $items['doc2']; ?>"><?= $items['doc2']; ?></a></td>
                                                    <?php
                                                  }
                                                  else {
                                                     ?>
                                                    <td valign="middle" align="center">No se ha subido postura 2</td>
                                                    <?php
                                                  }
                                                 ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td valign="middle" colspan="8">No hay alumnos registrados</td>
                                                </tr>
                                            <?php
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                      <div class="form-group">
                      <label> <h4> Comite</h4></label><br>
                      <select id="comite" class="select-css">
                        <option>Selecciona un comité</option>
                           <?php foreach ($comites as $comite):?>
                        <option value="<?php echo $comite['comite'] ?>"><?php echo $comite['comite'] ?></option>
                            <?php endforeach;?>
                      </select>
                      </div>
                      <div id="containergral">
                      <!-- Table votototal1 -->
                      <div id="container1">
                      <h4> El más guapo </h4>
                        <table id="myTable1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center">Lugar</th>
                                    <th align="center">Pais</th>
                                    <th align="center">Comité</th>
                                    <th align="center">Votos</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      </div>
                        <!-- Table votototal2 -->
                        <div id="container2">
                         <h4> El astronauta </h4>
                        <table id="myTable2" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center">Lugar</th>
                                    <th align="center">Pais</th>
                                    <th align="center">Comité</th>
                                    <th align="center">Votos</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      </div>
                      <div id="container3">
                        <!-- Table votototal3 -->
                         <h4> El cantiflas </h4>
                        <table id="myTable3" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center">Lugar</th>
                                    <th align="center">Pais</th>
                                    <th align="center">Comité</th>
                                    <th align="center">Votos</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      </div>
                      <div id="container4">
                        <!-- Table votototal4 -->
                         <h4> El fantasma </h4>
                        <table id="myTable4" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center">Lugar</th>
                                    <th align="center">Pais</th>
                                    <th align="center">Comité</th>
                                    <th align="center">Votos</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                      </div>
                        <div id="container5">
                        <!-- Table votototal5 -->
                         <h4> El bomba </h4>
                        <table id="myTable5" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th align="center">Lugar</th>
                                    <th align="center">Pais</th>
                                    <th align="center">Comité</th>
                                    <th align="center">Votos</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    </div>
                  </div>

                </div>
            </div>
          </div>
        </div>
    </div>
    <script>
      document.addEventListener('input', function (event) {
        var table = document.getElementById("myTable1");
       var rowCount = table.rows.length;
       for (var i = 1; i < rowCount; i++) {
          table.deleteRow(1);
       }
       var table = document.getElementById("myTable2");
       var rowCount = table.rows.length;
       for (var i = 1; i < rowCount; i++) {
          table.deleteRow(1);
       }
       var table = document.getElementById("myTable3");
       var rowCount = table.rows.length;
       for (var i = 1; i < rowCount; i++) {
          table.deleteRow(1);
       }
       var table = document.getElementById("myTable4");
       var rowCount = table.rows.length;
       for (var i = 1; i < rowCount; i++) {
          table.deleteRow(1);
       }
       var table = document.getElementById("myTable5");
       var rowCount = table.rows.length;
       for (var i = 1; i < rowCount; i++) {
          table.deleteRow(1);
       }
        let elementos=0;
  // Only run on our select menu
  if (event.target.id !== 'comite') return;
  // The selected value
  console.log(event.target.value);
  if (event.target.value=="Selecciona un comité") return;
  var oReq = new XMLHttpRequest();
      oReq.open("POST", "topnominations.php", true);
      oReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      oReq.send("comite="+event.target.value);
      swal("Procesando...");
      oReq.onload = function(oEvent) {
      //console.log(oReq.responseText);
      let datojson=JSON.parse(oReq.responseText);

      ///VOTO TOTAL CATEGORIA 1 NOMINACIONES
      console.log(datojson.votototal1);
      for (var i=elementos; i<datojson.votototal1.length-elementos; i++){
        document.getElementById("myTable1").innerHTML+= "<tr><td>"+(i+1)+
        "</td><td>"+datojson.votototal1[i].pais+"</td><td>"+datojson.votototal1[i].comite+"</td><td>"
        +datojson.votototal1[i].votototal1+"</td> </tr>"; 
      }

      ///VOTO TOTAL CATEGORIA 2 NOMINACIONES
      console.log(datojson.votototal2);
      for (var i=elementos; i<datojson.votototal2.length-elementos; i++){
        document.getElementById("myTable2").innerHTML+= "<tr><td>"+(i+1)+
        "</td><td>"+datojson.votototal2[i].pais+"</td><td>"+datojson.votototal2[i].comite+"</td><td>"
        +datojson.votototal2[i].votototal2+"</td> </tr>"; 
      }

      ///VOTO TOTAL CATEGORIA 3 NOMINACIONES
      console.log(datojson.votototal3);
      for (var i=elementos; i<datojson.votototal3.length-elementos; i++){
        document.getElementById("myTable3").innerHTML+= "<tr><td>"+(i+1)+
        "</td><td>"+datojson.votototal3[i].pais+"</td><td>"+datojson.votototal3[i].comite+"</td><td>"
        +datojson.votototal3[i].votototal3+"</td> </tr>"; 
      }

      ///VOTO TOTAL CATEGORIA 4 NOMINACIONES
      console.log(datojson.votototal4);
      for (var i=elementos; i<datojson.votototal4.length-elementos; i++){
        document.getElementById("myTable4").innerHTML+= "<tr><td>"+(i+1)+
        "</td><td>"+datojson.votototal4[i].pais+"</td><td>"+datojson.votototal4[i].comite+"</td><td>"
        +datojson.votototal4[i].votototal4+"</td> </tr>"; 
      }

      ///VOTO TOTAL CATEGORIA 1 NOMINACIONES
      console.log(datojson.votototal5);
      for (var i=elementos; i<datojson.votototal5.length-elementos; i++){
        document.getElementById("myTable5").innerHTML+= "<tr><td>"+(i+1)+
        "</td><td>"+datojson.votototal5[i].pais+"</td><td>"+datojson.votototal5[i].comite+"</td><td>"
        +datojson.votototal5[i].votototal5+"</td> </tr>"; 
      }
        if (oReq.status == 200) {
          console.log("consulta exitosa");
          swal("Panammun 2022","Consulta exitosa", "success");
        } else {
          console.log("consulta fallida"); 
        }
        };
        // setTimeout(() => {
        // location.reload();
        // }, 1500);

}, false);
    function btn_accept(intvar, comite, pais){
      console.log(intvar);
      console.log(comite);
      console.log(pais);
      var oReq = new XMLHttpRequest();
      oReq.open("POST", "insertalumni.php", true);
      oReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      oReq.send("ID=" + intvar + "&value=1&comite=" + comite+"&pais=" + pais);
      swal("Procesando...");
      oReq.onload = function(oEvent) {
      console.log(oReq.responseText);
        if (oReq.status == 200) {
          swal.close();
         switch(oReq.responseText){
          case '"err1"':
            swal("Panammun 2022","Datos ingresados a la base de datos con éxito", "success");
            break;
         }
        } else {
          swal("Panammun 2022","Error " + oReq.status + " ocurrió al procesar su solicitud", "error");   
        }
        };
        setTimeout(() => {
        location.reload();
        }, 1500);
        }

    function btn_deny(intvar){
      console.log(intvar);
      var oReq = new XMLHttpRequest();
      oReq.open("POST", "insertalumni.php", true);
      oReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      oReq.send("ID=" + intvar + "&value=0&comite=vacio&pais=vacio");
      swal("Procesando...");
      oReq.onload = function(oEvent) {
      console.log(oReq.responseText);
        if (oReq.status == 200) {
          swal.close();
         switch(oReq.responseText){
          case '"err2"':
            swal("Panammun 2022","Alumno rechazado exitosamente", "success");
            break;
         }
        } else {
          swal("Panammun 2022","Error " + oReq.status + " ocurrió al procesar su solicitud", "error");   
        }
        };
        setTimeout(() => {
        location.reload();
        }, 1500);
    }
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
