<?php
//  error_reporting(0);
if(isset($_POST['txt'])){
  $text = $_POST['txt'];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$postdata = array(
    "model"=> "text-davinci-003",
    "prompt"=> $text,
    "temperature"=> 0.4,
    "max_tokens"=> 64,
    "top_p"=> 1,
    "frequency_penalty"=> 0,
    "presence_penalty"=> 0
);
$postdata =json_encode($postdata);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization:Bearer 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';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
// echo $result;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
$result = json_decode($result,true);
echo '<pre>';
// print_r($result['choices'] [0] ['text']);

}
?> 


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bootstrap Chatroom</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Custom CSS -->
  <style>
    .chat-container {
      max-height: 400px;
      overflow-y: scroll;
    }
  </style>
</head>
<body>
    <form method="post" action="">
  <div class="container" >
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <h2 class="text-center">Chatroom</h2>
        <div class="panel panel-default">
          <div class="panel-body chat-container">
            <div class="chat-message">
              <p><?php echo $text;?></p>
            </div>
            <div class="chat-message">
              <p><?php echo $result['choices'] [0] ['text'];?></p>
            </div>
           
          </div>
          <div class="panel-footer">
            <form>
              <div class="input-group">
                <input type="text" class="form-control" name="txt" placeholder="Type your message...">
                <span class="input-group-btn">
                  <button class="btn btn-default" name="submit" type="submit">Send</button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
</body>
</html>
