<?php

namespace Base\Plugins;

class Builder extends \Phalcon\Mvc\Model{

    public $query;
    protected $table;
    protected $column;
    public $prefix ='';

    function __construct(String $query = null){ 
        $this->query = $query;
    }

    function selectFrom(String | Array $column, String | Array $table){
        $this->table = $table;
        $this->column = $column;
        $this->query = "SELECT " . $this->checkValue($column) . " FROM ". $this->checkValue($table) ;
        return $this;
    }

    function distinct(){
        $this->query = str_replace("SELECT", "SELECT DISTINCT", $this->query);
        return $this;
    }
    function setPrefix(String $prefix){
        $this->prefix = $prefix;
        if ($this->table !== null)
            $this->query = str_replace($this->table, $prefix.$this->table , $this->query);

        return $this;
    }

    function addLessThen(String $column, int $value){
        $this->conditionExists($this->query) ?
            $this->query .= " AND " . $column .' < '. $value :
            $this->query .= " WHERE " . $column .' < '. $value ;

        return $this;
    }
    function addMoreThen(String $column, int $value){
        $this->conditionExists($this->query) ?
            $this->query .= " AND " . $column .' > '. $value :
            $this->query .= " WHERE " . $column .' > '. $value ;

        return $this;
    }
    function addWhere(String $column,  String | int $value) {
        $this->conditionExists($this->query) ?
            $this->query .= " AND " . $column .'='. $value:
            $this->query .= " WHERE " . $column .'='. $value;     

        return $this;
    }
    function addBetween(String $key, int $min, int $max) {
        $this->conditionExists($this->query) ?
            $this->query .= " AND " . $key .' BETWEEN '. '\''.$min.'\''. ' AND '. '\''.$max.'\'' :
            $this->query .= " WHERE " . $key .' BETWEEN '. '\''.$min.'\''. ' AND '. '\''.$max.'\'' ;

        return $this;
    }
    function addHaving(String $column, String | Array $params) {
        $this->conditionExists($this->query) ?
            $this->query .= ' AND ' . $column ." IN ( '". $this->params($params) ."')" :
            $this->query .= ' HAVING ' . $column ." IN ( '".$this->params($params) ."')";

        return $this;

    }
    function addExists(String $JoinTable, String $targetColumn, Array | String $params) {
        //as * is not working with pdo
        $all_sub_columns = '*';
        if ($JoinTable === "models\colors")
            {$all_sub_columns = "id_produit, color";}
        if ($JoinTable === "models\sizes")
            {$all_sub_columns = "id_produit, size";}
    
        //join columns
        $targetId = "id_produit";
        $sourceId = "id";
        //creating subquery

        $subQuery = new Builder();
        $subQuery->selectFrom($all_sub_columns,$JoinTable )
                ->addWhere($targetId, $sourceId)
                ->addHaving($targetColumn, $params)
                ->setPrefix($this->prefix);

        $this->conditionExists($this->query) ?
            $this->query .= " AND EXISTS ( " . $subQuery->query . ")" :
            $this->query .= " WHERE EXISTS  ( " . $subQuery->query . ")" ;

        return $this;
    }

    function params( String | Array $params){
        is_array($params) ?
            $params = implode("','",$params):
            $params = $params ;
        return $params;
    }
    function checkValue( String | Array $params){
        is_array($params) ?
            $params = implode(",",$params):
            $params = $params ;
        return $params;
    }
    function subQuery() {
        
    }

    function conditionExists(String $query){
        if (str_contains($query, "WHERE") || str_contains($query, "HAVING") || str_contains($query, "EXISTS")){
            return true;
        }
        else{
            return false;
        }
    }

    function getTableName(String $query){
        $i = 0; 
        $tableName;
        $queryParams = explode(" ", $query);
        foreach( $queryParams as $param){
            $i++;
            if ($param === "FROM"){
                $tableName = $queryParams[$i];
                break;
            }
        }
        return $tableName;
    }
}
        /*$Builder= new Builder();
        $Builder->selectFrom(" * ", "product")
                ->setPrefix("App\Api\Models\\");

        if ($min !== null)
            $Builder->addMoreThen("price", $min); 
        if ($max !== null )
            $Builder->addLessThen("price", $max); 
        if ($categories !== null )
            $Builder->addHaving("category", $categories); 
        if ($brands !== null )
            $Builder->addHaving("brand", $brands); 
        if ($size !== null )
            $Builder->addExists("sizes", "size", $size); 
        if ($colors !== null )
            $Builder->addExists("colors", "color", $colors);//tablename, columnname, params*/
        //return $this->modelsManager->createQuery($Builder->query)->execute();

if (!function_exists('str_contains')) {
    function str_contains (string $haystack, string $needle)
    {
        return empty($needle) || strpos($haystack, $needle) !== false;
    }
}