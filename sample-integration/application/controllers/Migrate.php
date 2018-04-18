<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * used to execute db migrate files.  This is done on the url.
 * i.e. http://website.com/migrate/now  - migrate to current
 * http://website.com/migrate/now/4  - rewind migrate to version number
 */
class Migrate extends CI_Controller
{

    public function __construct()
    {
//        parent::__construct(parent::USER_LEVEL_BOSS, true);
        //parent::__construct(null, false);
        parent::__construct();
        if (!$this->input->is_cli_request()) {
            exit('Access forbidden.');
        }
        $this->db->cache_off();
    }
    
    //public function
    public function now($version = "latest")
    {
        $this->load->library('migration');
        //$this->is_ajax = true; // Disable Layout


        echo "Migration to $version" . PHP_EOL . "<br>";

        if ($version === "latest") {
            if (!$this->migration->current()) {
                show_error($this->migration->error_string());
            }
        } else {
            if (!$this->migration->version($version)) {
                show_error($this->migration->error_string());
            }
        }
        exit;
    }

}
