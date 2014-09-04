<?php

namespace Igestis\Modules\Samba;

/**
 * Thie class is designed to update all samba fields in the ldap database
 *
 * @author Gilles Hemmerlé
 */
class SambaLdapUpdate {

    /**
     *
     * @var \CoreContacts Contact to update in LDAP
     */
    private $contact;

    /**
     * Constructor will update all datas in ldap to integrate the employee in the ldap samba environment
     * @param \CoreContacts $contact
     */
    public function __construct(\CoreContacts $contact) {
        
        // If the ldap synchronization is not activated, quit the script
        if(\ConfigIgestisGlobalVars::USE_LDAP != true) return;
        
        $this->contact = $contact;
        if ($this->contact->getUser()->getUserType() != "employee")
            return;

        try {
            // Connect the ldap database
            $ldap = new \LDAP(\ConfigIgestisGlobalVars::LDAP_URIS, \ConfigIgestisGlobalVars::LDAP_BASE);
            $ldap->bind(\ConfigIgestisGlobalVars::LDAP_ADMIN, \ConfigIgestisGlobalVars::LDAP_PASSWORD);

            // Search the person
            $nodesList = $ldap->find("(uid=" . $this->contact->getLogin() . ")");      
            
            // If noone found, quit this script, the person should be created from the main script, if not, we cannot update it...
            if(!$nodesList) return;
            
            //Replacements in differents vars.
            $profilePath = str_replace(array('%u'), array($this->contact->getLogin()), ConfigModuleVars::profilePath);
            $homePath = str_replace(array('%u'), array($this->contact->getLogin()), ConfigModuleVars::homePath);
            if(defined("Igestis\Modules\Samba\ConfigModuleVars::loginShell")) {
              $loginShell =  ConfigModuleVars::loginShell;
            } else {
              $loginShell = "/sbin/nologin";
            }

             // Global datas
            $ldapArray = array(
                "objectClass" => array("sambaSamAccount"),                
                "homeDirectory" => "/home/" . $this->contact->getLogin(),
                "loginShell" => $loginShell,
                "sambaAcctFlags" => "[U]",
                "sambaHomeDrive" => ConfigModuleVars::homeDrive,
                "sambaHomePath" => $homePath,
                "sambaKickoffTime" => "2147483647",
                "sambaPrimaryGroupSID" => ConfigModuleVars::sambaSID . "-513",
                "sambaProfilePath" => $profilePath,
                "sambaPwdCanChange" => "0",
                "sambaPwdLastSet" => "2147483647",
                "sambaPwdMustChange" => "2147483647"                  
            );
            
            // Create the new sambaSID if the person has not one before
            $oldValues = $nodesList->getEntries();
            if(!isset($oldValues[0]['sambaSID'])) {
                $uidNumber = $oldValues[0]['uidnumber'][0];
                $ldapArray["sambaSID"] = ConfigModuleVars::sambaSID . "-" . $uidNumber;
            }
            
            // Create the password for samba connections
            $plainPassword = $this->contact->getPlainPassword();
            if($plainPassword) {
                $ldapArray["userPassword"]  = '{MD5}' . base64_encode(pack('H*', md5($plainPassword)));
                $sambapassword = new smbHash;
                $LM = $sambapassword->lmhash($plainPassword);
                $ldapArray["sambaLMPassword"] = $LM;
                $NT = $sambapassword->nthash($plainPassword);
                $ldapArray["sambaNTPassword"] = $NT;
            }
            
            $ldap_array = array_filter($ldapArray);
            
            // Launch the update in the ldap database
            foreach ($nodesList as $node) {
                $node->modify($ldap->mergeArrays($nodesList, $ldapArray));
            }
        } catch (Exception $exc) {
            new \wizz(_("Problem during the samba ldap update") . (\ConfigIgestisGlobalVars::DEBUG_MODE ? "<br />" . $exc->getTraceAsString() : ""), \wizz::$WIZZ_WARNING);
        }
    }    
    
}