<?php
include_once 'Database.php';

class Religion{

    private $id, $name;

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

    public static function getReligion($where=null){
        $dado = Database::ReadOne("religion", "*", $where);
        if(!$dado){
            return '';
        }
        $religion = new Religion();
        $religion->setId($dado['ID_RELIGION']);
        $religion->setName($dado['NAME_RELIGION']);

        return $religion;
    }

    public static function getReligions(){
        $dados = Database::ReadAll("religion", "*");
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $religion = new Religion();
            $religion->setId($dado['ID_RELIGION']);
            $religion->setName($dado['NAME_RELIGION']);
            $religions[] = $religion;
        }

        return $religions;
    }

}