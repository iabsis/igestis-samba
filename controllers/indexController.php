<?php
// controllers/indexController.php

// Les controleurs dans le namespace du module
namespace Igestis\Modules\Samba;

/**
 * Contrôleur permettant de lancer les différentes actions sur les tickets
 */
class indexController extends \IgestisController {
    /**
     * Affiche le tableau avec la liste des tickets
     */
    public function indexAction() {
        // Get list of all computers
        try {
          $computer_list = new SambaComputers;
        } catch (Exception $e) {
          new \wizz(_("Problem during the ldap connection") . $e);
        }
        
      
      
        $this->context->render("pages/adminSamba.twig", array('computer_list' => $computer_list->listComputers()));
    }
}