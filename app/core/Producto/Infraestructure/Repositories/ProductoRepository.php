<?php
class ProductoRepository {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //register new product
    public function register(Producto $data): bool {
        $this->db->query('INSERT INTO producto (nombre, valor, estado) VALUES (:nombre, :valor, :estado)');        
        $this->db->bind(':nombre', $data->getNombre());
        $this->db->bind(':valor', $data->getValor());
        $this->db->bind(':estado', $data->getEstado());

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //edit product
    public function editar(Producto $data): bool {
        $id = $data->getId();        
        $nombre = $data->getNombre();
        $valor = $data->getValor();        
        $estado = ($data->getEstado()) ? 1 : 0;

        try {        
            $result = false;
            $this->db->query("UPDATE producto set nombre ='$nombre', valor = '$valor', estado = $estado Where id = '$id' ");        
            if($this->db->execute()){
                $result = true;
            }
        } catch (\Throwable $er) {
            //TO DO ADD TO LOG
        }
        return $result;
    }  
    
    //delete product
    public function eliminar($id): bool {        
        try {        
            $result = false;
            $this->db->query("DELETE from producto  Where id = '$id' ");        
            if($this->db->execute()){
                $result = true;
            }
        } catch (\Throwable $er) {
            //TO DO ADD TO LOG
        }
        return $result;
    }     
    //find product by nombre
    public function findProductByNombre($nombre):bool {
        $this->db->query('SELECT * FROM producto WHERE nombre = :nombre');
        $this->db->bind(':nombre', $nombre);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //find product by id
    public function findProductById($id, $activo = false) {
        $concat = (!$activo) ? '' : ' and estado = 1 ';        
        $this->db->query('SELECT * FROM producto WHERE id = :id '.$concat);
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            $product = new Producto($row->nombre, $row->valor, $row->estado);                        
            $product->setId($row->id);
            return $product;
        }else{
            return false;
        }
    }    
    //list all products
    public function list(bool $activos) {
        $concat = (!$activos) ? '' : ' where estado = 1 ';        
        $this->db->query('SELECT * FROM producto '.$concat);        
        $rows = $this->db->resultSet();
        $products = [];        
        if($this->db->rowCount() > 0){
            foreach ($rows as $row) {
                $product = new Producto($row->nombre, $row->valor, $row->estado);                            
                $product->setId($row->id);
                $products[] = $product;                
            }
        }
        return $products;
    }
}