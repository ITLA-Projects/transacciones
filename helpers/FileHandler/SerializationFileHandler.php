<?php

class SerializationFileHandler implements IFileHandler
{
    public $directory;
    public $filename;

    function __construct($directory,$filename)
    {
        $this->directory = $directory;
        $this->filename = $filename;
    }

    function CreateDirectory()
    {
        if (!file_exists($this->directory)) {
            mkdir($this->directory,0777, true);
        }
    }



    function ReadFile()
    {

        $this->CreateDirectory($this->directory);
        $path = $this->directory . "/" . $this->filename . ".txt";

        if (file_exists($path)) {
            $file = fopen($path, "r");
            $contents = fread($file, filesize($path));
            fclose($file);
            return unserialize($contents);
        } else {
            return false;
        }
    }

    function SaveFile($value)
    {

        $this->CreateDirectory($this->directory);
        $path = $this->directory . "/" . $this->filename . ".txt";

        

        $serializeData = serialize($value);

        $file = fopen($path, "a");
        fwrite($file, $serializeData . PHP_EOL);
        fclose($file);
    }

    function LoadCustomFile($path)
    {
        
    }
}
