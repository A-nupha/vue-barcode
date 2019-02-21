
<?php 

// header('Content-type: text/plain');
  $url = $_GET['url'];
  // $url = "https://www.dit.go.th/rss_news_procurement1.aspx" ;
  $base = "http://172.16.21.218/vdc/server/public/api"  ;

  function Parse ($url) {
    $fileContents= file_get_contents( $url); 
    return $fileContents; 
  } 
  echo Parse( $base . $url); 
?>
