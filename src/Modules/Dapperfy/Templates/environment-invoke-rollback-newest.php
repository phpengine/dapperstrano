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
    }

    /* Steps */
    private function setSteps() {

        $this->steps =
        array(
            array ( "Logging" => array( "log" => array(
                "log-message" => "Lets begin invoking Rollback to newest Version on environment <%tpl.php%>env_name</%tpl.php%>"
            ), ) ),
            array ( "Logging" => array( "log" => array(
                "log-message" => "First lets SFTP over our Dapper Autopilot"
            ), ) ),
            array ( "SFTP" => array( "put" => array(
                "source" => getcwd()."/build/config/dapperstrano/autopilots/<%tpl.php%>env_name</%tpl.php%>-node-install-rollback-newest.php",
                "target" => "<%tpl.php%>gen_env_tmp_dir</%tpl.php%><%tpl.php%>env_name</%tpl.php%>-node-install-rollback-newest.php",
                "environment-name" => "<%tpl.php%>env_name</%tpl.php%>"
            ) , ) , ) ,
            array ( "Logging" => array( "log" => array(
                "log-message" => "Lets run that autopilot"
            ), ) ),
            array ( "Invoke" => array( "data" =>  array(
                "guess" => true,
                "ssh-data" => $this->setSSHData(),
                "environment-name" => "<%tpl.php%>env_name</%tpl.php%>"
            ), ), ),
            array ( "Logging" => array( "log" => array(
                "log-message" => "Invoking Rollback to newest Version on environment <%tpl.php%>env_name</%tpl.php%> complete"
            ), ) ),
        );

    }

    private function setSSHData() {
        $sshData = <<<"SSHDATA"
cd <%tpl.php%>gen_env_tmp_dir</%tpl.php%>
sudo dapperstrano autopilot execute <%tpl.php%>env_name</%tpl.php%>-node-install-rollback-newest.php
sudo rm <%tpl.php%>env_name</%tpl.php%>-node-install-rollback-newest.php
SSHDATA;
        return $sshData ;
    }

}
