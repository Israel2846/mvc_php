<?php
session_start();

class Conectar
{
    protected $dbh;

    protected function Conexion()
    {
        try {
            $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=mvc_php", "root", "");
            return $conectar;
        } catch (Exception $e) {
            print("¡Error en la base de datos!:" . $e->getMessage() . "</br>");
            die();
        }
    }

    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    public function ruta()
    {
        return "http://localhost/mvc_php/";
    }
}
