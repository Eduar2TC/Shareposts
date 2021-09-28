<?php
    class User {
       private $db;     
       public function __construct( ){
        $this->db = new Database;
    }
    //Register user
    public function register( $data ){
        $this->db->query( 'INSERT INTO users(name, email, password) VALUES( :name, :email, :password )' );
        //bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        //Execute
        if( $this->db->execute() == true ){
            return true;
        }else{
            return false;
        }
    }

    //Login user
    public function login($email, $password){
       $this->db->query('SELECT * FROM users WHERE email = :email');
       //Bind value
       $this->db->bind(':email', $email);
       
       $row = $this->db->single();

       $hashed_password = $row->password;
       if( password_verify( $password, $hashed_password ) == true ){
           return $row;
       }else{
           return false;
       }
    }

    //Check user by email
    public function findUserByEmail( $email ){
        $this->db->query( 'SELECT * FROM users WHERE email = :email' );
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        //Check row
        if( $this->db->rowCount() > 0 ){ //email found
            return true;
        }else{
            return false;
        }
    }

    //Get user by id
    public function getUserById( $id ){
        $this->db->query(
            'SELECT USER.id AS user_id, USER.name, USER.email, USER_DET.job, USER_DET.about_me, COUNT(*) AS number_posts FROM users AS USER
                    INNER JOIN users_details AS USER_DET
                    ON USER.id = USER_DET.user_id
                    INNER JOIN posts AS POST
                    ON USER_DET.user_id = POST.user_id
                    WHERE POST.user_id = :id' 
            );
        //bind values
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

}

?>