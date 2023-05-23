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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="style.css">
</head>
<body class="get">
  <form  method="post" action="">
<div class="container d-flex justify-content-center">
  <div class="card mt-5 w-full h-full relative">
    <div class="d-flex flex-row justify-content-between flex h-full flex-1 flex-col md:pl-[260px] p-3 adiv text-white">
      <i class="fas fa-chevron-left"></i>
      <span class="pb-3">Live chat</span>
      <i class="fas fa-times"></i>
    </div>
      <div class="d-flex flex-row p-3">
        <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">
        <div class="chat ml-2 p-3"><?php echo $text;?></div>
      </div>

      <div class="d-flex flex-row p-3">
        <div class="bg-white mr-2 p-3 my-9 mx-10 "><span class="text-muted"><?php echo $result['choices'] [0] ['text'];?></span></div>
        <img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-7.png" width="30" height="30">
      </div>
      
      
      
      
      
      <div class="form-group px-3">
        <input class="form-control" name="txt" rows="5" placeholder="Type your message"></input>
        <div class="input-group-append">
        <button class="btn btn-info" name="submit" value="submit"><i class="far fa-paper-plane"></i></button>
        </div>
       
        
      </div>
        
  </div>
</div>
</form>
</body>
</html>