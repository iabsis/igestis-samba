<?php
// config/ConfigInitModule.php

// Le fichier de config se trouve dans le namespace du module
namespace Igestis\Modules\Samba;

/* 
 * La classe ConfigInitModule sera lancée par le coeur de l'application à différents moments,
 * afin de  rapatrier la liste des droits ou les entrées du menu.
 * Il est conseillé d'implémenter les interfaces ConfigMenuInterface et
 * ConfigRightsListInterface afin que votre logiciel puisse aisément vous aider à compléter
 * les méthodes abstraites.
 */
class ConfigInitModule implements \Igestis\Interfaces\ConfigMenuInterface {

  
public static function getRightsList() {
        $module =   array(
            /* MODULE_NAME 
             * contient la référence de l'application que le core a besoin de connaitre */
            "MODULE_NAME" => ConfigModuleVars::moduleName,
            /* MODULE_FULL_NAME 
             * contient le nom de l'application tel qu'affiché dans la gestion des droits */
            "MODULE_FULL_NAME" => _(ConfigModuleVars::moduleShowedName),
            /* RIGHTS_LIST 
             * contient la liste des droits qu'on va définir plus bas */
            "RIGHTS_LIST" => NULL);
        
        /* On définit maintenant la liste des droits */
        $module['RIGHTS_LIST'] =  array(
            /* Premier droit "None"*/
            array(
                /* CODE 
                 * contient le code du droit utilisé comme référence dans la base de données */
                "CODE" => "NONE",
                /* NAME 
                 * contient le  nom du droit tel qu'affiché dans la page 
                 * d'administration des droits */
                "NAME" => "None",
                /* DESCRIPTION 
                 * contient la description du droit pour que l'administrateur sache ce à quoi 
                 * aura accès l'utilisateur disposant de ce droit */
                "DESCRIPTION" => "There is no right available for this module"
            )
        );
        
        return $module;
    }
    
    
    
    
    /* Ajoute au menu les différentes url, inutile de faire des vérifications des droits, 
     * le core ne les affichera automatiquement que pour les personnes aillant le droit 
     * d'accéder à la page.
     */
    public static function menuSet(\Application $context, \IgestisMenu &$menu) {
        /**
         * $menu->additem prend 3 paramètres
         * - Le nom du menu de la racine dans lequel placer l'entrée (ici dans le menu Modules)
         * - Le nom de l'entrée dans le menu (ici on crée l'entrée tickets dans le menu Modules)
         * - La route à lancer
         */
        $menu->addItem(
                dgettext(ConfigModuleVars::textDomain, "Administration"), 
                dgettext(ConfigModuleVars::textDomain, "Samba"), 
                "admin_samba"
        );
    }
}

