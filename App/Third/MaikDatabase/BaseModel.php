<?php
/**
 * @author Maicon Gonzales<maicon@maiscontrole.net>
 */
namespace MaikDatabase;

use MaikDatabase\Database\Database;
use MaikDatabase\Database\SetsBuilder;

class BaseModel extends Property {

    const HASMANY = "many";
    const HASONE = "one";

    public $___table_name;
    public $___alias;
    public $___aliasTemp;

    public $___Coluns = [];
    public $___hasJoin = [];

    public $___primary;

    public $___aliasConsult = array();
    public $___aliasColun = array();

    public $___isAlone = false;

    /**
     * @var Database
     */
    public $___Connection;

    protected $___SqlQuery;
    protected $___Pagination;

    public $isOnCreateUpdateAt = false;
    const CREATEAT = "createAt";
    const UPDATEAT = "updateAt";

    /**
     * BaseModel constructor.
     */
    public function __construct(){
        $this->initTableDefinitions();
        $this->setupTable();
        $this->setConnection();
    }

    /**
     * Setar Conexão
     * @param null $key
     */
    public function setConnection($key = null){
        if (Settings::getInstance()->hasKey($key)) {
            $this->___Connection = Settings::getInstance()->getConnection($key);
        }else {
            $this->___Connection = Settings::getInstance()->getActiveConnection();
        }
    }

    /**
     * Obter conexão ativa
     * @return Database
     */
    public function getConnection(){
        return $this->___Connection;
    }

    /**
     * Setar tabela
     * @param $table
     */
    public function setTable($table){
        $this->___table_name = $table;
        $this->___alias = $this->alias();
    }

    /**
     * Alias do table
     * @return mixed
     */
    public function getAlias(){
        return $this->___alias;
    }

    /**
     * Pegar nome da tabela
     * @return mixed
     */
    public function getTableName(){
        return $this->___table_name;
    }

    /**
     * Adicionar Coluna
     * @param $key
     * @param $array
     */
    public function addColum($key, $array){
        $this->___Coluns[$key] = $array;
        if ($array["primary"]){
            $this->___primary = $key;
        }
    }

    /**
     * Setar JOIN
     * @param $Model
     * @param $array
     */
    public function hasJoin($Model, $array){
        $this->___hasJoin[$Model] = $array;
    }

    /**
     * Adicionar parametro em JOIN
     * @param $Model
     * @param $key
     * @param $array
     */
    public function addOnJoin($Model, $key, $array){
        $this->___hasJoin[$Model][$key] = $array;
    }

    /**
     * Inserir automaticamente data de inserção e atualização
     * @param $bool bool
     */
    public function setAutomaticDate($bool){
        $this->isOnCreateUpdateAt = $bool;
    }

    /**
     * Obter select da tabela
     * @return string
     */
    public function getTableSelect(){
        return $this->___table_name." ".$this->___alias;
    }

    /**
     * Obter alias de coluna
     * @param $col
     * @return string
     */
    public function getColunAlias($col){
        return $this->___alias.".".$col;
    }

    /**
     * Obter alias temporio de coluna
     * @param $col
     * @return string
     */
    public function getColunAliasTemp($col){
        return $this->___aliasTemp.".".$col;
    }

    /**
     * Obter WHERE para coluna
     * @param $col
     * @return string
     */
    public function getWhere($col){
        return $this->getColunAlias($col)." = :{$col}";
    }

    /**
     * Obter where sem alias
     * @param $col
     * @return string
     */
    public function getWhereNoAlias($col){
        return "{$col} = :{$col}";
    }

    /**
     * Obter todos campos da tabela com alias
     * @param $name
     * @param bool $concat
     * @return array
     */
    public function getFields($name){
        $this->___aliasTemp = $name;
        $Field = array();
        foreach ($this->___Coluns as $colun=>$other){
            $this->___aliasColun["{$name}__{$colun}"] = $colun;
            $this->___aliasConsult[$this->getColunAlias($colun)] = "{$name}__{$colun}";
            $Field[] = $this->getColunAlias($colun) . " AS {$name}__{$colun}";
        }
        return $Field;
    }

