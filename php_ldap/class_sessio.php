<?php
class sessio {

    public $ldaphost;
	public $ldappass;
    public $ldapadmin;
    public $ldapconn;

    public function __construct($ldaphost, $ldappass, $ldapadmin){
        $this->ldaphost=$ldaphost;
        $this->ldappass=$ldappass;
        $this->ldapadmin=$ldapadmin;
    }

    public function connect(){
        $this->ldapconn = ldap_connect($this->ldaphost) or die("No s'ha pogut establir una connexió amb el servidor openLDAP.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        return $this->ldapconn;
    }

    public function bind(){
        $connexion = ldap_bind($this->ldapconn, $this->ldapadmin, $this->ldappass);
        return $connexion;
    }

    public function search($ldapusr){
        return ldap_search($this->ldapconn, "dc=fjeclot,dc=net", "uid=".$ldapusr);
    }

    public function delete($ldap_dc){
        return ldap_delete($this->ldapconn, $ldap_dc);
    }

    public function add($dn, $newUser){
        return ldap_add($this->ldapconn, $dn, $newUser);
    }

    public function __destruct(){
        ldap_close($this->ldapconn);
    }


}

?>