<?php
class Database{
	private $db_host = "localhost";
	private $db_user = "root";
	private $db_pass = "";
	private $db_name = "akaunting-app";
	private $mysqli = "";
	private $result = array();
	private $conn = false;
	
	public function __construct(){
		if(!$this->conn){
			$this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
			$this->conn = true;
			if($this->mysqli->connect_error){
				array_push($this->result, $this->mysqli->connect_error);
				return false;
			}
		}else{
			return true;
		}
	}

	// Function to insert into the database
  public function insert($table,$params=array()){
      // Seperate $params's Array KEYs and VALUEs and Convert them to String Value
  		$table_columns = implode(', ', array_keys($params));
  		$table_value = implode("', '", $params);
  		 //echo "INSERT INTO $table ($table_columns) VALUES ('$table_value')";
  		 //die();
  	    $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";
  		// Make the query to insert to the database
  		if($this->mysqli->query($sql)){
  			array_push($this->result, $this->mysqli->insert_id);
  			return true; // The data has been inserted
  		}else{
  			array_push($this->result, $this->mysqli->error);
  			return false; // The data has not been inserted
  		}
  }
  	

  // Function to update row in database
  public function update($table,$params=array(),$where = null){
      // Create Array to hold all the columns to update
      $args = array();
      foreach ($params as $key => $value) {
        $args[] = "$key = '$value'"; // Seperate each column out with it's corresponding value
      }
      $sql = "UPDATE $table SET " . implode(', ', $args);
      //echo $sql .= " WHERE $where";
      //die();
      if($where != null){
        $sql .= " WHERE $where";
      }
	
      // Make query to database
      if($this->mysqli->query($sql)){
        array_push($this->result, $this->mysqli->affected_rows);
        return true; // Update has been successful
      }else{
        array_push($this->result, $this->mysqli->error);
        return false; // Update has not been successful
      }
  }

  public function sql($sql){
    $query = $this->mysqli->query($sql);

    if($query){
      $this->result = $query->fetch_all(MYSQLI_ASSOC);
      return true; // Query was successful
    }else{
      array_push($this->result, $this->mysqli->error);
      return false; // No rows were returned
    }
  }


  // Public function to return the data to the user
  public function getResult(){
  	$val = $this->result;
  	$this->result = array();
  	return $val;
  }

  // close connection
	public function __destruct(){
		if($this->conn){
			if($this->mysqli->close()){
				$this->conn = false;
				return true;
			}
		}else{
			return false;
		}
	}

} //Class Close


?>