<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * replace paths
 * 
 */
if (!function_exists('replace_paths'))
{
	
	function replace_paths($content, $template_dir)
	{
		//opendir requires an ending slash in the directory
		//$template_dir .= '/';
		
		$CI =& get_instance();
		$CI->load->helper('url');
        $CI->config->load('layout');
        
		/* REPLACE ARRAYS */
		$to_replace = array();
		$replace_with = array();
		
		if ($handle = opendir($template_dir))		
		{
			while (false !== ($file = readdir($handle)))
			{
				if (is_dir($template_dir.$file) && ($file != ".") && ($file != "..") && ($file != "_notes"))
				{
					$to_replace[] = '"' . $file . '/';
					$to_replace[] = "'" . $file . "/";
					
					$replace_with[] = '"' . base_url() . $template_dir . $file . '/';
					$replace_with[] = "'" . base_url() . $template_dir . $file . '/';
				}
			}
		}
		
		/* COMBINING ADDITIONAL REPLACEMENTS DEFINED IN public_config.php */
		$to_replace = array_merge($to_replace, $CI->config->item('to_replace'));
		$replace_with = array_merge($replace_with, $CI->config->item('replace_with'));
		
		return str_replace($to_replace,$replace_with,$content);	
	}
	
}