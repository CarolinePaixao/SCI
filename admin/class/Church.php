<?php
include_once 'Database.php';
include_once 'Address.php';
/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 16/09/2015
 * Time: 19:12
 */
class Church
{
    private $id, $name, $pastor, $address, $status;

    public function __construct(){
        $this->address = new Address();
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
    public function getPastor()
    {
        return $this->pastor;
    }

    /**
     * @param mixed $pastor
     */
    public function setPastor($pastor)
    {
        $this->pastor = $pastor;
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
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public static function getChurch($where=null){
        $dado = Database::ReadOne("church", " *", $where);
        if(!$dado){
            return '';
        }
        $church = new Church();
        $church->setId($dado['ID_CHURCH']);
        $church->setName($dado['NAME_CHURCH']);
        $church->setPastor($dado['NAME_PASTOR']);
        $church->setStatus($dado['STATUS']);

        $address = Address::getAddress('AND a.id_address = '.$dado['ID_ADDRESS']);
        $church->setAddress($address);

        return $church;
    }

    public static function getChurches(){
        $dados = Database::ReadAll("church", "*");
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $church = new Church();
            $church->setId($dado['ID_CHURCH']);
            $church->setName($dado['NAME_CHURCH']);
            $church->setPastor($dado['NAME_PASTOR']);
            $church->setStatus($dado['STATUS']);

            $address = Address::getAddress('AND a.id_address = '.$dado['ID_ADDRESS']);
            $church->setAddress($address);

            $churches[] = $church;
        }

        return $churches;
    }


}