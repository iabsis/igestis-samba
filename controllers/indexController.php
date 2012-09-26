<?php
// controllers/indexController.php

// Les controleurs dans le namespace du module
namespace Igestis\Modules\Samba;

/**
 * Show the admin page for Samba
 */
class indexController extends \IgestisController {
    /**
     * We show the computer list.
     */
    public function indexAction() {
        // Get list of all computers
        try {
            $computer_list = new SambaComputers;
            $computers = $computer_list->listComputers();
        } catch (\Exception $e) {
            \IgestisErrors::createWizz($e);
        }
        
        $this->context->render("pages/adminSamba.twig", array('computer_list' => $computers));
    }
}