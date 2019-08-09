<?php
  $conn = new mysqli("localhost","root","root","crud");
  if($conn->connect_error){
    die("Could not able to connect with Database". $conn->connect_error);
  }
  
  $result = array('error'=>false);
  $action ='';

  if(isset($_GET['action'])){
      $action = $_GET['action'];
  }
 



  if($action == 'read'){
        $sql = $conn->query("select * from crud_vuetable");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users , $row);
        }

        $result['users'] = $users;

  }


  /*------For Inserting Data to db------------*/
  if($action == 'create')
  {

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = $conn->query("Insert into crud_vuetable(name,email,phone) values('$name','$email','$phone')");
    if($sql){
        $result['message'] = "User Added Successfully ! ";
    }else{
        $result['error'] = true;
        $result['message'] = "This Email Id is already added!..Try with different email id";
    }
  }


  /*------For Update Data to db------------*/
  if($action == 'update')
  {
    $id = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = $conn->query("Update crud_vuetable set name ='$name' , email ='$email' , phone = '$phone'  where id = '$id' ");
    if($sql){
        $result['message'] = "User Updated Successfully ! ";
    }else{
        $result['error'] = true;
        $result['message'] = "Fail to Update user ! ";
    }
  }


  /*------For Delete Data to db------------*/
  if($action == 'delete')
  {
    $id = $_POST['id'];
    $sql = $conn->query("delete from crud_vuetable where id = '$id' ");
    if($sql){
        $result['message'] = "User Deleted Successfully ! ";
    }else{
        $result['error'] = true;
        $result['message'] = "Fail to Delete user ! ";
    }
  }




  $conn->close();
  echo json_encode($result);








?>