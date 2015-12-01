<?php
include_once "Address.php";
include_once "Religion.php";
include_once "Login.php";
/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 19/08/2015
 * Time: 20:15
 */

class Person
{
    private $id, $name, $age, $sex, $email, $phone, $operator, $maritalStatus, $children, $religion, $address, $login, $dateInsert;

    /**
     * Person constructor.
     */
    public function __construct()
    {
        $this->address = new Address();
        $this->religion = new Religion();
        $this->login = new Login();
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return mixed
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param mixed $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return mixed
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * @param mixed $religion
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return Login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param Login $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * @param mixed $dateInsert
     */
    public function setDateInsert($dateInsert)
    {
        $dateInsert = substr($dateInsert, 8,2).'/'.substr($dateInsert, 5,2).'/'.substr($dateInsert, 0,4).' às '.substr($dateInsert, 11, 5);
        $this->$dateInsert = $dateInsert;
    }

    public static function getPerson($where){
        $dado = Database::ReadOne("person", "*", $where);
        if(!$dado){
            return '';
        }
        $person = new Person();
        $person->setId($dado['ID_PERSON']);
        $person->setName($dado['NAME_PERSON']);
        $person->setEmail($dado['EMAIL']);
        $person->setAge($dado['AGE']);
        $person->setSex($dado['SEX']);
        $person->setPhone($dado['PHONE']);
        $person->setOperator($dado['OPERATOR']);
        $person->setMaritalStatus($dado['MARITAL_STATUS']);
        $person->setChildren($dado['CHILDREN']);
        $person->setDateInsert($dado['INSERT_DATE']);

        $religion = Religion::getReligion("WHERE id_religion = ".$dado['ID_RELIGION']);
        $person->setReligion($religion);

        $address = Address::getAddress("AND id_address = ".$dado['ID_ADDRESS']);
        $person->setAddress($address);

        $login = Login::getLogin($dado['ID_PERSON']);
        $person->setLogin($login);

        return $person;
    }

    public static function getPersons(){
        $dados = Database::ReadAll("person", "*");
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $person = new Person();
            $person->setId($dado['ID_PERSON']);
            $person->setName($dado['NAME_PERSON']);
            $person->setEmail($dado['EMAIL']);
            $person->setAge($dado['AGE']);
            $person->setSex($dado['SEX']);
            $person->setPhone($dado['PHONE']);
            $person->setOperator($dado['OPERATOR']);
            $person->setMaritalStatus($dado['MARITAL_STATUS']);
            $person->setChildren($dado['CHILDREN']);

            $religion = Religion::getReligion("WHERE id_religion = ".$dado['ID_RELIGION']);
            $person->setReligion($religion);

            $address = Address::getAddress("AND id_address = ".$dado['ID_ADDRESS']);
            $person->setAddress($address);

            $login = Login::getLogin($dado['ID_PERSON']);
            $person->setLogin($login);

            $persons[] = $person;
        }

        return $persons;
    }
}