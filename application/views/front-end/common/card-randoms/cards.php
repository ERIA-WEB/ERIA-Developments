<?php

$whitelist = array('127.0.0.1', "::1", "localhost");

if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

    $urlArray = explode('/', $parse_url);
    
    $getAllPages = $this->frontModel->getAllPages();
    
    foreach ($urlArray as $key => $value) {
        for ($i=0; $i < count($getAllPages) ; $i++) { 
            
            if (strtolower($getAllPages[$i]->uri) == strtolower($value)) {
                $page_id = $getAllPages[$i]->page_id;    
                $cardId = $this->frontModel->getCardByPage($page_id);
            }
        }
    }
    
} else {
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

    $urlArray = explode('/', $parse_url);
    
    $getAllPages = $this->frontModel->getAllPages();
    
    foreach ($urlArray as $key => $value) {
        for ($i=0; $i < count($getAllPages) ; $i++) { 
            
            if (strtolower($getAllPages[$i]->uri) == strtolower($value)) {
                $page_id = $getAllPages[$i]->page_id;    
                $cardId = $this->frontModel->getCardByPage($page_id);
            }
        }
    }
}

if (!empty($cardId) and isset($cardId)) {

    /*
    ** Get Cards Random Images & View Template Card Image Randoms
    */ 
    
    foreach ($cardId as $key => $value) {
        if ($value > 10) {
            $card_ids[] = $value;
        } else {
            $card_ids = array();
        }
    }
    
    if (!empty($card_ids)) {
        $page_card_image = $this->header->getPageCardImageRandomByCardId($card_ids);
        foreach ($page_card_image as $key => $value) {
            if ($value->c_id > 10) {
                $id    = $value->c_id;
                $link  = $value->headinng;
                $image = $value->content;
                $alt   = $value->c_name;
                if (!empty($link)) {
                    $links = $link;
                } else {
                    $links = '#';
                }

                if (!empty($image)) {
                    $path_image = base_url().$image;
                } else {
                    $path_image = '';
                }

                echo '<a href="'.$links.'">
                        <div class="card-image pb-4">
                            <img src="'.$path_image.'" alt="'.$alt.'" class="img-fluid w-100" />
                        </div>
                    </a>';
            }
        }
    }
    
    /*
    ** ends
    */ 
    
    /*
    ** Get Cards Random & View Template Card ID 1 s/d 10 Randoms
    */ 
    $card_randoms = $this->frontModel->getAllCardsRandomByActive($cardId);
    
    if (!empty($card_randoms)) {
        foreach ($card_randoms as $value) {
            if (!empty($value->file)) {
            $this->load->view('front-end/common/card-randoms/files/'. $value->file);
            } else {
                echo '<div class="container background d-none d-sm-block" style="background: #F3F8FC;">
                        <div class="row d-none d-sm-block">
                            <div class="col-md-12 col-xs-12 d-none d-sm-block">
                                '.$value->template.'
                            </div>
                        </div>

                    </div>';
            }
        }
    }
}

?>