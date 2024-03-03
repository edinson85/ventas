<?php
class VentaProductoRepository {
    private $db;
    private $productoRepository;
    private $ventaRepository;
    public function __construct()
    {
        $this->db = new Database;
        $this->productoRepository = new ProductoRepository();
        $this->ventaRepository = new VentaRepository();
    }

    //register new venta producto
    public function register(VentaProducto $data): bool {
        $this->db->query('INSERT INTO venta_producto (venta_id, producto_id) VALUES (:venta_id, :producto_id)');        
        $this->db->bind(':venta_id', $data->getVenta()->getId());        
        $this->db->bind(':producto_id', $data->getProducto()->getId());                
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //edit venta
    public function editar(VentaProducto $data): bool {
        $id = $data->getId();        
        $ventaId = $data->getVenta()->getId();
        $productoId = $data->getProducto()->getId();        

        try {        
            $result = false;
            $this->db->query("UPDATE venta_producto set venta_id ='$ventaId', producto_id = '$productoId' Where id = '$id' ");        
            if($this->db->execute()){
                $result = true;
            }
        } catch (\Throwable $er) {
            //TO DO ADD TO LOG
        }
        return $result;
    }  
    
    //delete venta
    public function eliminar($id): bool {        
        try {        
            $result = false;
            $this->db->query("DELETE from venta_producto  Where id = '$id' ");        
            if($this->db->execute()){
                $result = true;
            }
        } catch (\Throwable $er) {
            //TO DO ADD TO LOG
        }
        return $result;
    }         

    //find venta by id
    public function findVentaProductoById($id) {
        $this->db->query('SELECT * FROM venta_producto WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){            
            $venta = $this->ventaRepository->findVentaById($row->venta_id);
            $producto = $this->productoRepository->findProductById($row->producto_id);
            $ventaProducto = new VentaProducto($venta, $producto);                        
            $ventaProducto->setId($row->id);
            return $ventaProducto;        
        }else{
            return false;
        }
    }
    
    //find product of one venta by id
    public function findVentaProductoByIdVenta($id) {
        $this->db->query('SELECT * FROM venta_producto WHERE venta_id = :id');
        $this->db->bind(':id', $id);
        $rows = $this->db->resultSet();
        $ventaProductos = [];
        //check the row 
        if($this->db->rowCount() > 0){            
            $venta = $this->ventaRepository->findVentaById($id);
            foreach ($rows as $row) {
                $producto = $this->productoRepository->findProductById($row->producto_id);
                $ventaProducto = new VentaProducto($venta, $producto);                        
                $ventaProducto->setId($row->id);
                $ventaProductos [] = $ventaProducto;
            }
            return $ventaProductos;        
        }else{
            return false;
        }
    }    
}