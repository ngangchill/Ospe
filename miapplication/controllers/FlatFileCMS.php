<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Forhad\Libs\Lstorage;
class FlatFileCMS extends MY_Controller {

	public $baseUrl = 'learn';

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
    /**
     * Cms index
     * @return [type] [description]
     */
    public function index() {
        // get requested file
        $requestedFile = Cms::requestedFile();

        //trigger event with requestedFile
        Cms::triggerEvent('requestedFile', array($requestedFile));

        //read requested file
        $requestedFileData = Cms::readFile($requestedFile);

        // trigger events with pages
        Cms::triggerEvent('readRequestedFile', array($requestedFileData));

        // parse file meta
        $this->data['meta'] = Cms::parseFileMeta($requestedFileData);
       // load all pages from cache or Save to cache  // key, time
        $pages = Cache::remember('pages', 4, function() {
            return Cms::readPages();
        });

        //Cache::flush();
        //dd(Cache::get('pages'));

        // trigger events with pages
        Cms::triggerEvent('beforeShow', array($pages));


        // set meta data for view file
        Cms::setMeta($this->data['meta']);

        // remove meta from raw data and parse it for view
        $final_data = Cms::prepareFileContent($requestedFileData, $this->data['meta']);
        $this->data['content'] = Cms::parse($final_data);

        //set page title
        if(!$this->uri->segment(2)){
        	$title = $this->data['meta']['title'];
        } elseif($this->uri->segment(2) != $this->data['meta']['title']) {
        	$title = ucfirst($this->uri->segment(2)) .' :: '.$this->data['meta']['title'];
        } else {
        	$title = $this->data['meta']['title'];
        }
        SEO::setTitle($title);
        // all done, lets view
        $this->show();
    }

    public function edit($id = null) {
        $id = Cms::requestedFile();
        $this->data['content'] = Cms::readFile($id);
        $this->data['meta'] = Cms::parseFileMeta($this->data['content']);
        Cms::setMeta($this->data['meta']);

        SEO::setTitle('Edit');
        $this->show();
    }

    public function postEdit() {
        dump($this->input->post());
    }

    function preview(){

    }
	/**
	 *  Get prev & next file
	 */
    public function test(){

        $current_id = substr(Cms::requestedFile(), 0, -3);
	   //echo $current_id;
        $pages = Cache::remember('pages', 4, function() {
            return Cms::readPages();
        });
        $as_array_of_pages = collect($pages)->toArray();
    	// return as [1 => 'index',2=>'demo']
        $pageIds = array_keys($as_array_of_pages);

    	// now return current page number i.e 1
        $currentPageIndex = array_search($current_id, $pageIds);
    	// get current page name
        $currentPage = $pageIds[$currentPageIndex];
    	//prev page
        if(isset($pageIds[$currentPageIndex - 1])){
    		 // so prev page id
            $prevPageIndex = $currentPageIndex - 1;
    		 // so prev page name
            $prevPage = $pageIds[$prevPageIndex];
        }
    	 // next page
        if(isset($pageIds[$currentPageIndex + 1])){
    		 // so next page id
            $nextPageIndex = $currentPageIndex + 1;
    		 // so next page  name
            $nextPage = $pageIds[$nextPageIndex];
        }

        echo 'current page'.$currentPageIndex.' : '.anchor('learn/'.$currentPage, $currentPage) .'<br>';
        echo 'Prev page'.$prevPageIndex.' : '.anchor('learn/'.$prevPage, $prevPage) .'<br>';
        echo 'Next page'.$nextPageIndex.' : '.anchor('learn/'.$nextPage, $nextPage) .'<br>';

    }

    public function getTreeForIndex()
    {
        $treeView = new \Forhad\Libs\FileTree('./content/','learn',['md']);
        echo $treeView->showTree();
    }

}

/* End of file FlatFileCMS.php */
/* Location: ./application/controllers/FlatFileCMS.php */