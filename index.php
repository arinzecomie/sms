<?php
require '../vendor/autoload.php';
require 'db_conf.php';
  $token = $_GET['id'];
  $dsms = 0;
if(isset($_GET['sms'])){
    $recipient = $_GET['rec'];
    $sms = $_GET['sms'];
    $header = $_GET['h'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE token='$token'");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $results = $stmt->fetch();
    if (count($results)) {
        $messageBird = new \MessageBird\Client('UyTSOqLrDTUbxBXzFZHW5HV6e');
    $message =  new \MessageBird\Objects\Message();
    

        $message->originator = $header;
        $message->recipients = [$recipient];
        $message->body = $sms;
        $response = $messageBird->messages->create($message);
    

    $status = $response->recipients->items[0]->status;
    if ($status == 'sent') {

        $bal = $results['bal'] - $results['charge'];
        $smscut = $results['smscut'] + 1;
        $success = $results['success'] + 1;
        $sql = "UPDATE user SET  bal = '$bal', smscut = $smscut,success = $success WHERE token ='$token'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $dsms = 1;
    }  
    }
  
}


$stmt = $conn->prepare("SELECT * FROM user WHERE token='$token'");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$results = $stmt->fetch();
unset($results['user_id'],$results['token']);
$results['status'] = $dsms;
$results['remain'] = (int)($results['bal'] / $results['charge']);
if (count($results) > 0) {
 echo json_encode($results);
} else {
  echo json_encode([]);
}
$conn = null;
?>
