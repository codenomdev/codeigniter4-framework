<?php

namespace Codenom\Framework\Controllers\Backend;

class BackendController extends \CodeIgniter\Controller
{
    protected $render;
    /**
     * @var array
     */
    protected $css = [];
    /**
     * @var array
     */
    protected $js = [];

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();
        $this->render = \Codenom\Framework\Config\Services::SmartyEngine(\APPPATH . 'Modules/Backend/Codeshop/Views/admintpl')->setData($this->render());
    }

    private function render()
    {
        $this->baseTemplate();
        $data['css'] = $this->css;
        $data['js'] = $this->js;
        $data['base_url'] = base_url();

        return $data;
    }
    /**
     * Set js & css file
     *
     * @return $this
     */
    private function baseTemplate(): self
    {
        $this->set_css($this->asset_path('vendor/fontawesome-free/css/all.min.css'));
        $this->set_css('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i');
        $this->set_css($this->asset_path('css/sb-admin-2.min.css'));
        $this->set_js($this->asset_path('vendor/jquery/jquery.min.js'));
        $this->set_js($this->asset_path('vendor/bootstrap/js/bootstrap.bundle.min.js'));
        $this->set_js($this->asset_path('vendor/jquery-easing/jquery.easing.min.js'));
        $this->set_js($this->asset_path('js/sb-admin-2.min.js'));

        return $this;
    }
    /**
     * @param string $file link
     *
     * @return $this
     */
    private function set_css(string $file): self
    {
        $this->css[] = $file;

        return $this;
    }
    /**
     * @param string $file link
     *
     * @return $this
     */
    private function set_js(string $file): self
    {
        $this->js[] = $file;

        return $this;
    }

    private function asset_path($filename)
    {
        return base_url('static/adminhtml/assets/' . $filename);
    }
}
