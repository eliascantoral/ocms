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
                        
/***************************************************************************************************************/
                        function get_mainmenu($rol){
                            $con = $this->start_connect();
                            $menu = array();
                            $query = "SELECT * FROM `mainmenu` WHERE `status` = '1' AND `access`>'".$rol."';";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $index = 0;
                                while($row = mysqli_fetch_array($result)){
                                    $menu[$index][0] = $row['id'];
                                    $menu[$index][1] = $row['name'];
                                    $menu[$index][2] = $row['desc'];
                                    $menu[$index][3] = $row['img'];
                                    $index++;
                                }
                            }
                            $this->close_connect($con);
                            return $menu;
                        }
/*******************************************************************************************************************/
                        function get_objectsfieldtype($type = false){
                            $con = $this->start_connect();
                            $list = array();
                            $query = $type ? ("SELECT * FROM `field_type` WHERE `id`='".$type."';"): ("SELECT * FROM `field_type` WHERE `status`='1';");
                            $result = mysqli_query($con, $query);                                                        
                            if($result){                                
                                while($row = mysqli_fetch_array($result)){
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $desc = $row['desc'];
                                    $folder = $row['folder'];
                                    array_push($list, array($id,$name,$desc,$folder ));
                                }
                            }
                            $this->close_connect($con);
                            return $list;
                        }
                        function set_objectfield($name, $id, $desc, $object, $type){
                            $con = $this->start_connect();
                            $return = false;
                            $time = time();
                            $query = "INSERT INTO `field` "
                                    . "(`id`, `name`, `idname`, `desc`, `object`, `type`, `status`, `createtime`, `modtime`) "
                                    . "VALUES (NULL, '".$name."', '".$id."', '".$desc."', '".$object."', '".$type."', '1', '".$time."', '".$time."');";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $return = true;
                            }
                            $this->close_connect($con);
                            return $return;
                            
                        }
                        function save_objecttype($name, $desc, $creater, $status = 2){
                            $con = $this->start_connect();
                            $return = false;
                            $time = time();
                            $query = "INSERT INTO `object_type` (`id`, `name`, `desc`, `createtime`, `creater`, `status`) "
                                    . "VALUES (NULL, '".$name."', '".$desc."', '".$time."', '".$creater."', '".$status."');";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $return = mysqli_insert_id($con);
                            }
                            $this->close_connect($con);
                            return $return;
                        }
                        function update_objecttype($objectid, $name, $desc, $status){
                            $con = $this->start_connect();
                            $return = false;
                            $query ="UPDATE `ocms`.`object_type` SET"; 
                            if($name) $query.= "`name` = '".$name."' ";
                            if($desc) $query.= $name?"," . "`desc` = '".$desc."' ":"`desc` = '".$desc."' ";
                            if($status) $query.= $name||$desc? "," . "`status` = '".$status."' ":"`status` = '".$status."' ";
                            
                            $query .="WHERE `object_type`.`id` = '".$objectid."';";                          
                            $result = mysqli_query($con, $query);
                            if($result){
                                $return = true;
                            }
                            $this->close_connect($con);
                            return $return;
                        }
                        function delete_objecttype($objectid, $user){
                            $con = $this->start_connect();
                            $return = false;
                            $query = "UPDATE `object_type` SET `status` = '0' WHERE `object_type`.`id` = '".$objectid."';";
                            
                            $result = mysqli_query($con, $query);
                            if($result){
                                $return = true;
                            }
                            $this->close_connect($con);
                            return $return;
                        }
                        function get_objecttypedata($objectid){
                            $con = $this->start_connect();
                            $return = array();
                            $name = "";
                            $desc = "";
                            $status = 2;
                            $query = "SELECT * FROM `object_type` WHERE `object_type`.`id`='".$objectid."';";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while($row = mysqli_fetch_array($result)){
                                    $name = $row['name'];
                                    $desc = $row['desc'];
                                    $status = $row['status'];
                                }
                            }
                            $return = array($name, $desc, $status);
                            $this->close_connect($con);
                            return $return;
                        }
                        function get_objecttypelist(){
                            $con = $this->start_connect();
                            $return = array();
                            $query = "SELECT * FROM `object_type` WHERE `object_type`.`status`<>'0';";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while($row = mysqli_fetch_array($result)){
                                    array_push($return, array($row['id'],$row['name'],$row['desc'],$row['status']));
                                }
                            }
                            $this->close_connect($con);
                            return $return;                            
                        }
	}
?>