<?php 

class MY_controller extends CI_Controller{

	public $data = array();
	public $theme;
	public $controller;
	public $function;
	protected $previous_controller_name;
	protected $previous_action_name;    
	protected $save_previous_url = false;  

	/**
     * A list of models to be autoloaded
     */
    protected $models = array();

    /**
     * A formatting string for the model autoloading feature.
     * The percent symbol (%) will be replaced with the model name.
     */
    protected $model_string = '%_m';

    /**
     * A list of helpers to be autoloaded
     */
    protected $helpers = array();

    private $__filter_params;

    public function __construct(){
      parent::__construct();
      $this->__filter_params = array($this->uri->uri_string());
      $this->call_filters('before');

        // 
      $this->_load_models();
      $this->_load_helpers();
        //
        //save the previous controller and action name from session
      $this->previous_controller_name = $this->session->flashdata('previous_controller_name'); 
      $this->previous_action_name     = $this->session->flashdata('previous_action_name'); 
       //set the current controller and action name
      $this->controller = $this->router->fetch_directory() . $this->router->fetch_class();
      $this->method = $this->router->fetch_method();

        //log_message( 'debug', get_class( $this ) . ' controller loaded.' );
      //get nav data array
      $this->data['nav'] = \Model\Page::get_nested();
  }
  public function __destruct() {
        //save the controller and action names in session
    if ($this->save_previous_url) {
        $this->session->set_flashdata('previous_controller_name', $this->previous_controller_name);
        $this->session->set_flashdata('previous_action_name', $this->previous_action_name);
    }
    else {
        $this->session->set_flashdata('previous_controller_name', $this->controller);
        $this->session->set_flashdata('previous_action_name', $this->method);
    }
}

	/**
	 * Remap route
	 * @param  [string] $method     [description]
	 * @param  array  $parameters [description]
	 * @return [type]             [description]
	 */
	public function _remap($method, $parameters = array()) {

        empty($parameters) ? $this->$method() : call_user_func_array([$this, $method], $parameters);

        if ($method != 'call_filters') {
            $this->call_filters('after');
        }
    }

    /**
     * auto view
     * @param  boolean $file [description]
     * @return [type]        [description]
     */
    public function show($file = false)
    {
    	if($file) {
    		$view_file = $file;
    	} else {
    		$view_file = $this->controller . '/' . $this->method;
    	}
        if ($this->load->get_vars())
            $this->data = array_merge($this->data, $this->load->get_vars());
    	// benchmark
        $this->benchmark->mark('code_end');
        $this->data['elapsed_time'] = $this->benchmark->elapsed_time('total_execution_time_start', 'code_end');
        // all done
        echo View::make($view_file, $this->data);

    }

    /* --------------------------------------------------------------
     * MODEL LOADING
     * ------------------------------------------------------------ */

    /**
     * Load models based on the $this->models array
     */
    private function _load_models() {
        foreach ($this->models as $model) {
            $this->load->model($this->_model_name($model), $model);
        }
    }

    /**
     * Returns the loadable model name based on
     * the model formatting string
     */
    protected function _model_name($model) {
        return str_replace('%', $model, $this->model_string);
    }

    /* --------------------------------------------------------------
     * HELPER LOADING
     * ------------------------------------------------------------ */

    /**
     * Load helpers based on the $this->helpers array
     */
    private function _load_helpers() {
        foreach ($this->helpers as $helper) {
            $this->load->helper($helper);
        }
    }
    private function call_filters($type) {

        $loaded_route = $this->router->get_active_route();
        $filter_list = Route::get_filters($loaded_route, $type);

        foreach ($filter_list as $filter_data) {
            $param_list = $this->__filter_params;

            $callback = $filter_data['filter'];
            $params = $filter_data['parameters'];

            // check if callback has parameters
            if (!is_null($params)) {
                // separate the multiple parameters in case there are defined
                $params = explode(':', $params);

                // search for uris defined as parameters, they will be marked as {(.*)}
                foreach ($params as &$p) {
                    if (preg_match('/\{(.*)\}/', $p, $match_p)) {
                        $p = $this->uri->segment($match_p[1]);
                    }
                }

                $param_list = array_merge($param_list, $params);
            }

            if (class_exists('Closure') and method_exists('Closure', 'bind')) {
                $callback = Closure::bind($callback, $this);
            }

            call_user_func_array($callback, $param_list);
        }
    }
    protected function save_url() {
        $this->save_previous_url = true;
    }

}

class AdminController extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	}
}