    /**
     * Obter Colunas
     * @return array
     */
    public function getColuns(){
        $Field = array();
        foreach ($this->___Coluns as $colun=>$other){
            $Field[] = $this->getColunAlias($colun);
        }
        return $Field;
    }

    /**
     * Adicionar coluna com alias
     * @param $colun
     */
    public function addFields($colun){
        $this->___aliasColun["{$this->___aliasTemp}__{$colun}"] = $colun;
        $this->___aliasConsult[$this->getColunAlias($colun)] = "{$this->___aliasTemp}__{$colun}";
    }

    /**
     * Obter coluna especifica de um alias
     * @param $colun
     * @return mixed
     */
    public function getField($colun){
        return $this->___aliasConsult[$this->getColunAlias($colun)];
    }

    /**
     * Obter nome da coluna sem alias
     * @param $colun
     * @return mixed
     */
    public function getFieldColunm($colun){
        return $this->___aliasColun["{$this->___aliasTemp}__{$colun}"];
    }

    /**
     * Pegar todos as colunas com alias
     * @return array
     */
    public function getAllFieldColunm(){
        return $this->___aliasColun;
    }

    /**
     * Obter a query completa
     * @return mixed
     */
    public function getSqlQuery(){
        return $this->___SqlQuery;
    }

    /**
     * Obter array da Paginação
     * @return mixed
     */
    public function getPagination(){
        return $this->___Pagination;
    }

    /**
     * Pegar construtor de query
     * @return SetsBuilder SetsBuilder class
     */
    public function getBuilder(){
        return new SetsBuilder();
    }

    /**
     * Salvar dado no banco
     * @throws \Exception
     */
    public function save(){
        $Keys = $this->uiyewyqueyewuqibcnsabh;

        $AutoIncrement = $this->___primary;
        foreach ($this->___Coluns as $colum=>$property) {
            if (!isset($Keys[$colum])){
                if (!$this->___isAlone && $property['auto_increment']){
                }else {
                    $Keys[$colum] = $property['default'];
                    $this->$colum = $property['default'];
                }
            }
            if ($this->isOnCreateUpdateAt && ((!$this->___isAlone && $colum == self::CREATEAT) or ($this->___isAlone && $colum == self::UPDATEAT))) {
                $Keys[$colum] = getDatetime();
                $this->$colum = $Keys[$colum];
            }
        }

        $Bind = array();
        foreach ($Keys as $key=>$value){
            if (!isset($this->___Coluns[$key])){
                throw new \Exception("Coluna {$key} não encontrada em {$this->___table_name}");
            }
            $Bind[$key] = $value;
        }

        if ($this->___isAlone){
            $this->___Connection->update($this->___table_name, $Bind, $this->getWhereNoAlias($AutoIncrement), array(':'.$AutoIncrement => $this->$AutoIncrement));
        }else{
            $this->$AutoIncrement = $this->___Connection->create($this->___table_name, $Bind);
            $this->___isAlone = true;
        }

    }

    /**
     * Atualizar dados no banco
     * @throws \Exception
     */
    public function saveEdit(){
        $Keys = $this->uiyewyqueyewuqibcnsabh;
        $AutoIncrement = $this->___primary;

        if ($this->isOnCreateUpdateAt && isset($this->___Coluns[self::UPDATEAT])){
            $Keys[self::UPDATEAT] = getDatetime();
        }

        $Bind = array();
        foreach ($Keys as $key=>$value){
            if (!isset($this->___Coluns[$key])){
                throw new \Exception("Coluna {$key} não encontrada em {$this->___table_name}");
            }
            $Bind[$key] = $value;
        }

        if ($this->___isAlone){
            $this->___Connection->update($this->___table_name, $Bind, $this->getWhereNoAlias($AutoIncrement), array(':'.$AutoIncrement => $this->$AutoIncrement));
        }
    }

