<?php

class ReportService {

    public function sendReport($xmlReport) {

        // validacija XML-a (osnovna)
        if (empty($xmlReport)) {
            return "Greška: Prazan XML dokument";
        }

        // spremi XML u datoteku (dokaz da SOAP radi)
        $filename = "../xml/report_" . time() . ".xml";
        file_put_contents($filename, $xmlReport);

        return "SOAP servis: Izvještaj uspješno zaprimljen";
    }
}

// SOAP server
$options = [
    'uri' => 'http://localhost/PHPProjekt/soap'
];

$server = new SoapServer(null, $options);
$server->setClass('ReportService');
$server->handle();
