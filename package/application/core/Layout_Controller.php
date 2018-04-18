<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Guest_Controller is used for all views that are accessable by the Guest
class Layout_Controller extends CI_Controller
{
    protected $data = array();
    protected $classname = null;
    protected $methodname = null;
    protected $classparams = array();
    protected $sidebar_view = '';
    protected $sidebar_data = null;
    protected $is_ajax = false;
    protected $return_head = 'default';
    protected $theme = null;

    public function __construct()
    {
        parent::__construct();

        //alerts
        if ($this->session->flashdata('error'))
        {
            $this->data['error'] = $this->session->flashdata('error');
        }
        if ($this->session->flashdata('success'))
        {
            $this->data['success'] = $this->session->flashdata('success');
        }
        
        if ( empty($this->session->userdata('language')) ) {
            $this->session->set_userdata('language', 'english');
        }
        
        //load language
        $this->_loadLang();
    }

    public function initData()
    {    
        //page level class items
        $this->data['page_class'] = strtolower('page-' . $this->classname . '-' . $this->methodname) . ' ';
        $this->data['class_name'] = $this->classname;
        $this->data['method_name'] = $this->methodname;

        //default description and keyword
        $this->data['keywords'] = '';
        $this->data['description'] = '';
        
        $this->data['language'] = $this->session->userdata('language');

        if ($this->config->item('test_mode') == TRUE)
        {
            $this->output->enable_profiler('true');
        }
        
        //see any notifications to display
        if (!empty($this->session->flashdata('notification'))) {
            $this->data['notification'] = $this->session->flashdata('notification');
            $this->data['notification_type'] = $this->session->flashdata('notification_type');
        }

        // set csrf
        $this->data['csrf'] = array(
            'token_name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash(),
            'cookie_name' => $this->config->item('csrf_cookie_name'),
        );
    }

    //lang can switch by providing url like:
    //http://hk.jousun.com/en/aisles/{name of aisle} => http://hk.jousun.com/aisles/{name of aisle}
    protected function _loadLang()
    {
        //set language session if a parameter is passed in the URL
        $set_lang = $this->config->item('default_language');
                
        if ($this->config->item('is_multi_language') == TRUE) {
            if ($this->uri->segment(1) == 'en' || $this->uri->segment(1) == 'ch')
            {
                $allowed_langs = $this->config->item('allowed_langs');
                $_lang = $allowed_langs[$this->uri->segment(1)];
                if (in_array($_lang, $allowed_langs)) { //only allow langs specified
                    $set_lang = $_lang;
                }
                
                //set session lang
                $this->session->set_userdata('language', $set_lang);
            } else {
                $set_lang = 'english';
                
                //set session lang
                $this->session->set_userdata('language', $set_lang);
            }

            if ($this->session->userdata('language'))
            {
                $set_lang = $this->session->userdata('language');
            }
        }

        // Comment this section to avoid user setting invalid language that does not exist
        // if ($this->input->get('lang'))
        // {
        //     $set_lang = $this->input->get('lang');
        // }

        if (!empty($set_lang))
        {
            if (!empty($set_lang))
            {
                $this->session->set_userdata('language', $set_lang);
                
                //this helps set form_validation language as well.
                $this->config->set_item('language', $set_lang);
            }

            //page language
            if ($set_lang && is_dir(APPPATH . 'language/' . $set_lang))
            {
                $this->lang->load('site', $set_lang);
                $this->lang->load('error', $set_lang);
            } else
            {
                $this->lang->load('site', $this->config->item('language'));
                $this->lang->load('error', $this->config->item('language'));
            }
        } else
        {
            $this->lang->load('site', $this->config->item('language'));
            $this->lang->load('error', $this->config->item('language'));
        }
    }

    public function _output($content = '')
    {
        if ($this->is_ajax)
        {
            $this->data['content'] = $content;
            $this->_outputNoLayout($this->data);
        } else
        {
            $this->_outputLayout($content);
        }
    }

    public function _outputLayout($data)
    {
        if ($data)
        {
            $this->layout->get_layout()->content($data);
        }
        $content = $this->layout->get_layout()->render();

        echo $content;
    }

    protected function _outputNoLayout($data)
    {
        switch ($this->return_head) {
            case 'html':
                echo $data['content'];
                break;
            case 'json':
                if (!$this->input->is_cli_request()) {
                    header('Content-Type: application/json', TRUE);
                }
                echo $data['content'];
                break;
            case 'javascript':
                header('Content-Type: application/javascript', TRUE);
                echo $data['content'];
                break;
            default:
                break;
        }
    }
}
