<?php

namespace App\Entity;

use App\Db\Database;
use PDO;

class Vaga
{

    public $id;
    public $titulo;
    public $descricao;
    //verifica se esta ativo (1/0)
    public $status;
    public $data;


    //metodo responsável por cadastrar uma nova vaga
    //métodos públic function são métodos instanciavéis
    public function cadastrar()
    {
        //definir a data
        $this->data = date('Y-m-d H:i:s');


        //inserir a vaga no banco
        //atribuir o id da vaga na instancia

        $obDatabase = new Database('vagas');
        //metodo que insere os dados passando chave valor
        $this->id = $obDatabase->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'status' => $this->status,
            'data' => $this->data,
        ]);





        //retornar sucesso
        return true;
    }

    //método responsável por atualizar uma vaga no banco
    //return boolean
    public function atualizar()
    {

        //OBS:::descobrir porque que o id não está sendo passado no parametro
        return (new Database('vagas'))->update('id=' . $this->id, [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'status' => $this->status,
            'data' => $this->data,
        ]);
    }

    //método de excluir vaga
    public function excluir()
    {
        return (new Database('vagas'))->delete('id=' . $this->id, []);
    }

    //método statico, pois retorna varias instancias de vagas, passando por parâmetros 
    public static function getVagas($where = null, $order = null, $limit = null)
    {
        //retorna apenas o statemente
        return (new Database('vagas'))->select($where, $order, $limit)
            //transforma o retorno em um array(definindo o tipo de array que será retornado, e qual tipo de objeto)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }


    //static quer dizer global, assim eu consigo pegar ela em outro arquivo
    //método select 
    public static function getVaga($id)
    {
        //retorna apenas o statement
        return (new Database('vagas'))->select('id = ' . $id)
            //retorna um único elemento do array 
            ->fetchObject(self::class);
    }
}
