<?php
if (!isset($_POST['fileName'])):
    die();
endif;

$file=fopen("../files/".$_POST['fileName'].".csv",'w');

if($file==false):
    die('Error when open file');
endif;
fputcsv($file,$_POST['title']);
for($i=0;$i<$_POST['rows'];$i++)
{
        fputcsv($file,$_POST['row'.$i]);
}
fclose($file);
Header('Location: ../home.php');
