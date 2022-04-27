<?php 
include 'conn.php';
$xml = $_REQUEST['xml'];
$xml = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xml);
class Module{
    public $Id;
    public $Name;
}
$programmes = null;
$xml = new SimpleXMLIterator($xml);
$i=0;
for( $xml->rewind(); $xml->valid(); $xml->next() ) {
    
  echo "-----------PROGRAMME------<br>";
  foreach($xml->programme[$i]->attributes() as $a => $b)
  {
    
    
  echo $a,' = ',$b,"<br>";
  }
  
  if($xml->hasChildren()){
    foreach($xml->getChildren() as $value) {
        echo "-----------MODULE------<br>";
        foreach($value->attributes() as $a => $b)
        {
           
        echo $a,' = ',$b,"<br>";
        }
      }
  }
  $i++;
}


?>