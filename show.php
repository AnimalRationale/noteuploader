<?PHP
  $jsons = array();
  $jsons_path = getcwd();
  $dir = opendir($jsons_path);
    while ($file = readdir($dir)) {
         if (eregi("\.json",$file)) {
             $jsons[] = $file;
         }
    }
    sort($jsons);

  echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <link rel='stylesheet' type='text/css' href='show.css' /><html><body>";

  foreach ($jsons as $json){
    $data = json_decode(file_get_contents($json), true);
    echo "<div class='title'>".$data['title']."</div></br><div class='date'>".$data['date'].", ".$data['time']."</br>";
    echo "<div class='author'>".$data['author']."</div></br>";
    echo "<div class='note'>".$data['note']."</div></br>";
    if ($data['rotation'] == "yes") {
      echo "</br></br></br></br></br><img src='".$data['photo']."' style='-webkit-transform: rotate(90deg)'; alt='note_photo' />";
    } else {
        echo "<img src='".$data['photo']."'; alt='note_photo' />";
    }
    if ($data['location'] != "") {
      $location = explode(",", $data['location']);
      $lat = $location[0];
      $lng = $location[1];
      echo "<iframe width='400px' height='486px' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://maps.google.com/maps?q=".$lat.",".$lng."&amp;ie=UTF8&amp;z=14&amp;output=embed&amp;'></iframe>";
    }
    echo "</br></br></br></br></br></br>";
    echo "<hr class='noteline'>";
  }

  echo "</body></html>";

?>
