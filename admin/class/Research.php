<?php
include_once 'Database.php';

/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 29/09/2015
 * Time: 15:11
 */
class Research
{

    private $id, $timeFe, $knowIasd, $iasdVisit, $iasdBack, $iasdLocal, $considerAdventista, $opnionAdventista, $opnionIasd, $opnionReason,
        $knowSignification, $knowDesbravadores, $knowAventureiros, $knowAdra, $opnionProjects, $knowTv, $programTv, $person, $dateResearch;

    /**
     * Research constructor.
     * @param $person
     */
    public function __construct()
    {
        $this->person = new Person();
        $this->resident = new Resident();
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
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return mixed
     */
    public function getTimeFe()
    {
        return $this->timeFe;
    }

    /**
     * @param mixed $timeFe
     */
    public function setTimeFe($timeFe)
    {
        $this->timeFe = $timeFe;
    }

    /**
     * @return mixed
     */
    public function getKnowIasd()
    {
        return $this->knowIasd;
    }

    /**
     * @param mixed $knowIasd
     */
    public function setKnowIasd($knowIasd)
    {
        $this->knowIasd = $knowIasd;
    }

    /**
     * @return mixed
     */
    public function getIasdVisit()
    {
        return $this->iasdVisit;
    }

    /**
     * @param mixed $iasdVisit
     */
    public function setIasdVisit($iasdVisit)
    {
        $this->iasdVisit = $iasdVisit;
    }

    /**
     * @return mixed
     */
    public function getIasdBack()
    {
        return $this->iasdBack;
    }

    /**
     * @param mixed $iasdBack
     */
    public function setIasdBack($iasdBack)
    {
        $this->iasdBack = $iasdBack;
    }

    /**
     * @return mixed
     */
    public function getIasdLocal()
    {
        return $this->iasdLocal;
    }

    /**
     * @param mixed $iasdLocal
     */
    public function setIasdLocal($iasdLocal)
    {
        $this->iasdLocal = $iasdLocal;
    }

    /**
     * @return mixed
     */
    public function getConsiderAdventista()
    {
        return $this->considerAdventista;
    }

    /**
     * @param mixed $considerAdventista
     */
    public function setConsiderAdventista($considerAdventista)
    {
        $this->considerAdventista = $considerAdventista;
    }

    /**
     * @return mixed
     */
    public function getOpnionAdventista()
    {
        return $this->opnionAdventista;
    }

    /**
     * @param mixed $opnionAdventista
     */
    public function setOpnionAdventista($opnionAdventista)
    {
        $this->opnionAdventista = $opnionAdventista;
    }

    /**
     * @return mixed
     */
    public function getOpnionIasd()
    {
        return $this->opnionIasd;
    }

    /**
     * @param mixed $opnionIasd
     */
    public function setOpnionIasd($opnionIasd)
    {
        $this->opnionIasd = $opnionIasd;
    }

    /**
     * @return mixed
     */
    public function getOpnionReason()
    {
        return $this->opnionReason;
    }

    /**
     * @param mixed $opnionReason
     */
    public function setOpnionReason($opnionReason)
    {
        $this->opnionReason = $opnionReason;
    }

    /**
     * @return mixed
     */
    public function getKnowSignification()
    {
        return $this->knowSignification;
    }

    /**
     * @param mixed $knowSignification
     */
    public function setKnowSignification($knowSignification)
    {
        $this->knowSignification = $knowSignification;
    }

    /**
     * @return mixed
     */
    public function getKnowDesbravadores()
    {
        return $this->knowDesbravadores;
    }

    /**
     * @param mixed $knowDesbravadores
     */
    public function setKnowDesbravadores($knowDesbravadores)
    {
        $this->knowDesbravadores = $knowDesbravadores;
    }

    /**
     * @return mixed
     */
    public function getKnowAventureiros()
    {
        return $this->knowAventureiros;
    }

    /**
     * @param mixed $knowAventureiros
     */
    public function setKnowAventureiros($knowAventureiros)
    {
        $this->knowAventureiros = $knowAventureiros;
    }

    /**
     * @return mixed
     */
    public function getKnowAdra()
    {
        return $this->knowAdra;
    }

    /**
     * @param mixed $knowAdra
     */
    public function setKnowAdra($knowAdra)
    {
        $this->knowAdra = $knowAdra;
    }

    /**
     * @return mixed
     */
    public function getOpnionProjects()
    {
        return $this->opnionProjects;
    }

    /**
     * @param mixed $opnionProjects
     */
    public function setOpnionProjects($opnionProjects)
    {
        $this->opnionProjects = $opnionProjects;
    }

    /**
     * @return mixed
     */
    public function getKnowTv()
    {
        return $this->knowTv;
    }

    /**
     * @param mixed $knowTv
     */
    public function setKnowTv($knowTv)
    {
        $this->knowTv = $knowTv;
    }

    /**
     * @return mixed
     */
    public function getProgramTv()
    {
        return $this->programTv;
    }

    /**
     * @param mixed $programTv
     */
    public function setProgramTv($programTv)
    {
        $this->programTv = $programTv;
    }

    /**
     * @return mixed
     */
    public function getDateResearch()
    {
        return $this->dateResearch;
    }

    /**
     * @param mixed $dateResearch
     */
    public function setDateResearch($dateResearch)
    {
        $dateResearch = substr($dateResearch, 8,2).'/'.substr($dateResearch, 5,2).'/'.substr($dateResearch, 0,4)
                        . ' às '.substr($dateResearch, 11, 5) ;
        $this->dateResearch = $dateResearch;
    }

    /**
     * @param $where
     * @return bool
     */
    public static function  getResearch($where){
        $dado = Database::ReadOne('research', '*', $where);

        if(!$dado)
            return false;

        $research = new Research();
        $research->setId($dado['ID_RESEARCH']);
        $research->setConsiderAdventista($dado['CONSIDER_ADVENTISTA']);
        $research->setIasdBack($dado['IASD_BACK']);
        $research->setIasdLocal($dado['IASD_LOCAL']);
        $research->setIasdVisit($dado['IASD_VISIT']);
        $research->setKnowAdra($dado['KNOW_ADRA']);
        $research->setKnowAventureiros($dado['KNOW_AVENTUREIRO']);
        $research->setKnowDesbravadores($dado['KNOW_DESBRAVADOR']);
        $research->setKnowIasd($dado['KNOW_IASD']);
        $research->setKnowSignification($dado['KNOW_SIGNIFICATION']);
        $research->setOpnionAdventista($dado['OPNION_ADVENTISTA']);
        $research->setOpnionIasd($dado['OPNION_IASD']);
        $research->setOpnionProjects($dado['OPNION_PROJECTS']);
        $research->setOpnionReason($dado['OPNION_REASON']);
        $research->setTimeFe($dado['TIME_FE']);
        $research->setKnowTv($dado['KNOW_TVNOVOTEMPO']);
        $research->setProgramTv($dado['PROGRAM_TV']);
        $research->setDateResearch($dado['INSERT_DATE']);

        $log = Database::ReadOne('login', '*', 'WHERE id_login = '.$dado['ID_LOGIN']);
        $person = Person::getPerson('WHERE id_person = '.$log['ID_PERSON']);
        $research->setPerson($person);

        return $research;
    }

    public static function existResearch($id){

        $one = Database::ReadOne('research', '*', 'WHERE id_resident = '.$id);
        if($one){
            return true;
        }else{
            return false;
        }

    }
}