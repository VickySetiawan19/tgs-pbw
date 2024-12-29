<?php

    try{
        $koneksi = new PDO("mysql:host=localhost;dbname=akademik",'root','Setiawan#123');

    }

    catch(PDOException $e) {    
        echo "koneksi gagal",$e->getMessage();
    }