    /**
     * Atualizar tabela
     * @param $where
     * @param $array
     */
    public function updateTable($where,$array){
        $this->___Connection->update($this->___table_name, $array, $where, array(':'.$this->___primary => $this->___primary));
    }

    /**
     * Procurar todos na tabela
     * @param null $other
     * @return array
     */
    public function find($other = null){
        $this->___isAlone = false;

        $BindValues = array();
        $this->___aliasConsult = array();
        $Fields = $this->getFields($this->alias());

        $isSelect = isset($other["select"]) ? true : false;
        $setSelect = isset($other["select"]) ? $other["select"] : null;
        $setReplace = [];
        if ($isSelect){
            $setSelect = str_replace("new.", "{$this->___aliasTemp}__", $setSelect);
            $setSelect = str_replace("this.", "{$this->___alias}.", $setSelect);
            $setReplace["{$this->___aliasTemp}__"] = "{$this->___aliasTemp}__";
        }

        $Joins = array();
        $left_joins = isset($other["leftjoin"]) ? $other["leftjoin"] : array();
        $right_joins = isset($other["rightjoin"]) ? $other["rightjoin"] : array();
        $inner_joins = isset($other["innerjoin"]) ? $other["innerjoin"] : array();
        $joins_joins = isset($other["join"]) ? $other["join"] : array();
        $all_joins = array_merge($left_joins, $right_joins, $inner_joins, $joins_joins);

        $AliasJoin = array();
        $AliasGet = array();

        foreach($left_joins as $join){
            $GetJoin = $this->createJoin($join);
            if (is_array($GetJoin)){
                $Fields = array_merge($Fields,$GetJoin['fields']);
                $Joins[] = $GetJoin['sql'];
                $AliasJoin[$join] = $GetJoin['alias'];
                if (!empty($GetJoin['alias_get'])) {
                    $AliasGet[$join] = $GetJoin['alias_get'];
                    if ($isSelect){
                        $setSelect = str_replace("{$join}.", "{$GetJoin['alias_get']}.", $setSelect);
                        $setSelect = str_replace("new.", "{$GetJoin['alias_temp']}__", $setSelect);
                        $setReplace["{$GetJoin['alias_temp']}__"] = "{$GetJoin['alias_temp']}__";
                    }
                }
            }
        }
        foreach($right_joins as $join){
            $GetJoin = $this->createJoin($join, "RIGHT");
            if (is_array($GetJoin)){
                $Fields = array_merge($Fields,$GetJoin['fields']);
                $Joins[] = $GetJoin['sql'];
                $AliasJoin[$join] = $GetJoin['alias'];
                if (!empty($GetJoin['alias_get'])) {
                    $AliasGet[$join] = $GetJoin['alias_get'];
                    if ($isSelect){
                        $setSelect = str_replace("{$join}.", "{$GetJoin['alias_get']}.", $setSelect);
                        $setSelect = str_replace("new.", "{$GetJoin['alias_temp']}__", $setSelect);
                        $setReplace["{$GetJoin['alias_temp']}__"] = "{$GetJoin['alias_temp']}__";
                    }
                }
            }
        }
        foreach($inner_joins as $join){
            $GetJoin = $this->createJoin($join,"INNER");
            if (is_array($GetJoin)){
                $Fields = array_merge($Fields,$GetJoin['fields']);
                $Joins[] = $GetJoin['sql'];
                $AliasJoin[$join] = $GetJoin['alias'];
                if (!empty($GetJoin['alias_get'])) {
                    $AliasGet[$join] = $GetJoin['alias_get'];
                    if ($isSelect){
                        $setSelect = str_replace("{$join}.", "{$GetJoin['alias_get']}.", $setSelect);
                        $setSelect = str_replace("new.", "{$GetJoin['alias_temp']}__", $setSelect);
                        $setReplace["{$GetJoin['alias_temp']}__"] = "{$GetJoin['alias_temp']}__";
                    }
                }
            }
        }
        foreach($joins_joins as $join){
            $GetJoin = $this->createJoin($join, "");
            if (is_array($GetJoin)){
                $Fields = array_merge($Fields, $GetJoin['fields']);
                $Joins[] = $GetJoin['sql'];
                $AliasJoin[$join] = $GetJoin['alias'];
                if (!empty($GetJoin['alias_get'])) {
                    $AliasGet[$join] = $GetJoin['alias_get'];
                    if ($isSelect){
                        $setSelect = str_replace("{$join}.", "{$GetJoin['alias_get']}.", $setSelect);
                        $setSelect = str_replace("new.", "{$GetJoin['alias_temp']}__", $setSelect);
                        $setReplace["{$GetJoin['alias_temp']}__"] = "{$GetJoin['alias_temp']}__";
                    }
                }
            }
        }

        $OrderKey = isset($other["orderby"]) ? " ".$other["orderby"] : " ASC";
        $OrderColun = isset($other["ordercol"]) ? "{$this->___aliasTemp}__{$other["ordercol"]}" : null;
        $GroupColun = isset($other["groupcol"]) ? "{$this->___aliasTemp}__{$other["groupcol"]}" : "{$this->___aliasTemp}__{$this->___primary}";

        $hasGroupSelect = isset($other["groupcol"]) && $isSelect ? true : false;

        $otherWhere = isset($other["where"]) ?  $other["where"] : null;

        $OrderBy = is_null($OrderColun) ? " " : " ORDER BY ".$OrderColun.$OrderKey ;
        $GroupBy = " ";

        if (!count($left_joins) == 0 or !count($right_joins) == 0 or !count($inner_joins) == 0 or !count($joins_joins) == 0){
            if (!$isSelect or ($isSelect && $hasGroupSelect))
                $GroupBy = " GROUP BY " . $GroupColun;
        }

        $Limit = isset($other["limit"]) ? "LIMIT {$other["limit"]}" : "";

        $Where = "";
        if (is_array($otherWhere)){
            $Values = array();
            foreach ($otherWhere['coluns'] as $key=>$colun){
                if (isset($colun['Model'])){
                    if (isset($AliasGet[$colun['Model']]))
                        $Values[] = $AliasGet[$colun['Model']].".".$colun['colun'];
                }else{
                    $Values[] = $this->getColunAlias($colun['colun']);
                }
            }
            $Query = str_replace(array_keys($otherWhere['coluns']), $Values, $otherWhere['query']);
            $Where .= " WHERE ".$Query;
            $BindValues = array_merge($BindValues, $otherWhere['bind']);
        }

        if (isset($other['pagination']) && is_array($other['pagination'])){
            $PerPage = isset($other['pagination']['per_page']) ? $other['pagination']['per_page'] : 10;
            $Page = isset($other['pagination']['page'])? $other['pagination']['page'] : 1;

            $this->addFields("totalrows");
            $CountSql = "SELECT COUNT(*) FROM " . $this->getTableSelect() . implode(' ', $Joins) . $Where;
            $Total = $this->___Connection->count($CountSql, $BindValues);
            $n = $Page+1;
            $p = $Page-1;
            $TotalPage =  ceil($Total/$PerPage);

            $this->___Pagination['total'] = $Total;
            $this->___Pagination['page'] = $Page;
            $this->___Pagination['total_page'] = $TotalPage;
            $this->___Pagination['next_page'] = $n > $TotalPage ? null : $n;
            $this->___Pagination['preview_page'] = $p < 1 ? null : $p;

            $offset = ($Page - 1)  * $PerPage;
            $start = $offset;
            $end = min(($offset + $PerPage), $Total);
            $Limit = "LIMIT ".$start.",".$end;

            $Start = $this->___Pagination["page"] - 5;
            $End = $this->___Pagination["page"] + 5;
            if ($Start <= 0){
                $Start = 1;
                $End += 5 - $this->___Pagination["page"];
            }
            if ($End > $this->___Pagination["total_page"]){
                $End = $this->___Pagination["total_page"];
            }
            $this->___Pagination['start_on'] = $Start;
            $this->___Pagination['end_on'] = $End;
        }

        $selectColuns = $isSelect ? $setSelect : implode(', ',$Fields);

        $this->___SqlQuery = "SELECT " . $selectColuns . " FROM " . $this->getTableSelect() . implode('', $Joins) . $Where. $GroupBy . $OrderBy ."".$Limit;
        $result = $this->___Connection->run($this->___SqlQuery, $BindValues);
        $result->setFetchMode(\PDO::FETCH_ASSOC);

        $rows = array();
        while($row = $result->fetch()) {
            $Data = array();
            foreach ($row as $key=>$value){
                if ($isSelect){
                    $Data[str_replace($setReplace,"", $key)] = $value;
                }else {
                    if (isset($this->___aliasColun[$key])) {
                        $Data[$this->___aliasColun[$key]] = $value;
                    }
                    if (count($all_joins) > 0)
                        foreach ($all_joins as $join) {
                            if (isset($AliasJoin[$join][$key])) {
                                $Data[$join][$AliasJoin[$join][$key]] = $value;
                                break;
                            }
                        }
                }
            }
            if (count($all_joins) > 0)
                foreach($all_joins as $join){
                    $Property = $this->___hasJoin[$join];
                    if ($Property["type"] == self::HASMANY){
                        $Model = $Property["class"];
                        $Class = new $Model();
                        $Find = "findBy".$Property['foreign'];
                        $others = isset($Property["other"]) ? $Property["other"] : null;
                        $Data[$join] = $Class->$Find($Data[$Property['local']],$others);
                    }
                }

            $rows[] = $Data;
        }
        return $rows;
    }

