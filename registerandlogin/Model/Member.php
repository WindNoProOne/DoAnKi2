<?php

class Member
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->ds = new DataSource();
    }
    public function isUsernameExists($username)
    {
        $query = 'SELECT * FROM tbUser_Account where username = ?';
        $paramType = 's';
        $paramValue = array($username);
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    public function isEmailExists($email)
    {
        $query = 'SELECT * FROM tbUser_Account where email = ?';
        $paramType = 's';
        $paramValue = array($email);
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    public function registerMember()
    {
        $isUsernameExists = $this->isUsernameExists($_POST["username"]);
        $isEmailExists = $this->isEmailExists($_POST["email"]);
        if ($isUsernameExists) {
            $response = array(
                "status" => "error",
                "message" => "Username already exists."
            );
        } else if ($isEmailExists) {
            $response = array(
                "status" => "error",
                "message" => "Email already exists."
            );
        } else {
            $query = 'INSERT INTO tbUser_Account (username, password, fullname, email, phonenumber) VALUES (?, ?, ?, ?, ?)';
            $paramType = 'sssss';
            $paramValue = array(
                $_POST["username"],
                $_POST["signup-password"],
                $_POST["fullname"],
                $_POST["email"],
                $_POST["phonenum"]               
            );
            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            $query = 'INSERT INTO tbdelivery_address (userid, address, is_default) VALUES (LAST_INSERT_ID(), ?,1)';
            $paramType = 's';
            $paramValue = array(
                $_POST["address"]
            );
            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            if (!empty($memberId)) {
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                );
            }
        }
        return $response;
    }

    public function getMember($username)
    {
        $query = 'SELECT * FROM tbUser_Account where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }
    public function loginMember()
    {
        $memberRecord = $this->getMember($_POST["username"]);
        $loginPassword = 0;
        if (! empty($memberRecord)) {
            if (! empty($_POST["login-password"])) {
                $password = $_POST["login-password"];
            }
            $userPassword = $memberRecord[0]["Password"];
            $loginPassword = 0;
            if ($userPassword == $password) {
                $loginPassword = 1;
            }
        } else {
            $loginPassword = 0;
        }
        if (($loginPassword == 1) && ($memberRecord[0]["Status"] == true)) {
            session_start();
            $_SESSION["username"] = $memberRecord[0]["UserName"];
            session_write_close();
            $url = "./home.php";
            header("Location: $url");
        
        } else if ($loginPassword == 1 && ($memberRecord[0]["Status"] == false)) {
            $loginStatus = "Your account is blocked.";
            return $loginStatus;
        } else {
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }
}
