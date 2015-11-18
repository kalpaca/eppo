<?php
return array(
    'pdf' => array(
        'enabled' => true,
        //linux 64bit server
        'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        //windows 64bit server
        //'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf.exe'),
        'timeout' => false,
        'options' => array(),
    )
);