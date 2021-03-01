<?php

namespace App\Http\Controllers\Session;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use League\Csv\Reader;
use League\Csv\Statement;

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
        return $this->session->paginate(10);
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
            // $id = '974302180';
        //     /** TODO inserir lógica aqui */
        // }
       
        $this->session->create($request->all());
        return response()
            ->json([
                'data' => 'Message received'
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
                'message' => 'The given session does not exist'
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
                "message" => "All sessions ended"
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
        $extension = $request->file('csv')->getClientOriginalExtension();
        if($extension !== 'csv') {
            return response()->json(['data' => [
                'message' => 'Extension not allowed, try using a file with a .csv extension',
                'isOk' => false,
                'statusCode' => Response::HTTP_BAD_REQUEST
            ]], Response::HTTP_BAD_REQUEST);
        }

        $stream = $request->file('csv');
        if(!file_exists($stream)) {
            return response()->json(['data' => [
                'message' => 'File not exists',
                'isOk' => false,
                'statusCode' => Response::HTTP_BAD_REQUEST
            ]], Response::HTTP_BAD_REQUEST);
        }

        $csv = Reader::createFromPath($stream, 'r');
        $csv->setDelimiter(',');
        $csv->setHeaderOffset(0);

        $stmt = (new Statement());
        $sessions = $stmt->process($csv);

        foreach ($sessions as $row) {
            $payload = [
                '_id' => $row['_id'],
                'name' => $row['name'],
                'platform_type' => $row['platform_type'],
                'contact_identifier' => $row['contact_identifier'],
                'messages' => json_decode($row['messages'])
            ];
           
            $this->session->create($payload);
        }

        return response()->json(['data' => [
            'message' => 'Upload successfully',
            'isOk' => true,
            'statusCode' => Response::HTTP_CREATED
        ]], Response::HTTP_CREATED);
    }
}
