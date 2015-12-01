<?php
include_once 'Database.php';
include_once 'Person.php';
/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 24/08/2015
 * Time: 21:02
 */
class Calebe extends Person
{
    private $timeStudy, $leader, $baptism, $status;


    /**
     * @return mixed
     */
    public function getTimeStudy()
    {
        return $this->timeStudy;
    }

    /**
     * @param mixed $timeStudy
     */
    public function setTimeStudy($timeStudy)
    {
        $this->timeStudy = $timeStudy;
    }

    /**
     * @return mixed
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * @param mixed $leader
     */
    public function setLeader($leader)
    {
        $this->leader = $leader;
    }

    /**
     * @return mixed
     */
    public function getBaptism()
    {
        return $this->baptism;
    }

    /**
     * @param mixed $baptism
     */
    public function setBaptism($baptism)
    {
        $this->baptism = $baptism;
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

    public static function getCalebe($where=null){
        $dado = Database::ReadOne("calebe c, person p", "c.*, p.*", "WHERE p.id_person = c.id_person ".$where);
        if(!$dado){
            return '';
        }
        $calebe = new Calebe();
        $calebe->setId($dado['ID_PERSON']);
        $calebe->setName($dado['NAME_PERSON']);
        $calebe->setEmail($dado['EMAIL']);
        $calebe->setAge($dado['AGE']);
        $calebe->setSex($dado['SEX']);
        $calebe->setPhone($dado['PHONE']);
        $calebe->setOperator($dado['OPERATOR']);
        $calebe->setMaritalStatus($dado['MARITAL_STATUS']);
        $calebe->setChildren($dado['CHILDREN']);
        $calebe->setBaptism($dado['BAPTISM']);
        $calebe->setLeader($dado['LEADER']);
        $calebe->setTimeStudy($dado['TIME_STUDY']);
        $calebe->setDateInsert($dado['INSERT_DATE']);

        $calebe->setLeader($dado['LEADER']);
        $calebe->setTimeStudy($dado['TIME_STUDY']);
        $calebe->setBaptism($dado['BAPTISM']);
        $calebe->setStatus($dado['STATUS']);

        $religion = Religion::getReligion("WHERE id_religion = ".$dado['ID_RELIGION']);
        $calebe->setReligion($religion);

        $address = Address::getAddress("AND id_address = ".$dado['ID_ADDRESS']);
        $calebe->setAddress($address);

        $login = Login::getLogin($dado['ID_PERSON']);
        $calebe->setLogin($login);

        return $calebe;
    }

    public static function getCalebes(){
        $dados = Database::ReadAll("calebe c, person p", "c.*, p.*", "WHERE p.id_person = c.id_person AND c.leader = 1");
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $calebe = new Calebe();
            $calebe->setId($dado['ID_PERSON']);
            $calebe->setName($dado['NAME_PERSON']);
            $calebe->setEmail($dado['EMAIL']);
            $calebe->setAge($dado['AGE']);
            $calebe->setSex($dado['SEX']);
            $calebe->setPhone($dado['PHONE']);
            $calebe->setOperator($dado['OPERATOR']);
            $calebe->setMaritalStatus($dado['MARITAL_STATUS']);
            $calebe->setChildren($dado['CHILDREN']);
            $calebe->setBaptism($dado['BAPTISM']);
            $calebe->setLeader($dado['LEADER']);
            $calebe->setTimeStudy($dado['TIME_STUDY']);
            $calebe->setStatus($dado['STATUS']);
            $calebe->setDateInsert($dado['INSERT_DATE']);

            $religion = Religion::getReligion("WHERE id_religion = ".$dado['ID_RELIGION']);
            $calebe->setReligion($religion);

            $address = Address::getAddress("AND id_address = ".$dado['ID_ADDRESS']);
            $calebe->setAddress($address);

            $login = Login::getLogin($dado['ID_PERSON']);
            $calebe->setLogin($login);

            $calebes[] = $calebe;
        }

        return $calebes;
    }

    public static function getLeaders(){
        $dados = Database::ReadAll("calebe c, person p", "c.*, p.*", "WHERE p.id_person = c.id_person AND c.leader = 2");
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $calebe = new Calebe();
            $calebe->setId($dado['ID_PERSON']);
            $calebe->setName($dado['NAME_PERSON']);
            $calebe->setEmail($dado['EMAIL']);
            $calebe->setAge($dado['AGE']);
            $calebe->setSex($dado['SEX']);
            $calebe->setPhone($dado['PHONE']);
            $calebe->setOperator($dado['OPERATOR']);
            $calebe->setMaritalStatus($dado['MARITAL_STATUS']);
            $calebe->setChildren($dado['CHILDREN']);
            $calebe->setBaptism($dado['BAPTISM']);
            $calebe->setLeader($dado['LEADER']);
            $calebe->setTimeStudy($dado['TIME_STUDY']);
            $calebe->setStatus($dado['STATUS']);
            $calebe->setDateInsert($dado['INSERT_DATE']);

            $religion = Religion::getReligion("WHERE id_religion = ".$dado['ID_RELIGION']);
            $calebe->setReligion($religion);

            $address = Address::getAddress("AND id_address = ".$dado['ID_ADDRESS']);
            $calebe->setAddress($address);

            $login = Login::getLogin($dado['ID_PERSON']);
            $calebe->setLogin($login);

            $calebes[] = $calebe;
        }

        return $calebes;
    }


}