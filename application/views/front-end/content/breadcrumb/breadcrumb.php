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
    } elseif (in_array('press-room', $urlArray)) {
        $breadcrumb = 'press-room';
    } elseif (in_array('experts', $urlArray)) {
        $breadcrumb = 'experts';
    } elseif (in_array('contact-us', $urlArray)) {
        $breadcrumb = 'contact-us';
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
    } elseif (in_array('press-room', $urlArray)) {
        $breadcrumb = 'press-room';
    } elseif (in_array('experts', $urlArray)) {
        $breadcrumb = 'experts';
    } elseif (in_array('contact-us', $urlArray)) {
        $breadcrumb = 'contact-us';
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
                                        <a href="' . base_url() . $breadcrumb .'/" class="text-uppercase">
                                            Research
                                        </a>
                                    </li>';
                            
                            if (in_array('asean', $urlArray)) {
                                echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . $breadcrumb .'/topic/asean/all" class="text-uppercase">
                                            ASEAN
                                        </a>
                                    </li>';
                                $asean = 'asean/';
                                $slug_research = ucfirst(end($urlArray));
                                $text_breadcrumb = ucfirst(end($urlArray));
                            } else {
                                $asean = '';
                                $slug_research = strtolower(end($urlArray));
                                $text_breadcrumb = ucwords(end($urlArray));
                            }
                            
                            if (end($urlArray) != 'all') {
                                if (!isset($article) AND empty($article)) {
                                    
                                    if (end($urlArray) != 'index.php' AND end($urlArray) != 'research') {
                                        echo '<li class="breadcrumb-item" aria-current="page">
                                                    <a href="'.base_url() .'research/topic/'. $asean . $slug_research .'" class="text-uppercase">
                                                        '.str_replace(array('%20', '-'), ' ', $text_breadcrumb).'
                                                    </a>
                                                </li>';
                                    }
                                }
                            }
                            
                            
                        } elseif ($breadcrumb == 'database-and-programmes') {
                            
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'database-and-programmes/' . '" class="text-uppercase">
                                            Programmes 
                                        </a>
                                    </li>';

                            if (!isset($article) AND empty($article)) {
                                if (end($urlArray) != 'index.php' AND end($urlArray) != 'database-and-programmes') {
                                    echo '<li class="breadcrumb-item" aria-current="page">
                                                <a href="'.base_url() .'database-and-programmes/topic/' . strtolower(end($urlArray)).'" class="text-uppercase">
                                                    '.ucfirst(str_replace('-', ' ', end($urlArray))).'
                                                </a>
                                            </li>';
                                }
                            }
                            
                        } elseif ($breadcrumb == 'publications') {
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'publications/" class="text-uppercase">
                                            Publications
                                        </a>
                                    </li>';
                                    
                            if (!isset($article) AND empty($article)) {
                                if (end($urlArray) != 'index.php' AND end($urlArray) != 'publications') {
                                    echo '<li class="breadcrumb-item" aria-current="page">
                                                <a href="'.base_url() .'publications/category/' . strtolower(end($urlArray)).'" class="text-uppercase">
                                                    '.ucfirst(str_replace('-', ' ', end($urlArray))).'
                                                </a>
                                            </li>';
                                }
                            }
                            
                        } elseif ($breadcrumb == 'news-and-views') {
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'news-and-views/' . '" class="text-uppercase">
                                            Updates 
                                            </a>
                                    </li>';
                            
                            if (!isset($article) AND empty($article)) {
                                if (end($urlArray) != 'index.php' AND end($urlArray) != 'news-and-views') {
                                    if (end($urlArray) == 'call-for-proposals') {
                                        $url_category = 'news-and-views/category/all/';
                                    } else {
                                        $url_category = 'news-and-views/category/';
                                    }
                                    echo '<li class="breadcrumb-item" aria-current="page">
                                                <a href="'.base_url() . $url_category . strtolower(end($urlArray)).'" class="text-uppercase">
                                                    '.ucfirst(str_replace('-', ' ', end($urlArray))).'
                                                </a>
                                            </li>';
                                }
                            }
                        } elseif ($breadcrumb == 'press-room') {
                                echo '<li class="breadcrumb-item" aria-current="page">
                                            <a href="' . base_url() . 'news/press-room/' . '" class="text-uppercase">
                                                Press Room 
                                                </a>
                                        </li>';
                        } elseif ($breadcrumb == 'experts') {
                                echo '<li class="breadcrumb-item" aria-current="page">
                                            <a href="' . base_url() . 'experts/' . '" class="text-uppercase">
                                                Our People 
                                            </a>
                                        </li>';
                        } elseif ($breadcrumb == 'contact-us') {
                                echo '<li class="breadcrumb-item" aria-current="page">
                                            <a href="' . base_url() . 'contact-us/' . '" class="text-uppercase">
                                                Contact Us
                                            </a>
                                        </li>';
                        } elseif ($breadcrumb == 'events') {
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'events/' . '" class="text-uppercase">
                                            Events 
                                            </a>
                                    </li>';
                        } elseif ($breadcrumb == 'multimedia') {
                            echo '<li class="breadcrumb-item" aria-current="page">
                                        <a href="' . base_url() . 'multimedia/' . '" class="text-uppercase">
                                            Multimedia 
                                            </a>
                                    </li>';
                            if (end($urlArray) != 'index.php' AND end($urlArray) != 'multimedia') {
                                if (!isset($article) || empty($article)) {
                                echo '<li class="breadcrumb-item" aria-current="page">
                                            <a href="'.base_url() .'multimedia/' . strtolower(end($urlArray)).'" class="text-uppercase">
                                                '.ucfirst(end($urlArray)).'
                                            </a>
                                        </li>';
                                }
                            }
                            if (isset($article) AND !empty($article)) {
                                if ($article->category == 'Unclassified') {
                                    $category_multimedia = 'Others';
                                } else {
                                    $category_multimedia = $article->category;
                                }

                                echo '<li class="breadcrumb-item" aria-current="page">
                                            <a href="'.base_url() . strtolower($article->article_type).'/' . strtolower($article->category).'" class="text-uppercase">
                                                '.ucfirst($category_multimedia).'
                                            </a>
                                        </li>';
                            }
                            
                        } else {}
                    }
                    ?>
                    <?php 
                        if (isset($article) AND !empty($article)) {
                            echo '<li class="breadcrumb-item">
                                        <span>'.limit_text(str_replace(array('â€™', 'â€˜'), "'", $article->title), 7).'</span>
                                    </li>';
                        }
                    ?>

                </ol>
            </nav>
        </div>
    </div>
</div>