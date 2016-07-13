<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{

		$this->show();
	}

	/**
     * Cache Garbase collector 
     */
    public function garbasecollector()
    {
        $f = \App::make('files');
        $files = $f->allfiles('storage/cache');
        $expired_file_count = 0;
        $active_file_count = 0;
        foreach ($files as $key => $cachefile) {
            if($cachefile->getBasename() == '.gitignore') {
               continue;
            }
            if($cachefile->getBasename() == 'index.html') {
               continue;
            }
            // Grab the contents of the file
            $contents = $f->get($cachefile);
            
            // Get the expiration time
            $expire = substr($contents, 0, 10);
            // See if we have expired
            if(time() >= $expire) {
                // Delete the file
                $f->delete($cachefile);
                $expired_file_count++;
            } else {
                $active_file_count++;
            }
        }
        $this->data['fileRemoved'] = $expired_file_count;
        $this->data['activeCacheFile'] = $active_file_count;
        
        $this->show();
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */