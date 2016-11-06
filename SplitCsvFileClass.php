<?php 

/**
* Class SplitCsvFile
* Author : KaiChen (dj31416@gmail.com)
*/

namespace Dj\Tools;


class SplitCsvFile {


    public $regularRow;             // how many rows in a single split file
    public $filePrefix;             // split file's prefix of name
    public $file;                   // where the file is
    public $store_dir;              // where the split files be stored
    public $addFistRowToEachFile;   // add original file's first row to each split file or not
    public $splitAns;               // default : 2  //if show the message of "Output file suffixes exhausted" , need to level the value up 
    
    public function __construct() {

        $this->regularRow=500;
        $this->filePrefix='Split_';
        $this->file='';
        $this->store_dir='./';
        $this->addFistRowToEachFile = false;
        $this->splitAns = 2;

    }
    /**
    * change the spilt files stored dir
    */
    
    public function changeStoreDir($value){
    
        $this->store_dir=$value;

    }
    
    /**
    * change the spilt files prefix
    */
    public function changePrefix($value){
    
        $this->filePrefix=$value;

    }

    /**
    * change the split ans value
    */
    public function changeAns($value){
        $this->splitAns = $value;

    }


    /**
    * determine add original file's first row to each split file or not
    */
    public function changeAddFirstOrNot($value){

        $this->addFistRowToEachFile = $value;
    }


    /**
    * echo variable to check value is correct or not
    */
    public function echoVariable($name){
        echo $this->{$name};
    }

    
    /**
    * starting split file
    */
    public function split($whereIsFile){

        //check folder
        if(!is_dir($this->store_dir)){
            throw new Exception("the destination folder does not exist");
            exit;
        }   

        //check file
        $this->file = $whereIsFile;
        if($this->file==''){
            throw new Exception("file couldn't be blank");
            exit;
        }

        //starting split file
        if($this->addFistRowToEachFile){ // have to add origin file's first row to each split file

            exec('
                 tail -n +2 '.$this->file.' | split -a '.$this->splitAns.' -l 500 - \''.$this->store_dir.'/\''.$this->filePrefix.'
                 for file in \''.$this->store_dir.'/\''.$this->filePrefix.'*
                 do
                     head -n 1 '.$this->file.' > tmp_file
                     cat $file >> tmp_file
                     mv -f tmp_file $file
                 done
            ');

        }else{ //no need to add origin file's first row to each split file

            exec('
                 tail -n +2 '.$this->file.' | split -a '.$this->splitAns.' -l 500 - \''.$this->store_dir.'/\''.$this->filePrefix.'
            ');

        }

    }




}



