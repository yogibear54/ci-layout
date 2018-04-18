<?php

/**
 * Bootstrap layout
 */
class Layout
{
    public $is_admin = false;
    public $is_logged_in = false;
    public $user_level = null;
    public $required_access_level = null;
    private $_showHeader = true;
    private $_showPageTitle = true;
    private $_showSidebar = true;
    private $_showFooter = true;
    private $_showBreadcrumb = false;
    private $theme_set = false;

    //Layout Data
    private $_title = null;
    private $_pageTitle = null;
    private $_js_files = array();
    private $_external_js_files = array();
    private $_css_files = array();
    private $_package_js_files = array();
    private $_package_css_files = array();
    private $_meta = null;
    private $_header = null;
    private $_sidebar = null;
    private $_footer = null;
    private $_breadcrumb = null;
    private $_content = null;
    private $_theme = null;
    private $_theme_filepath = null;
    private $_headerData = null;
    private $_sidebarData = null;
    private $_footerData = null;
    private $_breadcrumbData = null;

    /**
     * -_-
     */
    public function __construct()
    {
        $this->title($this->config->item('site_name'));
        $this->config->load('layout');
    }

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var)
    {
        return get_instance()->$var;
    }

    /**
     * Set and get the html for the meta
     * @param string $meta
     */
    public function meta($meta = false)
    {
        if (empty($meta)) {
            return $this->_meta;
        } else {
            $this->_meta = $meta;
        }
    }

    /**
     * Set and get the html for the Header
     * @param string $header
     */
    public function header($header = false)
    {
        if (empty($header)) {
            return $this->_header;
        } else {
            $this->_header = $header;
        }
    }

    /**
     * Setting additional header data for use in header template
     *
     * @param array $data
     * @return \Layout
     */
    public function setHeaderData($data)
    {
        if (is_array($data)) {
            $this->_headerData = empty($this->_headerData) ? $data : array_merge($this->_headerData, $data);
            return $this;
        }
    }

    /**
     * Set the page title
     * @param string $title
     */
    public function title($title = false)
    {
        if (empty($title)) {
            return $this->_title;
        } else {
            $this->_title = $title;
        }
    }

    /**
     * Set the page title
     * @param string $title
     */
    public function pageTitle($title = false)
    {
        if (empty($title)) {
            return $this->_pageTitle;
        } else {
            $this->_pageTitle = $title;
        }
    }

    /**
     * Set the html for the Sidebar
     * @param string $sidebar
     */
    public function sidebar($sidebar = false)
    {
        if (empty($sidebar)) {
            return $this->_sidebar;
        } else {
            $this->_sidebar = $sidebar;
        }
    }

    /**
     * set the html for the breadcrumb
     */
    public function breadcrumb($breadcrumb = false)
    {
        if (empty($breadcrumb)) {
            return $this->_breadcrumb;
        } else {
            $this->_breadcrumb = $breadcrumb;
        }
    }

    /**
     * Setting meta data
     *
     * @param array $data
     * @return \Layout
     */
    public function setMetaData($data)
    {
        if (is_array($data)) {
            $this->_metaData = empty($this->_metaData) ? $data : array_merge($this->_metaData, $data);
            return $this;
        }
    }
    
    /**
     * Setting additional sidebar data for use in sidebar template
     *
     * @param array $data
     * @return \Layout
     */
    public function setSidebarData($data)
    {
        if (is_array($data)) {
            $this->_sidebarData = empty($this->_sidebarData) ? $data : array_merge($this->_sidebarData, $data);
            return $this;
        }
    }

    /**
     * Setting breadcrumb data
     * Breadcrumb data MUST be in the following multi-dimensional form:
     * array(
            array('url' => site_url('app/links'), 'title' => 'Links'),
            array('url' => '', 'title' => $_t)
        )
     * @param array $data
     * @return \Layout
     */
    public function setBreadcrumbData($data)
    {
        if (is_array($data)) {
            $this->_breadcrumbData = empty($this->_breadcrumbData) ? $data : array_merge($this->_breadcrumbData, $data);
            return $this;
        }
    }

    /**
     * Set the html for the content
     * @param string $content
     */
    public function content($content = false)
    {
        if (empty($content)) {
            return $this->_content;
        } else {
            $this->_content = $content;
        }
    }

    /**
     * Set the html for the footer
     * @param string $footer
     */
    public function footer($footer = false)
    {
        if (empty($footer)) {
            return $this->_footer;
        } else {
            $this->_footer = $footer;
        }
    }

    /**
     * Setting additional footer data for use in footer template
     *
     * @param array $data
     * @return \Layout
     */
    public function setFooterData($data)
    {
        if (is_array($data)) {
            $this->_footerData = empty($this->_footerData) ? $data : array_merge($this->_footerData, $data);
            return $this;
        }
    }

    /**
     * Add JS File
     * @param string JS Path
     */
    public function addJS($jsFile)
    {
        $this->_js_files[] = base_url() . 'js/' . $jsFile;
        return $this;
    }
    
    public function addExternalJS($jsFile)
    {
        $this->_external_js_files[] = $jsFile;
    }

    /**
     * Add CSS File
     * @param string JS Path
     */
    public function addCSS($cssFile)
    {
        $this->_css_files[] = base_url() . 'css/' . $cssFile;
        return $this;
    }

    /**
     * Add Package File
     * @param string package Path
     */
    public function addPackage($packageJSFile, $packageCSSFile = null)
    {
        if (!empty($packageJSFile)) {
            $this->addJSPackage($packageJSFile);
        }

        if (!empty($packageCSSFile)) {
            $this->addCSSPackage($packageCSSFile);
        }
        return $this;
    }

    /**
     * Add CSS Package File
     * @param string package Path
     */
    public function addCSSPackage($packageFile)
    {
        if (!empty($packageFile)) {
            $this->_package_css_files[] = base_url() . 'package/' . $packageFile;
        }
        return $this;
    }

    /**
     * Add JS Package File
     * @param string package Path
     */
    public function addJSPackage($packageFile)
    {
        if (!empty($packageFile)) {
            $this->_package_js_files[] = base_url() . 'package/' . $packageFile;
        }
        return $this;
    }

    /**
     * Load a custom theme
     * @param string $theme
     */
    public function theme($theme = false)
    {
        if (empty($theme)) {
            return $this->_theme;
        } else {
            $this->_theme = $theme;
        }
    }

    /**
     * sets the themes file path relative to application/view folder
     * @param type $path
     * @return \Layout
     */
    public function themeFilePath($path = false)
    {
        if (empty($path)) {
            return $this->_theme_filepath;
        } else {
            $this->_theme_filepath = $path;
        }
    }

    public function themeFilePathForView()
    {
        return '../../' . $this->_theme_filepath;
    }
    /**
     * Renders the page bootstrap style
     *
     * If we have not disabled or loaded any custom scaffolding
     * then it will all be rendered from the defaults. see other php files in
     * the layout folder
     * @return type
     */
    public function render()
    {
        $data = array();
        $data['theme_path'] = $this->theme();
        $data['title'] = $this->title();
        $data['page_title'] = $this->_showPageTitle ? $this->pageTitle() : '';
        $data['site_name'] = $this->config->item('site_name');
        $data['js_files'] = $this->_js_files;
        $data['external_js_files'] = $this->_external_js_files;
        $data['css_files'] = $this->_css_files;
        $data['package_js_files'] = $this->_package_js_files;
        $data['package_css_files'] = $this->_package_css_files;
        $data['meta'] = $this->renderMeta();
        $data['header'] = $this->setHeaderData(array('site_name' => $this->config->item('site_name')))->renderHeader();
        $data['sidebar'] = $this->renderSidebar();
        $data['breadcrumb'] = $this->renderBreadcrumb();
        $data['content'] = $this->content();
        $data['footer'] = $this->renderFooter();

        $_theme_base_file = $this->config->item('theme_base_file');
        if ( $this->is_admin ) {
            $_theme_base_file = $this->config->item('admin_theme_base_file');
        }
        
        $content = $this->load->view($this->themeFilePathForView() . $_theme_base_file, $data, true);

        /* DO PATH REPLACEMENT ON FILES FROM RELATIVE TO ABSOLUTE */
        $this->load->helper('path');

        //Converts all relative paths in template to URL's
        $content = replace_paths($content, $this->themeFilePath());

        return $content;
    }

    /**
     * Render the default header or the custom header.
     * @return string
     */
    protected function renderHeader()
    {
        $headerData = empty($this->_headerData) ? array() : $this->_headerData;

        if (!$this->_showHeader) {
            return '';
        }

        if ($this->header() === null) {
            $_theme_header_file = $this->config->item('theme_header_file');

            if ($this->is_logged_in) {
                $_theme_header_file = '';
                if ($this->is_admin) {
                    $_theme_header_file = $this->config->item('admin_theme_header_file') ;
                }
            } else {
                $_theme_header_file = $this->config->item('theme_guestheader_file');
            }

            if (file_exists($this->themeFilePath() . $_theme_header_file . '.php')) {
                return $this->load->view($this->themeFilePathForView() . $_theme_header_file, $headerData, true);
            }
        }

        return $this->header();
    }

    /**
     * Render the meta data
     * @return string
     */
    protected function renderMeta()
    {
        $metaData = empty($this->_metaData) ? array() : $this->_metaData;

        if ($this->meta() === null) {
            $_theme_meta_file = $this->config->item('theme_meta_file');

            if ( $this->is_admin ) {
                $_theme_meta_file = $this->config->item('admin_theme_meta_file');
            }
            
            if (file_exists($this->themeFilePath() . $_theme_meta_file . '.php')) {
                return $this->load->view($this->themeFilePathForView() . $_theme_meta_file, $metaData, true);
            }
            
        }

        return $this->meta();
    }

    /**
     * Render the default sidebar or the custom sidebar.
     * @return string
     */
    protected function renderSidebar()
    {
        $sidebarData = empty($this->_sidebarData) ? array() : $this->_sidebarData;

        if (!$this->_showSidebar) {
            return '';
        }

        if ($this->sidebar() === null) {
            $_theme_sidebar_file = $this->config->item('theme_sidebar_file');

            if (($this->is_admin)) {
                $_theme_sidebar_file = $this->config->item('admin_theme_sidebar_file');
            }

            if (file_exists($this->themeFilePath() . $_theme_sidebar_file . '.php')) {
                return $this->load->view($this->themeFilePathForView() . $_theme_sidebar_file, $sidebarData, true);
            }
        }

        return $this->sidebar();
    }

    /**
     * Render the custom breadcrumb
     * @return string
     */
    protected function renderBreadcrumb()
    {
        $breadcrumbData = empty($this->_breadcrumbData) ? array() : $this->_breadcrumbData;

        if (!$this->_showBreadcrumb) {
            return '';
        }

        if ($this->breadcrumb() === null) {
            $_theme_breadcrumb_file = $this->config->item('theme_breadcrumb_file');

            if ( $this->is_admin ) {
                $_theme_breadcrumb_file = $this->config->item('admin_theme_breadcrumb_file');
            }
            
            if (file_exists($this->themeFilePath() . $_theme_breadcrumb_file . '.php')) {
                return $this->load->view($this->themeFilePathForView() . $_theme_breadcrumb_file, array("breadcrumbs" => $breadcrumbData), true);
            }
            
        }

        return $this->breadcrumb();
    }

    /**
     * Render the default footer or the custom footer.
     * @return string
     */
    protected function renderFooter()
    {
        $footerData = empty($this->_footerData) ? array() : $this->_footerData;

        if (!$this->_showFooter) {
            return '';
        }

        if ($this->footer() === null) {
            $_theme_footer_file = $this->config->item('theme_footer_file');
            
            if ( $this->is_admin ) {
                $_theme_footer_file = $this->config->item('admin_theme_footer_file');
            }
            
            if (file_exists($this->themeFilePath() . $_theme_footer_file . '.php')) {
                return $this->load->view($this->themeFilePathForView() . $_theme_footer_file, $footerData, true);
            }
        }

        return $this->footer();
    }

    /**
     * Hides the Sidebar
     */
    public function disableSidebar()
    {
        $this->_showSidebar = false;
        return $this;
    }

    /**
     * Hides the Sidebar
     */
    public function disablePageTitle()
    {
        $this->_showPageTitle = false;
        return $this;
    }

    /**
     * Hides the header
     */
    public function disableHeader()
    {
        $this->_showHeader = false;
        return $this;
    }

    /**
     * Hides the footer
     */
    public function disableFooter()
    {
        $this->_showFooter = false;
        return $this;
    }

    /**
     * enables breadcrumb
     */
    public function enableBreadcrumb()
    {
        $this->_showBreadcrumb = true;
        return $this;
    }

    /**
     * Get the instance of the Layout
     *
     * @return Layout layout instance
     */
    public function get_layout()
    {
        if (!$this->theme_set) {
            if ($this->is_admin) {
                //if this is a preview from the admin page, display the site as a vendor would see.
                if ($this->session->userdata('admin_preview') != true) {
                    $this->is_admin = true;
                    $this->themeFilePath($this->config->item('admin_theme_path'));
                } else {
                    $this->themeFilePath($this->config->item('theme_path'));
                }
            } else {
                $this->themeFilePath($this->config->item('theme_path'));
            }
            $this->theme(base_url() . $this->themeFilePath());
            $this->theme_set = true;
        }
        return $this;
    }
}