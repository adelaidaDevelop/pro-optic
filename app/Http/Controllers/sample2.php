<?php
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
$profile = CapabilityProfile::load("simple");
$connector = new WindowsPrintConnector("smb://computer/printer");
$printer = new Printer($connector, $profile);


//$profile = CapabilityProfile::load("simple");
////$conector = new WindowsPrintConnector("smb://user:pass@maquina1/epson_tm34");
//$conector = new WindowsPrintConnector("smb://user:pass@LAPTOP-U1QFAR2U/Brother_DCP-T510W1");
//$print = new Printer($conector, $profile);
?>