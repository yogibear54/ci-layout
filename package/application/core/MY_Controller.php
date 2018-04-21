<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(APPPATH . "core/Layout_Controller.php");

class MY_Controller extends Layout_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
}