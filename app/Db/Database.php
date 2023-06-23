<?php

namespace App\Db;

use Exception;
use \PDO;
use PDOException;

class Database
{

    //host de conexão com banco de dados
    const Host = 'localhost';

    //nome do banco
    const Name = 'wdev_vagas';

    //user do banco
    const User = 'root';

    //senha de acesso ao banco
    const Pass = 'admin';


    //nome da tabela a ser manipulado
    private $table;

    //instancia de conexão com banco de dados
    private $connection;


    //defini a tabela na instancia da conexão $table opcional
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    //metodo responsavél por criar uma conexão com banco de dados
    private function setConnection()
    {
        try {
            //instanciando o pdo passando o tipo de banco, host, nome banco, user banco, senha banco
            //erros no banco o pdo trata como warnning e nao um erro por isso precissamos tratar
            $this->connection = new PDO('mysql:host=' . self::Host . '; dbname=' . self::Name, self::User, self::Pass);
            //caso ocorra algum erro, esse metodo para o processo passando o atributo que queremos alterar e o segundo é o valor que vamos receber 
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("error: " . $e->getMessage());
        }
    }


    //método responsável por executar queries dentro do banco de dados
    public function execute($query, $params = [])
    {
        try {
            //preparando a query
            $statement = $this->connection->prepare($query);

            //executando a query
            $statement->execute($params);

            //retorno da query executada
            return $statement;
            echo "<pre>";
            print_r($statement);
            echo "<pre>";
        } catch (Exception $e) {
            die("error: " . $e->getMessage());
        }
    }

    //metodo responsável por inserir dados no banco
    //devolve um array tipo [field => value]
    public function insert($values)
    {

        //dados da query
        $fields = array_keys($values);

        //defini os valores dinamicamente
        //função que  pego um array, uma variável e posso determinar a quantidade de posições e se não tiver a quantidade de posição ele cria novas posições com padrão específico  
        $binds = array_pad([], count($fields), '?');



        //PDO VERIFICAR OS DADOS DINAMICOS SE SAO VALIDOS/SEGUROS (?,?,?,?,?)
        //função implode junta todos os campos de field formando uma string só, podendo ser separadas por virgula como determinado
        $query = 'INSERT INTO ' . $this->table . '(' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        //executa o insert
        $this->execute($query, array_values($values));

        //retorno do id inserido
        return $this->connection->lastInsertId();
    }

    //método responsável por executar uma consulta no banco de dados
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        //dados da query

        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER' . $order : '';
        $limit = strlen($limit) ? 'LIMIT' . $limit : '';

        //montando a query
        $query = 'SELECT' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //retornando a query
        return $this->execute($query);
    }

    //método responsável por atualizar os dados no banco de dados
    public function update($where, $values)
    {

        //dados da query
        $fields = array_keys($values);


        //monta a query
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?, ', $fields) . '=? WHERE ' . $where;

        $this->execute($query, array_values($values));

        return true;
    }


    public function delete($where)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

        $this->execute($query);

        return true;
    }
}
