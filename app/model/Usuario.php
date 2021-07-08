<?php
namespace App\Model;

use \App\Model\Database;
use \PDO;

class Paciente{

    //dados pessoais
    public $id;
    public $nome;
    //public $dataNascimento;
    //public $genero;
    public $email;
    // public $celular;
    // public $telefone;
    // public $outroTelefone;
    // public $cpf;
    // public $rg;
    // public $emissorRg;
    // public $estadoCivil;

    //endereco
    // public $cep;
    // public $endereco;
    // public $numero;
    // public $complemento;
    // public $bairro;
    // public $cidade;
    // public $uf;
    // public $naturalidade;

    //dados Familiares
    // public $nomeMae;
    // public $nomePai;
    // public $cpfResponsavel;

    public function cadastrar(){

        $db = new Database('paciente');

        $this->id = create([
            'nome' => $this->nome,
            'email' => $this->email
        ]);

        return true;
    }

    public static function getPacientes($where = null, $order = null, $limit = null){
      return (new Database('paciente'))->select($where, $order, $limit)
                                       ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    public static function getPaciente($id){
      return (new Database('paciente'))->select('id='.$id)
                                       ->fetchObject(self::class);
    }

    public function atualizar(){
        return (new Database('paciente'))->update('id='.$this->id,[
            'nome' => $this->nome,
            'email' => $this->email
        ]);
    }

    public function excluir(){
        return (new Database('paciente'))->delete('id = '.$this->id);
    }

    //echo "<pre>"; print_r($this); echo "</pre>"; exit;



}
