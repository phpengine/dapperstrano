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
  public $swaps ;

  public function __construct() {
    $this->setSteps();
    $this->setSSHData();
  }

  /* Steps */
  private function setSteps() {

    $this->steps =
      array(
        array ( "InvokeSSH" => array(
          "sshInvokeSSHDataExecute" => true,
          "sshInvokeSSHDataData" => "",
          "sshInvokeServers" => array(
              ****gen_srv_array_text****
            ),
        ) , ) ,
        );

    }


//
// This function will set the sshInvokeSSHDataData variable with the data that
// you need in it. Call this in your constructor
//
  private function setSSHData() {
    $timeDrop = time();
    $this->steps[0]["InvokeSSH"]["sshInvokeSSHDataData"] = <<<"SSHDATA"
cd ****gen_env_tmp_dir****
git clone -b ****dap_git_custom_branch**** --no-checkout --depth 1 ****dap_git_repo_url**** dapper$timeDrop
cd dapper$timeDrop
git show HEAD:build/config/dapperstrano/autopilots/****gen_env_name****-install-code-data.php > ****gen_env_tmp_dir********gen_env_name****-install-code-data.php
rm -rf ****gen_env_tmp_dir****dapper$timeDrop
cd ****gen_env_tmp_dir****
sudo dapperstrano autopilot execute ****gen_env_name****-install-code-data.php
sudo chown -R www-data ****dap_proj_cont_dir****current/src
sudo rm ****gen_env_name****-install-code-data.php
SSHDATA;
  }

}
