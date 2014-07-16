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
                    "log-message" => "Lets begin invoking a Continuous Build job to Staging on environment <%tpl.php%>env_name</%tpl.php%>"
                ), ) ),
                array ( "Logging" => array( "log" => array(
                    "log-message" => "Lets ssh over the build install command"
                ), ) ),
                array ( "Invoke" => array( "data" =>  array(
                    "guess" => true,
                    "ssh-data" => $this->setSSHData(),
                    "environment-name" => "<%tpl.php%>env_name</%tpl.php%>"
                ), ), ),
                array ( "Logging" => array( "log" => array(
                    "log-message" => "Invoking Continuous Build job from Staging on environment <%tpl.php%>env_name</%tpl.php%> complete"
                ), ) ),
            );

    }

    private function setSSHData() {
        $sshData = <<<"SSHDATA"
cd <%tpl.php%>gen_env_tmp_dir</%tpl.php%>
sudo rm -rf <%tpl.php%>jenkins-home</%tpl.php%>/jobs/<%tpl.php%>target-job-name</%tpl.php%>*
sudo dapperstrano builderfy continuous-staging --yes --jenkins-home="<%tpl.php%>jenkins-home</%tpl.php%>" --target-job-name="<%tpl.php%>target-job-name</%tpl.php%>" --project-description="<%tpl.php%>project_description</%tpl.php%>" --primary-scm-url="<%tpl.php%>source_scm_url</%tpl.php%>" --source-branch-spec="<%tpl.php%>source_branch_spec</%tpl.php%>" --source-scm-url="<%tpl.php%>source_scm_url</%tpl.php%>" --days-to-keep="<%tpl.php%>days_to_keep</%tpl.php%>" --amount-to-keep="<%tpl.php%>num_to_keep</%tpl.php%>" --autopilot-test-invoke-install-file="<%tpl.php%>autopilot-test-invoke-install-file</%tpl.php%>" --data-handling-type="<%tpl.php%>data-handling</%tpl.php%>" --error-email="<%tpl.php%>error-email</%tpl.php%>"
sudo service jenkins restart
SSHDATA;
        return $sshData ;
    }

}
