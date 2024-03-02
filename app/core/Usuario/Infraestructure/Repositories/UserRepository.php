<?php
class UserRepository {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //register new user
    public function register(Usuario $data): bool {
        $this->db->query('INSERT INTO user (name, email, password, estado) VALUES (:name, :email, :password, :estado)');
        $this->db->bind(':name', $data->getNombre());
        $this->db->bind(':email', $data->getCorreo());
        $this->db->bind(':password', $data->getPassword());
        $this->db->bind(':estado', $data->getEstado());

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //edit user
    public function editar(Usuario $user): bool {
        $id = $user->getId();
        $nombre = $user->getNombre();
        $correo = $user->getCorreo();
        $correo = $user->getCorreo();
        $password = $user->getPassword();
        $estado = ($user->getEstado()) ? 1 : 0;

        try {        
            $result = false;
            $this->db->query("UPDATE user set name ='$nombre', email = '$correo', password = '$password' , estado = $estado Where id = '$id' ");        
            if($this->db->execute()){
                $result = true;
            }
        } catch (\Throwable $er) {
            //TO DO ADD TO LOG
        }
        return $result;
    }    
    //find user by email
    public function findUserByEmail($email):bool {
        $this->db->query('SELECT * FROM user WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //find user by id
    public function findUserById($id) {
        $this->db->query('SELECT * FROM user WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        //check the row 
        if($this->db->rowCount() > 0){
            $user = new Usuario($row->name, $row->email);
            $user->setPassword($row->password);
            $user->setEstado($row->estado);
            $user->setId($row->id);
            return $user;
        }else{
            return false;
        }
    }    

    public function login($email, $password){
        $this->db->query('SELECT * FROM user where email = :email');
        $this->db->bind(':email', $email);    
        $row = $this->db->single();
        $hash_password = $row->password;
        if(password_verify($password, $hash_password)){
            return $row;
        }else{
            return false;
        }
    }

    public function getUserById($id){
        $this->db->query('SELECT * FROM user WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
}