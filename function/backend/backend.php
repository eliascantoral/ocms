<?php 
	include_once("general.php");
	
	class backend{
			private function start_connect(){
						$con=mysqli_connect(DB_HOST2,DB_USER2,DB_PASSWORD2,DB_NAME2);
						// Check connection
						if (mysqli_connect_errno())
						  {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						  }
						return $con;				
				}

			private function close_connect($con){
						mysqli_close($con);					
				}
			private function encripter($key){
				return md5($key);
				//return $key;
			}
                        private function set_log($user, $action, $desc, $info = ""){
                            $con = $this->start_connect();
                            $time = time();
                            $retorno = FALSE;
                            $query = "INSERT INTO `log_activity` "
                                        . "(`id`, `time`, `user`, `action`, `desc`, `info`) "
                                   . "VALUES (NULL, '".$time."', '".$user."', '".$action."', '".$desc."', '".$info."');";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $retorno = TRUE;
                            }
                            $this->close_connect($con);
                            return $retorno;
                        }
 /********************************************************************************************************/                       
			public function test(){
					$con = $this->start_connect();
					if($con){
						$this->close_connect($con);
						return true;
					}else{
						return false;
					}
				}
                               
                        public function login($user, $pass){
                            $con = $this->start_connect();
                            $retorno = false;
                            $query = "SELECT * FROM `user` WHERE `user`='".$user."' AND `password`='".$this->encripter($pass)."';";
                           
                            $result = mysqli_query($con, $query);
                            if($result){
                                 
                                while($row = mysqli_fetch_array($result)){
                                    
                                    $retorno[0]= $row['id'];
                                    $retorno[1]= $row['fname'];
                                    $retorno[2]= $row['lname'];
                                    $retorno[3]= $row['mail'];
                                    $retorno[4]= $row['rol'];
                                    $retorno[5]= $row['status'];
                                   
                                    $this->set_log($retorno[0], 1, "El usuario ingreso al sistema");
                                }
                            }
                            $this->close_connect($con);
                            return $retorno;
                        }
	}
?>