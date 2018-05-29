<?php

try{ 
     require_once '../bootstrap/init.php'; 
 } catch (\Exception $ex) {
    $data = ['exception' => true, 'success' => false, 'msg' => $ex->getMessage(),'code'=>$ex->getCode()];  
    
    
    header('Content-type: text/json');
    echo json_encode($data, JSON_OBJECT_AS_ARRAY) . "\n";
    exit; 
 } 