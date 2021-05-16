<?php
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;


final class prt{
final public function printVenta(){
    try{
        
$profile = CapabilityProfile::load("simple");
//$conector = new WindowsPrintConnector("smb://user:pass@maquina1/epson_tm34");
$conector = new WindowsPrintConnector("smb://adela:1997@LAPTOPADE/Brother_DCP-T510W1");
//adelaida.molinar1997@gmail.com:Adelaida_97
$print = new Printer($conector, $profile);

        $connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);
$printer -> text("Hello World!\n");
$printer -> cut();
            $printer->close();
    }catch(Exception $e){
        return $e->getMessage();
    }
}
}
?>