<?php
session_start();

    $lloc=$_GET["opcio"];
    switch($lloc){
        case "crear":
            header( 'Location: http://localhost/php_ldap/crear.html' ) ;
        break;
        case "esborrar":
            header( 'Location: http://localhost/php_ldap/esborrar.html' ) ;
        break;
        case "mostrar":
            header( 'Location: http://localhost/php_ldap/mostrar.html' ) ;
        break;
        case "modificar":
            header( 'Location: http://localhost/php_ldap/modificar.html' ) ;
        break;
        case "inici":
            header( 'Location: http://localhost/php_ldap/index2.html' ) ;
        break;
    }
    //header( 'Location: http://localhost/php_ldap/main.html' ) ;

?>