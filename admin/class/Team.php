<?php
include_once 'Calebe.php';
/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 16/09/2015
 * Time: 19:08
 */
class Team
{
    private $id, $name, $leader, $members, $status;

    public function __construct(){
        $this->leader = new Calebe();
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
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param mixed $members
     */
    public function setMembers($members)
    {
        $this->members = $members;
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


    public static function getMembersTeam($id_team){
        $dados = Database::ReadAll("team_calebe tc", "tc.*", "WHERE tc.id_team = $id_team");
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $calebe = Calebe::getCalebe("AND c.id_person = ".$dado['ID_CALEBE']);
            $calebes[] = $calebe;
        }

        return $calebes;

    }



    public static function getTeam($where=null){
        $dado = Database::ReadOne("team t", "t.*", $where);
        if(!$dado){
            return '';
        }
        $team = new Team();
        $team->setId($dado['ID_TEAM']);
        $team->setName($dado['NAME_TEAM']);
        $team->setStatus($dado['STATUS']);

        $calebe = Calebe::getCalebe("AND c.id_person = ".$dado['ID_LEADER']);
        $team->setLeader($calebe);

        $team->setMembers(Team::getMembersTeam($team->getId()));

        return $team;
    }

    public static function getTeams(){
        $dados = Database::ReadAll("team t", "t.*");
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $team = new Team();
            $team->setId($dado['ID_TEAM']);
            $team->setName($dado['NAME_TEAM']);
            $team->setStatus($dado['STATUS']);

            $calebe = Calebe::getCalebe("AND c.id_person = ".$dado['ID_LEADER']);
            $team->setLeader($calebe);

            $team->setMembers(Team::getMembersTeam($team->getId()));

            $teams[] = $team;
        }

        return $teams;
    }
}