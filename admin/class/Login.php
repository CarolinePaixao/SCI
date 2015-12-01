<?php
include_once 'Database.php';
/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 18/10/2015
 * Time: 17:49
 */
class Login
{

    private $id, $user, $pass, $role;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }


    public static function getLogin($person){
        $dado = Database::ReadOne("login", "*", "WHERE id_person = $person");
        if(!$dado){
            return '';
        }
        $log = new Login();
        $log->setId($dado['ID_LOGIN']);
        $log->setUser($dado['USER_NAME']);
        $log->setPass($dado['USER_PASS']);
        $log->setRole($dado['ROLE']);

        return $log;
    }

}