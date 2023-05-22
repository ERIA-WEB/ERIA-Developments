<?php 
$whitelist = array('127.0.0.1', "::1", "localhost");

if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

    $urlArray = explode('/', $parse_url);
    
    $getAllPages = $this->frontModel->getAllPages();
    foreach ($getAllPages as $key => $value) {
        if (in_array($value->uri, $urlArray)) {
        
            $page_id = $value->page_id;
            $getCard = $this->frontModel->getCardByPage($page_id);
            // card param for research
            $cardId = $getCard;

        } else {
            $page_id = 1;
            $getCard = $this->frontModel->getCardByPage($page_id);
            // card param for research
            $cardId = $getCard;
        }
    }
} else {
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

    $urlArray = explode('/', $parse_url);
    $getAllPages = $this->frontModel->getAllPages();
    foreach ($getAllPages as $key => $value) {
        if (in_array($value->uri, $urlArray)) {
        
            $page_id = $value->page_id;
            $getCard = $this->frontModel->getCardByPage($page_id);
            // card param for research
            $cardId = $getCard;

        } else {
            $page_id = 1;
            $getCard = $this->frontModel->getCardByPage($page_id);
            // card param for research
            $cardId = $getCard;
        }
    }
}

foreach ($cardId as $key => $value) {
    if ($value > 10) {
        $card_ids[] = $value;
    }
}

$page_card_image = $this->header->getPageCardImageRandomByCardId($card_ids);

foreach ($page_card_image as $key => $value) {
    if ($value->c_id > 10) {
        $card_images[] = [
            'id'        => $value->c_id,
            'link'      => $value->headinng,
            'image'     => $value->content,
            'alt'       => $value->c_name
        ];
    }
}
?>
<?php 
    foreach ($card_images as $value) {
        if (!empty($value['link'])) {
            $links = $value['link'];
        } else {
            $links = '#';
        }

        if (!empty($value['image'])) {
            $path_image = base_url().$value['image'];
        } else {
            $path_image = '';
        }

        echo '<a href="'.$links.'">
                <div class="card-image pb-4">
                    <img src="'.$path_image.'" alt="'.$value['alt'].'" class="img-fluid w-100" />
                </div>
            </a>';
    }
?>