<?php

use \Phpfastcache\CacheManager;
use \Phpfastcache\Config\ConfigurationOption;

class headerModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        CacheManager::setDefaultConfig(new ConfigurationOption(
            [
                'path' => APPPATH . '/cache/',
            ]
        ));

        $this->InstanceCache = CacheManager::getInstance('files');
    }

    function timeExpired()
    {
        $time = 30; // 1 hour = 3600 seconds
        return $time;
    }

    function getMetaDataContents($images, $title, $keywords, $descriptions)
    {
        $whitelist = array('127.0.0.1', "::1", "localhost");

        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

            $urlArray = explode('/', $parse_url);
            
            if (in_array('research', $urlArray)) {
                $article_type = 'publications';
                if (end($urlArray) == 'research') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];

                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    if (in_array('topic', $urlArray)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                }
                
            } elseif (in_array('database-and-programmes', $urlArray)) {
                $article_type = 'articles';
                if (end($urlArray) == 'database-and-programmes') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];

                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    if (in_array('topic', $urlArray)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                }
            } elseif (in_array('publications', $urlArray)) {
                $article_type = 'publications';
                if (end($urlArray) == 'publications') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];

                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    if (in_array('category', $urlArray)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                    
                }
                
            } elseif (in_array('news-and-views', $urlArray)) {
                $article_type = 'news';
                
                if (end($urlArray) == 'news-and-views') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                        
                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];

                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    
                    if (in_array('category', $urlArray)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                            
                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                }
            } elseif (in_array('events', $urlArray)) {
                $article_type = 'events';
                if (end($urlArray) == 'events') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];

                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                    
                }
            } elseif (in_array('multimedia', $urlArray)) {
                $article_type = 'multimedia';
                if (end($urlArray) == 'multimedia') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => 'Multimedia',
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    
                    $this->db->select('eria_expert_categories.category');
                    $this->db->where('parent', 'multimedia');
                    $eria_expert_categories = $this->db->get('eria_expert_categories')->result();
                    foreach ($eria_expert_categories as $key => $value) {
                        $categorymultimedia[] = strtolower($value->category);
                    }
                    
                    // Category Multimedia
                    if (in_array(end($urlArray), $categorymultimedia)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                            
                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                    
                }
            } else {
                $article_type = '';
                if (end($urlArray) == 'index.php') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    /*
                    ** Meta data for All About Us Pages
                    ** Meta data for All People Pages
                    ** Meta data for All Press Room
                    ** Meta data for Contact
                    */ 
                    // echo "<pre>";
                    // print_r($urlArray);
                    // echo "<pre>";
                    // print_r(end($urlArray));
                    // echo "<pre>";
                    // print_r($images);
                    // echo "<pre>";
                    // print_r($title);
                    // echo "<pre>";
                    // print_r($keywords);
                    // echo "<pre>";
                    // print_r($descriptions);
                    // exit();
                    if (end($urlArray) == 'press-room') {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } 
                }
                
            }

            return $data;
        } else {
            $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

            $urlArray = explode('/', $parse_url);
            
            if (in_array('research', $urlArray)) {
                $article_type = 'publications';
                if (end($urlArray) == 'research') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];

                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    if (in_array('topic', $urlArray)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                }
                
            } elseif (in_array('database-and-programmes', $urlArray)) {
                $article_type = 'articles';
                if (end($urlArray) == 'database-and-programmes') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }
                        
                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                        
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    if (in_array('topic', $urlArray)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                }
            } elseif (in_array('publications', $urlArray)) {
                $article_type = 'publications';
                if (end($urlArray) == 'publications') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }
                 
                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                        
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    
                    if (in_array('category', $urlArray)) {

                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                            
                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }

                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }
                            
                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                    
                }
                
            } elseif (in_array('news-and-views', $urlArray)) {
                $article_type = 'news';
                if (end($urlArray) == 'news-and-views') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                        
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    if (in_array('category', $urlArray)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }
                            
                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }
                            
                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                }
            } elseif (in_array('events', $urlArray)) {
                $article_type = 'events';
                if (end($urlArray) == 'events') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                        
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                        
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                    
                }
            } elseif (in_array('multimedia', $urlArray)) {
                $article_type = 'multimedia';
                if (end($urlArray) == 'multimedia') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => 'Multimedia',
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];

                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    
                    $this->db->select('eria_expert_categories.category');
                    $this->db->where('parent', 'multimedia');
                    $eria_expert_categories = $this->db->get('eria_expert_categories')->result();
                    foreach ($eria_expert_categories as $key => $value) {
                        $categorymultimedia[] = strtolower($value->category);
                    }
                    
                    // Category Multimedia
                    if (in_array(end($urlArray), $categorymultimedia)) {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }
                            
                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }
                            
                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    }
                    
                }
            } else {
                $article_type = '';
                if (end($urlArray) == 'index.php') {
                    if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                        if (file_exists(FCPATH . $images) && $images != '') {
                            $image_meta = base_url().'get_share_image.php?im='.$images;
                        } else {
                            $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                        }

                        $data = [
                            'image_meta'        => $image_meta,
                            'title_meta'        => $title,
                            'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                            'description_meta'  => $descriptions,
                        ];
                        
                    } else {
                        $data = [
                            'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                            'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                            'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                            'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                        ];
                    }
                } else {
                    /*
                    ** Meta data for All About Us Pages
                    ** Meta data for All People Pages
                    ** Meta data for All Press Room
                    ** Meta data for Contact
                    */ 
                    // echo "<pre>";
                    // print_r($urlArray);
                    // echo "<pre>";
                    // print_r(end($urlArray));
                    // echo "<pre>";
                    // print_r($images);
                    // echo "<pre>";
                    // print_r($title);
                    // echo "<pre>";
                    // print_r($keywords);
                    // echo "<pre>";
                    // print_r($descriptions);
                    // exit();
                    if (end($urlArray) == 'press-room') {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {

                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }
                            
                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];

                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } else {
                        if (!empty($images) AND !empty($title) AND !empty($keywords) AND !empty($descriptions)) {
                            
                            if (file_exists(FCPATH . $images) && $images != '') {
                                $image_meta = base_url().'get_share_image.php?im='.$images;
                            } else {
                                $image_meta = base_url().'get_share_image.php?im=v6/assets/logo.png';
                            }
                            
                            $data = [
                                'image_meta'        => $image_meta,
                                'title_meta'        => $title,
                                'keyword_meta'      => str_replace(',,', ', ', str_replace(' ', ',', $keywords)),
                                'description_meta'  => $descriptions,
                            ];
                            
                        } else {
                            $data = [
                                'image_meta'        => base_url().'get_share_image.php?im=v6/assets/logo.png',
                                'title_meta'        => 'Economic Research Institute for ASEAN and East Asia',
                                'keyword_meta'      => 'eria, economic research, economic research institute, research institute, asean, east asia',
                                'description_meta'  => 'Economic Research Institute for ASEAN and East Asia',
                            ];
                        }
                    } 
                }
                
            }

            return $data;
        }
    }
    
    function getPage_card($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', $id);
            $query = $this->db->get('eria_card');
            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_topic($type)
    {
        try {
            $this->db->select('*');
            $this->db->where('category_type', $type);
            $query = $this->db->get('categories');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_cat($type)
    {
        try {
            $this->db->select('*');
            $this->db->where('category_type', $type);
            $query = $this->db->get('categories');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getCategoryMultimedia($category_id)
    {
        try {
            $this->db->select('eria_expert_categories.category');
            $this->db->where('ec_id', $category_id);
            $querys = $this->db->get('eria_expert_categories');
            $data = $querys->row();

            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getLatestMultimediaPageCard()
    {
        try {

            $this->db->select('articles.*,eria_expert_categories.category');
            $this->db->where('article_type', 'multimedia');
            $this->db->where('parent', 'multimedia');
            $this->db->where_in('category', ['Video', 'Podcasts','Webinar']);
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->limit(3);
            $results = $this->db->get('articles')->result();

            $data = array();

            foreach ($results as $aid => $queryim) {
                $category_data = $this->getCategoryMultimedia($queryim->sub_experts);
                $data[$aid]['article_type'] = $queryim->article_type;
                $data[$aid]['category'] = $category_data->category;
                $data[$aid]['uri'] = $queryim->uri;
                $data[$aid]['title'] = $queryim->title;
                $data[$aid]['posted_date'] = date('j F Y', strtotime($queryim->posted_date));
                $data[$aid]['video_url'] = $queryim->video_url;
            }
            return $data;

        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageCardMultimedia()
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', 3);
            $querys = $this->db->get('eria_card');
            $data = $querys->row();

            $typeData = array();

            $g = explode(',', $data->sub_heading);
            
            $this->db->select('article_type, tags, pub_type, posted_date, uri, title, video_url, sub_experts');
            $this->db->where_in('article_id', $g);
            $this->db->where('sub_experts', 'multimedia');
            $this->db->where('sub_experts !=', '21');
            $queryd = $this->db->get('articles')->result();

            foreach ($queryd as $aid => $queryim) {
                $category_data = $this->getCategoryMultimedia($queryim->sub_experts);
                $typeData[$aid]['article_type'] = $queryim->article_type;
                $typeData[$aid]['category'] = $category_data->category;
                $typeData[$aid]['uri'] = $queryim->uri;
                $typeData[$aid]['title'] = $queryim->title;
                $typeData[$aid]['posted_date'] = date('j F Y', strtotime($queryim->posted_date));
                $typeData[$aid]['video_url'] = $queryim->video_url;
            }
            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageCardMultimediaRandoms()
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', 3);
            $querys = $this->db->get('eria_card_randoms');
            $data = $querys->row();

            $typeData = array();

            $g = explode(',', $data->sub_heading);

            $this->db->select('article_type, tags, pub_type, posted_date, uri, title, video_url, sub_experts');
            $this->db->where_in('article_id', $g);
            $this->db->where('sub_experts', 'multimedia');
            $this->db->where('sub_experts !=', '21');
            $queryd = $this->db->get('articles')->result();

            foreach ($queryd as $aid => $queryim) {
                $category_data = $this->getCategoryMultimedia($queryim->sub_experts);
                $typeData[$aid]['article_type'] = $queryim->article_type;
                $typeData[$aid]['category'] = $category_data->category;
                $typeData[$aid]['uri'] = $queryim->uri;
                $typeData[$aid]['title'] = $queryim->title;
                $typeData[$aid]['posted_date'] = date('j F Y', strtotime($queryim->posted_date));
                $typeData[$aid]['video_url'] = $queryim->video_url;
            }
            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_card_mnews()
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', 3);
            $querys = $this->db->get('eria_card');
            $data = $querys->row();

            $typeData = array();

            $g = explode(',', $data->sub_heading);

            $this->db->select('article_type,tags,pub_type,posted_date,uri,title,video_url');
            $this->db->where_in('article_id', $g);
            $queryd = $this->db->get('articles')->result();

            foreach ($queryd as $aid => $queryim) {
                $typeData[$aid]['article_type'] = $queryim->article_type;
                $tag = explode(',', $queryim->tags);
                // $typeData[$aid]['tags']= $this->taglink($tag,$queryim->article_type,$queryim->pub_type);
                $typeData[$aid]['uri'] = $queryim->uri;
                $typeData[$aid]['title'] = $queryim->title;
                $typeData[$aid]['posted_date'] = date('j F Y', strtotime($queryim->posted_date));
                $typeData[$aid]['video_url'] = $queryim->video_url;
            }
            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_menucatogery($type)
    {
        $key = "all_menu_category_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->from('categories');
                $this->db->where('categories.category_type', $type);
                $this->db->where('published', 1);
                $this->db->order_by('order_id', 'ASC');

                $queryT = $this->db->get();
                $results = $queryT->result();

                $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function getPage_card_events()
    {
        $today = date('Y-m-d');

        try {
            $this->db->select('*');
            $this->db->where('c_id', 8);
            $querys = $this->db->get('eria_card');
            $data = $querys->row();

            $typeData = array();

            $this->db->select('articles.*');
            $this->db->where('article_type', 'events');
            $this->db->where('start_date >=', $today);
            $this->db->order_by('article_id', 'DESC');
            $query = $this->db->get('articles')->row();
            $typeData = null;

            if ($query) {
                $typeData['article_type'] = $query->article_type;
                $tag = explode(',', $query->tags);
                $typeData['tags'] = $this->tag_topic($query->article_id);
                $typeData['uri'] = $query->uri;
                $typeData['title'] = $query->title;

                if (file_exists(FCPATH . $query->image_name)) {

                    $nm = $query->image_name;
                } else {
                    $nm = "upload/Event.jpg";
                }

                $typeData['image_name'] = $nm;
                $typeData['cat'] = $this->get_articleCatogery($query->article_id);
                $typeData['posted_date'] = date('j F Y', strtotime($query->posted_date));

                $g = explode(',', $data->sub_heading);

                $typeData['blk'] = array();
                $this->db->select('article_type,tags,pub_type,posted_date,uri,title,article_id,content');
                $this->db->where('article_type', 'events');
                $this->db->where('article_id!=', $query->article_id);
                $this->db->where('start_date >=', $today);
                $this->db->limit(3);
                $this->db->order_by('article_id', 'DESC');
                $queryd = $this->db->get('articles')->result();

                foreach ($queryd as $aid => $queryim) {
                    $typeData['blk'][$aid]['article_type'] = $queryim->article_type;
                    $tag = explode(',', $queryim->tags);
                    $typeData['blk'][$aid]['tags'] = $this->tag_topic($queryim->article_id);
                    $typeData['blk'][$aid]['uri'] = $queryim->uri;
                    $typeData['blk'][$aid]['title'] = $queryim->title;
                    $typeData['blk'][$aid]['content'] = $queryim->content;
                    $typeData['blk'][$aid]['posted_date'] = date('j F Y', strtotime($queryim->posted_date));
                }

                return $typeData;
            }
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageCardRelatedCategoriesRandoms($c_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', $c_id);
            $querys = $this->db->get('eria_card_randoms');
            $result_card = $querys->row();

            return $result_card;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageCardImageRandomByCardId($card_random_id)
    {
        try {
            $this->db->select('eria_card_randoms.*');
            $this->db->where_in('eria_card_randoms.c_id', $card_random_id);
            $this->db->where('eria_card_randoms.published', 1);
            $this->db->where('eria_card_randoms.is_delete', 2);
            $this->db->where('eria_card_randoms.sort_by', 'images');
            $this->db->order_by('eria_card_randoms.sorted', 'ASC');
            $querys = $this->db->get('eria_card_randoms');
            $result_card = $querys->result();

            return $result_card;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageCardQuickLinksRandoms($c_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', $c_id);
            $querys = $this->db->get('eria_card_randoms');
            $result_card = $querys->row();

            return $result_card;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageCardParamFive($c_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', $c_id);
            $querys = $this->db->get('eria_card');
            $result_card = $querys->row();

            return $result_card;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageCardOtherTopics($c_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', $c_id);
            $querys = $this->db->get('eria_card');
            $result_card = $querys->row();

            return $result_card;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getCategoryResearchById($categoryIds)
    {
        try {
            $category_ids = explode(',', $categoryIds);
    
            $this->db->select('*');
            $this->db->where_in('category_id', $category_ids);
            $this->db->where('published', 1);
            $result_articles = $this->db->get('categories')->result();
            
            return $result_articles;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getArticleCardOtherTopics($articleIds)
    {
        try {
            $articleid = explode(',', $articleIds);
    
            $this->db->select('article_type,tags,pub_type,posted_date,uri,title,article_id');
            $this->db->where_in('article_id', $articleid);
            $this->db->order_by('posted_date', 'DESC');
            $this->db->limit(3);
            $result_articles = $this->db->get('articles')->result();
            
            return $result_articles;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getLatestNewsPageCard()
    {
        $this->db->select('article_type,tags,pub_type,posted_date,uri,title,article_id');
        $this->db->where('article_type', 'news');
        $this->db->where('published', '1');
        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit(3);

        $result = $this->db->get('articles')->result();
        foreach ($result as $aid => $value) {
            $data['blk'][$aid]['article_type'] = $value->article_type;
            $tag = explode(',', $value->tags);
            $data['blk'][$aid]['tags'] = $this->tag_topic($value->article_id);
            $data['blk'][$aid]['uri'] = $value->uri;
            $data['blk'][$aid]['title'] = $value->title;
            $data['blk'][$aid]['posted_date'] = date('j F Y', strtotime($value->posted_date));
        }
        return $data;
    }

    function getPageCardLatestNewsRandoms()
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', 2);
            $querys = $this->db->get('eria_card_randoms');
            $data = $querys->row();

            $typeData = array();

            $this->db->select('articles.*');
            $this->db->where('article_id', $data->headinng);
            $query = $this->db->get('articles')->row();

            $typeData['article_type'] = $query->article_type;
            $tag = explode(',', $query->tags);
            $typeData['tags'] = $this->tag_topic($query->article_id);
            $typeData['uri'] = $query->uri;
            $typeData['title'] = $query->title;
            $typeData['image_name'] = $query->image_name;
            $typeData['cat'] = $this->get_articleCatogery($query->article_id);
            $typeData['posted_date'] = date('j F Y', strtotime($query->posted_date));

            $g = explode(',', $data->sub_heading);

            $typeData['blk'] = array();
            $this->db->select('article_type,tags,pub_type,posted_date,uri,title,article_id');
            $this->db->where_in('article_id', $g);
            $this->db->order_by('posted_date', 'DESC');
            $this->db->limit(3);
            $queryd = $this->db->get('articles')->result();

            foreach ($queryd as $aid => $queryim) {
                $typeData['blk'][$aid]['article_type'] = $queryim->article_type;
                $tag = explode(',', $queryim->tags);
                $typeData['blk'][$aid]['tags'] = $this->tag_topic($queryim->article_id);
                $typeData['blk'][$aid]['uri'] = $queryim->uri;
                $typeData['blk'][$aid]['title'] = $queryim->title;
                $typeData['blk'][$aid]['posted_date'] = date('j F Y', strtotime($queryim->posted_date));
            }
            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_card_news()
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', 2);
            $querys = $this->db->get('eria_card');
            $data = $querys->row();

            $typeData = array();

            $this->db->select('articles.*');
            $this->db->where('article_id', $data->headinng);
            $query = $this->db->get('articles')->row();

            $typeData['article_type'] = $query->article_type;
            $tag = explode(',', $query->tags);
            $typeData['tags'] = $this->tag_topic($query->article_id);
            $typeData['uri'] = $query->uri;
            $typeData['title'] = $query->title;
            $typeData['image_name'] = $query->image_name;
            $typeData['cat'] = $this->get_articleCatogery($query->article_id);
            $typeData['posted_date'] = date('j F Y', strtotime($query->posted_date));

            $g = explode(',', $data->sub_heading);

            $typeData['blk'] = array();
            $this->db->select('article_type,tags,pub_type,posted_date,uri,title,article_id');
            $this->db->where_in('article_id', $g);
            $this->db->order_by('posted_date', 'DESC');
            $this->db->limit(3);
            $queryd = $this->db->get('articles')->result();

            foreach ($queryd as $aid => $queryim) {
                $typeData['blk'][$aid]['article_type'] = $queryim->article_type;
                $tag = explode(',', $queryim->tags);
                $typeData['blk'][$aid]['tags'] = $this->tag_topic($queryim->article_id);
                $typeData['blk'][$aid]['uri'] = $queryim->uri;
                $typeData['blk'][$aid]['title'] = $queryim->title;
                $typeData['blk'][$aid]['posted_date'] = date('j F Y', strtotime($queryim->posted_date));
            }
            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function tag_topic($aid)
    {
        $out = '';
        $this->db->select('*');
        $this->db->from('article_topics AS article_topics');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where('article_topics.article_id', $aid);
        $queryT = $this->db->get();

        foreach ($queryT->result() as $tag) {
            $url = base_url() . "Update/Brows/all/" . $tag->category_name;
            $out .= "<a href='" . $url . "' >" . $tag->category_name . "</a>,&nbsp";
        }

        if (trim($out) != '') {
            return ":&nbsp" . rtrim($out, ",&nbsp");
        } else {
            return "";
        }
    }

    function get_articleCatogery($id)
    {
        $this->db->select('*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
        $this->db->where('article_categories.article_id', $id);
        $queryT = $this->db->get();
        return $queryT->row();
    }

    function get_Site()
    {
        try {
            $this->db->select('*');
            $this->db->where('id', 1);
            $query = $this->db->get('content');
            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getUpdatesNewsType($category_type)
    {
        $this->db->select('*');
        $this->db->where('category_type', $category_type);
        $this->db->where('published', 1);

        $query = $this->db->get('categories');

        $data = $query->result();
        return $data;
    }

    function getPublicationType($category_type)
    {
        $this->db->select('*');
        $this->db->where('category_type', $category_type);
        $this->db->where('published', 1);

        $query = $this->db->get('categories');

        $data = $query->result();
        return $data;
    }

    function getMenuShortCutLinkCategories($type, $limit)
    {
        $this->db->select('*');
        $this->db->where_in('category_type', $type);
        $this->db->where('published', 1);

        if ($type == 'topics') {
            $this->db->where('uri!=', 'co-publications');
        }
        if ($limit) {
            $this->db->limit($limit);
        }

        $query = $this->db->get('categories');

        return $query->result();
    }

    function get_menuTopic($type, $limit)
    {
        $this->db->select('*');
        $this->db->where('category_type', $type);
        $this->db->where('published', 1);

        if ($type == 'topics') {
            $this->db->where('uri!=', 'co-publications');
        }
        if ($limit) {
            $this->db->limit($limit);
        }

        $query = $this->db->get('categories');

        return $query->result();
    }

    function get_menu_latest_multimedia($id)
    {
        $key = "all_" . $id . "_menu_latest_multimedia_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            $category_type = 'multimedia';
            $limit = '6';
            try {
                $this->db->select('articles.*,eria_expert_categories.category');
                $this->db->where('article_type', 'multimedia');
                $this->db->where('published', '1');
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
                $this->db->order_by('articles.posted_date', 'DESC');
                $this->db->limit($limit);
                $query = $this->db->get('articles');

                $results = $query->result();

                $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function get_menuMultimedia($id)
    {
        $this->db->select('*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('articles', 'articles.article_id = article_categories.article_id', 'left');
        $this->db->where('articles.published', 1);
        $this->db->where('article_categories.category_id', $id);
        $queryT = $this->db->get();
        return $queryT->result();
    }

    function get_menuArticle($type)
    {
        $key = $type."_Mega_Menu_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('article_type', $type);
                $this->db->where('published', 1);
                $this->db->order_by('posted_date', 'DESC');
                $this->db->limit(3);
                $query = $this->db->get('articles');

                $results = $query->result();
                $CachedString->set($results)->expiresAfter($this->timeExpired());  // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function get_menuEvents($type, $limit)
    {
        $key = "all_" . $type . "_menu_events_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            $today = date('Y-m-d');
            try {
                $this->db->select('*');
                $this->db->where('article_type', 'events');
                $this->db->where('published', 1);
                if ($type == 'past') {
                    $this->db->where('start_date <', $today);
                } else if ($type == 'today') {
                    $this->db->where('start_date', $today);
                } else if ($type == 'future') {
                    $this->db->where('start_date >=', $today);
                }
                $this->db->order_by('start_date', 'DESC');
                $this->db->limit($limit);
                $query = $this->db->get('articles');

                $results = $query->result();

                $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }


    function get_menuV_Event()
    {
        try {
            $this->db->select('*');
            $this->db->where('article_type', 'events');
            $this->db->where('published', 1);

            $this->db->limit(2);
            $this->db->order_by('posted_date', 'DESC');
            $query = $this->db->get('articles');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_variableContent($v)
    {
        try {
            $this->db->select('*');
            $this->db->where('v_name', $v);
            $query = $this->db->get('web_variales');

            return   $query->row('content');
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_menu_asean()
    {
        $key = "all_menu_asean_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->like('tags', 'ASEAN');
                $this->db->where('image_name!=', '');
                $this->db->limit(4);
                $this->db->order_by('article_id', 'DESC');
                $query = $this->db->get('articles');
                $results = $query->result();
                $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function get_menu_future($article_type)
    {
        $key = "all_" . $article_type . "_menu_future_multimedia_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            $limit = '1';
            try {
                $this->db->select('articles.*,eria_expert_categories.category');
                $this->db->where('article_type', 'multimedia');
                $this->db->where('published', '1');
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
                $this->db->order_by('articles.posted_date', 'DESC');
                $this->db->limit($limit);
                $query = $this->db->get('articles');

                $results = $query->row();

                $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function getFeatureMultimedia($feature)
    {
        $time_ = time();
        $key_cache = $feature . "_feature_multimedia_desktop" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('articles.*,eria_expert_categories.category');
                $this->db->where('article_type', 'multimedia');
                $this->db->where('feature', $feature);
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
                $query = $this->db->get('articles');
                $results = $query->row();

                $CachedString->set($results)->expiresAfter($this->timeExpired());  // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function getFeature($type)
    {
        $key = $type . "_feature_deskstop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('feature', $type);
                $query = $this->db->get('articles');
                $results = $query->row();

                $CachedString->set($results)->expiresAfter($this->timeExpired());  // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function get_dbMenu()
    {
        $key = "all_platforms_menu_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            $this->db->select('*');
            $this->db->from('categories');
            $this->db->where('categories.category_type', 'categories');
            $this->db->where('published', 1);
            $this->db->order_by('order_id', 'ASC');
            $query  = $this->db->get();

            $results = array();

            foreach ($query->result() as $aid => $query) {
                $results[$aid]['category_name'] = $query->category_name;
                $results[$aid]['category_id'] = $query->category_id;
                $results[$aid]['uri'] = $query->uri;
                $results[$aid]['sub'] = $this->subCatogery($query->category_id);
                $results[$aid]['published'] = $query->published;
            }

            $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
            $this->InstanceCache->save($CachedString);
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function people_category_top_menu()
    {
        $key = "all_menu_people_category_top_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            $this->db->select('category, slug');
            $this->db->where('parent', 'experts');
            $query_people_category = $this->db->get('eria_expert_categories');

            $results = $query_people_category->result();

            $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
            $this->InstanceCache->save($CachedString);
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function subCatogery($id)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('categories.parent_id', $id);
        $this->db->where('published', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function get_newsMenu()
    {
        $key = "all_news_menu_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->from('categories');
                $this->db->where('category_type', 'newscategories');
                $this->db->where('published', 1);
                $this->db->where('category_name!=', 'Multimedia');
                $this->db->where('category_name!=', 'Press Releases');

                $query  = $this->db->get();

                $results = $query->result();

                $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function getPageAllAboutMenu()
    {
        try {
            $this->db->select('*');
            $this->db->where('parent_id', 7);
            $this->db->where('published', 1);
            $this->db->order_by('order_id', 'ASC');
            $data = $this->db->get('pages');
            
            return $data->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageAllAboutSubMenu($page_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('page_id', $page_id);
            $this->db->where('published', 1);
            $query = $this->db->get('pages_sub');

            $data = $query->result();
            return $data;

        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
}