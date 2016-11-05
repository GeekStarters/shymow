<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use PDO;
class ChatController implements MessageComponentInterface{
	protected $clients;
    private $subscriptions;
    private $users;
    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->subscriptions = [];
        $this->users = [];
		// try{
		// 	$this->connection = new PDO('mysql:host=localhost;dbname=shymow','root', '');
		// 	$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// }catch(PDOException $e){
		// 	echo "ERROR: " . $e->getMessage();
		// }

		// function countUsers($transmitter){
	 //    	$sql = $this->connection->prepare('SELECT * FROM perfils WHERE id = :Id AND active = true');
		// 	$sql->execute(array('Id' => $transmitter));
		// 	$resultado = $sql->fetchAll();

		// 	return $resultado;
		// }
		// function countChannels($transmitter){
	 //    	$sql = $this->connection->prepare('SELECT * FROM chats WHERE userOne = :Transmitter OR userTwo = :Transmitter AND userOne = :Receiver OR userTwo = :Receiver AND ');
		// 	$sql->execute(array('Transmitter' => $transmitter));
		// 	$resultado = $sql->fetchAll();

		// 	return $resultado;
		// }
    }
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->users[$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {

    	$data = json_decode($msg);
    	
        switch ($data->command) {
            case "subscribe":
                if (isset($this->subscriptions[$conn->resourceId])){
	                if (is_array($this->subscriptions[$conn->resourceId])) {
	                    array_push($this->subscriptions[$conn->resourceId][1], $data->channel);
	                }
	            }else{
	                $this->subscriptions[$conn->resourceId] = [[$data->transmitter],[$data->channel]];
	            }
                break;
            case "message":
            	//Verifica si existe el usuario
                if (isset($this->subscriptions[$conn->resourceId])) {
                	//Guarda este usuario
		            $target = $this->subscriptions[$conn->resourceId][1];
		            //Recorre todos los suscriptores separando el id de los arrays
		            foreach ($this->subscriptions as $id=>$section) {
	            		//Si el arreglo 0 tiene el ID de la persona que recive el msg pasa
		            	if ($section[0][0] == $data->receiver) {
		            		//En este momento se recorren los canales
	            			//valida las suscripciones de los dos usuarios
	                        if ($id != $conn->resourceId) {
	                            $this->users[$id]->send($msg);
	                            // $this->users[$id]->send($data->message);
	                        }
		            	}                    
		            }
		        }
		        break;
		    case "newMessage":
		    	if (isset($this->subscriptions[$conn->resourceId])) {
                	//Guarda este usuario
		            $target = $this->subscriptions[$conn->resourceId][1];
		            //Recorre todos los suscriptores separando el id de los arrays
		            foreach ($this->subscriptions as $id=>$section) {
		            	//Si el arreglo 0 tiene el ID de la persona que recive el msg pasa
		            	if ($section[0][0] == $data->receiver) {
		            		//En este momento se recorren los canales
	            			//valida las suscripciones de los dos usuarios
	                        if ($id != $conn->resourceId) {
	                            $this->users[$id]->send($msg);
	                            // $this->users[$id]->send($data->message);
	                        }
		            	}                   
		            }
		        }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        unset($this->users[$conn->resourceId]);
        unset($this->subscriptions[$conn->resourceId]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
