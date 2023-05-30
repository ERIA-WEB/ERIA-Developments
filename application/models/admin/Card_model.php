<?php

class Card_model extends CI_Model
{
    function getAll_card()
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('*');
            $query = $this->db->get('eria_card');
            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllCardRandomByTypeCard($sort_by)
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('eria_card_randoms.*');
            $this->db->where('eria_card_randoms.is_delete', 2);
            $this->db->where('eria_card_randoms.sort_by', $sort_by);
            $query = $this->db->get('eria_card_randoms');

            $data = $query->result();
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllCardRandom()
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('eria_card_randoms.*');
            $this->db->where('eria_card_randoms.is_delete', 2);
            $query = $this->db->get('eria_card_randoms');

            $data = $query->result();
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getCardRandomPages($page_id, $card_random_id)
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('eria_card_randoms_pages.*');
            $this->db->where('eria_card_randoms_pages.page_id', $page_id);
            $this->db->where('eria_card_randoms_pages.card_random_id', $card_random_id);
            $query = $this->db->get('eria_card_randoms_pages');

            $results = $query->row();
            
            return $result;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllPages()
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('pages.*');
            $this->db->where('pages.parent_id', 0);
            $this->db->where('pages.published', 1);
            $query = $this->db->get('pages');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_card($id)
    {
        $users = $this->session->userdata('logged_in');
        try {
            $this->db->select('*');
            $this->db->where('c_id', $id);
            $query = $this->db->get('eria_card');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPageCardRandoms($id)
    {
        $users = $this->session->userdata('logged_in');
        try {
            $this->db->select('*');
            $this->db->where('c_id', $id);
            $this->db->where('published', 1);
            $this->db->where('is_delete', 2);
            $query = $this->db->get('eria_card_randoms');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getCategoryResearchAreasCardByCategoryType($category_type)
    {
        try {
            $this->db->select('*');
            $this->db->where('category_type', $category_type);
            $this->db->where('uri!=', 'co-publications');
            $this->db->where('published', 1);
            $query = $this->db->get('categories');

            $result = $query->result();
            return $result;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getArticleTopicsCardByCategoryType($category_type)
    {
        try {
            $this->db->select('`categories`.`category_id`,`categories`.`category_name`,`article_topics`.`article_id`,`article_topics`.`topic_id`,`articles`.`article_id`,`articles`.`title`');
            $this->db->where('categories.category_type', $category_type);
            $this->db->where('categories.published', 1);
            $this->db->where('articles.published', 1);
            $this->db->group_by("articles.article_id");
            $this->db->order_by("articles.posted_date", "DESC");
            $this->db->join('article_topics', 'article_topics.topic_id = categories.category_id', 'inner');
            $this->db->join('articles', 'articles.article_id = article_topics.article_id', 'inner');
            $query = $this->db->get('categories');

            $data = $query->result();

            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getCategoryResearchById($category_id)
    {
        try {
            $this->db->select('*');
            $this->db->where_in('category_id', $category_id);
            $this->db->where('category_type', 'topics');
            $query = $this->db->get('categories');
            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getArticleTopicByArticleId($article_id)
    {
        try {
            $this->db->select('*');
            $this->db->where_in('article_id', $article_id);
            $query = $this->db->get('articles');
            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function update_card_randoms_pages($result)
    {
        $pages = $result['page_id'];
        $card_random_id = $result['card_id'];

        $this->db->where('card_random_id', $card_random_id);
        $this->db->delete('eria_card_randoms_pages');

        foreach ($pages as $key => $value) {
            $data = [
                'page_id'           => $value,
                'card_random_id'    => $card_random_id
            ];

            $this->db->insert('eria_card_randoms_pages', $data);
        }

        return TRUE;
    }

    function updateCard($id, $newCard)
    {
        try {
            
            if (!empty($newCard['sub_heading'])) {
                $subheading = $newCard['sub_heading'];
            } else {
                $subheading = '';
            }
            
            $data = [
                'c_name'        => $newCard['c_name'],
                'sub_heading'   => $subheading,
            ];
            
            $this->db->set($data);
            $this->db->where('c_id', $id);
            $this->db->update('eria_card');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateCardRandoms($id, $newCard)
    {
        try {
            $this->db->set($newCard);
            $this->db->where('c_id', $id);
            $this->db->update('eria_card_randoms');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_inside_card($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('pc_id', $id);
            $query = $this->db->get('eria_page_card');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAll_a_card($id)
    {
        $users = $this->session->userdata('logged_in');

        try {
            $this->db->select('*');
            $query = $this->db->get('eria_card');
            $dq =   $query->result();

            $typeData = array();
            foreach ($dq as $aid => $query) {
                if ($query->published == 1) {
                    $typeData[$aid]['ref'] = $query->ref;
                    $typeData[$aid]['c_id'] = $query->c_id;
                    $typeData[$aid]['published'] = $query->published;
                    $typeData[$aid]['nm'] = $this->get_num($id, $query->c_id);
                }
            }

            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAll_article_card($id)
    {
        $users = $this->session->userdata('logged_in');
        try {
            $this->db->select('*');
            $query = $this->db->get('eria_card');
            $dq =   $query->result();
            $typeData = array();
            foreach ($dq as $aid => $query) {
                if ($query->published == 1) {
                    $typeData[$aid]['ref'] = $query->ref;
                    $typeData[$aid]['c_id'] = $query->c_id;
                    $typeData[$aid]['published'] = $query->published;
                    $typeData[$aid]['nm'] = $this->get_num_by_every_article($id, $query->c_id);
                }
            }

            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_article_num($pid, $ref)
    {
        $this->db->select('*');
        $this->db->from('eria_article_card');
        $this->db->where('ptype', $pid);
        $this->db->where('card', $ref);
        $query = $this->db->get();

        $num = $query->num_rows();

        if ($num == 0) {
            $n = 0;
        } else {
            $n = $query->row('number');
        }

        return $n;
    }

    function get_num($pid, $ref)
    {
        $this->db->select('*');
        $this->db->from('eria_page_card'); // eria_page_card
        $this->db->where('ptype', $pid);
        $this->db->where('card', $ref);
        $query = $this->db->get();

        $num = $query->num_rows();

        if ($num == 0) {
            $n = 0;
        } else {
            $n = $query->row('number');
        }

        return $n;
    }

    function get_num_by_every_article($pid, $ref)
    {
        $this->db->select('*');
        $this->db->from('eria_article_card');
        $this->db->where('ptype', $pid);
        $this->db->where('card', $ref);
        $query = $this->db->get();

        $num = $query->num_rows();

        if ($num == 0) {
            $n = 0;
        } else {
            $n = $query->row('number');
        }

        return $n;
    }

    function assignCart($id, $page, $num)
    {
        $this->db->select('*');
        $this->db->from('eria_page_card');
        $this->db->where('ptype', $id);
        $this->db->where('card', $page);
        $query = $this->db->get();

        $numb = $query->num_rows();

        if ($numb == 0) {
            $newCus = array(
                'number' => $num,
                'card' => $page,
                'ptype' => $id,
            );

            $this->db->insert('eria_page_card', $newCus);
        } else {
            $this->db->set('number', $num);
            $this->db->where('ptype', $id);
            $this->db->where('card', $page);
            $this->db->update('eria_page_card');
        }
    }

    function insert_card_random($data)
    {
        $result = $this->db->insert('eria_card_randoms', $data);

        return $result;
    }

    function insert_card($data)
    {
        $this->db->insert('eria_card', $data);
        $eria_card_id = $this->db->insert_id();

        return $eria_card_id;
    }

    function update_card_random($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('c_id', $id);
            $result = $this->db->update('eria_card_randoms');

            return $result;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function update_card($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('c_id', $id);
            $result = $this->db->update('eria_card');

            return $result;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function update_card_randoms($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('c_id', $id);
            $result = $this->db->update('eria_card_randoms');

            return $result;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getOneCardRandom($c_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', $c_id);
            $result = $this->db->get('eria_card_randoms');

            return $result->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getOneCard($c_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('c_id', $c_id);
            $result = $this->db->get('eria_card');

            return $result->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function assign_Cart($id, $page, $num)
    {
        
        $this->db->select('*');
        $this->db->from('eria_article_card');
        $this->db->where('ptype', $id);
        $this->db->where('card', $page);
        $query = $this->db->get();

        $numb = $query->num_rows();
        
        if ($numb == 0) {
            $newCus = array(
                'number' => $num,
                'card' => $page,
                'ptype' => $id,
            );
            
            $this->db->insert('eria_article_card', $newCus);
        } else {
            $this->db->set('number', $num);
            $this->db->where('ptype', $id);
            $this->db->where('card', $page);
            $this->db->update('eria_article_card');
        }
    }

    function update_inside_card($id, $newCard)
    {
        try {
            $this->db->set($newCard);
            $this->db->where('pc_id', $id);
            $this->db->update('eria_page_card');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAll_article($id)
    {
        $this->db->select('*');
        $this->db->from('articles');
        $this->db->where('article_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_All_recent()
    {
        $this->db->select('*');
        $this->db->where('published', 1);
        $this->db->where('article_type!=', 'publications');
        $this->db->order_by('article_id', 'DESC');

        $query = $this->db->get('articles');

        return $query->result();
    }

    function get_Allassigned_recent()
    {
        $this->db->select('*');
        $this->db->where('published', 1);
        $this->db->where('article_type!=', 'publications');
        $this->db->order_by('sort', 'ASC');
        $this->db->join('articles', 'articles.article_id = eria_recent_updates.article', 'left');
        
        $query = $this->db->get('eria_recent_updates');

        return $query->result();
    }
}