<?php

interface IFileHandler{
    function CreateDirectory();
    function SaveFile($value);
    function ReadFile();
    function LoadCustomFile($path);
}

?>