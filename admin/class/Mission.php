<?php
include_once 'Church.php';
include_once 'Team.php';

/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 16/09/2015
 * Time: 19:10
 */

class Mission{
    private $id, $name, $dateBegin, $dateEnd, $church, $address, $team, $status;

    public function __construct(){
        $this->team = new Team();
        $this->address = new Address();
        $this->church = new Church();
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
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * @param mixed $dateBegin
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return mixed
     */
    public function getChurch()
    {
        return $this->church;
    }

    /**
     * @param mixed $church
     */
    public function setChurch($church)
    {
        $this->church = $church;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param mixed $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
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

    public static function getMission($where){
        $dado = Database::ReadOne("mission", "*", $where);
        if(!$dado){
            return '';
        }

        $mission = new Mission();

        $mission->setId($dado['ID_MISSION']);
        $mission->setName($dado['NAME_MISSION']);
        $mission->setDateBegin($dado['DATE_INICIAL']);
        $mission->setDateEnd($dado['DATE_END']);
        $mission->setStatus($dado['STATUS']);

        $team = Team::getTeam("WHERE id_team = ".$dado['ID_TEAM']);
        $mission->setTeam($team);

        if(!empty($dado['ID_ADDRESS'])) {
            $address = Address::getAddress("AND id_address = " . $dado['ID_ADDRESS']);
            $mission->setAddress($address);
        }

        if(!empty($dado['ID_CHURCH'])) {
            $church = Church::getChurch("WHERE id_church = " . $dado['ID_CHURCH']);
            $mission->setChurch($church);
        }

        return $mission;
    }

    public static function getMissions($where=null){
        $dados = Database::ReadAll("mission", "*", $where);
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $mission = new Mission();

            $mission->setId($dado['ID_MISSION']);
            $mission->setName($dado['NAME_MISSION']);
            $mission->setDateBegin($dado['DATE_INICIAL']);
            $mission->setDateEnd($dado['DATE_END']);
            $mission->setStatus($dado['STATUS']);

            $team = Team::getTeam("WHERE id_team = ".$dado['ID_TEAM']);
            $mission->setTeam($team);

            if(!empty($dado['ID_ADDRESS'])) {
                $address = Address::getAddress("AND id_address = " . $dado['ID_ADDRESS']);
                $mission->setAddress($address);
            }

            if(!empty($dado['ID_CHURCH'])) {
                $church = Church::getChurch("WHERE id_church = " . $dado['ID_CHURCH']);
                $mission->setChurch($church);
            }


            $missions[] = $mission;
        }

        return $missions;
    }

}