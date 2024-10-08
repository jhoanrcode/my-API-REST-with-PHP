<?php 

class ResponseService {

  function success( $data = [], $message = "" ) {

    http_response_code(200);
    if( !empty($data) ) { $response = array("status" => "success", "message" => $message, "data" => $data); }
    else { $response = array("status" => "success" ,"message" => $message); }
      
    echo json_encode($response); 

  }

  function failed( $code, $message = "" ) {
    
    http_response_code($code);
    $response = array("status" => "failed" ,"message" => $message);  
  
    echo json_encode($response);  

  }

}
