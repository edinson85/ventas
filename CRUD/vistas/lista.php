 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>lista de personas</title>
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
 </head>
 <?php 
include'../config/conexion.php';
$bs=new conexion();
$bs->sql="select *from personas";
$bs->res=mysqli_query($bs->conector,$bs->sql);
$contador=0;
 ?>
 <body>
<div class="text-center">
 <h1><u>lista de Personas</u></h1>
</div>
<div class="container">
<div class="mt-2">
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered">
<thead class="text-center bg-dark text-white">
<tr>
<th><strong>ITEM</strong></th>
<th><strong>DNI</strong></th>
<th><strong>PERSONA</strong></th>
<th><strong>ACCIÓN</strong></th>
</tr>	
</thead>
<tbody>
<?php 
if(mysqli_num_rows($bs->res)>0){
while($persona=mysqli_fetch_row($bs->res)){
	$contador=$contador+1;
 ?>	
 <tr><td><?=$contador?></td><td><?=$persona[1]?></td><td><?=$persona[3]." ".$persona[2]?></td>
 	<td><a href="editarp.php?id=<?=$persona[0]?>" class="btn btn-outline-warning btn-sm"><strong>editar</strong></a><a href="../logica/delete.php?id=<?=$persona[0]?>" class="btn btn-outline-danger btn-sm mx-xl-2 mx-lg-2 mx-md-2 mx-0 mt-xl-0 mt-lg-0 mt-md-0 mt-2"><strong>eliminar</strong></a></td></tr>
<?php } }else{echo ' <th colspan="4" class="alert alert-danger text-center">no hay datos para mostrar</th>';}?>
</tbody>	
</table>	
</div>	
</div>	
<div class="card-body">
   <a href="../logica/destruir.php" class="btn btn-primary"><strong>Nuevo</strong></a> 
</div>
</div>	
</div>	
</div>
 </body>
 </html>