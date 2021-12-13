<?php
require 'vendor/autoload.php';

//header('Content-type: application/json');
$mongo = new \MongoDB\Client('mongodb://localhost:27017');
////http://localhost/api/?name=Hinterland
//$result = $mongo->admin->admin->find(['brewery' => 'BrewDog']);
//////
//foreach ($result as $r) {
//    die(var_dump($r));
//}
//$m = new MongoClient();
//die(var_dump($mongo->admin->selectCollection('admin')->find([ 'name' => 'Ismael ', 'brewery' => 'BrewDog' ])));
//die(var_dump($mongo->admin->selectCollection('admin')->find([ 'brewery' => 'BrewDog'])));
//echo "Connection to database successfully";
// select a database
//$db = $m->selectDB('admin');
//echo "Database admin selected";
//$collection = $db->createCollection("cliente");
//$collection = $db->createCollection("produto");
//die(var_dump($mongo->selectCollection('demo')->insertOne([ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ])));
//$collection = $mongo->getManager();
//phpinfo();
$path = $_SERVER['REQUEST_URI'];
$path = substr($path, 4, strlen($path));
echo $path;
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $path == '/cliente/') {
    echo 'get';
    $params = $_GET;
    $findArray = [];
    foreach ($params as $param => $value) {
        $findArray[$param] = $value;
    }
    //die(var_dump($findArray));
    //$result = $mongo->admin->admin->find($findArray)->toArray();
    $result = $mongo->admin->cliente->find($findArray)->toArray();
    //die(var_dump($result));
    $resultJson = [];
    foreach ($result as $r) {
        if ($r['_id'] instanceof MongoDB\BSON\ObjectId) {
            die(var_dump($r->jsonSerialize()));
        }
        //die(var_dump($r));
        //die(var_dump($r['_id']->));
        $resultJson[] = ['id' => $r['_id']->oid, 'name' => $r['name'], 'brewery' => $r['brewery']];
    }
    echo json_encode($resultJson);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $path == '/cliente/') {
    try {
        $mongo->selectDatabase('admin')->selectCollection('cliente')->insertOne(['name' => 'aa', 'brewery' => 'njasdn']);
        echo 'post';
    } catch (\Exception $e) {

    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' && $path == '/cliente/') {
    echo 'put';
    $json_recebido = file_get_contents('php://input');
    $dados = json_decode($json_recebido, true);
    $id = new \MongoDB\BSON\ObjectId('61b6606a1aaa170c397d02c5');
    $mongo->admin->cliente->findOneAndUpdate(array('_id' => $id));
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $path == '/cliente/') {
    echo 'delete';
    $id = new \MongoDB\BSON\ObjectId('61af99c9135c521c153cd7e2');
    $mongo->admin->cliente->findOneAndDelete(array('_id' => $id));
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $path == '/produto/') {
    echo 'get produto';
    $params = $_GET;
    $findArray = [];
    foreach ($params as $param => $value) {
        $findArray[$param] = $value;
    }
    //die(var_dump($findArray));
    //$result = $mongo->admin->admin->find($findArray)->toArray();
    $result = $mongo->admin->produto->find()->toArray();
    echo $mongo->selectDatabase('admin')->selectCollection('produto')->getCollectionName();
    die(var_dump($result));
    $resultJson = [];
    foreach ($result as $r) {
        if ($r['_id'] instanceof MongoDB\BSON\ObjectId) {
            die(var_dump($r->jsonSerialize()));
        }
        //die(var_dump($r));
        //die(var_dump($r['_id']->));
        $resultJson[] = ['id' => $r['_id']->oid, 'name' => $r['name'], 'brewery' => $r['brewery']];
    }
    echo json_encode($resultJson);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $path == '/produto/') {
    try {
        $mongo->selectDatabase('admin')->selectCollection('produto')->insertOne(['name' => 'aa', 'brewery' => 'njasdn']);
        echo 'post produto';
    } catch (\Exception $e) {

    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' && $path == '/produto/') {
    echo 'put produto';
    $json_recebido = file_get_contents('php://input');
    $dados = json_decode($json_recebido, true);
    $id = new \MongoDB\BSON\ObjectId('61b6606a1aaa170c397d02c5');
    $mongo->admin->produto->findOneAndUpdate(array('_id' => $id));
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $path == '/produto/') {
    echo 'delete produto';
    $id = new \MongoDB\BSON\ObjectId('61af99c9135c521c153cd7e2');
    $mongo->admin->produto->findOneAndDelete(array('_id' => $id));
}
