<?php

namespace App\Database;

use PDO, PDOStatement;

class Database
{

    protected PDO $connection;
    protected string $query = '';
    protected $params = [];
    protected PDOStatement $queryInfo;

    /**
    * Requisita um array contendo [$host, $nomeBD, $usuario, $senha]
    * para se conectar ao banco de dados e instanciar o PDO.
    * @author brunoggdev
    */
    public function __construct()
    {
        [$host, $nomeBD, $usuario, $senha] = require 'dbconfig.php';

        $dsn = "mysql:host=$host;dbname=$nomeBD";

        $this->connection = new PDO($dsn, $usuario, $senha, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]); 
    }


    /**
    * Adiciona um SELECT na consulta
    * @author brunoggdev
    */
    public function select(string $table, array $colunas = ['*']): self
    {
        $colunas = implode(', ', $colunas);

        $this->query = "SELECT $colunas FROM $table ";

        return $this;
    }



    /**
    * Adiciona um INSERT na consulta
    * @author brunoggdev
    */
    public function insert(string $table, array $params):bool
    {

        $colunas = implode(', ', array_keys($params));
        $values = ':' . implode(', :', array_keys($params));

        $sql = "INSERT INTO $table ($colunas) VALUES($values)";

        $query = $this->executarQuery($sql, $params);
        

        if($query->rowCount() > 0){
            return true;
        }
        
        return false;

    }



    /**
    * Adiciona um WHERE na consulta
    * @param Array $params Associative array 
    * @example $params ['id' => '2'] equals: id = 2 in the sql
    * @example $params ['id' => '>= 1'] equals: id >= 1 in the sql
    * @author brunoggdev
    */
    public function where(array $params): self
    {
        
        foreach ($params as $key => $value) {
            
            if (strpos($this->query, 'WHERE') === false) {
                $this->query .= ' WHERE ';
            }
            

            if(!preg_match('/[<>=]/', $value)){
                 
                $this->params[$key] = $value;
                $this->query .= "$key = :$key ";
                
            }else{
                
                $pieces = explode(' ', $value);
                $operators = $pieces[0];
                $this->params[$key] = $pieces[1];
                
                $this->query .= "$key $operators :$key ";
                
            }

            if($key !== array_key_last($params)){
                $this->query .= 'AND ';
            }

        }

        return $this;
    }



    /**
    * Adiciona um ORDER BY na query
    * @author brunoggdev
    */
    public function orderBy(string $column, string $order = 'ASC'):self
    {
        $this->query .= "ORDER BY $column $order ";
        
        return $this;
    }


    /**
    * Recebe uma sql completa para consultar no banco de dados.
    * @example $sql SELECT * FROM users WHERE id >= :id
    * @example $params ['id' => 1]
    * @author brunoggdev
    */
    public function query(string $sql, array $params = [])
    {
       
        $this->query = $sql;
        $this->params = $params;

        return $this;
    }


    /**
    * Pega o primeiro resultado da consulta
    * @author brunoggdev
    */
    public function primeiro(int $fetchMode = PDO::FETCH_ASSOC)
    {
        $query = $this->executarQuery($this->query, $this->params);
        
        return $query->fetch($fetchMode);
    }


    /**
    * Retorna todos os resultados da consulta
    * @author brunoggdev
    */
    public function todos(int $fetchMode = PDO::FETCH_ASSOC)
    {
        $query = $this->executarQuery($this->query, $this->params);

        return $query->fetchAll($fetchMode);
    }

    /**
    * Executa a consulta no banco de dados e retorna o PDOStatement
    * @author brunoggdev
    */
    private function executarQuery(string $sql, array $params = []):PDOStatement
    {
        $query = $this->connection->prepare($sql);

        $query->execute($params);

        $this->queryInfo = $query;

        return $query;
    }

    /**
    * Retorna a string da consulta executada
    * @author brunoggdev
    */
    public function consultaExecutada():string
    {
        return $this->query;
    }

    /**
    * Retorna os erros que ocorreram durante a execução da SQL
    * @author brunoggdev
    */
    public function erros():array
    {
        return $this->queryInfo->errorInfo();
    }

}
