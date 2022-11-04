<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deploy extends CI_Controller
{


    function __construct()
    {
        parent::__construct();;
    }

    public function index()
    {
        /**
         * GIT DEPLOYMENT SCRIPT
         *
         * Used for automatically deploying websites via GitHub
         *
         */

        // array of commands
        $commands = array(
            'echo $PWD',
            'whoami',
            'cd /var/www/passwordmanager && git pull',
            'git status',
            'git submodule sync',
            'git submodule update',
            'git submodule status',
        );

        // exec commands
        $output = '';
        foreach ($commands as $command) {
            $tmp = var_dump(shell_exec($command));

            $output .= "<span style=\"color: #6BE234;\">\$</span><span style=\"color: #729FCF;\">{$command}\n</span><br />";
            $output .=$tmp . "\n<br /><br />";
        }
        echo '

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<div style="width:700px">
    <div style="float:left;width:350px;">
    <p style="color:white;">Git Deployment Script</p>'.
    $output .'
    </div>
</div>
</body>
</html>
		';
       
    }
    

}
