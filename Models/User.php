<?php

class User
{
      public function getUser($user_login, $db){
        $sql = "SELECT * FROM users
            WHERE user_login = :user_login ";
        $pst = $db->prepare($sql);
        $pst->bindParam(':user_login', $user_login);
        $pst->execute();

        $user =  $pst->fetch(PDO::FETCH_OBJ);

        return $user;
    }
    public function addUser($user_login, $user_password, $db)
    {
        $sql = "INSERT INTO users (user_login, user_password) 
              VALUES (:user_login, :user_password) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':user_login', $user_login);
        $pst->bindParam(':user_password', $user_password);

        $user = $pst->execute();

        return $user;
    }
}

    