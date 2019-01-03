<?php
/**
 * @author Maicon Gonzales<maicon@maiscontrole.net>
 */
namespace MaikDatabase\Database;

class SetsBuilder {

    public $Query = array();

    /**
     * @param $select string Model.colun AS colun, JOIN.colun AS colun, this.*,
     */
    public function select($select){
        $this->Query["select"] = $select;
    }

    /**
     * @param $col string coluna
     * @param $val string valor
     * @param null $Model
     * @param string $operador string Operado = != etc
     * @param string $coma string AND OR etc
     * @param null $extraInit
     * @param null $extraEnd
     * @return $this
     */
    public function where($col, $val,  $Model = null,$operador = "=", $coma = "AND", $extraInit = null, $extraEnd = null){
        if (!isset($this->Query['where'])){
            $this->Query['where'] = array();
        }

        $colun = "%{$col}%";
        if (isset($this->Query['where']['query'])){
            $this->Query['where']['query'] .= "{$extraInit} {$coma} {$colun} {$operador} :val_{$col} {$extraEnd}";
        }else{
            $this->Query['where']['query'] = "{$extraInit} {$colun} {$operador} :val_{$col} {$extraEnd}";
        }

        $this->Query['where']['coluns'][$colun]["colun"] = $col;
        $this->Query['where']['bind'][":val_{$col}"] = $val;
        if (!is_null($Model)){
            $this->Query['where']['coluns'][$colun]["Model"] = $Model;
        }

        return $this;
    }

    /**
     * @param $col string coluna
     * @param $val string valor
     * @param string $operador stirng operador = != etc
     * @param null $Model
     * @param null $extraInit
     * @param null $extraEnd
     * @return $this
     */
    public function andWhere($col, $val, $operador = "=", $Model = null, $extraInit = null, $extraEnd = null){
        $this->where($col, $val, $Model, $operador, "AND", $extraInit, $extraEnd);
        return $this;
    }

    /**
     * @param $col string coluna
     * @param $val string valor
     * @param string $operador string operador = != etc
     * @param null $Model
     * @param null $extraInit
     * @param null $extraEnd
     * @return $this
     */
    public function orWhere($col, $val, $operador = "=", $Model = null, $extraInit = null, $extraEnd = null){
        $this->where($col, $val, $Model, $operador, "OR", $extraInit, $extraEnd);
        return $this;
    }

    /**
     * @param $col string nome da coluna
     * @param string $by ASC DESC
     * @return $this
     */
    public function order($col,$by = "ASC"){
        $this->Query['orderby'] = $by;
        $this->Query['ordercol'] = $col;
        return $this;
    }

    /**
     * @param $cols
     * @return $this
     */
    public function groupBy($cols){
        $this->Query['groupcol'] = $cols;
        return $this;
    }

    /**
     * @param $join string HasMany Ou HasOne configurado no Model
     * @return $this
     */
    public function leftJoin($join){
        $this->Query['leftjoin'][] = $join;
        return $this;
    }

    /**
     * @param $join string HasMany Ou HasOne configurado no Model
     * @return $this
     */
    public function rightJoin($join){
        $this->Query['rightjoin'][] = $join;
        return $this;
    }

    /**
     * @param $join string HasMany Ou HasOne configurado no Model
     * @return $this
     */
    public function innerJoin($join){
        $this->Query['innerjoin'][] = $join;
        return $this;
    }

    /**
     * @param $join string HasMany Ou HasOne configurado no Model
     * @return $this
     */
    public function join($join){
        $this->Query['join'][] = $join;
        return $this;
    }

    /**
     * @param $start int Inicio
     * @param null $end int Fim
     * @return $this
     */
    public function limit($start,$end = null){
        $this->Query['limit'] = $start;
        if (!is_null($end)){
            $this->Query['limit'] .= ",".$end;
        }
        return $this;
    }

    /**
     * @param $page int Pagína Atual
     * @param $per_page int Linhas por Páginha
     * @return $this
     */
    public function pagination($page, $per_page){
        $Pagination = null;
        if (!is_null($page)){
            $Pagination = [
                "per_page" => $per_page,
                "page" => $page ? $page : 1
            ];
        }
        if (!is_null($Pagination)){
            $this->Query['pagination'] = $Pagination;
        }
        return $this;
    }

    /**
     * @return array Configs to find
     */
    public function toArray(){
        return $this->Query;
    }
}