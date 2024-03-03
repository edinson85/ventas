<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT; ?>/js/tableCrearVentas.js"></script>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/table.css">
<div class="container-lg">
    <div class="table-responsive">
        <div class="table-wrapper">
        <?php flash('result'); ?>
            <div class="table-title">                
                <div class="row mb-4">
                    <a href="<?php echo URLROOT ;?>/ventas/index" class="btn btn-link pull-left"><i class="fa fa-backward"></i> Volver</a>
                </div>                    
                <div class="row">
                    <div class="col-sm-8"><h2><b>Crear Venta</b></h2></div>
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Agregar Producto</button>                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">Seleccione un cliente</div>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Seleccione ...</option>
                    <option value="1">Edinson</option>
                    <option value="2">Isabella</option>
                    <option value="3">Tatiana</option>
                </select>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Valor</th>                        
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $producto) : ?>
                        <tr id=<?php echo $producto['id'] ;?>>
                        <td id='producto' ><?php echo $producto['producto'] ;?></td>
                        <td id='valor' ><?php echo $producto['valor'] ;?></td>                        
                        <td>
                            <a class="add" title="Guardar" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>                            
                            <a class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <?php endforeach ;?>                        
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-4">Total: <span id="total"><b>400</b></span></div>
            </div>
            <div class="row">                    
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success create">Crear</button>
                </div>
            </div>
        </div>
    </div>
</div>     
</body>
<?php require APPROOT . '/views/inc/footer.php'; ?>