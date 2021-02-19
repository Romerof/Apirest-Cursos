<?php
class Provider{
    public static function getConnection() {
        $link = new PDO('mysql:host=localhost;dbname=apirest','root','');
        $link -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $link -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $link;
    }
}