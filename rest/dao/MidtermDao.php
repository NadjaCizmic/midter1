<?php

class MidtermDao {

    private $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){
        try {

        /** TODO
        * List parameters such as servername, username, password, schema. Make sure to use appropriate port
        */
          $servername = "localhost";
          $username = "root";
          $password = "1234";
          $schema = "midterm1";
          

        /*options array neccessary to enable ssl mode - do not change*/
        /*$options = array(
        	PDO::MYSQL_ATTR_SSL_CA => 'https://drive.google.com/file/d/1g3sZDXiWK8HcPuRhS0nNeoUlOVSWdMAg/view?usp=share_link',
        	PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,

        );
        /** TODO
        * Create new connection
        * Use $options array as last parameter to new PDO call after the password
        */
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
          // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    /** TODO
    * Implement DAO method used to get cap table
    */
    public function cap_table(){
      
  

    }

    /** TODO
    * Implement DAO method used to get summary
    */
    public function summary(){
      $query = "select count(distinct investor_id) as total_investors, sum(diluted_shares) as total_shares from cap_table";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
      
    }

    /** TODO
    * Implement DAO method to return list of investors with their total shares amount
    */
    public function investors(){
      $query = "select i.first_name, i.last_name, i.company, sum(ct.diluted_shares)
                from investors i
                JOIN cap_table ct on i.id=ct.investor_id
                group by i.id";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
      
}
}

?>
