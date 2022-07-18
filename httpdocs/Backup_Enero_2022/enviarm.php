<?php
$header="From: info@airpharm.com";
$asunto="Test de envio de mail";
$cuerpo="Està es una prueba de  envio de email desde airfarma";
$destinatario="jcaros@airpharmlogistics.com";
mail($destinatario,utf8_decode($asunto),utf8_decode($cuerpo),$header);
echo "envio ok";
?>
