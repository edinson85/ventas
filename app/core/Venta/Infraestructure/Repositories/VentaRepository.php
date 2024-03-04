<?php
class VentaRepository {
    private $db;
    private $clienteRepository;
    public function __construct()
    {
        $this->db = new Database;
        $this->clienteRepository = new ClienteRepository();
    }

    //register new venta
    public function register(Venta $data) {
        $this->db->query('INSERT INTO venta (cliente_id, valor, estado) VALUES (:cliente_id, :valor, :estado)');        
        $this->db->bind(':cliente_id', $data->getCliente()->getId());        
        $this->db->bind(':valor', $data->getValor());
        $this->db->bind(':estado', $data->getEstado());

        if($this->db->execute()){            
            return $this->db->lastId();
        }else{
            return false;
        }
    }

    //edit venta
    public function eliminadoLogico($id): bool {        
        try {        
            $result = false;
            $this->db->query("UPDATE venta set estado = '0' Where id = '$id' ");        
            if($this->db->execute()){
                $result = true;
            }
        } catch (\Throwable $er) {
            //TO DO ADD TO LOG
        }
        return $result;
    }     

    //edit venta
    public function editar(Venta $data): bool {
        $id = $data->getId();        
        $clienteId = $data->getCliente()->getId();
        $valor = $data->getValor();        
        $estado = ($data->getEstado()) ? 1 : 0;

        try {        
            $result = false;
            $this->db->query("UPDATE venta set cliente_id ='$clienteId', valor = '$valor', estado = $estado Where id = '$id' ");        
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
            $this->db->query("DELETE from venta  Where id = '$id' ");        
            if($this->db->execute()){
                $result = true;
            }
        } catch (\Throwable $er) {
            //TO DO ADD TO LOG
        }
        return $result;
    }         

    //find venta by id
    public function findVentaById($id, $activo = false) {
        $concat = (!$activo) ? '' : ' and estado = 1 ';        
        $this->db->query('SELECT * FROM venta WHERE id = :id '.$concat);
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            $cliente = $this->clienteRepository->findCustomerById($row->cliente_id);
            $venta = new Venta($cliente, $row->valor, $row->estado);                        
            $venta->setId($row->id);
            return $venta;
        }else{
            return false;
        }
    }    
    //list all ventas
    public function list(bool $activos) {
        $concat = (!$activos) ? '' : ' where estado = 1 ';        
        $this->db->query('SELECT * FROM venta '.$concat);        
        $rows = $this->db->resultSet();
        $ventas = [];        
        if($this->db->rowCount() > 0){
            foreach ($rows as $row) {
                $cliente = $this->clienteRepository->findCustomerById($row->cliente_id);
                $venta = new Venta($cliente, $row->valor, $row->estado);                            
                $venta->setId($row->id);
                $ventas[] = $venta;                
            }
        }
        return $ventas;
    }
}