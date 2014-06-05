<?php

Namespace Info;

class DBConfigureInfo extends Base {

    public $hidden = false;

    public $name = "Database Connection Configuration Functions";

    public function _construct() {
      parent::__construct();
    }

    public function routesAvailable() {
      return array( "DBConfigure" => array_merge(parent::routesAvailable(),
        array("configure", "config", "conf", "reset") ) );
    }

    public function routeAliases() {
      return array("dbconfigure"=>"DBConfigure", "db-configure"=>"DBConfigure", "db-conf"=>"DBConfigure");
    }

    public function autoPilotVariables() {
      return array(
        "DBConfigure" => array(
          "dbResetExecute" => array(
            "dbResetExecute" => "boolean",
            "dbResetPlatform" => "string", ) ,
          "dbConfigureExecute" => array(
            "dbConfigureExecute" => "boolean",
            "dbConfigureDBHost" => "string",
            "dbConfigureDBUser"=>"string",
            "dbConfigureDBPass"=>"string",
            "dbConfigureDBName"=>"string",
            "dbConfigurePlatform"=>"string", ) ,
        ) ,
      );
    }

    public function helpDefinition() {
      $help = <<<"HELPDATA"
  This command is part of Default Modules and handles Databasing Functions.

  DBConfigure, db-configure, dbconfigure, db-conf

      - configure, conf
      set up db user & pw for a project, use admins to create new resources as needed.
      example: dapperstrano db-conf conf drupal
      example: dapperstrano db-conf conf --yes --platform=joomla30 --mysql-host=127.0.0.1 --mysql-admin-user="" --mysql-user="impi_dv_user" --mysql-pass="impi_dv_pass" --mysql-db="impi_dv_db"

      - reset
      reset current db to generic values so dapperstrano can write them. may need to be run before db conf.
      example: dapperstrano db-conf reset drupal
      example: dapperstrano db-conf reset --yes --platform=joomla30

HELPDATA;
      return $help ;
    }

}