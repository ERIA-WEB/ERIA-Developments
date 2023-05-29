<?php

use \Phpfastcache\CacheManager;
use \Phpfastcache\Config\ConfigurationOption;
class FrontModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        CacheManager::setDefaultConfig(new ConfigurationOption([
            'path' => APPPATH . '/cache',
        ]));

        $this->InstanceCache = CacheManager::getInstance('files');
    }

    function timeExpired()
    {
        $time = 30; // 1 hour = 3600 seconds
        return $time;
    }

    function get_Slider()
    {
        $key_cache = "get_slider_home_desktop_".time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('published', 1);
                $query = $this->db->get('slides');
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

    function get_news_detail_page($url)
    {
        try {
            $this->db->select('*');
            $this->db->where('published', '1');
            $this->db->where('uri', urldecode($url));
            $query = $this->db->get('articles');
            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_articles_detail_page($url, $article_type)
    {
        try {
            $this->db->select('*');
            $this->db->where('published', '1');
            $this->db->where('article_type', $article_type);
            $this->db->where('uri', urldecode($url));
            $query = $this->db->get('articles');
            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAboutUsPagesDetailByURI($uri)
    {
        $key_cache = "getAboutUsPagesDetailByURI-_".time();
        $CachedString = $this->InstanceCache->getItem($key_cache);
        
        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('published', 1);
                $this->db->where('uri', urldecode($uri));
                $query = $this->db->get('pages');
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

    function getAboutUsSubPagesDetailByURI($uri)
    {
        $key_cache = "getAboutUsSubPagesDetailByURI-_".time();
        $CachedString = $this->InstanceCache->getItem($key_cache);
        
        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('published', 1);
                $this->db->where('uri', urldecode($uri));
                $query = $this->db->get('pages_sub');
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
        try {
            
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getTopicRelatedData($id)
    {
        try {
            $this->db->select('categories.*');
            $this->db->from('article_topics');
            $this->db->join('articles', 'articles.article_id = article_topics.article_id', 'left');
            $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
            $this->db->where('articles.uri', urldecode($id));
            $this->db->where('categories.published', 1);
            $query = $this->db->get();
            $results = $query->result();
            if (!empty($results)) {
                foreach ($results as $key => $value) {
                    if ($value->category_type == 'subtopics' and $value->parent_id == 11) {
                        $topic_relateds[] = '<a href="' . base_url() . 'research/topic/asean/' . $value->category_name . '">' . $value->category_name . '</a>';
                    } else {
                        $topic_relateds[] = '<a href="' . base_url() . 'research/topic/' . $value->uri . '">' . $value->category_name . '</a>';
                    }
                    
                }

                $data = implode(', ', $topic_relateds);
            } else {
                $data = array();
            }
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getTopicData($id)
    {
        try {
            $this->db->distinct('pdf_title');
            $this->db->select('categories.category_name,categories.uri');
            $this->db->from('article_topics');
            $this->db->join('articles', 'articles.article_id = article_topics.article_id', 'left');
            $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
            $this->db->where('articles.uri', urldecode($id));
            $query = $this->db->get();
            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getArticleInProgrammes($id, $article_type)
    {
        $this->db->select('*');
        $this->db->where('published', 1);
        $this->db->where('uri', urldecode($id));
        $this->db->where('article_type', $article_type);
        $query = $this->db->get('articles');
        $results = $query->row();

        return $results;
    }

    function getArticleMultimediaDetail($uri, $article_type)
    {
        try {
            $this->db->select('*');
            $this->db->where('published', 1);
            $this->db->where('uri', urldecode($uri));
            $this->db->where('article_type', $article_type);
            $query = $this->db->get('articles');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPublicationsExpertByTitle($title, $start, $limit)
    {
        $time_ = time(); // date('Y-m-d')
        $key_cache = "getPublicationsExpertByTitle_" . $title . "_" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {

                $this->db->select('*');
                $this->db->where('published', 1);
                $this->db->where('article_type', 'publications');
                $this->db->like('editor', $title);
                $this->db->or_like('author', $title);
                $this->db->order_by("posted_date", "desc");
                $this->db->limit($limit, $start);
                $query = $this->db->get('articles');
                $data = $query->result();

                $results = $data;

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

    function getArticleDetails($uri, $article_type)
    {
        $time_ = time();
        $key_cache = "get_inArticle_" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {        
                $this->db->select('articles.*, eria_expert_categories.ec_id, eria_expert_categories.category');
                $this->db->where('published', 1);
                $this->db->where('uri', urldecode($uri));
                $this->db->where('article_type', $article_type);
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'inner');
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

    function getInArticleResearch($id, $article_type)
    {
        $time_ = time();
        $key_cache = "get_inArticle_" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('uri', urldecode($id));
                $this->db->where('article_type', $article_type);
                $this->db->where('published', 1);
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

    function get_inArticle($id)
    {
        $time_ = time();
        $key_cache = "get_inArticle_" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('uri', urldecode($id));
                $this->db->where('published', 1);
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

    function load_pdf($id)
    {
        $this->db->distinct('pdf_title');
        $this->db->select('pdf_title');
        $this->db->from('eria_pdf AS eria_pdf');
        $this->db->join('articles', 'articles.article_id = eria_pdf.article_id', 'left');
        $this->db->where('articles.uri', $id);
        $this->db->order_by("eria_pdf.order_id", "asc");
        $queryT = $this->db->get();
        $data = $queryT->result();
        $typeData = array();
        foreach ($data as $aid => $query) {
            $typeData[$aid]['pdf_title'] = $query->pdf_title;

            $typeData[$aid]['content'] = $this->get_inPDF($id, $query->pdf_title);
        }

        return $typeData;
    }


    function get_inPDF($id, $title)
    {
        $this->db->select('*');
        $this->db->from('eria_pdf AS eria_pdf');
        $this->db->join('articles', 'articles.article_id = eria_pdf.article_id', 'left');
        $this->db->where('articles.uri', $id);
        $this->db->where('eria_pdf.pdf_title', $title);
        $queryT = $this->db->get();
        $data = $queryT->result();

        $typeData = array();
        foreach ($data as $aid => $query) {
            $typeData[$aid]['pdf_id'] = $query->pdf_id;
            $typeData[$aid]['pdf_title'] = $query->pdf_title;
            $typeData[$aid]['pdf_discription'] = $query->pdf_discription;
            $typeData[$aid]['pdf'] = $query->pdf;
            $typeData[$aid]['author'] = $this->get_pdfAuthor($query->pdf_id);
        }

        return $typeData;
    }

    function get_pdfAuthor($pdf)
    {
        $this->db->select('*');
        $this->db->where('pdf_id', $pdf);
        $this->db->join('articles', 'articles.article_id = eria_pdf_author.author', 'left');

        $query = $this->db->get('eria_pdf_author');

        return   $query->result();
    }

    function getCat_homearticle($id)
    {
        $this->db->select('*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
        $this->db->join('articles', 'articles.article_id = article_categories.article_id', 'left');
        $this->db->where('categories.category_name', $id);
        $this->db->where('articles.published', 1);

        $queryT = $this->db->get();

        return $queryT->result();
    }

    function assignNews($email)
    {
        $newHistory = array(
            'nemail' => $email
        );

        $this->db->insert('news_letter', $newHistory);
    }

    function get_messageinArticle($id)
    {
        try {
            $this->db->select('*');

            $this->db->where('article_id', $id);
            $query = $this->db->get('articles');
            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_Experts()
    {
        try {
            $this->db->select('*');
            $this->db->where('article_type', 'experts');
            $this->db->where('published', 1);
            $query = $this->db->get('articles');
            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_pageexperts($type, $key, $catogery_id)
    {
        try {
            $this->db->select('articles.*');
            $this->db->where('article_type', $type);
            $this->db->where('published', 1);
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->where('eria_expert_categories.article_types', $type);

            if ($catogery_id) {
                $this->db->where('articles.sub_experts', $catogery_id);
            }

            if ($key) {
                $this->db->like('articles.title', $key);
                $this->db->like('articles.content', $key);
            }

            $this->db->order_by('order_id', 'ASC');
            $query = $this->db->get('articles');

            $typeData = array();
            foreach ($query->result() as $aid => $query) {
                if ($query->sub_experts != '19') {
                    $typeData[$aid]['editor'] = $query->editor;
                    $typeData[$aid]['article_id'] = $query->article_id;
                    $typeData[$aid]['article_type'] = $query->article_type;
                    $typeData[$aid]['author'] = $query->author;
                    $typeData[$aid]['major'] = $query->major;
                    $typeData[$aid]['tags'] = $query->tags;
                    $typeData[$aid]['uri'] = $query->uri;
                    $typeData[$aid]['keywords'] = $query->keywords;
                    $typeData[$aid]['article_keywords'] = $query->article_keywords;
                    $typeData[$aid]['title'] = $query->title;
                    $typeData[$aid]['image_name'] = $query->image_name;
                    $typeData[$aid]['content'] = $query->content;
                    $typeData[$aid]['sub_experts'] = $query->sub_experts;
                    $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                    $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
                    $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
                    $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
                }
            }

            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPublicationForHighlight($inside)
    {
        try {
            $this->db->select('articles.*,pub_slider.*');
            $this->db->order_by('article_id', 'DESC');
            $this->db->join('articles', 'articles.article_id = pub_slider.pub_id', 'left');
            $this->db->where('inside', $inside);
            $this->db->where('published', '1');
            $query = $this->db->get('pub_slider');

            $typeData = array();
            foreach ($query->result() as $aid => $query) {
                $typeData[$aid]['editor'] = $query->editor;
                $typeData[$aid]['author'] = $query->author;
                $typeData[$aid]['article_id'] = $query->article_id;
                $typeData[$aid]['article_type'] = $query->article_type;
                $typeData[$aid]['major'] = $query->major;
                $tag = explode(',', $query->tags);
                $typeData[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
                $typeData[$aid]['uri'] = $query->uri;
                $typeData[$aid]['keywords'] = $query->keywords;
                $typeData[$aid]['article_keywords'] = $query->article_keywords;

                if ($query->n_title != '') {
                    $typeData[$aid]['title'] = $query->n_title;
                } else {
                    $typeData[$aid]['title'] = $query->title;
                }

                if ($query->n_content != '') {
                    $typeData[$aid]['content'] = $query->n_content;
                } else {
                    $typeData[$aid]['content'] = (string)$query->content;
                }

                $typeData[$aid]['image_name'] = $query->image_name;
                $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
                $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
                $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
            }

            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_publicatio_article($type)
    {
        $key_cache = "get_publicatio_article_" . $type;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('articles.*,pub_slider.*');
                $this->db->order_by('article_id', 'DESC');
                $this->db->join('articles', 'articles.article_id = pub_slider.pub_id', 'left');
                if ($type == 'home') {
                    $this->db->where('home', 1);
                }
                if ($type == 'inside') {
                    $this->db->where('inside', 1);
                }
                $query = $this->db->get('pub_slider');

                $results = array();
                foreach ($query->result() as $aid => $query) {
                    $results[$aid]['editor'] = $query->editor;
                    $results[$aid]['author'] = $query->author;
                    $results[$aid]['article_id'] = $query->article_id;
                    $results[$aid]['article_type'] = $query->article_type;
                    $results[$aid]['major'] = $query->major;
                    $tag = explode(',', $query->tags);
                    $results[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
                    $results[$aid]['uri'] = $query->uri;
                    $results[$aid]['keywords'] = $query->keywords;
                    $results[$aid]['article_keywords'] = $query->article_keywords;

                    if ($query->n_title != '') {
                        $results[$aid]['title'] = $query->n_title;
                    } else {
                        $results[$aid]['title'] = $query->title;
                    }

                    if ($query->n_content != '') {
                        $results[$aid]['content'] = $query->n_content;
                    } else {
                        $results[$aid]['content'] = (string)$query->content;
                    }

                    $results[$aid]['image_name'] = $query->image_name;
                    $results[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                    $results[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
                    $results[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
                    $results[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
                }

                $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;

        try {
            
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getArticleByKeystaffs($article_type)
    {
        try {
            $this->db->select('articles.*');
            $this->db->where('article_type', $article_type);
            $this->db->order_by('order_id', 'DECC');
            // $this->db->order_by('posted_date', 'DESC');
            $this->db->where('published', 1);
            $query = $this->db->get('articles');

            $result = array();
            foreach ($query->result() as $aid => $query) {
                $result[$aid]['editor'] = $query->editor;
                $result[$aid]['author'] = $query->author;
                $result[$aid]['article_id'] = $query->article_id;
                $result[$aid]['article_type'] = $query->article_type;
                $result[$aid]['major'] = $query->major;
                $result[$aid]['email'] = $query->majorEmail;
                $tag = explode(',', $query->tags);
                $result[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
                $result[$aid]['uri'] = $query->uri;
                $result[$aid]['keywords'] = $query->keywords;
                $result[$aid]['article_keywords'] = $query->article_keywords;
                $result[$aid]['title'] = $query->title;
                $result[$aid]['image_name'] = $query->image_name;
                $result[$aid]['email'] = $query->majorEmail;
                $result[$aid]['content'] = (string)$query->content;
                $result[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                $result[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
                $result[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
                $result[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
            }

            return $result;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpertsData($article_type)
    {
        $this->db->select('articles.*');
        $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
        $this->db->where('articles.article_type', $article_type);
        $this->db->where('published', 1);
        $this->db->where('eria_expert_categories.article_types', $article_type);
        $this->db->order_by('order_id', 'ASC');

        $result = $this->db->get('articles')->result();

        $data = array();
        foreach ($result as $aid => $query) {
            $data[$aid]['editor'] = $query->editor;
            $data[$aid]['author'] = $query->author;
            $data[$aid]['article_id'] = $query->article_id;
            $data[$aid]['article_type'] = $query->article_type;
            $data[$aid]['major'] = $query->major;
            $tag = explode(',', $query->tags);
            $data[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
            $data[$aid]['uri'] = $query->uri;
            $data[$aid]['keywords'] = $query->keywords;
            $data[$aid]['article_keywords'] = $query->article_keywords;
            $data[$aid]['title'] = $query->title;
            $data[$aid]['image_name'] = $query->image_name;
            $data[$aid]['email'] = $query->majorEmail;
            $data[$aid]['sub_experts'] = $query->sub_experts;
            $data[$aid]['content'] = (string)$query->content;
            $data[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
            $data[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
            $data[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
            $data[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
        }

        return $data;
    }

    function getHighlightByArticleId($article_id)
    {
        $this->db->select('article_persons.*');
        $this->db->where('article_id', $article_id);
        $this->db->where_in('ap_type', ['Author', 'Editor']);
        $this->db->where('show_type', 'Highlite');
        $query = $this->db->get('article_persons');

        $data = $query->result();

        return $data;
    }

    function getPeopleAuthorEditorByArticleTypes($article_type)
    {
        try {
            $this->db->select('articles.article_id, articles.title, articles.uri');
            $this->db->from('articles');
            $this->db->where_in('article_type', $article_type);
            $this->db->where('articles.published', 1);

            $query  = $this->db->get();
            $data = $query->result();
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
        
    }

    function getPeopleAuthorEditorByArticleId($article_id)
    {
        $this->db->select('articles.article_id, articles.title, articles.uri');
        $this->db->from('articles');
        $this->db->where('article_id', $article_id);
        $this->db->where('articles.published', 1);
        $query  = $this->db->get();

        if (isset($query->result()[0])) {
            $result = $query->result()[0];
        } else {
            $result = '';
        }
        return $result;
    }

    function getPeopleExperts($title)
    {
        $article_type = array('experts', 'fellows', 'associates', 'keystaffs');
        $this->db->select('articles.*');
        $this->db->from('articles');
        $this->db->where_in('title', $title);
        $this->db->where_in('articles.article_type', $article_type);
        $this->db->where('articles.published', 1);
        $query  = $this->db->get();

        $result = $query->result_array();
        return $result;
    }
    
    function get_article($limit, $type, $highlited, $from)
    {
        $key_cache = "get_article_" . $type . "_desktop_or_mobile";
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('articles.*');
                if ($type == 'keystaffs') {
                    $this->db->where('article_type', 'experts');
                    $this->db->where('sub_experts', 5);
                } else if ($type == 'co-publications') {
                    $this->db->where('article_type', 'publications');
                    $this->db->where('pub_type', 3);
                } else {
                    $this->db->where('article_type', $type);
                }

                $this->db->where('published', 1);

                if ($highlited) {
                    $this->db->where('highlight', 1);
                }

                if ($limit) {
                    $this->db->limit($limit);
                }

                if ($from == 'home') {
                    $this->db->where('image_name!=', '');
                }

                if ($type == 'experts') {
                    $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
                    $this->db->where('eria_expert_categories.category', 'experts');
                }

                if ($type) {
                    if ($type == 'publications') {
                        $this->db->order_by('posted_date', 'DESC');
                    } else if ($type == 'associates') {
                        $this->db->order_by('order_id', 'ASC');
                    } else {
                        $this->db->order_by('posted_date', 'DESC');
                    }
                } else {
                    $this->db->order_by('posted_date', 'DESC');
                }

                $query = $this->db->get('articles');

                $results = array();
                foreach ($query->result() as $aid => $query) {
                    $results[$aid]['editor'] = $query->editor;
                    $results[$aid]['author'] = $query->author;
                    $results[$aid]['article_id'] = $query->article_id;
                    $results[$aid]['article_type'] = $query->article_type;
                    $results[$aid]['major'] = $query->major;
                    $tag = explode(',', $query->tags);
                    $results[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
                    $results[$aid]['uri'] = $query->uri;
                    $results[$aid]['keywords'] = $query->keywords;
                    $results[$aid]['article_keywords'] = $query->article_keywords;
                    $results[$aid]['title'] = $query->title;
                    $results[$aid]['image_name'] = $query->image_name;
                    $results[$aid]['email'] = $query->majorEmail;
                    $results[$aid]['content'] = (string)$query->content;
                    $results[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                    $results[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
                    $results[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
                    $results[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
                }

                return $results;

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

    function get_all_departement_experts()
    {
        $query = "SELECT * FROM eria_expert_sub_categories";

        $result = $this->db->query($query);

        $data = $result->result();

        return $data;
    }

    function get_search_page_expert_by_content($key) {
        $this->db->select('articles.author, articles.editor');
        $this->db->where('published', 1);
        $this->db->where('article_type', 'publications');
        $this->db->like('title', $key);
        $this->db->order_by("posted_date", "desc");
        $query = $this->db->get('articles');
        $data = $query->row();
        return $data;
    }

    function getPeopleExpertsByContent($key)
    {
        $article_type = ['experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified'];

        $this->db->select('articles.*');
        $this->db->where('published', 1);
        $this->db->where_in('article_type', $article_type);
        $this->db->like('content', $key);
        $query = $this->db->get('articles');
        $data = $query->result_array();
        return $data;
    }

    function get_search_page_experts_($key, $sub_experts_id, $sub_dep_experts_id)
    {
        if (!empty($key)) {
            $keyword = "IF(`articles`.`title` != '', `articles`.`title`, `articles`.`major`) LIKE  '%$key%'";
        } else {
            $keyword = "";
        }

        if (!empty($sub_experts_id)) {
            
            if ($sub_experts_id == 'All' or $sub_experts_id == 'all') {
                $category_experts = "";
                if (!empty($key)) {
                    $article_type = "AND `articles`.`article_type` IN ('experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified')";
                } else {
                    $article_type = "`articles`.`article_type` IN ('experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified')";
                }
            } else {
                
                $category_experts = "AND `articles`.`sub_experts` = '" . $sub_experts_id . "'";

                $this->db->select('article_types');
                $this->db->where('ec_id', $sub_experts_id);
                $query_expert_category = $this->db->get('eria_expert_categories');

                $expert_category = $query_expert_category->row();
                if (!empty($key)) {
                    $article_type = "AND `articles`.`article_type` = '" . $expert_category->article_types . "'";
                } else {
                    $article_type = "`articles`.`article_type` = '" . $expert_category->article_types . "'";
                }
                
            }
        } else {
            $category_experts = "";

            $article_type = "AND `articles`.`article_type` IN ('experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified')";
        }

        if (!empty($sub_dep_experts_id)) {
            
            if ($sub_dep_experts_id !== 'All') {
                $subdepexpert_id = $sub_dep_experts_id;
                $query_people = "SELECT 
                                `article_experts_departements`.`article_id`
                                FROM `article_experts_departements` 
                                WHERE `article_experts_departements`.`eria_expert_departement_id` = '" . $subdepexpert_id . "'";

                $result_people = $this->db->query($query_people)->result();

                foreach ($result_people as $value) {
                    $peopleids[] = $value->article_id;
                }
                
                if (isset($peopleids)) {
                    if ($keyword != '') {
                        $sub_dep_experts = "AND `articles`.`article_id` IN ('" . implode("', '", $peopleids) . "')";
                    } else {
                        $sub_dep_experts = " `articles`.`article_id` IN ('" . implode("', '", $peopleids) . "') AND";
                    }
                } else {
                    $sub_dep_experts = "`articles`.`article_id` = '' AND";
                }
                
                
            } else {
                $sub_dep_experts = '';
            }
        } else {
            $sub_dep_experts = "";
        }

        $query = "SELECT 
                *
                FROM  `articles` 
                WHERE " . $keyword . "
                " . $sub_dep_experts . "
                " . $article_type . "
                " . $category_experts . "
                AND `articles`.`published` = '1'
                ORDER BY `order_id` ASC";

        $result = $this->db->query($query);

        return $result->result_array();
    }

    function get_search_experts($key, $role, $srole)
    {
        if ($role == 'Research Associates') {
            $role = "associates";
        }

        $this->db->select('articles.*');

        if ($key) {
            $this->db->like('title', $key);
            $this->db->or_like('major', $key, 'both');
        }

        if ($role == 'experts') {
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->where('eria_expert_categories.category', 'experts');
        }

        if ($role == 'Author') {
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->where('eria_expert_categories.category', 'Author');
        }

        if ($role == 'Editor') {
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->where('eria_expert_categories.category', 'Editor');
        }

        if ($role == 'Key Staff') {
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->where('eria_expert_categories.category', 'Key Staff');
        }

        if ($srole) {

            $this->db->join('eria_expert_sub_categories', 'eria_expert_sub_categories.ec_id = eria_expert_categories.ec_id', 'left');
            $this->db->where('eria_expert_sub_categories.es_id', $srole);
        }


        if ($role != 'all') {
            // $this->db->where('article_type', $role);

            $this->db->where('article_type', 'experts');
        } else {
            $this->db->where('article_type', 'experts');
        }


        $this->db->where('published', 1);
        $this->db->group_by('articles.article_id');
        $result_query = $this->db->get('articles');

        $typeData = array();
        foreach ($result_query->result() as $aid => $query) {

            if ($query->sub_experts != '19') {
                $typeData[$aid]['editor'] = $query->editor;
                $typeData[$aid]['author'] = $query->author;
                $typeData[$aid]['article_id'] = $query->article_id;
                $typeData[$aid]['article_type'] = $query->article_type;
                $typeData[$aid]['major'] = $query->major;
                $tag = explode(',', $query->tags);
                $typeData[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
                $typeData[$aid]['uri'] = $query->uri;
                $typeData[$aid]['keywords'] = $query->keywords;
                $typeData[$aid]['article_keywords'] = $query->article_keywords;
                $typeData[$aid]['title'] = $query->title;
                $typeData[$aid]['image_name'] = $query->image_name;
                $typeData[$aid]['content'] = (string)$query->content;
                $typeData[$aid]['sub_experts'] = $query->sub_experts;
                $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
            }
        }

        return $typeData;
    }

    function getPage_timeline()
    {
        $this->db->select('*');
        $this->db->from('eria_timeline');
        $this->db->where('published', 1);

        $this->db->order_by('year', 'ASC');
        $queryT = $this->db->get();
        return $queryT->result();
    }

    function getPerson($aid, $type, $place)
    {
        $this->db->select('articles.title,articles.uri');
        $this->db->from('article_persons');
        $this->db->join('articles', 'articles.article_id = article_persons.ec_id', 'left');
        $this->db->where('article_persons.ap_type', $type);
        $this->db->where('article_persons.show_type', $place);
        $this->db->where('article_persons.article_id', $aid);

        $queryT = $this->db->get();

        return $queryT->result();
    }

    function get_latest_article($limit)
    {
        try {
            $this->db->select('*');
            $this->db->where('published', 1);
            $this->db->where('article_type', 'news');
            $this->db->order_by('posted_date', 'DESC'); 
            $this->db->limit($limit);
            $query = $this->db->get('articles');

            $results = array();
            foreach ($query->result() as $aid => $query) {
                $results[$aid]['editor'] = $query->editor;
                $results[$aid]['author'] = $query->author;
                $results[$aid]['major'] = $query->major;
                $results[$aid]['keywords'] = $query->keywords;
                $results[$aid]['article_keywords'] = $query->article_keywords;
                $results[$aid]['title'] = $query->title;
                $results[$aid]['short_des'] = $query->short_des;
                $results[$aid]['article_type'] = $query->article_type;
                $results[$aid]['uri'] = $query->uri;
                $results[$aid]['image_name'] = $query->image_name;
                $results[$aid]['content'] = (string)$query->content;
                $results[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                $results[$aid]['posted_date'] = date('j  F Y', strtotime($query->posted_date));
                $results[$aid]['tags'] = $this->tag_topic($query->article_id);
            }

            return $results;

        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_recentArticle()
    {
        $key_cache = "get_recentArticle_";
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('published', 1);
                $this->db->where('article_type!=', 'publications');
                $this->db->order_by('sort', 'ASC');
                $this->db->join('articles', 'articles.article_id = eria_recent_updates.article', 'left');

                $query = $this->db->get('eria_recent_updates');

                $results = array();
                foreach ($query->result() as $aid => $query) {
                    $results[$aid]['editor'] = $query->editor;
                    $results[$aid]['author'] = $query->author;
                    $results[$aid]['major'] = $query->major;
                    $results[$aid]['keywords'] = $query->keywords;
                    $results[$aid]['article_keywords'] = $query->article_keywords;
                    $results[$aid]['title'] = $query->title;
                    $results[$aid]['short_des'] = $query->short_des;
                    $results[$aid]['article_type'] = $query->article_type;
                    $results[$aid]['uri'] = $query->uri;
                    $results[$aid]['image_name'] = $query->image_name;
                    $results[$aid]['content'] = (string)$query->content;
                    $results[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                    $results[$aid]['posted_date'] = date('j  F Y', strtotime($query->posted_date));
                    $results[$aid]['tags'] = $this->tag_topic($query->article_id);
                }

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

    function get_allarticle($limit, $type, $highlited, $from)
    {
        try {
            $this->db->select('*');

            $this->db->where('published', 1);
            $this->db->where('article_type!=', 'publications');

            $this->db->order_by('created_date', 'ASC');
            if ($highlited) {
                //  $this->db->where('highlight', 1);
            }
            if ($limit) {
                $this->db->limit($limit);
            }

            if ($from == 'home') {
                $this->db->where('image_name!=', '');
            }
            $query = $this->db->get('articles');

            $typeData = array();
            foreach ($query->result() as $aid => $query) {
                $typeData[$aid]['editor'] = $query->editor;
                $typeData[$aid]['author'] = $query->author;
                $typeData[$aid]['major'] = $query->major;
                $typeData[$aid]['tags'] = $query->tags;
                $typeData[$aid]['keywords'] = $query->keywords;
                $typeData[$aid]['article_keywords'] = $query->article_keywords;
                $typeData[$aid]['title'] = $query->title;
                $typeData[$aid]['article_type'] = $query->article_type;
                $typeData[$aid]['uri'] = $query->uri;
                $typeData[$aid]['image_name'] = $query->image_name;
                $typeData[$aid]['content'] = (string)$query->content;
                $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
                $typeData[$aid]['posted_date'] = date('j  F Y', strtotime($query->posted_date));
            }
            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_articleCatogery($id)
    {
        $this->db->distinct('article_categories.category_id');
        $this->db->select('categories.*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
        $this->db->where('article_categories.article_id', $id);
        $queryT = $this->db->get();
        return $queryT->row();
    }

    function get_card_articleCatogery($type, $ptype)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('category_type', $type);
        $queryT = $this->db->get();
        $linked = $queryT->result();

        return $linked;
    }

    function get_randomeArticle()
    {
        $key_cache = "get_randomeArticle_desktop";
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->from('articles');
                $this->db->where('article_type', 'articles');
                $this->db->where('published', 1);
                $this->db->order_by('rand()');
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

    function get_catogery_multimedia($type)
    {
        try {
            $this->db->select('*');
            $this->db->where('category_type', $type);
            $query = $this->db->get('categories');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getTopic($type, $limit)
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
    
    function get_catogery($type)
    {
        $key_cache = "get_category_" . $type . "_desktop";
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->from('categories');
                $this->db->where('categories.category_type', $type);
                $this->db->where('published', 1);
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

    function get_catogery_search($type, $limit, $start, $topic, $key)
    {

        $key_cache = "get_category_search_" . $type . "_" . $limit . "_" . $start . "_" . $topic . "_" . $topic . "_desktop";
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {

            try {

                $this->db->select('*');
                $this->db->from('categories');
                $this->db->where('categories.category_type', $type);
                $this->db->where('published', 1);

                if (
                    $topic != 'all'
                ) {
                    $this->db->where_in('category_id', $topic);
                }

                if ($key) {

                    $this->db->like('category_name', $key);
                }

                $this->db->limit($limit, $start);
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

    function getRelatedArticlePublicationTypeByCategoryId($categories, $start, $limit)
    {
        foreach ($categories as $category_) {
            $article_id[] = $category_->article_id;
        }

        $this->db->select('articles.*');
        $this->db->from('articles');
        $this->db->where('articles.published', 1);
        $this->db->where_in('articles.article_id', $article_id);
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        $data = $query->result();
        return $data;
    }

    function getCat_article($type, $start, $limit, $ath)
    {
        $this->db->select('articles.*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('articles', 'articles.article_id = article_categories.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
        $this->db->where('articles.published', 1);
        if ($type != 'all') {

            if ($type > 0) {
                foreach ($type as $typeuri) {
                    $uri[] = str_replace(array(' ', ':-'), '-', strtolower($typeuri));
                }

                $this->db->where_in('categories.uri', $uri);
            } else {
                $uri = $type;
                $this->db->where('categories.uri', $uri);
            }
            
        }

        if ($ath) {
            $this->db->where('articles.sub_experts', $ath);
        }
        $this->db->limit($limit, $start);
        $queryT = $this->db->get();
        return $queryT->result();
    }

    function getArticleTopics($cato)
    {
        $this->db->select('article_topics.*');
        $this->db->from('article_topics');
        $this->db->where_in('article_topics.topic_id', $cato);

        $query = $this->db->get();

        $data = $query->result();
        return $data;
    }

    function getArticleCategories($type)
    {
        $this->db->select('article_categories.*');
        $this->db->from('article_categories');
        $this->db->where_in('article_categories.category_id', $type);

        $query = $this->db->get();

        $data = $query->result();
        return $data;
    }

    function get_newsearchCat_article($type, $start, $limit, $cato, $key)
    {
        $this->db->select('articles.*');
        $this->db->from('articles');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'publications');

        if ($type != 'all') {
            $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
            $this->db->where('article_categories.category_id', $type);
        }

        if ($cato != 'all') {
            $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
            $this->db->where('article_topics.topic_id', $cato);
        }

        if ($key) {

            $keys = explode(' ', $key);

            foreach ($keys as $keys) {

                //  $this->db->like('articles.title', $keys);
                $this->db->like('articles.content', $keys);
            }
        }

        $this->db->group_by('articles.article_id');
        $this->db->limit($limit, $start);
        $this->db->order_by('posted_date', 'DESC');

        $queryT = $this->db->get();

        $data = $queryT->result();
        $typeData = array();
        foreach ($data as $aid => $query) {
            $typeData[$aid]['article_id']       = $query->article_id;
            $typeData[$aid]['title']            = $query->title;
            $typeData[$aid]['content']          = $query->content;
            $typeData[$aid]['image_name']       = $query->image_name;
            $typeData[$aid]['thumbnail_image']  = $query->thumbnail_image;
            $typeData[$aid]['posted_date']      = date('j F Y', strtotime($query->posted_date));
            $typeData[$aid]['editornew']        = $this->getPerson($query->article_id, 'Editor', 'Highlite');
            $typeData[$aid]['authornew']        = $this->getPerson($query->article_id, 'Author', 'Highlite');
            $typeData[$aid]['editor']           = $query->editor;
            $typeData[$aid]['author']           = $query->author;
            $typeData[$aid]['uri']              = $query->uri;

            $tag = explode(',', $query->tags);
            $typeData[$aid]['cat']              = $this->get_articleCatogery($query->article_id);
            $typeData[$aid]['tags']             = $this->taglink($tag, $query->article_type, $query->pub_type);
        }

        return $typeData;
    }

    function getPage_card_order($pid)
    {
        $key_cache = "getPage_card_order_" . $pid ."_". time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->from('eria_page_card');
                $this->db->where('eria_page_card.number!=', 0);
                $this->db->where('eria_page_card.ptype', $pid);
                $this->db->join('eria_card', 'eria_card.c_id = eria_page_card.card', 'left');
                $this->db->order_by('eria_page_card.number', 'ASC');
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

    function getArticle_card_order($aid)
    {
        $this->db->select('*');
        $this->db->from('eria_article_card');
        $this->db->where('eria_article_card.number!=', 0);
        $this->db->where('eria_article_card.ptype', $aid);
        $this->db->where('eria_card.published', 1);
        $this->db->join('eria_card', 'eria_card.c_id = eria_article_card.card', 'left');
        $this->db->order_by('eria_article_card.number', 'ASC');
        $queryT = $this->db->get();
        return $queryT->result();
    }

    function getAllCardsByActive()
    {
        $this->db->select('*');
        $this->db->from('eria_card');
        $this->db->where('eria_card.published', 1);
        $this->db->order_by('eria_card.c_id', 'DESC');
        $results = $this->db->get();
        $data = $results->result();
        return $data;
    }

    function getAllCardsRandomByActive($card_id)
    {
        $this->db->select('*');
        $this->db->from('eria_card_randoms');
        $this->db->where('eria_card_randoms.c_id <', 11);
        $this->db->where('eria_card_randoms.published', 1);
        $this->db->where('eria_card_randoms.is_delete', 2);
        $this->db->where_in('eria_card_randoms.c_id', $card_id);
        $this->db->where('eria_card_randoms.sort_by', 'files');
        $this->db->order_by('eria_card_randoms.sorted', 'ASC');
        
        $results = $this->db->get();
        $data = $results->result();
        
        return $data;
    }

    function getAllCardsPublicationRandomByActive($card_id)
    {
        $this->db->select('*');
        $this->db->from('eria_card');
        $this->db->where('eria_card.published', 1);
        $this->db->where_in('eria_card.c_id', $card_id);
        // $this->db->order_by('eria_card.c_id', 'DESC');
        
        $results = $this->db->get();
        $data = $results->result();
        
        return $data;
    }

    function getCountriesAsean($limit)
    {
        try {
            
            $this->db->select('countries.*');
            $this->db->limit($limit);
            // $this->db->order_by('countries.venue','ASC');
            $query = $this->db->get('article_venues as countries');
            $data = $query->result();
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_new_searchCat_article_asean($type, $start, $limit, $ath, $author, $country, $key, $ty)
    {
        $this->db->distinct('articles.title');
        $this->db->select('articles.*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('articles', 'articles.article_id = article_categories.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');

        if ($key) {
            $this->db->like('articles.title', $key);
            $this->db->or_like('articles.content', $key);
        }

        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'publications');
        if (!empty($type)) {

            if ($type > 1) {
                foreach ($type as $typeuri) {
                    $uri[] = str_replace(array(' ', ':-'), '-', strtolower($typeuri));
                }
                
                $this->db->where_in('categories.uri', $uri);
            } else {
                $this->db->where('categories.uri', $uri);
            }
            
        }

        if ($ath) {
            $this->db->where_in('articles.sub_experts', $ath);
        }

        
        if ($author['id'] != 'all') {
            $this->db->join('article_persons', 'article_persons.article_id = articles.article_id', 'left');
            
            if (!empty($author['name'])) {
                foreach ($author['name'] as $value) {
                    $this->db->like('articles.author', $value);
                    $this->db->or_like('articles.editor', $value);
                }
            }
            
            $this->db->where_in('ec_id', $author['id']);
        }

        if ($country != 'all') {
            foreach ($country as $value) {
                $this->db->like('articles.venue', $value);
            }
            
        }

        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit($limit, $start);

        $queryT = $this->db->get();

        $data = $queryT->result();

        return $data;
    }

    function get_new_searchCat_article($type, $start, $limit, $ath, $author, $country, $key, $ty)
    {
        $this->db->distinct('articles.title');
        $this->db->select('articles.*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('articles', 'articles.article_id = article_categories.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');

        $this->db->where('articles.article_type', 'publications');
        $this->db->where('articles.published', 1);

        if ($key) {
            $this->db->like('articles.title', $key);
            $this->db->or_like('articles.content', $key);
        }

        if ($type != 'all') {

            if ($type > 1) {
                
                foreach ($type as $typeuri) {
                    $uri[] = str_replace(array(' ', ':-'), '-', strtolower($typeuri));
                }
                
                $this->db->where_in('categories.uri', $uri);
            } else {
                $uri = $type;
                $this->db->where('categories.uri', $uri);
            }
            
        }

        if ($ath) {
            $this->db->where_in('articles.sub_experts', $ath);
        }

        
        if ($author['id'] != 'all') {
            $this->db->join('article_persons', 'article_persons.article_id = articles.article_id', 'left');
            
            if (!empty($author['name'])) {
                foreach ($author['name'] as $value) {
                    $this->db->like('articles.author', $value);
                    $this->db->or_like('articles.editor', $value);
                }
            }
            
            $this->db->where_in('ec_id', $author['id']);
        }

        if ($country != 'all') {
            $this->db->where_in('articles.venue', $country);
        }

        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit($limit, $start);

        $queryT = $this->db->get();

        $data = $queryT->result();

        return $data;
    }

    function get_searchCat_article($type, $start, $limit, $ath, $author, $country, $key, $ty)
    {
        $this->db->select('articles.*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('articles', 'articles.article_id = article_categories.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'articles');

        if ($type != 'all') {
            $this->db->where_in('categories.uri', $type);
        }

        if ($ath) {
            $this->db->where_in('articles.sub_experts', $ath);
        }

        if ($author != 'all') {
            $this->db->join('article_persons', 'article_persons.article_id = articles.article_id', 'left');
            $this->db->where_in('ec_id', $author);
        }

        if ($country != 'all') {
            $this->db->where_in('articles.venue', $country);
        }

        if ($key) {

            $this->db->like('articles.title', $key);
            $this->db->like('articles.content', $key);
        }

        $this->db->order_by('article_id', 'DESC');

        $this->db->limit($limit, $start);
        $queryT = $this->db->get();
        return $queryT->result();
    }

    function getCountry_article($country)
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        $this->db->like('articles.venue', $country);

        $queryT = $this->db->get();
        return $queryT->result();
    }

    function multimedia_search($key, $topic, $cat, $subcat, $start, $limit)
    {
        $this->db->select('articles.*,eria_expert_categories.category');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'multimedia');
        $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');

        if (isset($key) AND !empty($key)) {
            $this->db->like('title', $key, 'both');
            // $this->db->or_like('content', $key, 'both');
        }

        if ($topic != 'all') {

            foreach ($topic as $value) {
                if ($value != 'on') {
                    $topic_id[] = $value;
                }
            }

            //$topic_id = implode("','", $topic);

            $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
            $this->db->where_in('topic_id', $topic_id);
        }

        if ($cat !== 'all') {
            $this->db->where('sub_experts', $cat);
        }

        if ($subcat != 'Subcategory') {
            $this->db->where('sub_dep_experts', $subcat);
        }

        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        $this->db->order_by("posted_date", "desc");
        $this->db->from('articles as articles');
        $query = $this->db->get()->result();
        return $query;
    }

    function getArticleImageByArticleId($article_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('article_id', $article_id);
            $query = $this->db->get('article_images');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getTopicsByArticleId($article_id)
    {
        $this->db->select('*');
        $this->db->from('article_topics');
        $this->db->where('article_topics.article_id', $article_id);
        $this->db->where('categories.published', 1);
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'inner');

        $query = $this->db->get();

        $result = $query->result();

        return $result;
    }

    function getPage_multiallarticle_search($key, $topic, $cat, $start, $limit)
    {
        $this->db->select('*');
        $this->db->from('articles as articles');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'multimedia');

        if ($topic != 'Topics') {
            $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
            $this->db->where('topic_id', $topic);
        }
        if ($cat != 'Catogery') {
            $this->db->where('sub_experts', $cat);
        }

        if ($key) {
            $this->db->like('title', $key, 'both');
            // $this->db->or_like('content', $key, 'both');
        }

        $this->db->limit($limit, $start);

        $query = $this->db->get()->result();
        return $query;
    }

    function searchCombine_count($kword, $sdate, $fdate, $ptop, $country, $research, $sort)
    {
        $time_ = time();
        $key_cache = "searchCombine_count_" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            $kword = trim($kword);

            $num = 0;
            $d = '';
            $e = '';
            $j = '';
            $ty = '';
            $k = '';
            $jj = '';
            $t = '';
            $tt = '';
            $c = '';
            $l = '';

            if ($sdate) {
                //$d=" posted_date BETWEEN '".$sdate. "' AND '".$fdate."' AND" ;

                $d = "posted_date >= '" . $sdate . "'AND";
            }

            if ($fdate) {

                $e = "posted_date <= '" . $fdate . "'AND";
            }

            if ($ptop) {
                $g = implode("','", $ptop);
                $j = "JOIN article_categories ON articles.article_id = article_categories.article_id";
                $jj = "article_categories.category_id IN ('" . $g . "') AND ";
            }

            if ($research) {
                $g = implode("','", $research);
                $t = "JOIN article_topics ON articles.article_id = article_topics.article_id";
                $tt = "article_topics.topic_id IN ('" . $g . "') AND ";
            }

            if ($country) {
                $g = implode("','", $country);
                $c = "articles.venue IN ('" . $g . "') AND ";
            }

            if ($sort == 'rel') {
                //$od="(CONCAT(title, '', content)='$kword') DESC";

                // $od="title('$kword') ASC";
                // $od="article_id  ASC";

                $od = "title='$kword'  DESC";

                // $od="IF(CONCAT(title, ' ', content) LIKE '%$kword%', 0, 1)";

                if ($kword != '') {

                    $this->db->select('articles.article_id,uri,title,content,posted_date,article_type');

                    $keys = explode(' ', $kword);

                    foreach ($keys as $keys) {

                        $this->db->like('articles.content', $keys);
                    }
                    if ($sdate) {
                        $this->db->where('posted_date >=', $sdate);
                    }
                    if ($fdate) {
                        $this->db->where('posted_date <=', $fdate);
                    }
                    if ($ptop) {
                        $g = implode("','", $ptop);
                        $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                        $this->db->where_in('category_id', $g);
                    }
                    if ($research) {
                        $g = implode("','", $research);

                        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                        $this->db->where_in('topic_id', $g);
                    }
                    if ($country) {
                        $g = implode("','", $country);
                        $this->db->where_in('venue', $g);
                    }

                    $query = $this->db->get('articles');
                    $lastQuery = $query;
                    $num = $num + $lastQuery->num_rows();

                    $k = "title LIKE '$kword%' AND";

                    $l = "content LIKE '$kword%' AND";
                }

                $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od ";

                $queryT1 = $this->db->query($sql);

                $num = $num + $queryT1->num_rows();

                $newPub = $this->get_person($kword, $sdate, $fdate);

                $num = $num + count($newPub);

                $sqlNew = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $l $c published = 1 GROUP BY article_id ORDER BY $od ";

                $queryT2 = $this->db->query($sqlNew);

                $num = $num + $queryT2->num_rows();
            } else {
                if ($kword != '') {
                    //$k= "title LIKE '$kword%' AND";
                    // $l= "content LIKE '$kword%' AND";
                    $this->db->select('articles.article_id,uri,title,content,posted_date,article_type');
                    $keys = explode(' ', $kword);

                    foreach ($keys as $keys) {
                        $this->db->like('articles.content', $keys);
                    }

                    if ($sdate) {
                        $this->db->where('posted_date >=', $sdate);
                    }

                    if ($fdate) {
                        $this->db->where('posted_date <=', $fdate);
                    }

                    if ($ptop) {
                        $g = implode("','", $ptop);
                        $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                        $this->db->where_in('category_id', $g);
                    }

                    if ($research) {
                        $g = implode("','", $research);

                        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                        $this->db->where_in('topic_id', $g);
                    }

                    if ($country) {
                        $g = implode("','", $country);
                        $this->db->where_in('venue', $g);
                    }

                    $query = $this->db->get('articles');
                    $lastQuery = $query;
                    $num = $num + $lastQuery->num_rows();
                    $k = "CONCAT(title, ' ', content) LIKE '%$kword%' AND";
                }

                if ($sort == 'as') {
                    $od = "posted_date  ASC";
                    $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od";
                    $queryT1 = $this->db->query($sql);
                    $num = $num + $queryT1->num_rows();
                    $newPub = $this->get_person($kword, $sdate, $fdate);
                    $num = $num + count($newPub);
                } else {
                    $od = "posted_date  DESC";
                    $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od";
                    $queryT1 = $this->db->query($sql);
                    $num = $num + $queryT1->num_rows();
                    $newPub = $this->get_person($kword, $sdate, $fdate);
                    $num = $num + count($newPub);
                }
            }

            $results = $num;

            $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
            $this->InstanceCache->save($CachedString);
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function searchGeneral($kword, $sdate, $fdate, $ptop, $country, $research, $limit, $start, $sort)
    {
        $this->db->select('articles.article_id,uri,title,content,posted_date,article_type');

        if ($ptop) {
                $g = implode("','", $ptop);
                // $j = "JOIN article_categories ON articles.article_id = article_categories.article_id";
                $jj = "articles.article_type IN ('" . $g . "') AND ";
                //$g = implode("','", $ptop);
                //   $this->db->where_in('article_type', $g);     
            }
    }

    function searchCombine($kword, $sdate, $fdate, $ptop, $country, $research, $limit, $start, $sort)
    {
        $time_ = time();
        $key_cache = "searchCombine_" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            $out = array();
            $limit = 10;
            $kword = trim($kword);

            $d = '';
            $e = '';
            $j = '';
            $ty = '';
            $k = '';
            $jj = '';
            $t = '';
            $tt = '';
            $c = '';
            $l = '';

            /*$this->db->select('*');
            $this->db->from('articles');
            $this->db->where('published', 1);

            if($kword) {

            $this->db->like('title', $kword,'before');
                $this->db->or_like('content', $kword,'before');

            }*/

            if ($ptop) {
                $g = implode("','", $ptop);
                // $j = "JOIN article_categories ON articles.article_id = article_categories.article_id";
                $jj = "articles.article_type IN ('" . $g . "') AND ";
                //$g = implode("','", $ptop);
                //   $this->db->where_in('article_type', $g);     
            }

            if ($research) {
                $g = implode("','", $research);
                $t = "JOIN article_topics ON articles.article_id = article_topics.article_id";
                $tt = "article_topics.topic_id IN ('" . $g . "') AND ";
            }

            if ($country) {
                $g = implode("','", $country);
                $c = "articles.venue IN ('" . $g . "') AND ";
            }

            if ($sdate) {
                //$d=" posted_date BETWEEN '".$sdate. "' AND '".$fdate."' AND" ;
                $d = "posted_date >= '" . $sdate . "'AND";
            }

            if ($fdate) {
                $e = "posted_date <= '" . $fdate . "'AND";
            }

            if ($sort == 'rel') {
                //$od="(CONCAT(title, '', content)='$kword') DESC";
                // $od="title('$kword') ASC";
                // $od="article_id  ASC";

                $od = "title='$kword' DESC";

                // $od="IF(CONCAT(title, ' ', content) LIKE '%$kword%', 0, 1)";

                if ($kword != '') {

                    $this->db->select('articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts');

                    $keys = explode(' ', $kword);

                    foreach ($keys as $keys) {
                        $this->db->like('articles.content', $keys);
                    }

                    if ($sdate) {
                        $this->db->where('posted_date >=', $sdate);
                    }

                    if ($fdate) {
                        $this->db->where('posted_date <=', $fdate);
                    }

                    if ($ptop) {
                        // $g = implode("','", $ptop);
                        // $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                        //  $this->db->where_in('category_id', $g);

                        $g = implode("','", $ptop);
                        $this->db->where_in('article_type', $g);
                    }

                    if ($research) {
                        $g = implode("','", $research);

                        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                        $this->db->where_in('topic_id', $g);
                    }

                    if ($country) {
                        $g = implode("','", $country);
                        $this->db->where_in('venue', $g);
                    }

                    $this->db->order_by('articles.article_id', 'DESC');

                    $query = $this->db->get('articles');
                    $lastQuery = $query->result();

                    $k = "title LIKE '%$kword%' AND";
                    $l = "content LIKE '%$kword%' AND";
                }

                $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts FROM articles $j $t WHERE $jj $tt $k $l $c $d $e published = 1 GROUP BY article_id ORDER BY $od ";
                $queryT1 = $this->db->query($sql);
                $fout = $queryT1->result();

                if (count($fout) == 0) {
                    $split = str_replace(' ', ',', trim($kword));
                    $kwords = explode(
                        ',',
                        $split
                    );

                    if (count($kwords) > 1) {
                        foreach ($kwords as $kword_) {
                            $data_sql[] = "CONCAT(title, ' ', content) LIKE '%$kword_%'";
                        }

                        $k = implode(" OR ", $data_sql);

                        $and = "AND";
                    } else {
                        $and = '';
                    }

                    $query_sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts FROM articles $j $t WHERE $jj $tt $d $e $k $and $c published = 1 GROUP BY article_id ORDER BY $od";

                    $query_result = $this->db->query($query_sql);
                    $fout = $query_result->result();
                }

                $x = 0;
                //var_dump($sql);
                foreach ($fout as $bid => $bquery) {
                    $duplicate = $this->duplicate_check($out,
                        $bquery->uri
                    );
                    if ($duplicate) {
                        $out[$bid]['uri'] = $bquery->uri;
                        $out[$bid]['title'] = $bquery->title;
                        $out[$bid]['content'] = $bquery->content;
                        $out[$bid]['posted_date'] = $bquery->posted_date;
                        $out[$bid]['article_type'] = $bquery->article_type;
                        $x++;
                    }
                }

                $newPub = $this->get_person($kword, $sdate, $fdate);

                foreach ($newPub as $bid => $bquery) {

                    $duplicate = $this->duplicate_check($out, $bquery->uri);
                    if ($duplicate) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        $x++;
                    }
                }

                $sqlNew = "SELECT articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts FROM articles $j $t WHERE $jj $tt $d $e $l $c published = 1 GROUP BY article_id ORDER BY $od ";

                $queryT2 = $this->db->query($sqlNew);

                $sout = $queryT2->result();

                foreach ($sout as $bid => $bquery) {

                    $duplicate = $this->duplicate_check($out, $bquery->uri);

                    if ($duplicate) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        $x++;
                    }
                }

                if (isset($lastQuery)) {
                    foreach ($lastQuery as $bid => $bquery) {

                        $duplicate = $this->duplicate_check($out, $bquery->uri);
                        if ($duplicate) {
                            $out[$x]['uri'] = $bquery->uri;
                            $out[$x]['title'] = $bquery->title;
                            $out[$x]['content'] = $bquery->content;
                            $out[$x]['posted_date'] = $bquery->posted_date;
                            $out[$x]['article_type'] = $bquery->article_type;
                            $x++;
                        }
                    }
                }

                $out = array_slice($out, $start, 10);
            } else {
                if ($kword != '') {

                    $k = "title LIKE '$kword%' AND";

                    $l = "content LIKE '$kword%' AND";

                    $this->db->select('articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts');

                    $keys = explode(' ', $kword);

                    foreach ($keys as $keys) {
                        $this->db->where_in('articles.title', $keys);
                        $this->db->where_in('articles.content', $keys);
                    }

                    if ($sdate) {
                        $this->db->where('posted_date >=', $sdate);
                    }

                    if ($fdate) {
                        $this->db->where('posted_date <=', $fdate);
                    }

                    if ($ptop) {
                        // $g = implode("','", $ptop);
                        // $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                        // $this->db->where_in('category_id', $g); 
                        $g = implode("','", $ptop);
                        $this->db->where_in('article_type', $g);
                    }

                    if ($research) {
                        $g = implode("','", $research);

                        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                        $this->db->where_in('topic_id', $g);
                    }

                    if ($country) {
                        $g = implode("','", $country);
                        $this->db->where_in('venue', $g);
                    }

                    $query = $this->db->get('articles');
                    $lastQuery = $query->result();
                    $k = "CONCAT(title, ' ', content) LIKE '%$kword%' AND";
                }

                if ($sort == 'as') {
                    $od = "posted_date ASC";

                    $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od";

                    $queryT1 = $this->db->query($sql);

                    $fout = $queryT1->result();

                    if (count($fout) == 0) {
                        $split = str_replace(' ', ',', trim($kword));
                        $kwords = explode(',', $split);

                        if (count($kwords) > 1) {
                            foreach ($kwords as $kword_) {
                                $data_sql[] = "CONCAT(title, ' ', content) LIKE '%$kword_%'";
                            }

                            $k = implode(" OR ", $data_sql);

                            $and = "AND";
                        } else {
                            $and = '';
                        }

                        $query_sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts FROM articles $j $t WHERE $jj $tt $d $e $k $and $c published = 1 GROUP BY article_id ORDER BY $od";

                        $query_result = $this->db->query($query_sql);
                        $fout = $query_result->result();
                    }

                    $x = 0;
                    foreach ($fout as $bid => $bquery) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        $out[$x]['sub_experts'] = $bquery->sub_experts;
                        $out[$x]['sub_dep_experts'] = $bquery->sub_dep_experts;

                        $x++;
                    }

                    $newPub = $this->get_person($kword, $sdate, $fdate);

                    foreach ($newPub as $bid => $bquery) {
                        $duplicate = $this->duplicate_check($out, $bquery->uri);
                        if ($duplicate) {
                            $out[$x]['uri'] = $bquery->uri;
                            $out[$x]['title'] = $bquery->title;
                            $out[$x]['content'] = $bquery->content;
                            $out[$x]['posted_date'] = $bquery->posted_date;
                            $out[$x]['article_type'] = $bquery->article_type;
                            
                            $out[$x]['sub_experts'] = $bquery->sub_experts;
                            $out[$x]['sub_dep_experts'] = $bquery->sub_dep_experts;
                            $x++;
                        }
                    }

                    if (isset($lastQuery)) {
                        foreach ($lastQuery as $bid => $bquery) {
                            $duplicate = $this->duplicate_check($out, $bquery->uri);

                            if ($duplicate) {
                                $out[$x]['uri'] = $bquery->uri;
                                $out[$x]['title'] = $bquery->title;
                                $out[$x]['content'] = $bquery->content;
                                $out[$x]['posted_date'] = $bquery->posted_date;
                                $out[$x]['article_type'] = $bquery->article_type;
                                
                                $out[$x]['sub_experts'] = $bquery->sub_experts;
                                $out[$x]['sub_dep_experts'] = $bquery->sub_dep_experts;
                                $x++;
                            }
                        }
                    }

                    $out = array_slice($out, $start, 10);

                    function date_compare($a, $b)
                    {
                        $t1 = strtotime($a['posted_date']);
                        $t2 = strtotime($b['posted_date']);
                        return $t1  >=  $t2;
                    }

                    usort($out, 'date_compare');
                } else {
                    // $od = "posted_date DESC";
                    $od = "title='$kword' DESC";

                    $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od";

                    $queryT1 = $this->db->query($sql);
                    $fout = $queryT1->result();

                    if (count($fout) == 0) {
                        $split = str_replace(' ', ',', trim($kword));
                        $kwords = explode(',', $split);

                        if (count($kwords) > 1) {
                            foreach ($kwords as $kword_) {
                                $data_sql[] = "CONCAT(title, ' ', content) LIKE '%$kword_%'";
                            }

                            $k = implode(" OR ", $data_sql);

                            $and = "AND";
                        } else {
                            $and = '';
                        }

                        $query_sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type,sub_experts,sub_dep_experts FROM articles $j $t WHERE $jj $tt $d $e $k $and $c published = 1 GROUP BY article_id ORDER BY $od";

                        $query_result = $this->db->query($query_sql);
                        $fout = $query_result->result();
                    }

                    $x = 0;

                    foreach ($fout as $bid => $bquery) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        
                        $out[$x]['sub_experts'] = $bquery->sub_experts;
                        $out[$x]['sub_dep_experts'] = $bquery->sub_dep_experts;
                        $x++;
                    }

                    $newPub = $this->get_person($kword, $sdate, $fdate);

                    foreach ($newPub as $bid => $bquery) {
                        $duplicate = $this->duplicate_check($out, $bquery->uri);

                        if ($duplicate) {
                            $out[$x]['uri'] = $bquery->uri;
                            $out[$x]['title'] = $bquery->title;
                            $out[$x]['content'] = $bquery->content;
                            $out[$x]['posted_date'] = $bquery->posted_date;
                            $out[$x]['article_type'] = $bquery->article_type;
    
                            $out[$x]['sub_experts'] = $bquery->sub_experts;
                            $out[$x]['sub_dep_experts'] = $bquery->sub_dep_experts;
                            $x++;
                        }
                    }

                    if (isset($lastQuery)) {
                        foreach ($lastQuery as $bid => $bquery) {
                            $duplicate = $this->duplicate_check($out, $bquery->uri);
                            if ($duplicate) {
                                $out[$x]['uri'] = $bquery->uri;
                                $out[$x]['title'] = $bquery->title;
                                $out[$x]['content'] = $bquery->content;
                                $out[$x]['posted_date'] = $bquery->posted_date;
                                $out[$x]['article_type'] = $bquery->article_type;

                                $out[$x]['sub_experts'] = $bquery->sub_experts;
                                $out[$x]['sub_dep_experts'] = $bquery->sub_dep_experts;
                                $x++;
                            }
                        }
                    }

                    $out = array_slice($out, $start, 10);

                    function date_compare($a, $b)
                    {
                        $t1 = strtotime($a['posted_date']);
                        $t2 = strtotime($b['posted_date']);
                        return $t1 <= $t2;
                    }

                    usort($out, 'date_compare');
                }
            }

            $results = $out;

            $CachedString->set($results)->expiresAfter($this->timeExpired()); // 1 hour = 3600 seconds
            $this->InstanceCache->save($CachedString);
        } else {
            $results = $CachedString->get();
        }

        return $results;
    }

    function _searchCombine($kword, $sdate, $fdate, $ptop, $country, $research, $limit, $start, $sort)
    {

        $out = array();

        $limit = 10;

        $kword = trim($kword);

        $d = '';
        $e = '';
        $j = '';
        $ty = '';
        $k = '';
        $jj = '';
        $t = '';
        $tt = '';
        $c = '';
        $l = '';
        /*$this->db->select('*');
        $this->db->from('articles');
        $this->db->where('published', 1);

        if($kword) {

           $this->db->like('title', $kword,'before');
            $this->db->or_like('content', $kword,'before');

        }*/
        if ($ptop) {
            $g = implode("','", $ptop);
            $j = "JOIN article_categories ON articles.article_id = article_categories.article_id";
            $jj = "article_categories.category_id IN ('" . $g . "') AND ";
        }

        if ($research) {
            $g = implode("','", $research);
            $t = "JOIN article_topics ON articles.article_id = article_topics.article_id";
            $tt = "article_topics.topic_id IN ('" . $g . "') AND ";
        }

        if ($country) {
            $g = implode("','", $country);
            $c = "articles.venue IN ('" . $g . "') AND ";
        }

        if ($sdate) {
            //$d=" posted_date BETWEEN '".$sdate. "' AND '".$fdate."' AND" ;

            $d = "posted_date >= '" . $sdate . "'AND";
        }

        if ($fdate) {

            $e = "posted_date <= '" . $fdate . "'AND";
        }

        if ($sort == 'rel') {
            //$od="(CONCAT(title, '', content)='$kword') DESC";
            // $od="title('$kword') ASC";
            // $od="article_id  ASC";
            $od = "title='$kword'  DESC";
            // $od="IF(CONCAT(title, ' ', content) LIKE '%$kword%', 0, 1)";

            if ($kword != '') {
                $this->db->select('articles.article_id,uri,title,content,posted_date,article_type');
                $keys = explode(' ', $kword);
                foreach ($keys as $keys) {
                    $this->db->like('articles.content', $keys);
                }

                if ($sdate) {
                    $this->db->where('posted_date >=', $sdate);
                }

                if ($fdate) {
                    $this->db->where('posted_date <=', $fdate);
                }

                if ($ptop) {
                    $g = implode("','", $ptop);
                    $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                    $this->db->where_in('category_id', $g);
                }

                if ($research) {
                    $g = implode("','", $research);

                    $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                    $this->db->where_in('topic_id', $g);
                }

                if ($country) {
                    $g = implode("','", $country);
                    $this->db->where_in('venue', $g);
                }

                $this->db->order_by('articles.article_id', 'DESC');

                $query = $this->db->get('articles');
                $lastQuery = $query->result();
                $k = "title LIKE '%$kword%' AND";
                $l = "content LIKE '%$kword%' AND";
            }

            $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $k $l $c $d $e published = 1 GROUP BY article_id ORDER BY $od ";
            $queryT1 = $this->db->query($sql);
            $fout = $queryT1->result();
            $x = 0;

            foreach ($fout as $bid => $bquery) {
                $duplicate = $this->duplicate_check($out, $bquery->uri);
                if ($duplicate) {
                    $out[$bid]['uri'] = $bquery->uri;
                    $out[$bid]['title'] = $bquery->title;
                    $out[$bid]['content'] = $bquery->content;
                    $out[$bid]['posted_date'] = $bquery->posted_date;
                    $out[$bid]['article_type'] = $bquery->article_type;
                    $x++;
                }
            }

            $newPub = $this->get_person($kword, $sdate, $fdate);

            foreach ($newPub as $bid => $bquery) {

                $duplicate = $this->duplicate_check($out, $bquery->uri);
                if ($duplicate) {
                    $out[$x]['uri'] = $bquery->uri;
                    $out[$x]['title'] = $bquery->title;
                    $out[$x]['content'] = $bquery->content;
                    $out[$x]['posted_date'] = $bquery->posted_date;
                    $out[$x]['article_type'] = $bquery->article_type;
                    $x++;
                }
            }

            $sqlNew = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $l $c published = 1 GROUP BY article_id ORDER BY $od ";

            $queryT2 = $this->db->query($sqlNew);

            $sout = $queryT2->result();

            foreach ($sout as $bid => $bquery) {

                $duplicate = $this->duplicate_check($out, $bquery->uri);

                if ($duplicate) {
                    $out[$x]['uri'] = $bquery->uri;
                    $out[$x]['title'] = $bquery->title;
                    $out[$x]['content'] = $bquery->content;
                    $out[$x]['posted_date'] = $bquery->posted_date;
                    $out[$x]['article_type'] = $bquery->article_type;
                    $x++;
                }
            }

            if (isset($lastQuery)) {
                foreach ($lastQuery as $bid => $bquery) {

                    $duplicate = $this->duplicate_check($out, $bquery->uri);
                    if ($duplicate) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        $x++;
                    }
                }
            }

            $out = array_slice($out, $start, 10);
        } else {
            if ($kword != '') {
                //$k= "title LIKE '$kword%' AND";
                // $l= "content LIKE '$kword%' AND";
                $this->db->select('articles.article_id,uri,title,content,posted_date,article_type');
                $keys = explode(' ', $kword);

                foreach ($keys as $keys) {
                    //  $this->db->where_in('articles.content', $keys);
                }

                if ($sdate) {
                    $this->db->where('posted_date >=', $sdate);
                }

                if ($fdate) {
                    $this->db->where('posted_date <=', $fdate);
                }

                if ($ptop) {
                    $g = implode("','", $ptop);
                    $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                    $this->db->where_in('category_id', $g);
                }

                if ($research) {
                    $g = implode("','", $research);

                    $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                    $this->db->where_in('topic_id', $g);
                }

                if ($country) {
                    $g = implode("','", $country);
                    $this->db->where_in('venue', $g);
                }

                $query = $this->db->get('articles');
                $lastQuery = $query->result();
                $k = "CONCAT(title, ' ', content) LIKE '%$kword%' AND";
            }

            if ($sort == 'as') {
                $od = "posted_date  ASC";
                $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od";
                $queryT1 = $this->db->query($sql);
                $fout = $queryT1->result();
                $x = 0;
                foreach ($fout as $bid => $bquery) {
                    $out[$x]['uri'] = $bquery->uri;
                    $out[$x]['title'] = $bquery->title;
                    $out[$x]['content'] = $bquery->content;
                    $out[$x]['posted_date'] = $bquery->posted_date;
                    $out[$x]['article_type'] = $bquery->article_type;

                    $x++;
                }

                $newPub = $this->get_person($kword, $sdate, $fdate);

                foreach ($newPub as $bid => $bquery) {
                    $duplicate = $this->duplicate_check($out, $bquery->uri);
                    if ($duplicate) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        $x++;
                    }
                }

                if (isset($lastQuery)) {
                    foreach ($lastQuery as $bid => $bquery) {

                        $duplicate = $this->duplicate_check($out, $bquery->uri);
                        if ($duplicate) {
                            $out[$x]['uri'] = $bquery->uri;
                            $out[$x]['title'] = $bquery->title;
                            $out[$x]['content'] = $bquery->content;
                            $out[$x]['posted_date'] = $bquery->posted_date;
                            $out[$x]['article_type'] = $bquery->article_type;
                            $x++;
                        }
                    }
                }

                $out = array_slice($out, $start, 10);

                function date_compare($a, $b)
                {
                    $t1 = strtotime($a['posted_date']);
                    $t2 = strtotime($b['posted_date']);
                    return $t1  >=  $t2;
                }

                usort($out, 'date_compare');
            } else {
                $od = "posted_date  DESC";
                $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od";
                $queryT1 = $this->db->query($sql);
                $fout = $queryT1->result();
                $x = 0;

                foreach ($fout as $bid => $bquery) {
                    $out[$x]['uri'] = $bquery->uri;
                    $out[$x]['title'] = $bquery->title;
                    $out[$x]['content'] = $bquery->content;
                    $out[$x]['posted_date'] = $bquery->posted_date;
                    $out[$x]['article_type'] = $bquery->article_type;
                    $x++;
                }

                $newPub = $this->get_person($kword, $sdate, $fdate);

                foreach ($newPub as $bid => $bquery) {
                    $duplicate = $this->duplicate_check($out, $bquery->uri);
                    if ($duplicate) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        $x++;
                    }
                }

                if (isset($lastQuery)) {
                    foreach ($lastQuery as $bid => $bquery) {
                        $duplicate = $this->duplicate_check($out, $bquery->uri);
                        if ($duplicate) {
                            $out[$x]['uri'] = $bquery->uri;
                            $out[$x]['title'] = $bquery->title;
                            $out[$x]['content'] = $bquery->content;
                            $out[$x]['posted_date'] = $bquery->posted_date;
                            $out[$x]['article_type'] = $bquery->article_type;
                            $x++;
                        }
                    }
                }

                $out = array_slice($out, $start, 10);

                function date_compare($a, $b)
                {
                    $t1 = strtotime($a['posted_date']);
                    $t2 = strtotime($b['posted_date']);
                    return $t1  <=  $t2;
                }

                usort($out, 'date_compare');
            }
        }
        // $sql="SELECT articles.* FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY (title='$kword') DESC, LENGTH (title) LIMIT $start, $limit";
        return $out;
        /*
        $this->db->select('*');
        $this->db->from('articles as articles');
        $this->db->where('articles.published', 1);
        if($ptop)
        {
            $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
            $this->db->where_in('category_id', $ptop);
        }
        if($research)
        {
            $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
            $this->db->where_in('topic_id', $research);
        }
        if($country)
        {
            $this->db->where_in('articles.venue', $country);
        }
        if($sdate)
        {
            $this->db->where('articles.posted_date >=', $sdate);
        }
        if($fdate)
        {
            $this->db->where('articles.posted_date <=', $fdate);
        }
        if($kword)
        {
           // $this->db->like('title', $kword, 'both');
           // $this->db->like('content', $kword, 'both');
        }
        $this->db->limit($limit,$start);
        $query = $this->db->get()->result();
        return $query;*/
        //  $queryT1=$this->db->query("SELECT articles.* FROM articles $j WHERE $d $e title LIKE '$kword%' OR content LIKE '$kword%' AND published = 1 GROUP BY article_id ORDER BY posted_date  DESC LIMIT $start, $limit");
        //if($queryT->num_rows()==0)
        // {
            //   $queryT2=$this->db->query("SELECT articles.* FROM articles $j WHERE $d $e title LIKE '%$kword' OR content LIKE '$kword%' AND published = 1 GROUP BY article_id ORDER BY posted_date DESC LIMIT $start, $limit");
        // }
        // if($queryT->num_rows()==0)
        // {
            //  $queryT3=$this->db->query("SELECT articles.* FROM articles $j WHERE $d $e title LIKE '%$kword%' OR content LIKE '%$kword%' AND published = 1 GROUP BY article_id ORDER BY posted_date DESC LIMIT $start, $limit");
        // }
        // return $queryT1->result();
        //}
    }

    function search($kword, $sdate, $fdate, $ptop, $country, $research, $limit, $start, $sort)
    {
        $out = array();
        $limit = 10;
        $kword = trim($kword);
        $d = '';
        $e = '';
        $j = '';
        $ty = '';
        $k = '';
        $jj = '';
        $t = '';
        $tt = '';
        $c = '';
        $l = '';

        /*$this->db->select('*');
        $this->db->from('articles');
        $this->db->where('published', 1);
        if($kword) {
           $this->db->like('title', $kword,'before');
            $this->db->or_like('content', $kword,'before');
        }*/

        if ($sdate) {
            //$d=" posted_date BETWEEN '".$sdate. "' AND '".$fdate."' AND" ;
            $d = "posted_date >= '" . $sdate . "'AND";
        }

        if ($fdate) {

            $e = "posted_date <= '" . $fdate . "'AND";
        }

        if ($ptop) {
            $g = implode("','", $ptop);
            $j = "JOIN article_categories ON articles.article_id = article_categories.article_id";
            $jj = "article_categories.category_id IN ('" . $g . "') AND ";
        }

        if ($research) {
            $g = implode("','", $research);
            $t = "JOIN article_topics ON articles.article_id = article_topics.article_id";
            $tt = "article_topics.topic_id IN ('" . $g . "') AND ";
        }

        if ($country) {
            $g = implode("','", $country);
            $c = "articles.venue IN ('" . $g . "') AND ";
        }

        if ($sort == 'rel') {
            //$od="(CONCAT(title, '', content)='$kword') DESC";
            // $od="title('$kword') ASC";
            // $od="article_id  ASC";
            $od = "title='$kword'  DESC";
            // $od="IF(CONCAT(title, ' ', content) LIKE '%$kword%', 0, 1)";
            if ($kword != '') {
                $k = "title LIKE '$kword%' AND";
                $l = "content LIKE '$kword%' AND";
            }

            $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od ";
            $queryT1 = $this->db->query($sql);
            $fout = $queryT1->result();
            $x = 0;

            foreach ($fout as $bid => $bquery) {
                $out[$bid]['uri'] = $bquery->uri;
                $out[$bid]['title'] = $bquery->title;
                $out[$bid]['content'] = $bquery->content;
                $out[$bid]['posted_date'] = $bquery->posted_date;
                $out[$bid]['article_type'] = $bquery->article_type;
                $x++;
            }

            $newPub = $this->get_person($kword, $sdate, $fdate);

            foreach ($newPub as $bid => $bquery) {
                $duplicate = $this->duplicate_check($out, $bquery->uri);
                if ($duplicate) {
                    $out[$x]['uri'] = $bquery->uri;
                    $out[$x]['title'] = $bquery->title;
                    $out[$x]['content'] = $bquery->content;
                    $out[$x]['posted_date'] = $bquery->posted_date;
                    $out[$x]['article_type'] = $bquery->article_type;
                    $x++;
                }
            }

            $sqlNew = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $l $c published = 1 GROUP BY article_id ORDER BY $od ";
            $queryT2 = $this->db->query($sqlNew);
            $sout = $queryT2->result();

            foreach ($sout as $bid => $bquery) {
                $duplicate = $this->duplicate_check($out, $bquery->uri);

                if ($duplicate) {
                    $out[$x]['uri'] = $bquery->uri;
                    $out[$x]['title'] = $bquery->title;
                    $out[$x]['content'] = $bquery->content;
                    $out[$x]['posted_date'] = $bquery->posted_date;
                    $out[$x]['article_type'] = $bquery->article_type;
                    $x++;
                }
            }

            $out = array_slice($out, $start, 10);
        } else {
            if ($kword != '') {
                //$k= "title LIKE '$kword%' AND";
                // $l= "content LIKE '$kword%' AND";
                $k = "CONCAT(title, ' ', content) LIKE '%$kword%' AND";
            }

            if ($sort == 'as') {
                $od = "posted_date  ASC";
                $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od";
                $queryT1 = $this->db->query($sql);
                $fout = $queryT1->result();
                $x = 0;

                foreach ($fout as $bid => $bquery) {
                    $out[$x]['uri'] = $bquery->uri;
                    $out[$x]['title'] = $bquery->title;
                    $out[$x]['content'] = $bquery->content;
                    $out[$x]['posted_date'] = $bquery->posted_date;
                    $out[$x]['article_type'] = $bquery->article_type;

                    $x++;
                }

                $newPub = $this->get_person($kword, $sdate, $fdate);

                foreach ($newPub as $bid => $bquery) {
                    $duplicate = $this->duplicate_check($out, $bquery->uri);
                    if ($duplicate) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        $x++;
                    }
                }

                $out = array_slice($out, $start, 10);
            } else {
                $od = "posted_date  DESC";
                $sql = "SELECT articles.article_id,uri,title,content,posted_date,article_type FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY $od";
                $queryT1 = $this->db->query($sql);
                $fout = $queryT1->result();
                $x = 0;

                foreach ($fout as $bid => $bquery) {
                    $out[$x]['uri'] = $bquery->uri;
                    $out[$x]['title'] = $bquery->title;
                    $out[$x]['content'] = $bquery->content;
                    $out[$x]['posted_date'] = $bquery->posted_date;
                    $out[$x]['article_type'] = $bquery->article_type;
                    $x++;
                }

                $newPub = $this->get_person($kword, $sdate, $fdate);

                foreach ($newPub as $bid => $bquery) {
                    $duplicate = $this->duplicate_check($out, $bquery->uri);
                    if ($duplicate) {
                        $out[$x]['uri'] = $bquery->uri;
                        $out[$x]['title'] = $bquery->title;
                        $out[$x]['content'] = $bquery->content;
                        $out[$x]['posted_date'] = $bquery->posted_date;
                        $out[$x]['article_type'] = $bquery->article_type;
                        $x++;
                    }
                }
                $out = array_slice($out, $start, 10);
            }
        }
        // $sql="SELECT articles.* FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY (title='$kword') DESC, LENGTH (title) LIMIT $start, $limit";
        return $out;
        /*
        $this->db->select('*');
        $this->db->from('articles as articles');
        $this->db->where('articles.published', 1);
        if($ptop)
        {
            $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
            $this->db->where_in('category_id', $ptop);
        }
        if($research)
        {
            $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
            $this->db->where_in('topic_id', $research);
        }
        if($country)
        {
            $this->db->where_in('articles.venue', $country);
        }
        if($sdate)
        {
            $this->db->where('articles.posted_date >=', $sdate);
        }
        if($fdate)
        {
            $this->db->where('articles.posted_date <=', $fdate);
        }
        if($kword)
        {
           // $this->db->like('title', $kword, 'both');
           // $this->db->like('content', $kword, 'both');
        }
        $this->db->limit($limit,$start);
        $query = $this->db->get()->result();
        return $query;*/
        //  $queryT1=$this->db->query("SELECT articles.* FROM articles $j WHERE $d $e title LIKE '$kword%' OR content LIKE '$kword%' AND published = 1 GROUP BY article_id ORDER BY posted_date  DESC LIMIT $start, $limit");
        //if($queryT->num_rows()==0)
        // {
            //   $queryT2=$this->db->query("SELECT articles.* FROM articles $j WHERE $d $e title LIKE '%$kword' OR content LIKE '$kword%' AND published = 1 GROUP BY article_id ORDER BY posted_date DESC LIMIT $start, $limit");


        // }
        // if($queryT->num_rows()==0)
        // {
            //  $queryT3=$this->db->query("SELECT articles.* FROM articles $j WHERE $d $e title LIKE '%$kword%' OR content LIKE '%$kword%' AND published = 1 GROUP BY article_id ORDER BY posted_date DESC LIMIT $start, $limit");
        // }
        // return $queryT1->result();
        //}
    }

    function get_person($key, $sdate, $fdate)
    {
        $d = '';
        $e = '';
        $j = '';
        $ty = '';
        $k = '';
        $jj = '';
        $t = '';
        $tt = '';
        $c = '';
        $l = '';

        if ($sdate) {
            //$d=" posted_date BETWEEN '".$sdate. "' AND '".$fdate."' AND" ;
            $d = "a2.posted_date >= '" . $sdate . "'AND";
        }

        if ($fdate) {
            $e = "a2.posted_date <= '" . $fdate . "'AND";
        }

        $k = "CONCAT(a1.title, ' ', a1.content) LIKE '%$key%' AND";
        $t = "JOIN articles as a1 ON article_persons.ec_id = a1.article_id";
        $u = "JOIN articles as a2 ON article_persons.article_id = a2.article_id";
        $od = "a2.posted_date  ASC";
        $sql = "SELECT article_persons.article_id,a2.uri,a2.title,a2.content,a2.posted_date,a2.article_type, a2.sub_experts, a2.sub_dep_experts FROM article_persons $t $u WHERE $k $d $e a2.published = 1  ORDER BY $od";
        $queryT1 = $this->db->query($sql);
        $fout = $queryT1->result();

        return $fout;
    }

    function duplicate_check($array, $val)
    {
        foreach ($array as $a) {
            if ($a['uri'] == $val) {
                return false;
            }
        }

        return true;
    }

    public function getAllMemberGoverningBoards()
    {
        try {
            $this->db->select('*');
            $query = $this->db->get('members');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    public function getMemberBoardByID($article_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('published', '1');
            $this->db->where_in('article_id', $article_id);

            $query = $this->db->get('articles');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPeopleByMessageBoard($article_type)
    {
        try {
            $this->db->select('*');
            $this->db->where('article_type', $article_type);
            $this->db->where('published', 1);
            $query = $this->db->get('articles');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPeopleByArticleId($article_id)
    {
        try {
            
            $this->db->select('peoples.title as name_people');
            $this->db->where_in('peoples.article_id', $article_id);
            $this->db->where('peoples.published', 1);
            $query = $this->db->get('articles as peoples');

            $data = $query->result();
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getWeWorksWithcontent($article_type)
    {
        try {

            $this->db->select('*');
            $this->db->where('article_type', $article_type);
            $this->db->where('published', 1);
            $this->db->order_by("article_id", "desc");

            $query = $this->db->get('articles');
            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_Gboard_content($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('page_id', $id);
            $this->db->where('published', 1);
            $query = $this->db->get('pages');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_Gboard_down($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('page_id', $id);
            $query = $this->db->get('page_pdf');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_OG()
    {
        try {
            $this->db->select('*');

            $this->db->where('published', 1);
            $query = $this->db->get('organization_structure');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getDepartementByID($departement_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('id', $departement_id);
            $query = $this->db->get('eria_departement');
            return $query->result()[0];
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPeopleInOrganizationStructure($organization_structure_id)
    {
        try {
            $this->db->select('`organization_structure_people`.`people_id`, `articles`.`title`, `articles`.`major`, `articles`.`uri`');
            $this->db->where('organization_structure_id', $organization_structure_id);
            $this->db->join('articles', 'articles.article_id = organization_structure_people.people_id', 'inner');
            $this->db->order_by('organization_structure_people.sort', 'ASC');
            $result = $this->db->get('organization_structure_people');

            $data = $result->result();

            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllPeopleById($article_id)
    {
        try {
            $this->db->select('articles.*');
            $this->db->where_in('article_id', $article_id);
            $result = $this->db->get('articles');

            $data = $result->result();

            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllCategoryMultimedia($category)
    {
        try {
            $this->db->select('articles.*,eria_expert_categories.category');
            $this->db->where('article_type', 'multimedia');
            $this->db->where('parent', 'multimedia');
            $this->db->where('category', $category);
            $this->db->where('published', '1');
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->order_by('articles.posted_date', 'DESC');
            $query = $this->db->get('articles');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_unclassified_multimedia($sub_experts, $start, $limit)
    {
        try {
            $this->db->select('articles.*');
            $this->db->where('article_type', 'multimedia');
            $this->db->where('sub_experts', $sub_experts);
            $this->db->where('published', '1');
            $this->db->order_by('articles.posted_date', 'DESC');

            if ($limit != 0) {
                $this->db->limit($limit, $start);
            }

            $query = $this->db->get('articles');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_all_multimedia($category, $start, $limit)
    {
        try {
            $this->db->select('articles.*,eria_expert_categories.category');
            $this->db->where('article_type', 'multimedia');
            $this->db->where('parent', 'multimedia');
            $this->db->where('category', $category);
            $this->db->where('published', '1');
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->order_by('articles.posted_date', 'DESC');
            $this->db->limit($limit, $start);
            $query = $this->db->get('articles');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_multiallarticle($id, $start, $limit)
    {
        try {
            $this->db->select('articles.*,eria_expert_categories.category');
            $this->db->where('article_type', 'multimedia');
            $this->db->where('parent', 'multimedia');
            $this->db->where('category', $id);
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $this->db->limit($limit, $start);
            $query = $this->db->get('articles');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getCategoryByCategoryId($category_id)
    {
        $this->db->select('article_categories.article_id');
        $this->db->where_in('category_id', $category_id);
        $query = $this->db->get('article_categories');

        $data = $query->result();

        return $data;
    }

    function getCategoryByCategoryType($category_type)
    {
        $this->db->select('categories.category_id,categories.category_name, categories.uri');
        $this->db->where('published', 1);
        $this->db->where('category_type', $category_type);

        $query = $this->db->get('categories');
        $data = $query->result();

        return $data;
    }

    function getCategoryByUri($uri, $category_type)
    {
        $this->db->select('categories.*');
        $this->db->where('published', 1);
        $this->db->where_in('category_type', $category_type);
        $this->db->where('uri', $uri);
        $query = $this->db->get('categories');

        $data = $query->result();
        return $data;
    }

    function getTopicByID($topic_id)
    {
        $this->db->select('article_topics.article_id');
        $this->db->where('topic_id', $topic_id);
        $query = $this->db->get('article_topics');

        $data = $query->result();

        return $data;
    }

    function getRelatedArticleForProgrammesTopic($article_id, $start, $limit)
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->where_in('articles.article_id', $article_id);
        $this->db->where('articles.published', 1);
        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit($limit, $start);

        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }

    function get_pro_article($start, $limit, $region, $key, $sd, $ed)
    {
        $this->db->select('*');
        $this->db->from('articles as articles');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'articles');

        if ($region != 'all') {
            $this->db->where_in('articles.venue', $region);
        }

        if ($key) {
            $this->db->like('content', $key, 'both');
        }

        if ($sd) {
            $this->db->where('articles.posted_date>= ', $sd);
        }

        if ($ed) {
            $this->db->where('articles.posted_date<= ', $ed);
        }

        $this->db->order_by('article_id', 'DESC');
        $this->db->limit($limit, $start);

        $query = $this->db->get();
        return $query->result();
    }

    function get_subcatogery($id)
    {
        try {
            $this->db->select('eria_expert_categories.*');
            $this->db->where('parent', $id);
            $query = $this->db->get('eria_expert_categories');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllSubCategories($article_type_sub)
    {
        try {
            $this->db->select('eria_expert_sub_categories.*');
            $this->db->where('article_type_sub', $article_type_sub);
            $query = $this->db->get('eria_expert_sub_categories');

            $data = $query->result();

            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function nsearch($kword, $sdate, $fdate, $ptop, $country, $research)
    {
        $kword = trim($kword);
        $d = '';
        $e = '';
        $j = '';
        $ty = '';
        $k = '';
        $jj = '';
        $t = '';
        $tt = '';
        $c = '';

        if ($sdate) {
            $d = "posted_date >= '" . $sdate . "'AND";
        }

        if ($fdate) {
            $e = "posted_date <= '" . $fdate . "'AND";
        }

        if ($kword != '') {
            $k = "CONCAT(title, ' ', content) LIKE '%$kword%' AND";
        }

        if ($ptop) {
            $g = implode("','", $ptop);
            $j = "JOIN article_categories ON articles.article_id = article_categories.article_id";
            $jj = "article_categories.category_id IN ('" . $g . "') AND ";
        }

        if ($research) {
            $g = implode("','", $research);
            $t = "JOIN article_topics ON articles.article_id = article_topics.article_id";
            $tt = "article_topics.topic_id IN ('" . $g . "') AND ";
        }

        if ($country) {
            $g = implode("','", $country);
            $c = "articles.venue IN ('" . $g . "') AND ";
        }

        $sql = "SELECT articles.* FROM articles $j $t WHERE $jj $tt $d $e $k $c published = 1 GROUP BY article_id ORDER BY posted_date";
        $queryT1 = $this->db->query($sql);

        return $queryT1->num_rows();
    }

    function _search($kword, $sdate, $fdate, $ptop, $country)
    {
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->where('published', 1);

        if ($kword) {

            $this->db->like('title', $kword, 'before');
            $this->db->or_like('content', $kword, 'before');
        }

        if ($sdate) {
            $this->db->where('posted_date >=', $sdate);
        }

        if ($fdate) {
            $this->db->where('posted_date<=', $fdate);
        }

        if ($country) {
            $this->db->where_in('venue', $country);
        }
        // $queryT=$this->db->query("SELECT * FROM articles WHERE content LIKE '%$kword%'");
        $this->db->order_by('article_id', 'DESC');
        //$this->db->limit(10);

        $queryT = $this->db->get();
        return $queryT->result();
    }

    function getPage_content($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('page_id', $id);

            $query = $this->db->get('pages');

            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getMultimediaContent($article_type)
    {
        $key_cache = "getMultimedia_Page_" . $article_type . "_".time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('article_type', $article_type);
                $this->db->where('published', 1);
                $this->db->order_by('articles.posted_date', 'DESC');
                $query = $this->db->get('articles');

                $results = $query->result();

                $CachedString->set($results)->expiresAfter($this->timeExpired());
                $this->InstanceCache->save($CachedString);
            } catch (Exception $err) {
                return show_error($err->getMessage());
            }
        } else {
            $results = $CachedString->get();
        }

        return $results;

        
    }

    function getMultimediaLatest($article_type, $category)
    {
        $key_cache = "getMultimedia_latest_" . $article_type. "_". $category . "_".time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->from('articles');
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts');
                $this->db->where('articles.published', 1);
                $this->db->where('articles.article_type', $article_type);
                $this->db->where('eria_expert_categories.category', $category);
                $this->db->order_by('articles.posted_date', 'DESC');
                $this->db->limit(1);
                $query = $this->db->get();

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

    function getMultimedia($id, $limit)
    {
        $key_cache = "getMultimedia_" . $id . "_".time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->from('article_categories AS article_categories');
                $this->db->join('articles', 'articles.article_id = article_categories.article_id', 'left');
                $this->db->where('articles.published', 1);
                if ($limit) {
                }
                $this->db->where('article_categories.category_id', $id);
                $this->db->order_by('articles.article_id', 'DESC');
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

    function getExpert_su()
    {
        $this->db->distinct('sub_experts');
        $this->db->select('sub_experts,title as category,article_id');
        $this->db->from('articles AS articles');
        $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'experts');
        $this->db->where('eria_expert_categories.category', 'experts');
        $this->db->order_by('order_id', 'ASC');
        $queryT = $this->db->get();
        return $queryT->result();
    }

    function getTimeline()
    {
        $this->db->select('*');
        $this->db->from('eria_timeline');
        $queryT = $this->db->get();

        return $queryT->result();
    }

    function getCat($id)
    {
        $key_cache = "getCategoryResearch_" . $id . "_";
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('*');
                $this->db->where('published', 1);
                $this->db->where('uri', $id);
                $this->db->where('category_type', 'topics');

                $query = $this->db->get('categories');

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

    function get_pCat($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('published', 1);
            $this->db->where('uri', $id);
            $this->db->where('category_type', 'categories');
            $query = $this->db->get('categories');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllArticlesByNews()
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'news');
        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit(3);

        $query = $this->db->get();
        $results = $query->result();

        $data = array();

        foreach ($results as $aid => $result_) {
            $data[$aid]['title'] = $result_->title;
            $data[$aid]['content'] = (string)$result_->content;
            $data[$aid]['image_name'] = $result_->image_name;
            $data[$aid]['posted_date'] = date('j F Y', strtotime($result_->posted_date));
            $data[$aid]['uri'] = $result_->uri;
            $data[$aid]['cat'] = $this->get_articleCat($result_->article_id);
            $data[$aid]['tags'] = $this->tag_topic($result_->article_id);
        }

        return $data;
    }

    function countArticleInResearchPage($type, $uri)
    {
        $key_cache = "countArticleInResearchPage_" . $type . "_" . $uri . "_".time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->distinct();
                $this->db->select('count(*) as count_articles');
                $this->db->from('articles AS articles');
                $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
                $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                $this->db->join('categories as topic', 'topic.category_id = article_topics.topic_id', 'left');
                $this->db->where('articles.published', 1);
                // $this->db->where('articles.article_type', $type);
                $this->db->where_in('topic.uri', $uri);

                $query = $this->db->get();
                
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

    function getArticleInResearchPage($type, $uri, $start, $limit)
    {
        $key_cache = "getArticleInResearchPage_" . $type . "_" . $uri . "_".time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->distinct();
                $this->db->select('articles.*, topic.uri as url_slug');
                $this->db->from('articles AS articles');
                $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
                $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                $this->db->join('categories as topic', 'topic.category_id = article_topics.topic_id', 'left');
                $this->db->where('articles.published', 1);
                $this->db->where('articles.article_type', $type);
                $this->db->where_in('topic.uri', $uri);
                $this->db->order_by('posted_date', 'DESC');
                $this->db->limit($limit, $start);

                $query = $this->db->get();
                
                $result_data = $query->result();
                
                $results = array();

                if (!empty($result_data)) {
                    
                    foreach ($result_data as $aid => $result_) {
                        $results[$aid]['title'] = $result_->title;
                        $results[$aid]['content'] = (string)$result_->content;
                        $results[$aid]['image_name'] = $result_->image_name;
                        $results[$aid]['posted_date'] = date('j F Y', strtotime($result_->posted_date));
                        $results[$aid]['uri'] = $result_->uri;

                        $results[$aid]['cat'] = $this->get_articleCat($result_->article_id);
                        $results[$aid]['tags'] = $this->tag_topic_limit($result_->article_id, $result_->url_slug);
                    }
                } else {
                    $results = array(); // $this->getAllArticlesByNews()
                }

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
    
    function getArticle($type, $like)
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        //$this->db->where('articles.pub_type', 1);
        $this->db->where('articles.article_type', 'publications');
        $this->db->where('categories.category_type', 'topics');
        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where_in('categories.uri', $like);
        $this->db->order_by('article_id', 'DESC');

        $queryT = $this->db->get();
        $data = $queryT->result();
        $typeData = array();

        foreach ($data as $aid => $query) {
            $typeData[$aid]['editor'] = $query->editor;
            $typeData[$aid]['author'] = $query->author;
            $typeData[$aid]['pub_type'] = $query->pub_type;
            $typeData[$aid]['article_id'] = $query->article_id;
            $typeData[$aid]['article_type'] = $query->article_type;
            $typeData[$aid]['major'] = $query->major;
            $tag = explode(',', $query->tags);
            $typeData[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
            $typeData[$aid]['uri'] = $query->uri;
            $typeData[$aid]['keywords'] = $query->keywords;
            $typeData[$aid]['article_keywords'] = $query->article_keywords;
            $typeData[$aid]['title'] = $query->title;
            $typeData[$aid]['image_name'] = $query->image_name;
            $typeData[$aid]['content'] = (string)$query->content;
            $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
            $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
            $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
            $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
        }

        return $typeData;
    }

    function taglink($tags, $atype, $ptype)
    {
        //$urln=current_url();
        $out = '';

        foreach (array_slice(
            $tags,
            0,
            4
        )  as $tag) {
            $this->db->select('uri');
            $this->db->from('categories');
            $this->db->where('category_name', $tag);
            $this->db->where('category_type', 'topics');

            $queryT = $this->db->get();

            if ($queryT->num_rows() != 0) {
                $uri = $queryT->row('uri');
                $url = base_url() . "research/category/" . $uri;

                $out .= "<a style='display:inline-block' href='" . $url . "' >" . $tag . "</a>, ";
            } else {
                $this->db->select('uri');
                $this->db->from('categories');
                $this->db->where('category_name', $tag);
                $this->db->where('category_type', 'pubtypes');
                $queryT = $this->db->get();
                if ($queryT->num_rows() != 0) {
                    $uri = $queryT->row('uri');
                    $url = base_url() . "Publications/Brows/" . $uri;

                    $out .= "<a style='display:inline-block' href='" . $url . "' >" . $tag . "</a>, ";
                } else {

                    if ($tag != "")
                        $out .= "<a style='display:inline-block' href='#' data-key='" . $tag . "' class='n_related'>" . $tag . "</a>, ";
                }
            }
        }

        if (trim($out) != '') {
            $v = ":&nbsp" . rtrim(trim($out), " , ");

            return $v;
            // return substr($v, -4);
        } else {
            return "";
        }
    }

    function tag_topic_programmes($aid)
    {
        $out = '';

        $this->db->select('*');
        $this->db->from('article_topics AS article_topics');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where('article_topics.article_id', $aid);
        $this->db->where('categories.category_type', 'categories');
        $this->db->where('categories.published', 1);
        $queryT = $this->db->get();
        $result_article_topics = $queryT->result();
        
        foreach ($result_article_topics as $tag) {
            if ($tag->published == 1) {
                $url = base_url() . "database-and-programmes/topic/" . $tag->uri;
                $out .= "<a href='" . $url . "' >" . $tag->category_name . "</a>,&nbsp";
            }
        }
        
        $this->db->select('*');
        $this->db->from('article_multimedia_tag AS article_multimedia_tag');
        $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = article_multimedia_tag.cato', 'left');
        $this->db->where('article_multimedia_tag.a_id', $aid);

        $this->db->where('article_multimedia_tag.am_type!=', 'C');
        $queryTf = $this->db->get();
        foreach ($queryTf->result() as $tag) {
            $url = base_url() . "multimedia/" . $tag->category;
            $out .= "<a href='" . $url . "' >" . $tag->category . "</a>,&nbsp";
        }

        $this->db->select('*');
        $this->db->from('article_multimedia_tag AS article_multimedia_tag');
        $this->db->join('categories', 'categories.category_id = article_multimedia_tag.cato', 'left');
        $this->db->where('article_multimedia_tag.a_id', $aid);

        $this->db->where('article_multimedia_tag.am_type', 'C');
        $queryTf = $this->db->get();
        $result_article_multimedia = $queryTf->result();
        
        foreach ($result_article_multimedia as $tag) {
            $url = base_url() . "publications/brows/" . $tag->uri;
            $out .= "<a href='" . $url . "' >" . $tag->category_name . "</a>";
        }
        if (trim($out) != '') {
            return "<br>" . rtrim($out, ",&nbsp");
        } else {
            return "";
        }
    }

    function tag_topic_breadcrumb($aid)
    {
        $out = '';

        $this->db->select('categories.uri, categories.category_name');
        $this->db->from('article_topics AS article_topics');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where('article_topics.article_id', $aid);
        $queryT = $this->db->get();

        $results = $queryT->result();
        
        return $results;
    }

    function tag_topic_limit($aid, $url_slug)
    {
        $this->db->select('categories.uri, categories.category_name');
        $this->db->from('article_topics AS article_topics');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where('article_topics.article_id', $aid);
        $queryT = $this->db->get();

        $results = $queryT->result();
        
        if (!empty($results)) {
            
            $countries_asean = $this->getCountriesAsean(16);
            
            $not_asean = ['Australia', 'China', 'India', 'Japan', 'New Zealand', 'Republic of Korea'];

            foreach ($countries_asean as $value) {
                
                if (!in_array($value->venue, $not_asean)) {
                    $asean[] = $value->venue;
                }
            }
            
            foreach ($results as $key => $value) {
                if (in_array($value->category_name, $asean)) {
                    
                    if ($value->uri == $url_slug) {
                        $url = base_url() . "research/topic/asean/" . $value->uri;
                        $data[0] = "<a href='" . $url . "' >" . $value->category_name . "</a>";
                    } else {
                        $url = base_url() . "research/topic/asean/" . $value->uri;
                        $data[] = "<a href='" . $url . "' >" . $value->category_name . "</a>";
                    }
                } else {
                    if ($value->uri == $url_slug) {
                        $url = base_url() . "research/topic/" . $value->uri;
                        $data[0] = "<a href='" . $url . "' >" . $value->category_name . "</a>";
                    } else {
                        $url = base_url() . "research/topic/" . $value->uri;
                        $data[] = "<a href='" . $url . "' >" . $value->category_name . "</a>";
                    }
                }
            }
        } else {
            $data = array();
        }
        
        return array_slice($data, 0, 2);
    }

    function tag_topic_news_and_views($article_id)
    {
        $out = '';

        $this->db->select('*');
        $this->db->from('article_topics AS article_topics');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where('article_topics.article_id', $article_id);
        $queryT = $this->db->get();

        foreach ($queryT->result() as $tag) {
            $url = base_url() . "news-and-views/category/all/" . $tag->uri;
            $out .= "<a href='" . $url . "' >" . $tag->category_name . "</a>,&nbsp";
        }
        
        $this->db->select('*');
        $this->db->from('article_multimedia_tag AS article_multimedia_tag');
        $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = article_multimedia_tag.cato', 'left');
        $this->db->where('article_multimedia_tag.a_id', $article_id);

        $this->db->where('article_multimedia_tag.am_type!=', 'C');
        $queryTf = $this->db->get();
        foreach ($queryTf->result() as $tag) {
            $url = base_url() . "multimedia/" . $tag->category;
            $out .= "<a href='" . $url . "' >" . $tag->category . "</a>,&nbsp";
        }

        $this->db->select('*');
        $this->db->from('article_multimedia_tag AS article_multimedia_tag');
        $this->db->join('categories', 'categories.category_id = article_multimedia_tag.cato', 'left');
        $this->db->where('article_multimedia_tag.a_id', $article_id);

        $this->db->where('article_multimedia_tag.am_type', 'C');
        $queryTf = $this->db->get();
        foreach ($queryTf->result() as $tag) {
            $url = base_url() . "publications/brows/" . $tag->uri;
            $out .= "<a href='" . $url . "' >" . $tag->category_name . "</a>";
        }
        if (trim($out) != '') {
            return "<br>" . rtrim($out, ",&nbsp");
        } else {
            return "";
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
            $url = base_url() . "research/topic/" . $tag->uri;
            $out .= "<a href='" . $url . "' >" . $tag->category_name . "</a>,&nbsp";
        }
        $this->db->select('*');
        $this->db->from('article_multimedia_tag AS article_multimedia_tag');
        $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = article_multimedia_tag.cato', 'left');
        $this->db->where('article_multimedia_tag.a_id', $aid);

        $this->db->where('article_multimedia_tag.am_type!=', 'C');
        $queryTf = $this->db->get();
        foreach ($queryTf->result() as $tag) {
            $url = base_url() . "multimedia/" . $tag->category;
            $out .= "<a href='" . $url . "' >" . $tag->category . "</a>,&nbsp";
        }

        $this->db->select('*');
        $this->db->from('article_multimedia_tag AS article_multimedia_tag');
        $this->db->join('categories', 'categories.category_id = article_multimedia_tag.cato', 'left');
        $this->db->where('article_multimedia_tag.a_id', $aid);

        $this->db->where('article_multimedia_tag.am_type', 'C');
        $queryTf = $this->db->get();
        foreach ($queryTf->result() as $tag) {
            $url = base_url() . "publications/brows/" . $tag->uri;
            $out .= "<a href='" . $url . "' >" . $tag->category_name . "</a>";
        }
        if (trim($out) != '') {
            return "<br>" . rtrim($out, ",&nbsp");
        } else {
            return "";
        }
    }

    function get_searchCat_aseanarticle($type, $start, $limit, $ath, $author, $country, $key)
    {
        $this->db->select('articles.*');
        $this->db->from('article_topics AS article_topics');
        $this->db->join('articles', 'articles.article_id = article_topics.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where('articles.published', 1);
        // $this->db->where('articles.category_type', 'publications');
        $this->db->where_in('categories.category_name', 'ASEAN');
        $this->db->like('articles.venue', $country);
        $this->db->order_by('article_id', 'DESC');
        $this->db->limit($limit, $start);
        $queryT = $this->db->get();
        return $queryT->result();
    }

    function get_highasianArticle()
    {

        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        $this->db->where('highlight', 1);
        $this->db->where('categories.category_type', 'topics');
        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where_in('categories.category_name', 'ASEAN');
        $this->db->limit(5, 0);

        $queryT = $this->db->get();
        $data = $queryT->result();
        $typeData = array();

        foreach ($data as $aid => $query) {
            $typeData[$aid]['editor'] = $query->editor;
            $typeData[$aid]['author'] = $query->author;
            $typeData[$aid]['article_id'] = $query->article_id;
            $typeData[$aid]['article_type'] = $query->article_type;
            $typeData[$aid]['major'] = $query->major;
            $typeData[$aid]['tags'] = $query->tags;
            $typeData[$aid]['uri'] = $query->uri;
            $typeData[$aid]['keywords'] = $query->keywords;
            $typeData[$aid]['article_keywords'] = $query->article_keywords;
            $typeData[$aid]['title'] = $query->title;
            $typeData[$aid]['image_name'] = $query->image_name;
            $typeData[$aid]['content'] = (string)$query->content;
            $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
            $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
            $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
            $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
        }

        return $typeData;
    }

    function get_latestasianArticle()
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        $this->db->where('article_type', 'publications');
        $this->db->where('categories.category_type', 'topics');
        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where_in('categories.category_name', 'ASEAN');
        $this->db->limit(4, 0);
        $this->db->order_by('article_id', 'DESC');

        $queryT = $this->db->get();
        $data = $queryT->result();
        $typeData = array();

        foreach ($data as $aid => $query) {
            $typeData[$aid]['editor'] = $query->editor;
            $typeData[$aid]['author'] = $query->author;
            $typeData[$aid]['article_id'] = $query->article_id;
            $typeData[$aid]['article_type'] = $query->article_type;
            $typeData[$aid]['major'] = $query->major;
            $typeData[$aid]['tags'] = $query->tags;
            $typeData[$aid]['uri'] = $query->uri;
            $typeData[$aid]['keywords'] = $query->keywords;
            $typeData[$aid]['article_keywords'] = $query->article_keywords;
            $typeData[$aid]['title'] = $query->title;
            $typeData[$aid]['image_name'] = $query->image_name;
            $typeData[$aid]['content'] = (string)$query->content;
            $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
            $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
            $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
            $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
        }

        return $typeData;
    }

    function get_asianArticle($start, $limit, $region, $key, $research, $research_type, $c_type)
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'articles');

        $this->db->like('content', 'asean');

        // $this->db->where('articles.article_type!=', 'events');
        // $this->db->where('articles.article_type!=', 'multimedia');
        // $this->db->where('articles.article_type!=', 'news');
        // $this->db->where('categories.category_type', 'topics');
        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
        if ($research) {
            $this->db->where_in('categories.category_id', $research);
        }
        if ($research_type) {
            $this->db->where_in('article_categories.category_id', $research_type);
        }
        if ($region != 'all') {
            $this->db->where_in('articles.venue', $region);
        }

        if ($c_type) {
            if (in_array("articles", $c_type, TRUE)) {
                $this->db->where('articles.article_type', 'articles');
            }
            if (in_array("publicatios", $c_type, TRUE)) {
                $this->db->where('articles.pub_type', 1);
                $this->db->where('articles.article_type', 'publications');
            }
            if (in_array("research", $c_type, TRUE)) {
                $this->db->where('articles.pub_type', 3);
                $this->db->where('articles.article_type', 'publications');
            }
        }

        if ($key) {
            $this->db->like('articles.title', $key, 'both');
            $this->db->like('articles.content', $key, 'both');
        }

        $this->db->order_by('articles.article_id', 'DESC');
        $this->db->group_by('articles.article_id');
        $this->db->limit($limit, $start);

        $queryT = $this->db->get();
        $data = $queryT->result();
        $typeData = array();

        foreach ($data as $aid => $query) {
            $typeData[$aid]['editor'] = $query->editor;
            $typeData[$aid]['author'] = $query->author;
            $typeData[$aid]['pub_type'] = $query->pub_type;
            $typeData[$aid]['article_id'] = $query->article_id;
            $typeData[$aid]['article_type'] = $query->article_type;
            $typeData[$aid]['major'] = $query->major;
            $tag = explode(',', $query->tags);
            $typeData[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
            $typeData[$aid]['uri'] = $query->uri;
            $typeData[$aid]['keywords'] = $query->keywords;
            $typeData[$aid]['article_keywords'] = $query->article_keywords;
            $typeData[$aid]['title'] = $query->title;
            $typeData[$aid]['image_name'] = $query->image_name;
            $typeData[$aid]['content'] = (string)$query->content;
            $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
            $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
            $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
            $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
        }

        return $typeData;
    }

    function get_articleCat($aid)
    {
        $out = '';

        $this->db->select('categories.*');
        $this->db->from('categories AS categories');
        $this->db->join('article_categories', 'article_categories.category_id = categories.category_id', 'left');
        $this->db->where('article_categories.article_id', $aid);

        $queryT = $this->db->get();

        foreach ($queryT->result() as $a) {
            $out .= ", " . $a->category_name;
        }

        return $out;
    }

    function getTopicBySlug($uri, $category_type)
    {
        $this->db->select('*');
        $this->db->where('uri', urldecode($uri));
        $this->db->where('category_type', $category_type);
        $this->db->where('published', 1);
        $query = $this->db->get('categories');

        $data = $query->row();
        return $data;
    }

    function getPublicationResearchByTopics($article_type, $start, $limit, $topic_id)
    {
        $time_ = time();
        $key_cache = "getPublicationResearchByTopics_" . $article_type . "_" . $start . "_" . $limit . "_" . $topic_id . "_" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);
        if (!$CachedString->isHit()) {
            try {

                $this->db->select('articles.*, categories.uri as url_slug');
                $this->db->from('articles AS articles');
                $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
                if (!empty($topic_id)) {
                    $this->db->where_in('article_topics.topic_id', $topic_id);
                }
                $this->db->where('articles.published', 1);
                $this->db->where('articles.article_type', $article_type);
                
                $this->db->group_by('article_id');
                $this->db->order_by('posted_date', 'DESC');
                $this->db->limit($limit, $start);

                $queryT = $this->db->get();
                $data = $queryT->result();
                $typeData = array();

                foreach ($data as $aid => $query) {
                    $typeData[$aid]['editor'] = $query->editor;
                    $typeData[$aid]['author'] = $query->author;
                    $typeData[$aid]['pub_type'] = $query->pub_type;
                    $typeData[$aid]['article_id'] = $query->article_id;
                    $typeData[$aid]['article_type'] = $query->article_type;
                    $typeData[$aid]['major'] = $query->major;
                    $tag = explode(',', $query->tags);
                    $typeData[$aid]['tags'] = $this->tag_topic_limit($query->article_id, $query->url_slug);
                    $typeData[$aid]['uri'] = $query->uri;
                    $typeData[$aid]['keywords'] = $query->keywords;
                    $typeData[$aid]['article_keywords'] = $query->article_keywords;
                    $typeData[$aid]['title'] = $query->title;
                    $typeData[$aid]['image_name'] = $query->image_name;
                    $typeData[$aid]['content'] = (string)$query->content;
                    $typeData[$aid]['cat'] = $this->get_articleCat($query->article_id);
                    $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
                    $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
                    $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
                }

                $results = $typeData;

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

    function countContentResearchSearch($type, $publication, $region, $key, $cat)
    {
        try {

            $this->db->select('articles.article_id');
            $this->db->from('articles AS articles');
            $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
            $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
            
            if ($key) {
                $this->db->like('articles.title', $key);
            }

            if ($publication != 'all') {
                $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                $this->db->where_in('article_categories.category_id', $publication);
            }

            if ($cat != 'all') {

                $this->db->where_in('article_topics.topic_id', $cat);
            }

            if ($region != 'all') {
                $this->db->where_in('articles.venue', $region);
            }

            $this->db->where('articles.published', 1);
            $this->db->where('articles.article_type', 'publications');
            
            $this->db->group_by('article_id');
            $this->db->order_by('posted_date', 'DESC');
            
            $queryT = $this->db->get();
            $data = $queryT->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getResearch_Search($type, $start, $limit, $publication, $region, $key, $cat)
    {
        if ($publication != 'all') {
            $cache_pub = implode('_', $publication);
        } else {
            $cache_pub = "all";
        }

        if ($region != 'all') {
            $cache_reg = implode('_', $region);
        } else {
            $cache_reg = "all";
        }

        if ($cat != 'all') {
            if (!empty($cat)) {
                $cache_cat = implode('_', $cat);
            } else {
                $cache_cat = "";
            }
            
        } else {
            $cache_cat = "all";
        }

        $time_ = time();
        $key_cache = "getResearch_Search_" . $type . "_" . $start . "_" . $limit . "_" . $cache_pub . "_" . $cache_reg . "_" . $cache_cat . "_" . $time_;
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                
                
                $this->db->select('articles.*, categories.uri as url_slug');
                $this->db->from('articles AS articles');
                
                $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'inner');
                $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'inner');                
                //$this->db->where_in('categories.uri', $like);
            
                if ($key) {
                    $this->db->where("IF(`articles`.`title` > 0 , `articles`.`title` , `articles`.`content`) like '%".$key."%'", NULL, FALSE);
                    
                }

                $this->db->where('articles.article_type', 'publications');
                $this->db->where('articles.published', 1);
                
                if ($publication != 'all') {
                    $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'inner');
                    $this->db->where_in('article_categories.category_id', $publication);
                }

                if ($cat != 'all') {

                    $this->db->where_in('article_topics.topic_id', $cat);
                }

                if ($region != 'all') {
                    $this->db->where_in('articles.venue', $region);
                }

                if ($key) {
                    $this->db->or_where("IF(`articles`.`author` > 0 , `articles`.`author` , `articles`.`editor`) like '%".$key."%'", NULL, FALSE);
                }
                $this->db->group_by('article_id');
                $this->db->order_by('posted_date', 'DESC');
                $this->db->limit($limit, $start);

                $queryT = $this->db->get();
                $data = $queryT->result();
                $typeData = array();

                foreach ($data as $aid => $query) {
                    $typeData[$aid]['editor'] = $query->editor;
                    $typeData[$aid]['author'] = $query->author;
                    $typeData[$aid]['pub_type'] = $query->pub_type;
                    $typeData[$aid]['article_id'] = $query->article_id;
                    $typeData[$aid]['article_type'] = $query->article_type;
                    $typeData[$aid]['major'] = $query->major;
                    $tag = explode(',', $query->tags);
                    // $typeData[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
                    $typeData[$aid]['tags'] = $this->tag_topic_limit($query->article_id, $query->url_slug);
                    $typeData[$aid]['uri'] = $query->uri;
                    $typeData[$aid]['keywords'] = $query->keywords;
                    $typeData[$aid]['article_keywords'] = $query->article_keywords;
                    $typeData[$aid]['title'] = $query->title;
                    $typeData[$aid]['image_name'] = $query->image_name;
                    $typeData[$aid]['content'] = (string)$query->content;
                    $typeData[$aid]['cat'] = $this->get_articleCat($query->article_id); // get_articleCatogery
                    $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
                    $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
                    $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
                }

                $results = $typeData;

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

    function resultSearchPublications($start, $limit, $articleID, $key)
    {
        $this->db->select('articles.*, categories.uri as url_slug');
        $this->db->from('articles AS articles');
        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        //$this->db->where_in('categories.uri', $like);
    
        if ($key) {
            $this->db->like('articles.title', $key);
            // $this->db->like('articles.content', $key);
        }

        if ($publication != 'all') {
            $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
            $this->db->where_in('article_categories.category_id', $publication);
        }

        if ($cat != 'all') {

            $this->db->where_in('article_topics.topic_id', $cat);
        }

        if ($region != 'all') {
            $this->db->where_in('articles.venue', $region);
        }

        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_type', 'publications');
        
        $this->db->group_by('article_id');
        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit($limit, $start);

        $queryT = $this->db->get();
        $data = $queryT->result();
        $typeData = array();

        foreach ($data as $aid => $query) {
            $typeData[$aid]['editor'] = $query->editor;
            $typeData[$aid]['author'] = $query->author;
            $typeData[$aid]['pub_type'] = $query->pub_type;
            $typeData[$aid]['article_id'] = $query->article_id;
            $typeData[$aid]['article_type'] = $query->article_type;
            $typeData[$aid]['major'] = $query->major;
            $tag = explode(',', $query->tags);
            // $typeData[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
            $typeData[$aid]['tags'] = $this->tag_topic_limit($query->article_id, $query->url_slug);
            $typeData[$aid]['uri'] = $query->uri;
            $typeData[$aid]['keywords'] = $query->keywords;
            $typeData[$aid]['article_keywords'] = $query->article_keywords;
            $typeData[$aid]['title'] = $query->title;
            $typeData[$aid]['image_name'] = $query->image_name;
            $typeData[$aid]['content'] = (string)$query->content;
            $typeData[$aid]['cat'] = $this->get_articleCat($query->article_id); // get_articleCatogery
            $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));
            $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
            $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
        }

        $results = $typeData;

        return $data;
    }

    function getResultSearchPublicationData($start, $limit, $articleID, $key)
    {
        if (!empty($key)) {
            $keyword = "AND IF(`articles`.`title` IS NULL,
                    `articles`.`title` LIKE  '%$key%',  
                    `articles`.`content` LIKE  '%$key%'
                    )";

            if (!empty($articleID)) {
                $articleIds = implode("', '", $articleID);
                $article_ID = "OR `articles`.`article_id` IN('$articleIds')";
            } else {
                $article_ID = "";
            }
        } else {
            $keyword = "";

            if (!empty($articleID)) {
                $articleIds = implode("', '", $articleID);
                $article_ID = "AND `articles`.`article_id` IN('$articleIds')";
            } else {
                $article_ID = "";
            }
        }

        $query = "SELECT 
                `articles`.* 
                FROM `articles` 
                WHERE `articles`.`published` = '1' 
                AND `articles`.`article_type` = 'publications' 
                " . $article_ID . "
                " . $keyword . "
                ORDER BY `posted_date` DESC 
                LIMIT " . $start . ", " . $limit . "";

        $result = $this->db->query($query);
        $data = $result->result();
        $typeData = array();
        foreach ($data as $aid => $query) {
            $typeData[$aid]['title'] = $query->title;
            $typeData[$aid]['content'] = $query->content;
            $typeData[$aid]['image_name'] = $query->image_name;
            $typeData[$aid]['posted_date'] = date('j F Y', strtotime($query->posted_date));

            $typeData[$aid]['editornew'] = $this->getPerson($query->article_id, 'Editor', 'Highlite');
            $typeData[$aid]['authornew'] = $this->getPerson($query->article_id, 'Author', 'Highlite');
            $typeData[$aid]['editor'] = $query->editor;
            $typeData[$aid]['author'] = $query->author;
            $typeData[$aid]['uri'] = $query->uri;

            $tag = explode(',', $query->tags);
            $typeData[$aid]['cat'] = $this->get_articleCatogery($query->article_id);
            $typeData[$aid]['tags'] = $this->taglink($tag, $query->article_type, $query->pub_type);
        }

        return $typeData;
    }

    function getlikeArticle($type, $like)
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        //$this->db->where('articles.article_type', $type);
        //    $this->db->like('categories.category_name', $like);

        if ($type) {
            $this->db->where('articles.article_type', $type);
            //$this->db->or_where('articles.article_type!=', 'publications');
        } else {
            $this->db->where('articles.article_type!=', 'publications');
        }

        // $this->db->like('articles.content', $like);
        // $this->db->or_like('articles.tags', $like);
        // $this->db->like('articles.keywords', $like);
        // $this->db->or_like('articles.article_keywords', $like);
        $this->db->limit(10);
        $this->db->order_by('articles.article_id', 'RANDOM');

        $queryT = $this->db->get();

        return $queryT->result();
    }

    function getPublicationByRelated($article_id)
    {
        $this->db->select('*');
        $this->db->from('article_relateds_publication');
        $this->db->where('article_id', $article_id);
        $query  = $this->db->get();
        return $query->result_array();
    }

    function get_article_id_by_related($article_id)
    {
        $this->db->select('*');
        $this->db->from('article_relateds');
        $this->db->where('article_id', $article_id);
        $query  = $this->db->get();
        return $query->result_array();
    }

    function getRelatedArticleForPublication($article_id)
    {
        /* 
        ** Reminder: previously table in live eria is a (articles_relateds) for related publication 
        **        and then iam create to new table for related publications (article_relateds_publication)
        **        there is a conflict with the related article a new one
        **        Because related article is not there in the DB Live ERIA before
        ** Related Publications
        */

        $query = "SELECT articles.*
                FROM article_relateds_publication
                LEFT JOIN articles ON articles.article_id=article_relateds_publication.to_article_id
                WHERE article_relateds_publication.article_id='" . $article_id . "' 
                AND articles.article_type='publications' 
                AND (articles.pub_type & 1) = 1 
                AND articles.published=1
                ORDER BY articles.posted_date DESC
                LIMIT 2";

        $result = $this->db->query($query);

        $data = $result->result();

        return $data;
    }

    function getArticleByArticleId($article_id, $article_type)
    {
        $limit = 3;
        foreach ($article_id as $articleid_) {
            $articleid[] = $articleid_;
        }

        $this->db->select('*');
        $this->db->from('articles');
        $this->db->where_in('article_id', $articleid);
        $this->db->where('articles.article_type', $article_type);
        $this->db->where('articles.published', 1);
        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit($limit);
        $query  = $this->db->get();
        return $query->result();
    }

    function getRelatedPublicationByArticleId($article_id)
    {
        $limit = 2;
        foreach ($article_id as $articleid_) {
            $articleid[] = $articleid_;
        }

        $this->db->select('*');
        $this->db->from('articles');
        $this->db->where_in('article_id', $articleid);
        // $this->db->where('articles.article_type', 'publications');
        $this->db->where('articles.published', 1);
        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit($limit);
        $query  = $this->db->get();
        return $query->result();
    }

    function getRelatedPublicationLatestDate($type)
    {
        $limit = 2;
        $start = 0;
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->where('articles.article_type', $type);
        $this->db->where('articles.published', 1);
        $this->db->order_by('articles.posted_date', 'DESC');
        $this->db->limit($limit);
        $query  = $this->db->get();
        return $query->result();
    }

    function get_related_article($type, $uri)
    {
        $limit = 3;
        $querynT = array();

        $this->db->select('sub_articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_id!=', null);
        $this->db->where('articles.article_type', $type);
        $this->db->join('article_relateds', 'article_relateds.article_id = articles.article_id', 'left');
        $this->db->join('articles as sub_articles', 'sub_articles.article_id = article_relateds.to_article_id', 'left');
        $this->db->where('articles.uri', $uri);
        $this->db->order_by('posted_date', 'DESC');
        $this->db->limit(0, $limit);
        $queryT = $this->db->get();

        if (count($queryT->result()) < 3) {
            if (count($queryT->result()) == 2) {
                $limit_ = 1;
            } elseif (count($queryT->result()) == 1) {
                $limit_ = 3;
            } else {
                $limit_ = 3;
            }
            $this->db->select('articles.*');
            $this->db->from('articles AS articles');
            $this->db->where('articles.published', '1');
            $this->db->where('articles.article_type', $type);
            $this->db->order_by('posted_date', 'DESC');
            $this->db->limit($limit_);
            $querynT = $this->db->get()->result();
        }

        return array_merge($queryT->result(), $querynT);
    }

    function get_newlikeArticle($type, $uri)
    {
        $querynT = array();

        $this->db->select('sub_articles.*');
        $this->db->from('articles AS articles');
        $this->db->where('articles.published', 1);
        $this->db->where('articles.article_id!=', null);
        $this->db->where('articles.article_type', $type);
        $this->db->join('article_relateds', 'article_relateds.article_id = articles.article_id', 'left');
        $this->db->join('articles as sub_articles', 'sub_articles.article_id = article_relateds.to_article_id', 'left');
        $this->db->where('articles.uri', $uri);
        $this->db->order_by('article_id', 'DESC');
        $queryT = $this->db->get();

        if ($queryT->num_rows() < 3) {
            $this->db->select('articles.*');
            $this->db->from('articles AS articles');
            $this->db->where('articles.published', 1);
            $this->db->where('articles.article_type', $type);
            $this->db->order_by('article_id', 'DESC');
            $querynT = $this->db->get()->result();
        }

        return array_merge($queryT->result(), $querynT);
    }

    function getPodcast($name)
    {
        $this->db->select('*');
        $this->db->from('article_categories AS article_categories');
        $this->db->join('articles', 'articles.article_id = article_categories.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
        $this->db->where('articles.published', 1);
        $this->db->where('categories.category_name', $name);

        $queryT = $this->db->get();

        return $queryT->result();
    }

    function getAllDepartement()
    {
        $this->db->select('*');
        $this->db->from('eria_departement');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getSubExpert()
    {
        $this->db->select('*');
        $this->db->from('eria_expert_sub_categories AS eria_expert_sub_categories');
        $this->db->order_by('s_catogery', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getEventCardForPeople($people_id)
    {
        $this->db->select('eria_card_people.*, `articles`.*');
        $this->db->from('eria_card_people');
        $this->db->join('articles', 'articles.article_id = eria_card_people.event_id', 'inner');
        $this->db->where('people_id', $people_id);
        $this->db->group_by('articles.article_id');

        $query = $this->db->get();
        $data = $query->result();

        return $data;
    }
    
    function getSub_cat($name)
    {
        $this->db->select('*');
        $this->db->from('eria_expert_categories AS eria_expert_categories');
        $this->db->where('eria_expert_categories.parent', $name);

        $queryT = $this->db->get();
        return $queryT->result();
    }

    function get_Updatecatogery()
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('category_type', 'newscategories');
        $this->db->where('published', 1);
        $this->db->where('category_name!=', 'Multimedia');
        $this->db->where('category_name!=', 'Press Releases');
        $query  = $this->db->get();
        return $query->result();
    }

    function get_press_release($start, $limit, $type)
    {
        $key_cache = "get_press_release_" . time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {
                $this->db->select('articles.*');
                $this->db->from('articles AS articles');
                $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
                $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                $this->db->join('categories as topic', 'topic.category_id = article_topics.topic_id', 'left');
                $this->db->where('articles.published', 1);
                $this->db->where('articles.article_type', 'news');
                $this->db->where('categories.uri', $type);
                $this->db->group_by('articles.article_id');
                $this->db->order_by('articles.posted_date', 'DESC');

                $this->db->limit($limit, $start);

                $queryT = $this->db->get();
                $results = $queryT->result_array();

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

    function get_new_updateNews($start, $limit, $type, $cat, $key, $topic)
    {
        $key_cache = "get_new_updateNews_" . time();
        $CachedString = $this->InstanceCache->getItem($key_cache);

        if (!$CachedString->isHit()) {
            try {

                $this->db->select('articles.*');
                $this->db->from('articles AS articles');
                $this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
                $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
                $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
                $this->db->join('categories as topic', 'topic.category_id = article_topics.topic_id', 'left');

                if ($key) {
                    $this->db->like('title', $key); // $this->db->or_like('title', $key);
                }

                $this->db->where('articles.published', 1);
                $this->db->where('articles.article_type', 'news');

                if (
                    $type != 'all'
                ) {
                    if ($topic) {
                    } else {
                        $this->db->where('categories.uri', $type);
                    }
                }

                if ($topic) {
                    $this->db->where_in('topic.category_id', $topic);
                }

                if ($cat) {
                    $this->db->where_in('categories.category_id', $cat);
                }

                $this->db->group_by('articles.article_id');
                //$this->db->order_by('articles.article_id', 'DESC');
                $this->db->order_by('articles.posted_date', 'DESC');

                $this->db->limit($limit, $start);
                $queryT = $this->db->get();
                $data = $queryT->result();

                $typeData = array();
                foreach ($data as $aid => $query) {
                    $typeData[$aid]['content'] = $query->content;
                    $typeData[$aid]['image_name'] = $query->image_name;
                    $typeData[$aid]['posted_date'] = $query->posted_date;
                    $typeData[$aid]['uri'] = $query->uri;
                    $typeData[$aid]['title'] = $query->title;
                    $typeData[$aid]['cat'] = $this->get_articleCat($query->article_id);
                    $typeData[$aid]['tags'] = $this->tag_topic_news_and_views($query->article_id);
                    $typeData[$aid]['by_editor'] = $query->editor;
                    $typeData[$aid]['link_website'] = $query->link_website;
                    $typeData[$aid]['short_des'] = $query->short_des;
                }

                $results = $typeData;

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

    function get_updateNews($start, $limit, $type, $country, $key)
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->join('article_topics', 'article_topics.article_id = articles.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $this->db->where('articles.published', 1);
        //  $this->db->where('articles.article_type', 'news');
        $this->db->where('categories.category_name!=', 'Multimedia');
        $this->db->where('categories.category_name!=', 'Press Releases');
        $this->db->where('articles.article_type!=', 'experts');
        $this->db->where('articles.article_type!=', 'multimedia');
        $this->db->where('categories.category_name', 'opinions');

        if ($type != 'all') {
            // $this->db->where('categories.category_name', $type);
        } else {
        }

        if ($country != 'all') {
            $this->db->where_in('articles.venue', $country);
        }

        if ($key) {
            $this->db->where('categories.category_name', $key);
            $this->db->or_like('title', $key, 'before');
            $this->db->or_like('content', $key, 'before');
        }

        $this->db->order_by('articles.article_id', 'DESC');
        $this->db->limit($limit, $start);

        $queryT = $this->db->get();
        $data = $queryT->result();
        $typeData = array();

        foreach ($data as $aid => $query) {
            $typeData[$aid]['content'] = $query->content;
            $typeData[$aid]['image_name'] = $query->image_name;
            $typeData[$aid]['posted_date'] = $query->posted_date;
            $typeData[$aid]['uri'] = $query->uri;
            $typeData[$aid]['title'] = $query->title;
            $typeData[$aid]['cat'] = $this->get_articleCat($query->article_id);
            $typeData[$aid]['tags'] = $this->tag_topic($query->article_id);
        }

        return $typeData;
    }

    function get_pressNews($start, $limit, $country, $key)
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->join('article_categories', 'articles.article_id = article_categories.article_id', 'left');
        $this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');
        $this->db->where('articles.published', 1);
        $this->db->where('categories.category_name', 'Press Releases');
        $this->db->where('categories.category_type', 'newscategories');

        if ($country != 'all') {
            $this->db->where_in('venue', $country);
        }

        if ($key) {
            $this->db->like('title', $key, 'before');
            $this->db->or_like('content', $key, 'before');
        }

        $this->db->limit($limit, $start);
        $queryT = $this->db->get();

        return $queryT->result();
    }

    function getPeopleRelatedEvent($event_id)
    {
        $this->db->select('`eria_agenda_related`.*,`articles`.*');
        $this->db->from('eria_agenda_related');
        $this->db->where('eria_agenda_related.event_id', $event_id);
        $this->db->where('articles.published', 1);
        $this->db->join('articles', 'articles.article_id = eria_agenda_related.people_id', 'inner');

        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    function getAgendaDetailByEventId($event_id)
    {
        $this->db->select('`eria_agenda_detail`.*');
        $this->db->from('eria_agenda_detail');
        $this->db->where('eria_agenda_detail.event_id', $event_id);

        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    function getEvent_list($type, $start, $limit)
    {

        $date = date('y-m-d');

        $this->db->select('articles.article_id,articles.start_date,articles.uri,articles.title,articles.major,articles.majorEmail,articles.venue,exp.title as experts,exp.uri as link, articles.image_name, articles.content');
        $this->db->from('articles');
        $this->db->where('articles.article_type', 'events');
        $this->db->where('articles.published', 1);
        $this->db->join('articles as exp', 'exp.article_id = articles.major', 'left');

        if ($type == 'up') {
            $this->db->where('articles.start_date>=', $date);
            $this->db->order_by('articles.start_date', 'ASC');
        } else {
            $this->db->where('articles.start_date<', $date);
            $this->db->order_by('articles.start_date', 'DESC');
        }
        
        $this->db->limit($limit, $start);

        $query  = $this->db->get();

        return $query->result();
    }

    function get_Gboard()
    {
        $this->db->select('articles.*');
        $this->db->from('articles AS articles');
        $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
        $this->db->where('articles.published', 1);
        $this->db->where('eria_expert_categories.category', 'Research Associates');

        $queryT = $this->db->get();

        return $queryT->result();
    }

    function createContactUs($data)
    {
        $data = $this->db->insert('contacts', $data);

        return $data;
    }

    function card_design()
    {
        $this->db->select('eria_card.*');
        $this->db->from('eria_card AS eria_card');
        $this->db->where('eria_card.published', 1);

        $queryT = $this->db->get();

        return $queryT->result();
    }

    function getAllCardOnPages()
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('pages.page_id, pages.uri, pages.menu_title, eria_card_randoms_pages.card_random_id');
            $this->db->where('pages.parent_id', 0);
            $this->db->where('pages.published', 1);
            $this->db->join('eria_card_randoms_pages', 'eria_card_randoms_pages.page_id = pages.page_id', 'inner');
            $query = $this->db->get('pages');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getCardByPage($page_id)
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('eria_card_randoms_pages.*');
            $this->db->where('eria_card_randoms_pages.page_id', $page_id);
            
            $query = $this->db->get('eria_card_randoms_pages');

            $results = $query->result();
            
            if (isset($results)) {
                $data = array();
                foreach ($results as $key => $value) {
                    if (($value->card_random_id)) {
                        $data[] = $value->card_random_id;
                    }
                    
                }
            } else {
                $data = array();
            }
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllPages()
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('pages.page_id, pages.uri, pages.menu_title');
            $this->db->where('pages.parent_id', 0);
            $this->db->where('pages.published', 1);
            $query = $this->db->get('pages');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
}