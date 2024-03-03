<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT; ?>/js/table.js"></script>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/table.css">
<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
        <?php flash('result'); ?>
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>Clientes</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Nuevo</button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $customer) : ?>
                        <tr id=<?php echo $customer['id'] ;?>>
                        <td id='cedula' ><?php echo $customer['cedula'] ;?></td>
                        <td id='nombres' ><?php echo $customer['nombres'] ;?></td>
                        <td id='apellidos' ><?php echo $customer['apellidos'] ;?></td>
                        <td id="estado" ><input  type="checkbox" value="" name="estado" id="estado" <?php echo ($customer['estado']) ? 'checked disabled' : 'disabled' ;?>></td>
                        <td>
                            <a class="add" title="Guardar" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <?php endforeach ;?>                        
                </tbody>
            </table>
        </div>
    </div>
</div>     
</body>
<?php require APPROOT . '/views/inc/footer.php'; ?>