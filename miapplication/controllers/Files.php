<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MY_Controller {

	public $docControler = 'learn/';
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('directory');
	}
	public function index()
	{
		$treeView = new \Forhad\Libs\FileTree('./content/','learn',['md']);
		$this->data['treeView'] = $treeView->showTree();
		SEO::setTitle('Files');
		$this->show();
	}

	//public function getOL($arr, $dynamicDir = false, $controller = 'learn', $child = FALSE)
	public function getOL($arr,$dynamicDir = null, $parentDir = NULL, $child = FALSE)
	{
		$str = '';
		$str .= $child == FALSE ? '<ul class="collapsibleList">' : '<ul>';

		//dd(collect($arr));
		foreach ($arr as $key => $value) {
			if(is_string($value)){
				if (basename($value) === '404.md') {
					continue;
				}
			}
			$str .= '<li>';
			 //
			$dir = isset($dynamicDir) ? $dynamicDir : '';
			$parentDir = isset($parentDir) ? $parentDir : '';
			if(!is_array($value)){
				//$str .=  ucfirst(substr_replace($value, "", -3)) ;
				if(is_numeric($key)){
					$str .= anchor($this->docControler.$dir.substr_replace($value, "", -3), substr_replace($value, "", -3));
				} else {
					echo $str .= anchor($this->docControler.$dir.substr_replace($value, "", -3), substr_replace($value, "", -3));
					//$str .=  ucfirst(substr_replace($value, "", -3)) ;
				}
				//dump($key.''.$value);
			} else {
				//$str .= '<li id="list_' . substr_replace($key, "", -1) .'">';
				$str .=  '<h4>'.ucfirst(substr_replace($key, "", -1)).'</h4>' ;
				$str .= $this->getOL($value, $key, null, $child = TRUE);

			}

		}
		$str .= '</ul>'. PHP_EOL;

		return $str;

	}

	function fileTree($directory, $return_link, $extensions = array()) 		{
		//$code =
		// Generates a valid XHTML list of all directories, sub-directories, and files in $directory
		// Remove trailing slash
	if( substr($directory, -1) == "/" )
		$directory = substr($directory, 0, strlen($directory) - 1);

	$code = $this->fileTreeDir($directory, $return_link, $extensions);
	return $code;
}

function fileTreeDir($directory, $return_link, $extensions = array(), $first_call = true) {
		// Recursive function called by php_file_tree() to list directories/files

		// Get and sort directories/files
	if( function_exists("scandir") ) $file = scandir($directory);

	natcasesort($file);
		// Make directories first
	$files = $dirs = array();
	foreach($file as $this_file) {
		if( is_dir("$directory/$this_file" ) ) $dirs[] = $this_file; else $files[] = $this_file;
	}
	$file = array_merge($dirs, $files);

		// Filter unwanted extensions
	if( !empty($extensions) ) {
		foreach( array_keys($file) as $key ) {
			if( !is_dir("$directory/$file[$key]") ) {
				$ext = substr($file[$key], strrpos($file[$key], ".") + 1);
				if( !in_array($ext, $extensions) ) unset($file[$key]);
			}
		}
	}

		if( count($file) > 2 ) { // Use 2 instead of 0 to account for . and .. "directories"
		$php_file_tree = "<ul";
		if( $first_call ) { $php_file_tree .= " class=\"php-file-tree\""; $first_call = false; }
		$php_file_tree .= ">";
		foreach( $file as $this_file ) {
			if( $this_file != "." && $this_file != ".." && $this_file != "404.md" ) {
				if( is_dir("$directory/$this_file") ) {
						// Directory
					$php_file_tree .= "<li class=\"pft-directory\"><a href=\"#\">" . htmlspecialchars($this_file) . "</a>";
					$php_file_tree .= $this->fileTreeDir("$directory/$this_file", $return_link ,$extensions, false);
					$php_file_tree .= "</li>";
				} else {
						// File
						// Get extension (prepend 'ext-' to prevent invalid classes from extensions that begin with numbers)
					$dirForView = str_replace('./content', '', $directory).'/';
					$finalUrl = substr_replace($this_file, "", -3);
					$ext = "ext-" . substr($this_file, strrpos($this_file, ".") + 1);
					$link = str_replace("[link]", "$dirForView" . urlencode($finalUrl), $return_link);
					$php_file_tree .= "<li class=\"pft-file " . strtolower($ext) . "\"><a href=\"$link\">" . htmlspecialchars(substr_replace($this_file, "", -3)) . "</a></li>";
				}
			}
		}
		$php_file_tree .= "</ul>";
	}
	return $php_file_tree;
}

}

/* End of file Files.php */
/* Location: ./application/controllers/Files.php */