    /**
     * Procurar todos na tabela por coluna
     * @param $colun
     * @param $value
     * @param null $other
     * @return array
     * @throws \Exception
     */
    private function findBy($colun, $value, $other = null){
        $this->___isAlone = false;

        $original = $colun;
        if (!isset($this->___Coluns[$colun])){
            $colun = lcfirst($colun);
            if (!isset($this->___Coluns[$colun])){
                throw new \Exception("Coluna ".$original." não existe.");
            }
        }

        if ($other == null) {
            $Results = $this->___Connection->read($this->getTableSelect(), $this->getWhere($colun), array(":{$colun}" => $value), "{$this->___alias}.*");
            return $Results;
        }else{
            $BindValues = array(":{$colun}" => $value);

            $this->___aliasConsult = array();
            $Fields = $this->getFields($this->alias());
            $Joins = array();
            $left_joins = isset($other["leftjoin"]) ? $other["leftjoin"] : array();
            $AliasJoin = array();
            $AliasGet = array();


            foreach($left_joins as $join){
                $GetJoin = $this->createJoin($join);
                if (is_array($GetJoin)){
                    $Fields = array_merge($Fields,$GetJoin['fields']);
                    $Joins[] = $GetJoin['sql'];
                    $AliasJoin[$join] = $GetJoin['alias'];
                    if (!empty($GetJoin['alias_get']))
                        $AliasGet[$join] = $GetJoin['alias_get'];
                }
            }

            $OrderKey = isset($other["orderby"]) ? " ".$other["orderby"] : " ASC";
            $OrderColun = isset($other["ordercol"]) ? $this->___aliasConsult[$this->getColunAlias($other["ordercol"])] : $this->___aliasConsult[$this->getColunAlias($this->___primary)];
            $GroupColun = isset($other["groupcol"]) ? $this->___aliasConsult[$this->getColunAlias($other["groupcol"])] : $this->___aliasConsult[$this->getColunAlias($this->___primary)];

            $otherWhere = isset($other["where"]) ?  $other["where"] : null;

            $OrderBy = " ORDER BY ".$OrderColun.$OrderKey ;
            $GroupBy = " GROUP BY ".$GroupColun;
            $Limit = isset($other["limit"]) ? $this->___aliasConsult[$other["limit"]] : "";

            $Where = " WHERE ".$this->getWhere($colun)." ";
            if (is_array($otherWhere)){
                $Values = array();
                foreach ($otherWhere['coluns'] as $key=>$colun){
                    if (isset($colun['Model'])){
                        if (isset($AliasGet[$colun['Model']]))
                            $Values[] = $AliasGet[$colun['Model']].".".$colun['colun'];
                    }else{
                        $Values[] = $this->getColunAlias($colun['colun']);
                    }
                }
                $Query = str_replace(array_keys($otherWhere['coluns']), $Values,$otherWhere['query']);
                $Where .= "AND ".$Query;

                $BindValues = array_merge($BindValues, $otherWhere['bind']);
            }

            $this->___SqlQuery = "SELECT " . implode(', ',$Fields) . " FROM " . $this->getTableSelect() . implode(' ', $Joins) . $Where. $GroupBy . $OrderBy ." ".$Limit;

            $result = $this->___Connection->run($this->___SqlQuery, $BindValues);
            $result->setFetchMode(\PDO::FETCH_ASSOC);
            $rows = array();

            while($row = $result->fetch()) {
                $Data = array();
                foreach ($row as $key=>$value){
                    if (isset($this->___aliasColun[$key])){
                        $Data[$this->___aliasColun[$key]] = $value;
                    }
                    foreach($left_joins as $join){
                        if (isset($AliasJoin[$join][$key])){
                            $Data[$join][$AliasJoin[$join][$key]] = $value;
                            break;
                        }
                    }
                }
                foreach($left_joins as $join){
                    $Property = $this->___hasJoin[$join];
                    if ($Property["type"] == self::HASMANY){
                        $Model = $Property["class"];
                        $Class = new $Model();
                        $Find = "findBy".$Property['foreign'];
                        $Data[$join] = $Class->$Find($Data[$Property['local']]);
                    }
                }
                $rows[] = $Data;
            }
            return $rows;
        }
    }

