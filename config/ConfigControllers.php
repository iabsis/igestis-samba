<?php
// config/ConfigControllers.php

// Le fichier de config se trouve dans le namespace du module
namespace Igestis\Modules\Samba;

class ConfigControllers extends \IgestisConfigController {
    /**
     * Retourne un tableau (attention à garder la même syntaxe de tableau)
     * contenant la liste des routes du module.
     * @return Array Liste des routes de ce module
     */
    public static function get() {
        return  array(
            /*********** Routes for the Samba module ***********/
            array(
                "id" => "admin_samba",
                "Parameters" => array(
                    "Module" => "Samba",
                    "Action" => "home"
                ),
                "Controller" => "\Igestis\Modules\Samba\indexController",
                "Action" => "indexAction",
                "Access" => array("CORE:ADMIN")
            )
            
         );
    }
}