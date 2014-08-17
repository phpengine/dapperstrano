<?php

Namespace Model;

class DapperfyJoomlaAllOS extends DapperfyAllOS {

    // Compatibility
    public $os = array("any") ;
    public $linuxType = array("any") ;
    public $distros = array("any") ;
    public $versions = array("any") ;
    public $architectures = array("any") ;

    // Model Group
    public $modelGroup = array("DapperfyJoomlaPhlagrant") ;

    public $platform = "joomla30" ;

    public function __construct($params) {
        parent::__construct($params);
    }

    public function askToScreenWhetherToDapperfy() {
        if (isset($this->params["yes"])) { return true ; }
        $question = 'Dapperfy This for Joomla?';
        return self::askYesOrNo($question, true);
    }

    public function setEnvironmentReplacements() {

        /* @todo use some logic to get the value set by parent::setEnvironmentReplacements()
         * and just unset the dap_db_platform var
         *
         * @todo removing the ones that we are not using from the pool so questions are not even asked
        */
        $this->environmentReplacements =
          array( "dapper" => array(
              array("var"=>"dap_proj_cont_dir", "friendly_text"=>"Project Container directory, (inc slash)"),
              array("var"=>"dap_git_repo_url", "friendly_text"=>"Git Repo URL"),
              array("var"=>"dap_git_repo_ssh_key", "friendly_text"=>"Optional Private SSH Key for Git Repo"),
              array("var"=>"dap_git_custom_branch", "friendly_text"=>"Git Custom Branch"),
              array("var"=>"dap_apache_vhost_url", "friendly_text"=>"Apache VHost URL (Don't Include http://)"),
              array("var"=>"dap_apache_vhost_ip", "friendly_text"=>"Apache VHost Hostname/IP"),
              array("var"=>"dap_version_num_revisions", "friendly_text"=>"How many revisions to keep"),
          ) );

    }


    public function doDapperfy() {
        $templatesDir1 = str_replace("Joomla", "Dapperfy", dirname(__FILE__) ) ;
        $templatesDir1 = str_replace("Model", "Templates", $templatesDir1 ) ;
        $templates1 = scandir($templatesDir1);

        $templatesDir2 = str_replace("Model", "Templates/Dapperfy/".ucfirst($this->platform), dirname(__FILE__) ) ;
        $templates2 = scandir($templatesDir2);
        // $templates = array_merge($templates2, $templates1) ;
        foreach ($this->environments as $environment) {

            if (isset($this->params["environment-name"])) {
                if ($this->params["environment-name"] != $environment["any-app"]["gen_env_name"]) {
                    $tx = "Skipping Environment {$environment["any-app"]["gen_env_name"]} to create files " ;
                    $tx .= "as specified Environment is {$this->params["environment-name"]} \n" ;
                    echo $tx;
                    continue ; } }

            $defaultReplacements =
                array(
                    "gen_srv_array_text" => $this->getServerArrayText($environment["servers"]) ,
                    "env_name" => $environment["any-app"]["gen_env_name"],
                    "dap_db_platform" => $this->platform,
                    "gen_env_tmp_dir" => $environment["any-app"]["gen_env_tmp_dir"],
                    "dap_db_ip_address" => "127.0.0.1",
                    "dap_db_app_user_name" => "ph_user",
                    "dap_db_app_user_pass" => "ph_pass",
                    "dap_db_name" => "ph_db",
                    "dap_db_admin_user_name" => "root",
                    "dap_db_admin_user_pass" => "cleopatra",
                ) ;

            if (isset($environment["dapper"])) {
                $replacements = array_merge($defaultReplacements, $environment["dapper"]) ; }
            else {
                $replacements = $defaultReplacements ; }


            if (!isset($this->params["no-autopilot-creation"])) {

                echo "Joomla Dapperfies for Phlagrant:\n" ;
                foreach ($templates2 as $template) {
                    if (!in_array($template, array(".", ".."))) {
                        $templatorFactory = new \Model\Templating();
                        $templator = $templatorFactory->getModel($this->params);
                        $newFileName = str_replace("environment", $environment["any-app"]["gen_env_name"], $template ) ;
                        $autosDir = getcwd().DIRECTORY_SEPARATOR.'build'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.
                            'dapperstrano'.DIRECTORY_SEPARATOR.'dapperfy'.DIRECTORY_SEPARATOR.'autopilots'.DIRECTORY_SEPARATOR.
                            'generated';
                        $targetLocation = $autosDir.DIRECTORY_SEPARATOR.$newFileName ;
                        $templator->template(
                            file_get_contents($templatesDir2.DIRECTORY_SEPARATOR.$template),
                            $replacements,
                            $targetLocation );
                        echo $targetLocation."\n"; } } }

            else {
                echo "Skipping creation of autopilot files in environment {$environment["any-app"]["gen_env_name"]} due to no-autopilot-creation parameter.\n" ; } }

    }
}