    /**
     * Procurar um na tabela por coluna
     * @param $colun
     * @param $value
     * @param null $other
     * @return $this|null
     * @throws \Exception
     */
    private function findOneBy($colun, $value, $other = null){
        $Results = $this->getOne($colun, $value);
        if ($Results != null){
            foreach ($Results as $key=>$value){
                $this->$key = $value;
            }
            $this->___isAlone = true;
            return $this;
        }
        return null;
    }

    /**
     * Array para Model
     * @param $array
     * @return $this
     */
    public function toObject($array){
        foreach ($array as $key=>$value){
            $this->$key = $value;
        }
        $this->___isAlone = true;
        return $this;
    }

    /**
     * Contar linhas na tabela
     * @param null $other
     * @return mixed
     */
    public function count($other = null){
        $BindValues = array();
        $this->___aliasConsult = array();
        $Fields = $this->getColuns();

        $Joins = array();
        $left_joins = isset($other["leftjoin"]) ? $other["leftjoin"] : array();
        $AliasJoin = array();
        $AliasGet = array();
        foreach($left_joins as $join){
            $GetJoin = $this->createJoin($join);
            if (is_array($GetJoin)){
                $Fields = array_merge($Fields,$GetJoin['fields']);
                $Joins[] = $GetJoin['sql'];
                $AliasJoin[$join] = $GetJoin['alias'];
                if (!empty($GetJoin['alias_get']))
                    $AliasGet[$join] = $GetJoin['alias_get'];
            }
        }

        $OrderKey = isset($other["orderby"]) ? " ".$other["orderby"] : " ASC";
        $OrderColun = isset($other["ordercol"]) ? $this->getColunAlias($other["ordercol"]) : $this->getColunAlias($this->___primary);
        $GroupColun = isset($other["groupcol"]) ? $this->getColunAlias($other["groupcol"]) : $this->getColunAlias($this->___primary);
        $otherWhere = isset($other["where"]) ?  $other["where"] : null;
        $OrderBy = " ORDER BY ".$OrderColun.$OrderKey ;
        if (count($left_joins ) == 0){
            $GroupBy = "";
        }else {
            $GroupBy = "";//" GROUP BY " . $GroupColun;
        }

        $Where = "";
        if (is_array($otherWhere)){
            $Values = array();
            foreach ($otherWhere['coluns'] as $key=>$colun){
                if (isset($colun['Model'])){
                    if (isset($AliasGet[$colun['Model']]))
                        $Values[] = $AliasGet[$colun['Model']].".".$colun['colun'];
                }else{
                    $Values[] = $this->getColunAlias($colun['colun']);
                }
            }
            $Query = str_replace(array_keys($otherWhere['coluns']), $Values, $otherWhere['query']);
            $Where .= " WHERE ".$Query;
            $BindValues = array_merge($BindValues, $otherWhere['bind']);
        }

        $this->___SqlQuery = "SELECT COUNT({$this->getColunAlias($this->___primary)}) as Total FROM " . $this->getTableSelect() . implode(' ', $Joins) . $Where. $GroupBy . $OrderBy;
        $result = $this->___Connection->run($this->___SqlQuery, $BindValues);
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $row = $result->fetch();
        return $row['Total'];
    }

