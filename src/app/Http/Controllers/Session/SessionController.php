<?php

namespace App\Http\Controllers\Session;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class SessionController extends BaseController
{
    protected Session $session;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->session->all();
    }
        
    /**
     * show
     *
     * @param  mixed $request
     * @return void
     */
    public function show(Request $request)
    {   
        /** TODO VALIDAR CAMPOS */
        $name = $request->get('name');
        $result = $this->session->where('name',$name)->get();

        return response()->json(['data' => $result], Response::HTTP_OK);
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        /** Comandos básicos para buscar, criar e deletar um registro no REDIS*/
        // Redis::get('key');
        // Redis::set('key');
        // Redis::del('key');

        // if() {
        //     /** TODO inserir lógica aqui */
        // }
       
        $this->session->create($request->all());
        return response()
            ->json([
                'data' => 'Mensagem recebida'
            ], Response::HTTP_CREATED);
    }
    
    /**
     * destroy
     *
     * @param  mixed $sessionId
     * @return void
     */
    public function destroy($sessionId)
    {
        $session_exists = $this->session->find($sessionId);
        if(empty($session_exists)) {
            return response()
            ->json(['data' => [
                'message' => 'A sessão fornecida não existe'
            ]], Response::HTTP_NOT_FOUND);
        }

        $this->session->destroy($session_exists->_id);
        return response()
            ->json(['data' => [
                "message" => "Sessão encerrada para o cliente {$session_exists->name}."
            ]], Response::HTTP_OK);
    }
    
    /**
     * destroyAll
     *
     * @return void
     */
    public function destroyAll()
    {
        $this->session->truncate();
        return response()
            ->json(['data' => [
                "message" => "Todas as sessões foram encerradas"
            ]], Response::HTTP_OK);
    }
    
    /**
     * upload
     *
     * @param  mixed $request
     * @return void
     */
    public function upload(Request $request)
    {
        return dd($request);
        $result = $request->file('file');
        return dd($result);
        return response()->json(['data' => $result]);
    }
}
