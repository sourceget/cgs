<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Utils;

use Illuminate\Pagination\BootstrapThreePresenter;
use Illuminate\Support\HtmlString;
use Request;

class PaginationPresenter extends BootstrapThreePresenter {
    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render()
    {

        $str = '<ul class="pagination pagination-sm xj-pagination">%s %s %s</ul>';
        $pre    = $this->getPreviousButton('上一页');
        $next   = $this->getNextButton('下一页');
        return new HtmlString(sprintf($str, $pre, $this->getLinks(), $next));
    }
    
    public function getPreviousButton($text = '&laquo;')
    {
        // If the current page is less than or equal to one, it means we can't go any
        // further back in the pages, so we will render a disabled previous button
        // when that is the case. Otherwise, we will give it an active "status".
        if ($this->paginator->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text, 'prev');
    }
    
    /**
     * 重写分页连接
     * @param type $url
     * @param type $page
     * @param type $rel
     * @return type
     */
    public function getPageLinkWrapper($url, $page, $rel = null) {
        $data   = [];
        foreach (Request::all() as $key => $value) {
            if($key != 'page' && $key != '_url'){
                $data[$key] = $value;
            }
        }
        if($data){
            if(!strstr($url, '?')){
                $url    = $url . '?'.http_build_query($data);
            }else{
                $url    = $url . '&'.http_build_query($data);
            }            
        }
        if ($page == $this->paginator->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePageWrapper($url, $page, $rel);
    }
}
