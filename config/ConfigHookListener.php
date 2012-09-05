<?php

/**
 * Hook listener for the roundcube module
 *
 * @author Gilles Hemmerlé
 */
namespace Igestis\Modules\Samba;

/**
 * Hook listener for the Samba module
 */
class ConfigHookListener implements \Igestis\Interfaces\HookListenerInterface  {
    /**
     * 
     * @param string $HookName The name of the hook  that was fired
     * @param \Igestis\Types\HookParameters $params List of parameters sent by the hook to all the listeners
     * @return boolean True if the hook was intercepted by this listener, false else ...
     */
    public static function listen($HookName, \Igestis\Types\HookParameters $params = null) {
        switch ($HookName) {
            // Fired when a contact was updated and stored in the ldap database
            case "afterContactLdapSave" :
                new SambaLdapUpdate($params->get("contact"));
                return true;
                break;
            // Default, do nothing
            default:
                break;
        }
        
        // If gone here, the hook has not been managed
        return false;
    }
}