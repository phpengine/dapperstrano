<?php

namespace Controller ;

class SshKeyStore extends Base
{

    public function execute($pageVars)
    {

        $thisModel = $this->getModelAndDeps(substr(get_class($this), 11), $pageVars) ;
        // if we don't have an object, its an array of errors
        if (is_array($thisModel)) {
            return $this->failDependencies($pageVars, $this->content, $thisModel) ;
        }

        $action = $pageVars["route"]["action"];

        if ($action=="help") {
            $helpModel = new \Model\Help();
            $this->content["helpData"] = $helpModel->getHelpData($pageVars["route"]["control"]);
            return array ("type"=>"view", "view"=>"help", "pageVars"=>$this->content);
        }

        if (in_array($action, array("find"))) {
            $this->content["result"] = $thisModel->askAction($action);
            $this->content["module"] = $thisModel->getModuleName();
            $this->content["appName"] = $thisModel->programNameInstaller ;
            return array ("type"=>"view", "view"=>"sshkeystore", "pageVars"=>$this->content);
        }

        \Core\BootStrap::setExitCode(1);
        $this->content["messages"][] = "Action $action is not supported by ".get_class($this)." Module";
        return array ("type"=>"control", "control"=>"index", "pageVars"=>$this->content);
    }
}
