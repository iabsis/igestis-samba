iGestis Samba
=============

Table of content
================

* What is iGestis Samba
* iGestis Samba installation

What is iGestis Samba
============================

iGestis Samba is a module dedicated for iGestis core software. It adds the
OpenLDAP schema for Samba 3 series for employee management.

Warning : the module installation doesn't affect the existing employees, they
have to be edited one by one in order to get the new Samba attributes.

iGestis Samba installation
==========================

Debian/Ubuntu installation
--------------------------

The installation is quite simple from Debian or Ubuntu and if you already
have the iGestis repository.

    apt-get install igestis-samba

Other operating system
----------------------

Create an empty directory under modules named Samba and place the content of
the module inside. Rename or copy config/ConfigModuleVars-template.php to 
config/ConfigModuleVars.php and modify the value inside following your Samba
setup.
