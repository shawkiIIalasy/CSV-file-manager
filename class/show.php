<?php
if($file=fopen('../files/'.$_GET['fileName'],'r'))
{
    while ($data=fgetcsv($file,100000,','))
    {
        foreach ($data as $datum)
        {
            echo $datum,',';
        }
        echo "<br>";
    }
}else
{
    echo "File Does Not Exist";
}