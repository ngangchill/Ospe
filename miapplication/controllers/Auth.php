<?php 

class Auth extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
	} 

	public function index()
	{
		if ($this->ion_auth->logged_in())
		{
			//$this->logout();
        	echo 'logged_in';
    	} else {
    		$identity = 'admin@admin.com';
			$password = 'password';
			$remember = TRUE; // remember the user
			$this->ion_auth->login($identity, $password, $remember);
    	}
		
	}
	// login
	public function login()
	{
		SEO::setTitle('Login');
		SEO::opengraph()->setUrl(base_url('login'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->helper('form');
            $this->show();
        } else {
            //$this->ion_auth->set_hook('post_login_successful', 'get_gravatar_hash', $this, '_gravatar', array());
            $remember = (bool) $this->input->post('remember');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->ion_auth->login($username, $password, $remember)) {
                $this->load->library('rat');
                $this->rat->log('User logged in', 1);
                if ($this->auth->is_admin())
                    redirect('admin');

                redirect('/');
            }
            else {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect('login');
            }
        }

	} 
	// logout
	public function logout()
	{
		//$this->load->library('rat');
        //$this->rat->log('User logged out', 1);
        $this->ion_auth->logout();
        redirect('login');
	} 
	public function profile() {
        $this->output->set_template('public');
        $user = $this->ion_auth->user()->row();
        $this->data['page_title'] = 'Profile';
        $this->data['user'] = $user;
        $this->data['current_user_menu'] = '';
        if ($this->ion_auth->in_group('admin')) {
            //$this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu_admin_view.php', NULL, TRUE);
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First name', 'trim');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim');
        $this->form_validation->set_rules('company', 'Company', 'trim');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');

        if ($this->form_validation->run() === FALSE) {
            $this->show();
        } else {
            $new_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone')
            );
            if (strlen($this->input->post('password')) >= 6)
                $new_data['password'] = $this->input->post('password');
            $this->ion_auth->update($user->id, $new_data);
            $this->postal->add($this->ion_auth->messages(), 'error');
            redirect('profile');
        }
    }

}