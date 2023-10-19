<?php

try
{
	$db = new PDO('mysql:host=localhost;dbname=gestion_des_taches;charset=utf8', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>