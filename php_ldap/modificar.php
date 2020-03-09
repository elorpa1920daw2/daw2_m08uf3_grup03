<html>
	<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<?php
session_start();
include ('class_sessio.php');
    $ldaphost = $_SESSION["host"];
	$ldappass = $_SESSION["ctrs"]; 
    $ldapadmin= $_SESSION["admin"]; 
    $uid_usr= $_POST["uid_usr"];
    $uid_num= $_POST["uid_num"];
    $gid_num= $_POST["gid_num"];
    $ou= $_POST["ou"];
    $dn="uid=".$uid_usr.",ou=".$ou.",dc=fjeclot,dc=net";

    $connexio = new sessio($ldaphost, $ldappass, $ldapadmin);
    //
	// Connectant-se al servidor openLDAP
	$ldapconn = $connexio->connect() or die ("warra");
	//$ldapconn = ldap_connect($ldaphost) or die("No s'ha pogut establir una connexió amb el servidor openLDAP.");
	//
	//Versió del servidor i protocol
	ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
	//
	//Autenticació
	if ($ldapconn) {
		// Autenticant-se en el servidor openLDAP
		$ldapbind = $connexio->bind();
		//$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		// Accedint a les dades de la BD LDAP
        if ($ldapbind) {        
            if ($gid_num!=null && $uid_num!=null){
                $newUser['uidNumber']=$uid_num;
                $newUser['gidNumber']=$gid_num;

                $result=ldap_modify($ldapconn, $dn, $newUser);

                if ($result){
                    echo "Usuari modificat";
                    echo "<form action=\"http://localhost/php_ldap/main.html\" method=\"get\" target=\"_blank\">
                        <button class=\"btn btn-primary\" type=\"submit\">Tornar inici</button>";
                }
                else{
                    echo "<p class=\"text-danger\">Error en la modificacio del usuari</p>";
                    echo "<form action=\"http://localhost/php_ldap/main.html\" method=\"get\" target=\"_blank\">
                        <button class=\"btn btn-primary\" type=\"submit\">Tornar inici</button>";
                }
            }
            else{
                echo "<p class=\"text-danger\">Error de dades del formulari</p>";
                    echo "<form action=\"http://localhost/php_ldap/main.html\" method=\"get\" target=\"_blank\">
                        <button class=\"btn btn-primary\" type=\"submit\">Tornar inici</button>";
            }
        }
        else{
            echo "<p class=\"text-danger\">Error d'autenticació!<br></p>";
                    echo "<form action=\"http://localhost/php_ldap/index2.html\" method=\"get\" target=\"_blank\">
                        <button class=\"btn btn-primary\" type=\"submit\">Tornar inici</button>
                     </form>";
        }
    }
?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>