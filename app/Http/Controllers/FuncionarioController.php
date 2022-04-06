<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Funcionalidade;

class FuncionarioController extends Controller{
    
    public function __construct()
    {
        $this->funcionarios = new Funcionario();
        $this->funcao = new Funcionalidade();
    }

    public function index(){

        $func =  $this->funcao->all();
        return view('funcionarios.index', compact('func'));

    }
    public function getFunc(){
        $options['funcionarios'] =  $this->funcionarios->all();
        $options['funcao'] =  $this->funcao->all();
      
        return $options;
        
    }
    public function deleteFunc($id){
       
        if($this->funcionarios->find($id)->delete()){
            $return ['error'] = false;
            $return ['icon'] = 'success';
            $return ['msg'] = 'Deletado com sucesso';
        }else{
            $return ['error'] = true;
            $return ['icon'] = 'error';
            $return ['msg'] = 'Erro ao deletar funcionário';

        }
        echo json_encode($return);
        

    }
    public function salvarFunc(Request $request){
        //dd($request);
        
        if(isset($request->id)){
            if($this->funcionarios->find($request->id)->update($request->all())){
                $return ['error'] = false;
                $return ['icon'] = 'success';
                $return ['msg'] = 'atualizado com sucesso';
            }else{
                $return ['error'] = true;
                $return ['icon'] = 'error';
                $return ['msg'] = 'Erro ao atualizar funcionário';

            }
        }else{
            $fun = new Funcionario();
            $fun->nome = $request->nome;
            $fun->email = $request->email;
            $fun->funcionalidade_id = $request->funcionalidade_id;
            $fun->save();
            if($fun->save()){
                $return ['error'] = false;
                $return ['icon'] = 'success';
                $return ['msg'] = 'cadastrado com sucesso';
            }else{
                $return ['error'] = true;
                $return ['icon'] = 'error';
                $return ['msg'] = 'Erro ao cadastrar funcionário';
            }
        }
        echo json_encode($return);
        
    }
}
