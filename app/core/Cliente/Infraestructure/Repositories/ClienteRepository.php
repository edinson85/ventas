<?php
class ClienteRepository {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //register new customer
    public function register(Cliente $data): bool {
        $this->db->query('INSERT INTO cliente (cedula, nombres, apellidos, estado) VALUES (:cedula, :nombres, :apellidos, :estado)');
        $this->db->bind(':cedula', $data->getCedula());        
        $this->db->bind(':nombres', $data->getNombres());
        $this->db->bind(':apellidos', $data->getApellidos());
        $this->db->bind(':estado', $data->getEstado());

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //edit customer
    public function editar(Cliente $data): bool {
        $id = $data->getId();
        $cedula = $data->getCedula();
        $nombres = $data->getNombres();
        $apellidos = $data->getApellidos();        
        $estado = ($data->getEstado()) ? 1 : 0;

        try {        
            $result = false;
            $this->db->query("UPDATE cliente set cedula=$cedula, nombres ='$nombres', apellidos = '$apellidos', estado = $estado Where id = '$id' ");        
            if($this->db->execute()){
                $result = true;
            }
        } catch (\Throwable $er) {
            //TO DO ADD TO LOG
        }
        return $result;
    }    
    //find customer by cedula
    public function findCustomerByCedula($cedula):bool {
        $this->db->query('SELECT * FROM cedula WHERE cedula = :cedula');
        $this->db->bind(':cedula', $cedula);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //find customer by id
    public function findCustomerById($id) {
        $this->db->query('SELECT * FROM cliente WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            $customer = new Cliente($row->cedula, $row->nombres, $row->apellidos);            
            $customer->setEstado($row->estado);
            $customer->setId($row->id);
            return $customer;
        }else{
            return false;
        }
    }    

    public function list() {
        $this->db->query('SELECT * FROM cliente');        
        $rows = $this->db->resultSet();
        $customers = [];        
        if($this->db->rowCount() > 0){
            foreach ($rows as $row) {
                $customer = new Cliente($row->cedula, $row->nombres, $row->apellidos);            
                $customer->setEstado($row->estado);
                $customer->setId($row->id);
                $customers[] = $customer;                
            }
        }
        return $customers;
    }
}