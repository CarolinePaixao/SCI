<?php
include_once 'Church.php';

class HistoryChurch{

    private $id, $church, $namePastor, $dateInicial, $dateFinal;

    /**
     * HistoryChurch constructor.
     * @param $church
     */
    public function __construct()
    {
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
    public function getNamePastor()
    {
        return $this->namePastor;
    }

    /**
     * @param mixed $namePastor
     */
    public function setNamePastor($namePastor)
    {
        $this->namePastor = $namePastor;
    }

    /**
     * @return mixed
     */
    public function getDateInicial()
    {
        return $this->dateInicial;
    }

    /**
     * @param mixed $dateInicial
     */
    public function setDateInicial($dateInicial)
    {
        $this->dateInicial = $dateInicial;
    }

    /**
     * @return mixed
     */
    public function getDateFinal()
    {
        return $this->dateFinal;
    }

    /**
     * @param mixed $dateFinal
     */
    public function setDateFinal($dateFinal)
    {
        if(!empty($dateFinal)) {
            $this->dateFinal = $dateFinal;
        }
    }

    public static function getHistory($where){
        $dado = Database::ReadOne('history', '*', $where);

        if(!$dado)
            return false;

        $history = new HistoryChurch();
        $history->setId($dado['ID_HISTORY']);
        $history->setNamePastor($dado['NAME_PASTOR']);

        $church = Church::getChurch("WHERE id_church = ".$dado['ID_CHURCH']);
        $history->setChurch($church);

        $history->setDateInicial($dado['DATE_INICIAL']);
        $history->setDateFinal($dado['DATE_FINAL']);

    }

    public static function getHistorys($where=null){
        $dados = Database::ReadAll('history', '*', $where);

        if(!$dados)
            return false;

        foreach ($dados as $dado) {
            $history = new HistoryChurch();
            $history->setId($dado['ID_HISTORY']);
            $history->setNamePastor($dado['NAME_PASTOR']);

            $church = Church::getChurch("WHERE id_church = ".$dado['ID_CHURCH']);
            $history->setChurch($church);

            $history->setDateInicial($dado['DATE_INICIAL']);
            $history->setDateFinal($dado['DATE_FINAL']);

            $historys[] = $history;
        }

        return $historys;

    }

}