    /**
     * Metodo de criação via array
     * @param $data
     * @throws \Exception
     * @return int
     */
    public function create($data){
        $this->clearObject();
        foreach ($data as $colun=>$value){
            $this->$colun = $value;
        }
        $this->save();

        $Col = $this->___primary;
        return $this->$Col;
    }

    /**
     * Metodo de edição via array
     * @param $data array colun e valores
     * @param $id int opcional ID primary key
     * @throws \Exception
     */
    public function edit($data, $id = null){
        if (!is_null($id)){
            $auto = $this->___primary;
            $this->___isAlone = true;
            $this->$auto = $id;
        }
        if (isset($this->___isAlone)){
            foreach ($data as $colun=>$value){
                $this->$colun = $value;
            }
            $this->saveEdit();
        }
    }

    /**
     * Obter um por coluna facil
     * @param $value
     * @param string $by
     * @return bool|self
     */
    public function getBy($value, $by){
        $this->clearObject();
        $Method = "findOneBy".$by;
        $Find = $this->$Method($value);
        if ($Find instanceof self){
            return $Find;
        }
        return false;
    }

    /**
     * Obeter Dados de um JOIN setado na Base
     * @param $join
     */
    public function get($join){
        $Property = $this->___hasJoin[$join];
        if ($Property["type"] == self::HASMANY){
            $Model = $Property["class"];
            $Class = new $Model();
            $Find = "findBy".$Property['foreign'];

            $value = $Property['local'];
            $this->$join = $Class->$Find($this->$value);
        }elseif ($Property["type"] == self::HASONE){
            $Model = $Property["class"];
            $Class = new $Model();

            $value = $Property['local'];
            $this->$join = $Class->getOne($Property['foreign'], $this->$value);
        }
    }

