<?php 

    include('SplitCsvFileClass.php');


    $obj = new Dj\Tools\SplitCsvFile();
    //$obj->echoVariable('filePrefix');

    $obj->changeStoreDir('./tempfile');
    $obj->changePrefix('nohead_');

    //$obj->changeAddFirstOrNot(true);
    //$obj->changePrefix('withhead_');

    try{
        $obj->split('testbigfile.csv');
    }catch(Exception $e){
        echo 'Error Message: '.$e->getMessage()."\r\n";
    }
