<?php

namespace Services;

class DateService{

    /**
     * Retorna la fecha actual del servidor en formato Y-M-D
     *
     * @return String
     */
    public static function getCurrentDate() : String{
        return date("Y-m-d");
    }

    /**
     * Compara la primera fecha con una segunda fecha y retorna verdadero si la primera fecha es mayor
     *
     * @param String $date1
     * fecha base de la comparación
     * @param String $date2
     * fecha con que se compara la primera fecha
     * @return boolean
     */    
    public static function comparerDates(String $date1, String $date2) : bool{
        return (strtotime($date1) > strtotime($date2))? true : false;
    }

    /**
     * Retorna verdadero si la fecha actual es mayor a una fecha de ingreso
     *
     * @param String $date
     * Fecha a comparar
     * @return boolean
     */
    public static function comparerWithCurrentDate(String $date) : bool{
        return (strtotime(date("Y-m-d")) > strtotime($date))? true : false;
    }

    /**
     * Agrega un numero de dias a la fecha actual y retorna el resultado de la adición
     *
     * @param Int $numberDays
     * numero de dias a agregar
     * @return String
     */
    public static function addDaysToCurrentDate(Int $numberDays) : String{
        $currentDate = date("Y-m-d");
        $date = new \DateTime($currentDate);
        $date->add(new \DateInterval('P'.$numberDays.'D'));
        return $date->format("Y-m-d");
        // date_add($currentDate, date_interval_create_from_date_string($numberDays." days"));
        // return date_format($currentDate, "Y-m-d");
    }
    
    /**
     * Suma una cantidad de dias a una fecha determinada
     *
     * @param String $date
     * fecha base
     * @param Int $numberDays
     * numero de dias a agregar
     * @return String
     */
    public static function addDaysToDate(String $date, Int $numberDays) : String{
        date_add($date, date_interval_create_from_date_string($numberDays." days"));
        return date_format($date, "Y-m-d");
    }

}