<?php
class Validador {

    public function __construct(){}

    public function empty($param) {
        return empty($param);
    }

    public function isset($param) {
        return isset($param);
    }

    public function isNull($param) {
        return is_null($param);
    }

    public function email($param) {
        return filter_var( $param, FILTER_VALIDATE_EMAIL);
    }

    public function isNumeric($param) {
        return is_numeric($param);
    }

    public function numeroMaximo($param, $maxNumber) {
        return $param > $maxNumber;
    }

    public function numeroMinimo($param, $minNumber) {
        return $param < $minNumber;
    }

    public function isNaN($param) {
        return is_nan($param);
    }

    public function url($param) {
        return filter_var( $param, FILTER_VALIDATE_URL );
    }

    public function tamanhoMaximo($param, $maxlength) {
        return strlen($param) > $maxlength;
    }

    public function tamanhoMinimo($param, $minlength) {
        return strlen($param) > $minlength;
    }

    public function somenteLetrasBr($param) {
        return preg_match("/^[a-zA-Z]*$/", $param);
    }

    public function dataValida($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return !empty($d) ? 1 : 0;
    }

    public function verificarDataMaior($date1, $date2) {
        return strtotime($data1) > strtotime($data2);
    }

    public function verificarDataMenor($date1, $date2) {
        return strtotime($data1) < strtotime($data2);
    }

    public function verificarDataIgual($date1, $date2) {
        return strtotime($data1) == strtotime($data2);
    }

    /**
       format::(Y-m-d)
        negativo = $data1 > $data2
        positivo = $data1 < $data2
        zero = $data1 == $data2
        return numerico
    */
    public function intervaloDatas($data1, $data2) {
        $hojeExplodido = explode('-', $data1);
        $hojeReordenado = $hojeExplodido[0] ."". $hojeExplodido[1] ."". $hojeExplodido[2];

        $dataXExplodido = explode('-', $data2);
        $dataXReordenado = $dataXExplodido[0] ."". $dataXExplodido[1] ."". $dataXExplodido[2];

        return $hojeReordenado - $dataXReordenado;
    }

}
