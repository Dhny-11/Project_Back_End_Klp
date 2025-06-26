<?php
class Size {
    private $con;
    public function __construct($con) {
        $this->con = $con;
    }
    public function getAll() {
        return $this->con->query("SELECT Id_Size, Size FROM Size ORDER BY Size");
    }
}