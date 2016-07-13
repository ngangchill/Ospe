<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dummy
 *
 * @author forhad
 */
class PageLinks extends \Forhad\Plugin\Plugin {

    function _makeLinks($pages){

          //get requested file
        $currentID = substr(Cms::requestedFile(), 0, -3);
        //make links
        $pageIds = array_keys($pages);

        // now return current page number i.e 1
        $currentPageIndex = array_search($currentID, $pageIds);
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
        return array(
            'cPage' => $currentPage,
            'pPage' => $prevPage,
            'nPage' => $nextPage
            );

    }
    public function beforeShow($pages) {
        //dd($this->_makeLinks($pages));
       $this->load(['blogPageLinks' => $this->_makeLinks($pages)]);
    }

    // public function requestedFile($requestedFile)
    // {
    //     return $requestedFile;
    // }

}
