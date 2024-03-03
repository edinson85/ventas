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
                    
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">Seleccione un cliente</div>
                <select id="clientes" class="form-select" aria-label="Default select example">
                    <option value="0" selected>Seleccione ...</option>
                    <?php foreach ($data['clientes'] as $customer) : ?>
                        <option value="<?php echo $customer['id'] ;?>"><?php echo $customer['nombres'] ;?> <?php echo $customer['nombres'] ;?></option>                        
                    <?php endforeach ;?>                        
                </select>
            </div>
            <div class="row mt-4">
                <div class="col-sm-4">Seleccione un producto</div>
                <select id="productos" class="form-select" aria-label="Default select example">
                    <option value="0" selected>Seleccione ...</option>
                    <?php foreach ($data['productos'] as $producto) : ?>
                        <option value="<?php echo $producto['id'] ;?>"><?php echo $producto['nombre'] ;?>- $<?php echo $producto['valor'] ;?></option>                        
                    <?php endforeach ;?>                        
                </select>
                <div class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Agregar Producto</button>                        
                    </div>
            </div>            
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Valor</th>                        
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>                                       
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-4">Total: <span id="total"><b>$ 0</b></span></div>
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