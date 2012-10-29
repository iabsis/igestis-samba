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
                dgettext(ConfigModuleVars::textDomain, "Domain's computers"), 
                "admin_samba"
        );
    }
}