    /**
     * Obter array de um unico valor
     * @param $colun
     * @param $value
     * @return null
     * @throws \Exception
     */
    public function getOne($colun, $value){
        $original = $colun;
        if (!isset($this->___Coluns[$colun])){
            $colun = lcfirst($colun);
            if (!isset($this->___Coluns[$colun])){
                throw new \Exception("Coluna ".$original." não existe.");
            }
        }
        $Results = $this->___Connection->read($this->getTableSelect(), $this->getWhere($colun), array(":{$colun}" => $value), "{$this->___alias}.*", "1");
        if (isset($Results[0])){
            return $Results[0];
        }
        return null;
    }

    /**
     * Remover Dado
     * @param null $id
     */
    public function remove($id = null){
        $AutoIncrement = $this->___primary;
        if ($this->___isAlone && is_null($id)){
            $this->___Connection->delete($this->___table_name, $this->getWhereNoAlias($AutoIncrement), array(":{$AutoIncrement}" => $this->$AutoIncrement));

            $this->___isAlone = false;
            foreach ($this->___Coluns as $colum=>$property) {
                $this->$colum = null;
            }

        }else{
            if ($id != null){
                $this->___Connection->delete($this->___table_name, $this->getWhereNoAlias($AutoIncrement), array(":{$AutoIncrement}" => $id));
            }
        }
    }

