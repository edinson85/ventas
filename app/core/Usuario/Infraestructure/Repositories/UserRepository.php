<?php
class UserRepository {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    //register new user
    public function register(Usuario $data): bool {
        $this->db->query('INSERT INTO user (name, email, password) VALUES (:name, :email, :password)');
        $this->db->bind(':name', $data->getNombre());
        $this->db->bind(':email', $data->getCorreo());
        $this->db->bind(':password', $data->getPassword());

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
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