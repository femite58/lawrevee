<?php

session_start();

class User{

    public function isLogged(){

        if(isset($_SESSION['user'])){
            return true;
        }
        else{
            $this->logout();
        }
    }

    public function login($db,$MPAuthentication,$MPPassword){

        $MemSQL = "SELECT * FROM lrvmemprofile WHERE MPUserId = '$MPAuthentication' AND MPPassword = '$MPPassword'";
        $SQLRun = $db->query($MemSQL) or die(mysqli_error($db));

        if(mysqli_num_rows($SQLRun) < 1){
            return false;
        }
        else{
            $_SESSION['user'] = mysqli_fetch_assoc($SQLRun);
            return true;
        }
    }

    public function UsrProfile(){
        return $_SESSION['user'];
    }

    public function logout(){
    session_unset();
    session_destroy();

    header("Location: ../auth/index.php");

    }
}