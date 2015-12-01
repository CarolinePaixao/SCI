<?php
include_once 'Research.php';
include_once 'Person.php';

/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 27/08/2015
 * Time: 14:06
 */
class Resident extends Person
{
    private $numberResident, $houseFather, $cognateAdventista, $research;

    /**
     * @return mixed
     */
    public function getNumberResident()
    {
        return $this->numberResident;
    }

    /**
     * @param mixed $numberResident
     */
    public function setNumberResident($numberResident)
    {
        $this->numberResident = $numberResident;
    }

    /**
     * @return mixed
     */
    public function getHouseFather()
    {
        return $this->houseFather;
    }

    /**
     * @param mixed $houseFather
     */
    public function setHouseFather($houseFather)
    {
        $this->houseFather = $houseFather;
    }

    /**
     * @return mixed
     */
    public function getCognateAdventista()
    {
        return $this->cognateAdventista;
    }

    /**
     * @param mixed $cognateAdventista
     */
    public function setCognateAdventista($cognateAdventista)
    {
        $this->cognateAdventista = $cognateAdventista;
    }

    /**
     * @return mixed
     */
    public function getResearch()
    {
        return $this->research;
    }

    /**
     * @param mixed $research
     */
    public function setResearch($research)
    {
        $this->research = $research;
    }

    public static function getResidents()
    {
        $dados = Database::ReadAll("resident m, person p", "m.*, p.*", "WHERE p.id_person = m.id_person");
        if (!$dados) {
            return '';
        }
        foreach ($dados as $dado) {
            $resident = new Resident();
            $resident->setId($dado['ID_PERSON']);
            $resident->setName($dado['NAME_PERSON']);
            $resident->setEmail($dado['EMAIL']);
            $resident->setAge($dado['AGE']);
            $resident->setSex($dado['SEX']);
            $resident->setPhone($dado['PHONE']);
            $resident->setOperator($dado['OPERATOR']);
            $resident->setMaritalStatus($dado['MARITAL_STATUS']);
            $resident->setChildren($dado['CHILDREN']);
            $resident->setDateInsert($dado['INSERT_DATE']);

            $resident->setNumberResident($dado['NUMBER_RESIDENT_HOUSE']);
            $resident->setHouseFather($dado['HOUSEFATHER']);
            $resident->setCognateAdventista($dado['COGNATE_ADVENTISTA']);

            $religion = Religion::getReligion("WHERE id_religion = " . $dado['ID_RELIGION']);
            $resident->setReligion($religion);

            $address = Address::getAddress("AND id_address = " . $dado['ID_ADDRESS']);
            $resident->setAddress($address);

            $research = Research::getResearch('WHERE id_resident = '.$dado['ID_PERSON']);
            $resident->setResearch($research);

            $residents[] = $resident;
        }

        return $residents;
    }

    public static function getResident($where){
        $dado = Database::ReadOne("resident r, person p", "r.*, p.*", "WHERE p.id_person = r.id_person $where");
        if(!$dado){
            return '';
        }

        $resident = new Resident();
        $resident->setId($dado['ID_PERSON']);
        $resident->setName($dado['NAME_PERSON']);
        $resident->setEmail($dado['EMAIL']);
        $resident->setAge($dado['AGE']);
        $resident->setSex($dado['SEX']);
        $resident->setPhone($dado['PHONE']);
        $resident->setOperator($dado['OPERATOR']);
        $resident->setMaritalStatus($dado['MARITAL_STATUS']);
        $resident->setChildren($dado['CHILDREN']);
        $resident->setDateInsert($dado['INSERT_DATE']);

        $resident->setNumberResident($dado['NUMBER_RESIDENT_HOUSE']);
        $resident->setHouseFather($dado['HOUSEFATHER']);
        $resident->setCognateAdventista($dado['COGNATE_ADVENTISTA']);

        $religion = Religion::getReligion("WHERE id_religion = ".$dado['ID_RELIGION']);
        $resident->setReligion($religion);

        $address = Address::getAddress("AND id_address = ".$dado['ID_ADDRESS']);
        $resident->setAddress($address);

        $research = Research::getResearch('WHERE id_resident = '.$dado['ID_PERSON']);
        $resident->setResearch($research);

        return $resident;

    }
}