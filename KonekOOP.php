<?php 
class KonekOOP{
    protected $con;

    function __construct(){
        $this->con = mysqli_connect("localhost", "root", "", "boutique");
    }
}
