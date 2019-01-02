 <?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if(isset($_GET["id"])){
    if( !empty($_GET["id"])){

      $id=$_GET["id"];

      $conn = new mysqli("localhost", "root", "", "bfapp");

      $query2 = "SELECT user_id, status FROM children WHERE id = $id";

      $result2 = mysqli_query($conn,$query2);

      if($rs1=$result2->fetch_array(MYSQLI_ASSOC)) {
        $usrid=$rs1['user_id'];
        $status=$rs1['status'];

      }

      $query = "SELECT token FROM users WHERE id = '$usrid'";

      $result = mysqli_query($conn,$query);

      $outp ="";

      if($rs=$result->fetch_array(MYSQLI_ASSOC)) {
        $tokens=$rs['token'];

      }

       if ($status == "Home")
      {
        $message = "Status Home";
      } elseif ($status == "Pick-Up")
      {
        $message = "Status Pick-Up";
      } elseif ($status == "School")
      {
        $message = "Status School";
      } elseif ($status == "Absent")
      {
        $message = "Status Absent";
      }


      $curl = curl_init();
      $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIyNDU3ZGQwMS1hNDRlLTRiNjktOTE3Mi1hNzk1MTdkNzUwYjkifQ.v1bMqmxRp0Q3BUuYHFtZ0ZTMYLkLw41owcEpxIcjnWg";
      $vars = '{
        "tokens": "'.$tokens.'",
        "profile": "bfapp",
        "notification": {
          "message": "'.$message.'"
        }
      }';

      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.ionic.io/push/notifications",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $vars,
        CURLOPT_HTTPHEADER => array (
          "Authorization: Bearer $token",
          "Content-Type: application/json"
          ),
        ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        echo $response;
      }
    }
  }
?>