<?php

function limit_text($text, $limit, $link = null)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        if ($link) {
            $text  = substr($text, 0, $pos[$limit]) . '<a href="' . base_url() . $link . '" >[...]</a>';
        } else {
            $text  = substr($text, 0, $pos[$limit]) . '[...]';
        }
    }
    return $text;
}

$whitelist = array('127.0.0.1', "::1", "localhost");

if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

    $urlArray = explode('/', $parse_url);
    
    if (in_array('research', $urlArray)) {
        $breadcrumb = 'research';
    } elseif (in_array('database-and-programmes', $urlArray)) {
        $breadcrumb = 'database-and-programmes';
    } elseif (in_array('publications', $urlArray)) {
        $breadcrumb = 'publications';
    } elseif (in_array('news-and-views', $urlArray)) {
        $breadcrumb = 'news-and-views';
    } elseif (in_array('events', $urlArray)) {
        $breadcrumb = 'events';
    } elseif (in_array('multimedia', $urlArray)) {
        $breadcrumb = 'multimedia';
    }else {
        $breadcrumb = '';
    }
} else {
    $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

    $urlArray = explode('/', $parse_url);
    if (in_array('research', $urlArray)) {
        $breadcrumb = 'research';
    } elseif (in_array('database-and-programmes', $urlArray)) {
        $breadcrumb = 'database-and-programmes';
    } elseif (in_array('publications', $urlArray)) {
        $breadcrumb = 'publications';
    } elseif (in_array('news-and-views', $urlArray)) {
        $breadcrumb = 'news-and-views';
    } elseif (in_array('events', $urlArray)) {
        $breadcrumb = 'events';
    } elseif (in_array('multimedia', $urlArray)) {
        $breadcrumb = 'multimedia';
    }else {
        $breadcrumb = '';
    }
    
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent px-0">
                    <li class="breadcrumb-item align-items-center">
                        <a href="<?php echo base_url(); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                class="bi bi-house mb-1" viewBox="0 0 16 16">
                                <path
                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <?php
                    if (!empty($breadcrumb)) {
                        if ($breadcrumb == 'research') {
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . $breadcrumb .'/">
                                            Research
                                        </a>
                                    </li>';
                            
                        } elseif ($breadcrumb == 'database-and-programmes') {
                            
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'database-and-programmes/' . '">
                                            Programmes </a>
                                    </li>';
                            
                        } elseif ($breadcrumb == 'publications') {
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'publications/">
                                            Publications
                                        </a>
                                    </li>';
                        } elseif ($breadcrumb == 'news-and-views') {
                                echo '<li class="breadcrumb-item" aria-current="page">
                                            <a href="' . base_url() . 'news-and-views/' . '">
                                                Updates </a>
                                        </li>';
                        } elseif ($breadcrumb == 'events') {
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'events/' . '">
                                            Events </a>
                                    </li>';
                        } elseif ($breadcrumb == 'multimedia') {
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'multimedia/' . '">
                                            Multimedia </a>
                                    </li>';
                            // echo '<li class="breadcrumb-item" aria-current="page">
                            //             <a href="'.base_url().strtolower($article->article_type).'">
                            //                 '.ucfirst($article->article_type).'
                            //             </a>
                            //         </li>';
                            if ($article->category == 'Unclassified') {
                                $category_multimedia = 'Others';
                            } else {
                                $category_multimedia = $article->category;
                            }

                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="'.base_url() . strtolower($article->article_type).'/' . strtolower($article->category).'">
                                            '.ucfirst($category_multimedia).'
                                        </a>
                                    </li>';
                        } else {}
                    }
                    ?>

                    <li class="breadcrumb-item">
                        <?php echo limit_text(str_replace(array('â€™', 'â€˜'), "'", $article->title), 7); ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>