    /**
     * @param String $Join
     * @param string $type
     * @return array
     */
    private function createJoin($Join, $type = "LEFT"){
        if (isset($this->___hasJoin[$Join])) {
            $Property = $this->___hasJoin[$Join];
            $Model = $Property["class"];
            /**
             * @var $Class BaseModel
             */
            $Class = new $Model();
            if ($Property["type"] == self::HASONE){
                $LeftJoin = " {$type} JOIN {$Class->getTableSelect()} ON {$Class->getColunAlias($Property['foreign'])} = {$this->getColunAlias($Property['local'])}";
                $Field = $Class->getFields($this->alias());
                return array("sql" => $LeftJoin, "fields" => $Field, "alias" => $Class->___aliasColun, "alias_get" => $Class->___alias, "alias_temp" => $Class->___aliasTemp);
            }else if ($Property["type"] == self::HASMANY){
                return array("sql" => "", "fields" => array(), "alias" => "", "alias_get" => "", "alias_temp" => "");
            }
        }
        return null;
    }

    /**
     * Gerar alias
     * @return string
     */
    public function alias() {
        $lmin = 'bcdfghjklmnpqrtvwxyz';
        $retorno = '';
        $caracteres = $lmin;

        $len = strlen($caracteres);
        for ($n = 1; $n <= 3; $n++) {
            $rand = mt_rand(1, $len);
            $chars = str_shuffle($caracteres);
            $retorno .= $chars[$rand-1];
        }
        return $retorno;
    }

    /**
     * Obter array de consulta
     * @return array
     */
    public function toArray(){
        return $this->uiyewyqueyewuqibcnsabh;
    }

    /**
     * Limpar Model
     */
    public function clearObject(){
        $this->uiyewyqueyewuqibcnsabh = array();
        $this->___isAlone = false;
    }

    /**
     * Calls de funções _MAGIC
     * @param $_Name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($_Name, $arguments){
        $by = null;
        $count = count($arguments);
        if (substr($_Name, 0, 6) == 'findBy') {
            $by = substr($_Name, 6, strlen($_Name));
            $method = 'findBy';
            if ($count > 2) {
                throw new \Exception("Set a valid argument to the method 'findBy'.");
            }
        } else if (substr($_Name, 0, 9) == 'findOneBy') {
            $by = substr($_Name, 9, strlen($_Name));
            $method = 'findOneBy';
            if ($count > 2) {
                throw new \Exception("Set a valid argument to the method 'findOneBy'.");
            }
        }

        if (!isset($method) || !method_exists($this,$method)) {
            throw new \Exception("The method ".$_Name." not exist.");
        }

        switch ($method) {
            case "findBy":
                return $this->$method($by,$arguments[0], isset($arguments[1]) ? $arguments[1] : null);
                break;
            case "findOneBy":
                return $this->$method($by,$arguments[0], isset($arguments[1]) ? $arguments[1] : null);
                break;
        }

    }

}