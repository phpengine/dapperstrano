<?php

/*************************************
*      Generated Autopilot file      *
*     ---------------------------    *
*Autopilot Generated By Dapperstrano *
*     ---------------------------    *
*************************************/

Namespace Core ;

class AutoPilotConfigured extends AutoPilot {

    public $steps ;

    public function __construct() {
	    $this->setSteps();
        $this->setVHostTemplate();
    }

    /* Steps */
    private function setSteps() {

	    $this->steps =
	      array(
              array ( "Project" => array(
                  "projectInitializeExecute" => true,
              ) , ) ,
              array ( "HostEditor" => array(
                  "hostEditorAdditionExecute" => true,
                  "hostEditorAdditionIP" => "<%tpl.php%>dap_apache_vhost_ip</%tpl.php%>",
                  "hostEditorAdditionURI" => "<%tpl.php%>dap_apache_vhost_url</%tpl.php%>.local",
              ) , ) ,
              array ( "ApacheVHostEditor" => array(
                  "virtualHostEditorAdditionExecute" => true,
                  "virtualHostEditorAdditionDocRoot" => "<%tpl.php%>dap_proj_cont_dir</%tpl.php%>",
                  "virtualHostEditorAdditionURL" => "<%tpl.php%>dap_apache_vhost_url</%tpl.php%>.local",
                  "virtualHostEditorAdditionIp" => "<%tpl.php%>dap_apache_vhost_ip</%tpl.php%>",
                  "virtualHostEditorAdditionTemplateData" => "",
                  "virtualHostEditorAdditionDirectory" => "/etc/apache2/sites-available",
                  "virtualHostEditorAdditionFileSuffix" => "",
                  "virtualHostEditorAdditionVHostEnable" => true,
                  "virtualHostEditorAdditionSymLinkDirectory" => "/etc/apache2/sites-enabled",
                  "virtualHostEditorAdditionApacheCommand" => "apache2",
              ) , ) ,
              array ( "DBConfigure" => array(
                    "dbResetExecute" => true,
                    "dbResetPlatform" => "<%tpl.php%>dap_db_platform</%tpl.php%>",
              ) , ) ,
              array ( "DBConfigure" => array(
                    "dbConfigureExecute" => true,
                    "dbConfigureDBHost" => "<%tpl.php%>dap_db_ip_address</%tpl.php%>",
                    "dbConfigureDBUser" => "<%tpl.php%>dap_db_app_user_name</%tpl.php%>",
                    "dbConfigureDBPass" => "<%tpl.php%>dap_db_app_user_pass</%tpl.php%>",
                    "dbConfigureDBName" => "<%tpl.php%>dap_db_name</%tpl.php%>",
                    "dbConfigurePlatform" => "<%tpl.php%>dap_db_platform</%tpl.php%>",
              ) , ) ,
              array ( "DBInstall" => array(
                    "dbDropExecute" => true,
                    "dbDropDBHost" => "<%tpl.php%>dap_db_ip_address</%tpl.php%>",
                    "dbDropDBName" => "<%tpl.php%>dap_db_name</%tpl.php%>",
                    "dbDropDBRootUser" => "****dap_db_admin_user_name****",
                    "dbDropDBRootPass" => "****dap_db_admin_user_pass****",
                    "dbDropUserExecute" => true,
                    "dbDropDBUser" => "<%tpl.php%>dap_db_app_user_name</%tpl.php%>",
              ) , ) ,
              array ( "DBInstall" => array(
                    "dbInstallExecute" => true,
                    "dbInstallDBHost" => "<%tpl.php%>dap_db_ip_address</%tpl.php%>",
                    "dbInstallDBUser" => "<%tpl.php%>dap_db_app_user_name</%tpl.php%>",
                    "dbInstallDBPass" => "<%tpl.php%>dap_db_app_user_pass</%tpl.php%>",
                    "dbInstallDBName" => "<%tpl.php%>dap_db_name</%tpl.php%>",
                    "dbInstallDBRootUser" => "****dap_db_admin_user_name****",
                    "dbInstallDBRootPass" => "****dap_db_admin_user_pass****",
              ) , ) ,
              array ( "Version" => array(
                    "versionExecute" => true,
                    "versionAppRootDirectory" => "<%tpl.php%>dap_proj_cont_dir</%tpl.php%>",
                    "versionArrayPointToRollback" => "0",
                    "versionLimit" => "<%tpl.php%>dap_version_num_revisions</%tpl.php%>",
              ) , ) ,
              array ( "ApacheControl" => array(
                  "apacheCtlRestartExecute" => true,
              ) , ) ,
	      );

	  }


 // This function will set the vhost template for your Virtual Host
 // You need to call this from your constructor
 private function setVHostTemplate() {
   $this->steps[2]["ApacheVHostEditor"]["virtualHostEditorAdditionTemplateData"] =
  <<<'TEMPLATE'
 NameVirtualHost ****IP ADDRESS****:80
 <VirtualHost ****IP ADDRESS****:80>
   ServerAdmin webmaster@localhost
 	ServerName ****SERVER NAME****
 	DocumentRoot ****WEB ROOT****src
 	<Directory ****WEB ROOT****src>
 		Options Indexes FollowSymLinks MultiViews
 		AllowOverride All
 		Order allow,deny
 		allow from all
 	</Directory>
   ErrorLog /var/log/apache2/error.log
   CustomLog /var/log/apache2/access.log combined
 </VirtualHost>

 NameVirtualHost ****IP ADDRESS****:443
 <VirtualHost ****IP ADDRESS****:443>
 	 ServerAdmin webmaster@localhost
 	 ServerName ****SERVER NAME****
 	 DocumentRoot ****WEB ROOT****src
     SSLEngine on
     SSLCertificateFile /etc/ssl/certs/ssl-cert-snakeoil.pem
     SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key
   # SSLCertificateChainFile /etc/apache2/ssl/bundle.crt
 	 <Directory ****WEB ROOT****src>
 		 Options Indexes FollowSymLinks MultiViews
		AllowOverride All
		Order allow,deny
		allow from all
	</Directory>
  ErrorLog /var/log/apache2/error.log
  CustomLog /var/log/apache2/access.log combined
  </VirtualHost>
TEMPLATE;
}


}
