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
$ldapadmin = $_SESSION["admin"];
$connexio = new sessio($ldaphost, $ldappass, $ldapadmin);

	$ldapconn = $connexio->connect();
    //$ldapconn = ldap_connect($ldaphost) or die("No s'ha pogut estabilir una connexió amb el servidor openLDAP.");

    if($ldapconn) {
        $ldapbind = $connexio->bind();
        //$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);
        
        if ($ldapbind) {
            if(isset($_POST['submit'])){

	           $uid=$_POST['uid'];
	           $ou = $_POST['ou'];
	           $cn = $_POST['givenname']." ".$_POST['sn'];
	           $sn = $_POST['sn'];
	           $givenName = $_POST['givenname'];
	           $title=$_POST['title'];
	           $telephoneNumber=$_POST['telephonenumber'];
	           $mobile = $_POST['mobile'];
	           $postalAddress = $_POST['adres'];
	           $description=$_POST['description'];
	           $password=$_POST['password'];

	           //$ldaphost = "ldap://localhost/phpldap";

	           /*$ldapconn = ldap_connect($ldaphost);
	           ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	           $bind = ldap_bind($ldapconn, "cn=admin,dc=fjeclot,dc=net", "fjeclot");*/

	           $dn = 'uid='.$_POST['uid'].',ou='.$_POST['ou'].',dc=fjeclot,dc=net';

		       $newUser['objectClass'][0] = 'top';
		       $newUser['objectClass'][1] = 'person';
		       $newUser['objectClass'][2]='organizationalPerson';
		       $newUser['objectClass'][3]='inetOrgPerson';
		       $newUser['objectClass'][4]='posixAccount';
		       $newUser['objectClass'][5]='shadowAccount';
		       $newUser['uid']=$uid;
		       $newUser['cn']=$cn;
		       $newUser['sn']=$sn;
		       $newUser['givenName']=$givenName;
		       $newUser['title']=$title;
		       $newUser['telephoneNumber']=$telephoneNumber;
		       $newUser['mobile']=$mobile;
		       $newUser['postalAddress']=$postalAddress;
		       $newUser['loginShell']="/bin/bash";
		       $newUser['gidNumber']=$_POST['gidnumber'];
		       $newUser['uidNumber']=$_POST['uidnumber'];
		       $newUser['homeDirectory']="/home/$uid/";
		       $newUser['description']=$description;
		       $newUser['userPassword']=$password;
                 
                       $adduser = $connexio->add($dn, $newUser);

		       if ($adduser) {
					  echo "se ha creado";
					  echo "<form action=\"http://localhost/php_ldap/main.html\" method=\"get\" target=\"_blank\">
						<button class=\"btn btn-primary\" type=\"submit\">Tornar inici</button>
					 </form>";
	           }else{
					  echo "<p class=\"text-danger\">no se ha creado<br></p>";
					  echo "<form action=\"http://localhost/php_ldap/main.html\" method=\"get\" target=\"_blank\">
						<button class=\"btn btn-primary\" type=\"submit\">Tornar inici</button>
					 </form>";
	           }
               }
                else{
                    echo "<p class=\"text-danger\">Error d'autenticació!<br></p>";
                    echo "<form action=\"http://localhost/php_ldap/index2.html\" method=\"get\" target=\"_blank\">
                        <button class=\"btn btn-primary\" type=\"submit\">Tornar inici</button>
                     </form>";
                }
	           }
			}
?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
