<?php
/**
 * Description of Dummy
 *
 * @author forhad
 */
use Forhad\Plugin\Plugin;

class Dummy extends Plugin {

    public function afterParsingMeta($param) {
        // do anithing u need
    }
    public function beforeShowingFile($param) {
        // do anithing u need
    }

    public function beforeShow(array $pages) {
        //$this->load(['plu' => $pages]);
        //dump(['dummy data']);
        
        $blog = 'blog/';
                $p = collect($pages);
        $filtered = $p->filter(function ($var) use($blog) {
            return strpos($var['id'], $blog) !== false;
        });
        $blogs = $filtered->all();   
        $blogs = $filtered->sortByDesc('time');
        $this->load(['blogs' => $blogs]);
    }

}
