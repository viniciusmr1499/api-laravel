<?php 

namespace App\Services\Session;

use App\helpers\BotTelegram;
use App\Repositories\Session\SessionRepository;
use \App\Services\AbstractService;
use Exception;
use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Statement;

/**
 * SessionService
 */
class SessionService extends AbstractService 
{  
  /**
   * __construct
   *
   * @param  mixed $sessionRepository
   * @return void
   */
  public function __construct(SessionRepository $sessionRepository)
  {
    $this->repository = $sessionRepository;
  }
  
  /**
   * findByName
   *
   * @param  mixed $name
   * @return array
   */
  public function findByName(string $name): array
  {
    if(empty($name)){
      throw new Exception('Field empty or invalid');
    }

    $session = $this->repository->findByName($name);

    if(empty($session)) {
      throw new Exception('Session not found');
    }

    return $session;
  }

  public function handleFileUpload(Request $request)
  {
    $stream = $request->file('csv');
    if(!file_exists($stream)) {
        throw new Exception('File not exists');
    }

    $extension = $request->file('csv')->getClientOriginalExtension();
    if($extension !== 'csv') {
      throw new Exception('Extension not allowed, try using a file with a .csv extension');
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
        
        $this->repository->create($payload);
    }

    $channel = $request->get('channel');
    (new BotTelegram())->sendMessage($channel, 'Upload sessions were successful!');
  }
  
  /**
   * create
   *
   * @param  mixed $data
   * @return array
   */
  public function create(array $data): array
  {
    if(
      empty($data['chatId']) ||
      empty($data['name']) ||
      empty($data['platform_type']) ||
      empty($data['contact_identifier']) ||
      empty($data['messages'])
    ) {
      throw new Exception('Invalid fields');
    }

    return $this->repository->create($data);
  }
    
  /**
   * update
   *
   * @param  mixed $id
   * @param  mixed $data
   * @return bool
   */
  public function update(string $id, array $data): bool
  {
    if(empty($data) || empty($id)) {
      return false;
    }
    
    $session = $this->repository->findById($id);
    if(empty($session)) {
      return false;
    }
   
    $payload = array_merge($session['messages'], [$data]);
    $this->repository->update($id, $payload);
    return true;
  }
}