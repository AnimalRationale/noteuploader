<?php

   $jsonurl = $_REQUEST['json'];    
   // $json = urldecode($jsonurl);
   $json = html_entity_decode($jsonurl);
   $json = str_replace("\\","", $json);  
   $data = json_decode($json, true);   
    
   if (isset($data['check_uploader'])) {
        print("Uploader OK");        
     }

   $server_pass = "Blogtrotter.v01.236";
   $pass = "No-pass";   

   if (isset($data['pass'])) {
        $pass = $data['pass'];        
     }

   if ($pass != $server_pass) {
        print("No access!");
        exit("No access!");
     }

   $base = $data['photo'];
   // print(" BAZA1: ".$base);
   $base = str_replace("\\","", $base);
   // print(" BAZA2: ".$base);
   // if (base64_encode(base64_decode($base)) === $base){
   // echo ' $base is valid';
   // } else {
   // echo ' $base is NOT valid';
   // }

   $photo_filename = $data['note_id'].".jpg";
   
   $buffer = base64_decode($base);
   file_put_contents($photo_filename, $buffer);   
   
   $filename = $data['note_id'].$data['author_id'].".json";   
   print(" :: ".$filename);   
   
   $data['photo'] = $photo_filename;
   $json = json_encode($data);

   if ($data != null) { /* sanity check */
     header('Content-type: application/json; charset=utf-8');
     // $file = fopen($filename,'w+');
     // $json = str_replace("\\","", $json);
     file_put_contents($filename, $json);
     // fwrite($file, $json);
     // fclose($file);
   } else {
     print("File write error"); // handle error 
   }
