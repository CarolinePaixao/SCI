<?php

/**
 * Created by PhpStorm.
 * User: Caroline
 * Date: 19/08/2015
 * Time: 20:25
 */
class Address
{
    private $id, $zipcode, $street, $number, $district, $complement, $city, $state, $ps, $latitude, $longitude;


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
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }

    /**
     * @return mixed
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param mixed $complement
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getPs()
    {
        return $this->ps;
    }

    /**
     * @param mixed $ps
     */
    public function setPs($ps)
    {
        $this->ps = $ps;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }



    public static function getAddress($where=null){
        $dados = Database::ReadOne("address a, city c, states s", "a.*, c.*, s.*", "WHERE a.id_city = c.id_city AND c.id_state = s.id_state ".$where);
        if(!$dados){
            return '';
        }

        $address = new Address();
        $address->setId($dados['ID_ADDRESS']);
        $address->setZipcode($dados['ZIPCODE']);
        $address->setStreet($dados['NAME_ADDRESS']);
        $address->setNumber($dados['NUMBER']);
        $address->setComplement($dados['COMPLEMENT']);
        $address->setDistrict($dados['DISTRICT']);
        $address->setLatitude($dados['LATITUDE']);
        $address->setLongitude($dados['LONGITUDE']);
        $address->setCity($dados['NAME_CITY']);
        $address->setState($dados['INITIALS']);
        $address->setPs($dados['PS']);

        return $address;
    }

    public static function getAddresses($where=null){
        $dados = Database::ReadAll("address a, city c, state s", "a.*, c.*, s.*", "WHERE a.id_city = c.id_city AND s.id_state = c.id_state ".$where);
        if(!$dados){
            return '';
        }
        foreach($dados as $dado){
            $address = new Address();
            $address->setId($dado['ID_ADDRESS']);
            $address->setStreet($dado['NAME_ADDRESS']);
            $address->setNumber($dado['NUMBER']);
            $address->setComplement($dado['COMPLEMENT']);
            $address->setDistrict($dado['DISTRICT']);
            $address->setLatitude($dados['LATITUDE']);
            $address->setLongitude($dados['LONGITUDE']);
            $address->setCity($dado['NAME_CITY']);
            $address->setState($dado['INITIALS']);
            $address->setPs($dado['PS']);

            $addresses[] = $address;
        }

        return $addresses;
    }
}