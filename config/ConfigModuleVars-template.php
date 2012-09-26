<?php
/**
 * This class will permitt to set all global variables of the module
 * @Author : Gilles Hemmerlé <gilles.h@iabsis.com>
 */

namespace Igestis\Modules\Samba;

define("IGESTIS_SAMBA_VERSION", "0.1-1");
define("IGESTIS_SAMBA_MODULE_NAME", "Samba");
define("IGESTIS_SAMBA_TEXTDOMAIN", IGESTIS_SAMBA_MODULE_NAME .  IGESTIS_SAMBA_VERSION);
/**
 * Configuration of the module
 *
 * @author Gilles Hemmerlé
 */
class ConfigModuleVars {

    /**
     * @var String Numéro de version du module
     */
    const version = IGESTIS_SAMBA_VERSION;
    /**
     *
     * @var String Name of the module (used only on the source code) 
     */
    const moduleName = IGESTIS_SAMBA_MODULE_NAME;
    
    /**
     *
     * @var String Name of the menu showed to the user (blank if it is a simple service)
     */
    const moduleShowedName = "Samba";
    
    /**
     *
     * @var String textdomain used for this module
     */
    const textDomain = IGESTIS_SAMBA_TEXTDOMAIN;
    
    /**
     * 
     * @var String Samba SID : use the command "net getlocalsid" to get this SID
     */
    const sambaSID = "S-1-5-21-2252709396-1843137321-1411830039";
    
    /**
     * 
     * @var Server hostname of the file server
     */
    const serverName = "SERVER";
    
    /**
     * 
     * @var profilePath the full path where are stored the profiles.
     * Use %u to replace by the username.
     */
    const profilePath = "\\\\SERVER\\%u\\.profiles";
    
    /**
     * 
     * @var homePath UNC home path for the user.
     */
    const homePath = "\\\\SERVER\\%u\\";
    
    /**
     * 
     * @var homeDrive Drive letter map by Windows on homePath.
     */
    const homeDrive = "Z:";
    
    /**
     * 
     * @var LDAP_COMPUTER_OU Where are stored computers informations
     */
    const LDAP_COMPUTER_OU = "ou=Machines,dc=domaine,dc=local";
    
    
    
}
