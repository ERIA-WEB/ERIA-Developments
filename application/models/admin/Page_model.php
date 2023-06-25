<?php

class Page_model extends CI_Model
{
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

    function getOneSubPageData($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('id', $id);
            $query = $this->db->get('pages_sub');

            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getOneSubChildPageData($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('id', $id);
            $query = $this->db->get('pages_sub_child');

            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSubPageContent($page_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('page_id', $page_id);
            $query = $this->db->get('pages_sub');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSubChildPageContent($page_sub_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('page_sub_id', $page_sub_id);
            $query = $this->db->get('pages_sub_child');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getMetaContentPublicationSEO($uri) 
    {
        try {
            $this->db->select('categories.*');
            $this->db->where('uri', $uri);
            $this->db->where('published', 1);
            $this->db->where('category_type', 'pubtypes');
            $query = $this->db->get('categories');

            $results = $query->result();
            
            if (!empty($results)) {
                foreach ($results as $content) {
                    $data['meta_title'] = $content->category_name;
                    $data['meta_description'] = $content->meta_description ? $content->meta_description: $content->category_name;
                    $data['meta_keywords'] = $content->meta_keywords ? $content->meta_keywords: str_replace(' ', ', ', $content->category_name);
                    $data['image_name'] = $content->image_name;
                }
            } else {
                $data['meta_title'] = '';
                $data['meta_description'] = '';
                $data['meta_keywords'] = '';
                $data['image_name'] = '';
            }
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getMetaContentProgrammesSEO($uri)
    {
        try {
            $this->db->select('categories.*');
            $this->db->where('uri', $uri);
            $this->db->where('published', 1);
            $this->db->where('category_type', 'categories');
            $query = $this->db->get('categories');

            $results = $query->result();
            
            if (!empty($results)) {
                foreach ($results as $content) {
                    $data['meta_title'] = $content->category_name;
                    $data['meta_description'] = $content->meta_description ? $content->meta_description: $content->category_name;
                    $data['meta_keywords'] = $content->meta_keywords ? $content->meta_keywords: str_replace(' ', ', ', $content->category_name);
                    $data['image_name'] = $content->image_name;
                }
            } else {
                $data['meta_title'] = '';
                $data['meta_description'] = '';
                $data['meta_keywords'] = '';
                $data['image_name'] = '';
            }
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getMetaContenSEO($uri)
    {
        try {
            $this->db->select('categories.*');
            $this->db->where('uri', $uri);
            $this->db->where('published', 1);
            $this->db->where('category_type', 'topics');
            $query = $this->db->get('categories');

            $results = $query->result();
            
            if (!empty($results)) {
                foreach ($results as $content) {
                    $data['meta_title'] = $content->category_name;
                    $data['meta_description'] = $content->meta_description;
                    $data['meta_keywords'] = $content->meta_keywords;
                    $data['image_name'] = $content->image_name;
                }
            } else {
                $data['meta_title'] = '';
                $data['meta_description'] = '';
                $data['meta_keywords'] = '';
                $data['image_name'] = '';
            }
            
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getMembers($article_type)
    {
        try {
            $this->db->select('*');
            $this->db->where('published', '1');
            $this->db->where_in('article_type', $article_type);
            $query = $this->db->get('articles');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    public function getAllMembers()
    {
        try {
            $this->db->select('*');
            $query = $this->db->get('members');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function createMemberGovernBoard($data)
    {
        try {

            $getAllMemberGovernBoardData = $this->Page_model->getAllMembers();

            if (isset($getAllMemberGovernBoardData)) {
                $this->db->insert('members', $data);
            }

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getMemberByPageID($pageID)
    {
        try {
            $this->db->select('members.article_id');
            $this->db->where('page_id', $pageID);
            $query = $this->db->get('members');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_content_id($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('np_id', $id);
            $query = $this->db->get('pub_slider');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_pslider()
    {
        try {
            $this->db->select('*');
            $query = $this->db->get('pub_slider');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertPage($data)
    {
        try {
            $this->db->insert('pages', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertSubPage($data)
    {
        try {
            $this->db->insert('pages_sub', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertSubChildPage($data)
    {
        try {
            $this->db->insert('pages_sub_child', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_expertCat($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('ec_id', $id);
            $query = $this->db->get('eria_expert_categories');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertpSlider($data)
    {
        try {
            $this->db->insert('pub_slider', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function inserRecent($id, $sort)
    {
        $data = array(
            'article' => $id,
            'sort' => $sort
        );

        try {
            $this->db->insert('eria_recent_updates', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSubCategoryMultimedia()
    {
        try {
            $this->db->select('eria_expert_sub_categories.*');
            $this->db->where('eria_expert_sub_categories.article_type_sub', 'multimedia');
            $query = $this->db->get('eria_expert_sub_categories');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateFeature($asean, $pub, $updates, $multimedia)
    {
        $this->db->set('feature', NULL);
        $this->db->update('articles');
        

        if (!empty($asean)) {
            $this->db->set('feature', 'asean');
            $this->db->where('article_id', $asean);
            $this->db->update('articles');
            
        } 
        
        if (!empty($pub)) {
            $this->db->set('feature', 'pub');
            $this->db->where('article_id', $pub);
            $this->db->update('articles');
            
        }
        
        if (!empty($updates)) {
            $this->db->set('feature', 'updates');
            $this->db->where('article_id', $updates);
            $this->db->update('articles');
        }
        
        if (!empty($multimedia)) {
            $this->db->set('feature', 'multimedia');
            $this->db->where('article_id', $multimedia);
            $this->db->update('articlesD');
        }
        
        return TRUE;
    }

    function updatePage($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('page_id', $id);
            $this->db->update('pages');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateSubPage($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('pages_sub');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateSubChildPage($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('pages_sub_child');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function update_Pslider($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('np_id', $id);
            $this->db->update('pub_slider');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateAbout($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('aid', $id);
            $this->db->update('about_us');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateResearch($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('research');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getFeatureMultimedia($feature)
    {
        try {
            $this->db->select('articles.*,eria_expert_categories.category');
            $this->db->where('article_type', 'multimedia');
            $this->db->where('feature', $feature);
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            $query = $this->db->get('articles');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getFeature($type)
    {
        try {
            $this->db->select('*');
            $this->db->where('feature', $type);
            $query = $this->db->get('articles');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function create_agenda_event($event_id, $result)
    {
        try {
            
            $agenda_data = $this->getAgendaListByArticleId($event_id);
            if (empty($agenda_data)) {
                foreach($result as $value) {
                    $this->db->insert('eria_agenda_event', $value);
                }
                
            } else {
                /*
                ** Delete exist data before save
                */ 
                $this->db->where('event_id', $event_id);
                $this->db->delete('eria_agenda_event');

                /*
                ** Add new
                */ 
                foreach($result as $value) {
                    $this->db->insert('eria_agenda_event', $value);
                }
                
            }
            
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function create_agenda_detail($event_id, $data)
    {
        try {

            $this->db->where('event_id', $event_id);
            $this->db->delete('eria_agenda_detail');
            
            /*
            ** Update detail
            */ 
            $this->db->insert('eria_agenda_detail', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAgendaDetailAllByArticleId($event_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('event_id', $event_id);
            $query = $this->db->get('eria_agenda_detail');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAgendaListByArticleId($event_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('event_id', $event_id);
            $query = $this->db->get('eria_agenda_event');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAgendaDetailByArticleId($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('event_id', $id);
            $query = $this->db->get('eria_agenda_detail');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getEventPeople($article_type)
    {
        try {
            $this->db->select('*');
            $this->db->where('article_type', $article_type);
            $this->db->order_by('article_id', 'desc');
            $query = $this->db->get('articles');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getEventDataByPeopleId($people_id)
    {
        try {
            $this->db->select('eria_card_people.*, `articles`.`article_id`, `articles`.`title`');
            $this->db->where('people_id', $people_id);
            $this->db->join('articles', 'articles.article_id = eria_card_people.event_id', 'inner');
            $query = $this->db->get('eria_card_people');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insert_event_people($data)
    {
        try {
            $people_id = $data['people_id'];
            $modified_by = $data['modified_by'];

            $this->db->where('people_id', $people_id);
            $this->db->delete('eria_card_people');

            foreach ($data['event_id'] as $value) {
                $newCardPeopleEvent = array(
                    'people_id'     => $people_id,
                    'event_id'      => $value,
                    'modified_by'   => $modified_by,
                );

                $this->db->insert('eria_card_people', $newCardPeopleEvent);
            }

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getEventByPeopleId($people_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('people_id', $people_id);
            $query = $this->db->get('eria_card_people');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpert_catogeries($pid)
    {
        try {
            $this->db->select('*');
            $this->db->where('parent', $pid);
            $query = $this->db->get('eria_expert_categories');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllSubCategoryExpert()
    {
        try {
            $this->db->select('*');
            $query = $this->db->get('eria_expert_sub_categories');
            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllDepartementByActive()
    {
        try {
            $this->db->select('*');
            $this->db->where('status', 1);
            $query = $this->db->get('eria_departement');
            
            $data = $query->result();

            return $data;
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

    function getArticleExpertDepartementById($article_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('article_id', $article_id);
            $this->db->join('eria_departement', 'eria_departement.id = article_experts_departements.eria_expert_departement_id', 'inner');
            $query = $this->db->get('article_experts_departements');
            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getDepartementByIDs($departement_id)
    {
        try {
            $this->db->select('*');
            $this->db->where_in('id', $departement_id);
            $query = $this->db->get('eria_departement');
            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpertDepartementByCategoryID($category_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('eria_expert_category_id', $category_id);
            $query = $this->db->get('eria_expert_departement');
            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpertDepartementRelatedAllCategories($departement_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('eria_departement_id', $departement_id);
            $query = $this->db->get('eria_expert_departement');
            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpertDepartementRelatedCategories($departement_id)
    {
        try {
            $this->db->select('eria_expert_departement.eria_expert_category_id');
            $this->db->where('eria_departement_id', $departement_id);
            $query = $this->db->get('eria_expert_departement');
            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpertSelectCategories($categoryIDs)
    {
        try {

            $this->db->select('eria_expert_categories.ec_id, eria_expert_categories.category');
            $this->db->where_in('ec_id', $categoryIDs);
            $query = $this->db->get('eria_expert_categories');

            $categories = $query->result();

            return $categories;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpertCategories($categoryIDs)
    {
        try {
            if (isset($categoryIDs)) {
                $this->db->select('eria_expert_categories.ec_id, eria_expert_categories.category');
                $this->db->where_in('ec_id', $categoryIDs);
                
                $query = $this->db->get('eria_expert_categories');

                $categories = array();
                foreach ($query->result() as $value) {
                    $categories[] = $value->category;
                }
            } else {
                $categories = array();
            }
            
            return $categories;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpertDepartementByID($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('id', $id);
            $query = $this->db->get('eria_departement');

            return $query->result()[0];
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpertDepartement()
    {
        try {
            $this->db->select('*');
            $this->db->where('status', 1);
            $this->db->order_by("id", "desc");
            $query = $this->db->get('eria_departement');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpert_subCatogeries($pid)
    {
        try {
            $this->db->select('*');
            $this->db->where('es_status', 1);
            $this->db->where('eria_expert_sub_categories.ec_id!=', 0);
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = eria_expert_sub_categories.ec_id', 'left');
            $this->db->where('parent', $pid);
            $query = $this->db->get('eria_expert_sub_categories');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getExpert_subDepartment($pid)
    {
        try {
            $this->db->select('*');
            $this->db->where('es_status', 1);
            $this->db->where('ec_id', 0);
            //  $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = eria_expert_sub_categories.ec_id', 'left');
            //  $this->db->where('parent', $pid);
            $query = $this->db->get('eria_expert_sub_categories');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSub_pages($pid)
    {
        try {
            $this->db->select('*');
            $this->db->where('parent_id', $pid);
            $this->db->where('is_delete !=', '1');
            $data = $this->db->get('pages');

            return $data->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSubPagesById($page_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('page_id', $page_id);
            $data = $this->db->get('pages');
            return $data->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSubChildPages()
    {
        try {
            $this->db->select('*');
            $data = $this->db->get('pages_sub');

            return $data->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSubMenuPageChildById($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('id', $id);
            $data = $this->db->get('pages_sub');

            return $data->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function create_submenu_child($data)
    {
        try {
            $this->db->insert('pages_sub', $data);

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function update_submenu_child($id, $data)
    {
        try {
            
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('pages_sub');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllPageByParentID($parent_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('published', 1);
            $this->db->where('parent_id', $parent_id);
            $data = $this->db->get('pages');

            return $data->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAllPageParents()
    {
        try {
            $this->db->select('*');
            $this->db->where('published', 1);
            $data = $this->db->get('pages');

            return $data->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function _getAllSubPage()
    {
        try {
            $this->db->select('*');
            $query = $this->db->get('pages');

            $result = $query->result();

            $data = array();

            foreach ($result as $item)
            {
                $data[$item->page_id] = $item->menu_title;
            }

            return $data;

        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
        
    }

    function getSubCategoryBySubID($subId)
    {
        try {
            $this->db->select('*');
            $this->db->where('eria_expert_subcategory_id', $subId);
            $query = $this->db->get('article_experts_sub_category');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSubCategoryByArticle($article_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('article_id', $article_id);
            $query = $this->db->get('article_experts_sub_category');

            return $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertArticle($data, $cat, $topic, $related, $editor, $heditor, $author, $hauthor, $mcatogery, $type, $related_publication,  $eria_expert_subcategory)
    {
        try {

            /* 
            ** For Table articles
            */
            $this->db->insert('articles', $data);
            $a_id = $this->db->insert_id();
            if ($cat) {
                foreach ($cat as $cat) {
                    $newA = array(
                        'category_id' => $cat,
                        'article_id' => $a_id,
                    );

                    $this->db->insert('article_categories', $newA);
                }
            }

            /* 
            ** ERIA Experts Subcategory
            ** For Table article_experts_departements
            */
            if ($eria_expert_subcategory) {

                $this->db->select('article_experts_departements.*');
                $this->db->where('article_id', $a_id);
                $subcat_query = $this->db->get('article_experts_departements');

                if (empty($subcat_query->result())) {
                    foreach ($eria_expert_subcategory as $subcat) {
                        $data_expert_subcategory = [
                            'article_id'                    => $a_id,
                            'eria_expert_category_id'       => $data['sub_experts'],
                            'eria_expert_departement_id'    => $subcat,
                        ];

                        $this->db->insert('article_experts_departements', $data_expert_subcategory);
                    }
                } else {
                    $get_subcat = $subcat_query->result();
                    foreach ($get_subcat as $get_) {
                        $getsubcat[] = $get_->eria_expert_subcategory_id;
                    }

                    $this->db->where('article_id', $a_id);
                    $this->db->delete('article_experts_departements');

                    foreach ($eria_expert_subcategory as $subcat) {
                        $data_expert_subcategory = [
                            'article_id'                    => $a_id,
                            'eria_expert_category_id'       => $data['sub_experts'],
                            'eria_expert_departement_id'    => $subcat,
                        ];

                        $this->db->insert('article_experts_departements', $data_expert_subcategory);
                    }
                }
            }

            /* 
            ** Article Topics
            */
            if ($topic) {
                foreach ($topic as $cat) {

                    $newA = array(
                        'topic_id' => $cat,
                        'article_id' => $a_id,
                    );
                    $this->db->insert('article_topics', $newA);
                }
            }

            /* 
            ** Related Articles
            */
            if ($related) {
                foreach ($related as $cat) {

                    $newA = array(
                        'to_article_id' => $cat,
                        'article_id' => $a_id,
                    );

                    $this->db->insert('article_relateds', $newA);
                }
            }

            /* 
            ** Reminder: previously table in live eria is a (articles_relateds) for related publication 
            **        and then iam create to new table for related publications (article_relateds_publication)
            **        there is a conflict with the related article a new one
            **        Because related article is not there in the DB Live ERIA before
            ** Related Publications
            */
            if ($related_publication) {
                foreach ($related_publication as $relatedpublication) {
                    $newA = array(
                        'to_article_id' => $relatedpublication,
                        'article_id' => $a_id,
                    );

                    $this->db->insert('article_relateds_publication', $newA);
                }
            }

            /* 
            ** For Table article_person (EDITOR)
            */
            if ($editor) {
                foreach ($editor as $cat) {
                    $newA = array(
                        'ec_id' => $cat,
                        'article_id' => $a_id,
                        'ap_type' => 'Editor',
                        'show_type' => 'Inside',
                    );

                    $this->db->insert('article_persons', $newA);
                }
            }

            /* 
            ** For Table article_person (HIGHLIGHT EDITOR)
            */
            if ($heditor) {
                foreach ($heditor as $cat) {
                    $newA = array(
                        'ec_id' => $cat,
                        'article_id' => $a_id,
                        'ap_type' => 'Editor',
                        'show_type' => 'Highlite',
                    );

                    $this->db->insert('article_persons', $newA);
                }
            }

            /* 
            ** For Table article_person (AUTHOR)
            */
            if ($author) {
                foreach ($author as $cat) {
                    $newA = array(
                        'ec_id' => $cat,
                        'article_id' => $a_id,
                        'ap_type' => 'Author',
                        'show_type' => 'Inside',
                    );

                    $this->db->insert('article_persons', $newA);
                }
            }

            /* 
            ** For Table article_person (HIGHLIGHT AUTHOR)
            */
            if ($hauthor) {
                foreach ($hauthor as $cat) {
                    $newA = array(
                        'ec_id' => $cat,
                        'article_id' => $a_id,
                        'ap_type' => 'Author',
                        'show_type' => 'Highlite',
                    );

                    $this->db->insert('article_persons', $newA);
                }
            }

            /* 
            ** For Table article_multimedia_tag
            */
            if ($mcatogery) {
                foreach ($mcatogery as $cat) {
                    $newA = array(
                        'cato' => $cat,
                        'a_id' => $a_id,
                        'am_type' => $type,
                    );

                    $this->db->insert('article_multimedia_tag', $newA);
                }
            }

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateNewImage($new_image_data)
    {
        $whitelist = array('127.0.0.1', "::1", "localhost");

        $im = $new_image_data['base_image'];
        $title = $new_image_data['title_image'];
        $documentRoot = $this->config->item('base_path');

        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            $cacheFolder = $documentRoot.$new_image_data['type_page'].'';
        } else {
            $cacheFolder = $documentRoot."/".$new_image_data['type_page'].'';
        }
        
        $thumb_width  = $new_image_data['width'];
        $thumb_height = $new_image_data['height'];
        $what = getimagesize(base_url().$im);
        switch( $what['mime'] ){
            case 'image/png' : $orig_image = imagecreatefrompng(base_url().$im);break;
            case 'image/jpeg': $orig_image = imagecreatefromjpeg(base_url().$im);break;
            case 'image/gif' : $orig_image = imagecreatefromgif(base_url().$im);
        }

        list($width, $height, $type, $attr) = getimagesize(base_url().$im);
        
        
        
        $ratioW = $width / $thumb_width;
        $ratioH = $height / $thumb_height;

        $ratioU = ($ratioW > $ratioH) ? $ratioH:$ratioW;

        $newWidth = $width / $ratioU;
        $newHeight = $height / $ratioU;
        
        $cacheFile = $cacheFolder."/".str_replace(' ', '-', $title).".png";
        
        $sm_image = imagecreatetruecolor($newWidth, $newHeight) or die ("Cannot Initialize new gd image stream");
        imagesavealpha($sm_image, true);
        $black = imagecolorallocate($sm_image, 0, 0, 0);
        imagefilledrectangle($sm_image, 0, 0, $newWidth, $newHeight, $black);
        $trans_colour = imagecolorallocatealpha($sm_image, 0, 0, 0, 127);
        imagefill($sm_image, 0, 0, $trans_colour);
        
        imagecopyresampled($sm_image, $orig_image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($orig_image), imagesy($orig_image));
        
        ob_start();
        imagepng($sm_image, $cacheFile, 5);
        
        $result = $new_image_data['type_page']."/".str_replace(' ', '-', $title).".png";
        
        return $result;
    }
    
    function resizeImageCover($image_cover_data)
    {
        $whitelist = array('127.0.0.1', "::1", "localhost");

        $im = $image_cover_data['base_image'];
        $title = $image_cover_data['title_image'];
        $documentRoot = $this->config->item('base_path');

        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            $cacheFolder = $documentRoot.'caching/'.$image_cover_data['type_page'].'';
        } else {
            $cacheFolder = $documentRoot."/caching".$image_cover_data['type_page'].'';
        }
        
        $thumb_width  = $image_cover_data['width'];
        $thumb_height = $image_cover_data['height'];
        $what = getimagesize(base_url().$im);
        switch( $what['mime'] ){
            case 'image/png' : $orig_image = imagecreatefrompng(base_url().$im);break;
            case 'image/jpeg': $orig_image = imagecreatefromjpeg(base_url().$im);break;
            case 'image/jpg': $orig_image = imagecreatefromjpeg(base_url().$im);break;
            case 'image/gif' : $orig_image = imagecreatefromgif(base_url().$im);
        }

        list($width, $height, $type, $attr) = getimagesize(base_url().$im);
        
        
        
        $ratioW = $width / $thumb_width;
        $ratioH = $height / $thumb_height;

        $ratioU = ($ratioW > $ratioH) ? $ratioH:$ratioW;

        $newWidth = $width / $ratioU;
        $newHeight = $height / $ratioU;
        
        $cacheFile = $cacheFolder."/".str_replace(' ', '-', $title).".png";
        
        $sm_image = imagecreatetruecolor($newWidth, $newHeight) or die ("Cannot Initialize new gd image stream");
        
        imagesavealpha($sm_image, true);
        $black = imagecolorallocate($sm_image, 0, 0, 0);
        imagefilledrectangle($sm_image, 0, 0, $newWidth, $newHeight, $black);
        $trans_colour = imagecolorallocatealpha($sm_image, 0, 0, 0, 127);
        imagefill($sm_image, 0, 0, $trans_colour);
        
        imagecopyresampled($sm_image, $orig_image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($orig_image), imagesy($orig_image));
        
        ob_start();
        
        imagepng($sm_image, $cacheFile, 5);
        
        $result = base_url()."caching/uploads/".$image_cover_data['type_page']."/".str_replace(' ', '-', $title).".png";
        
        return $result;
    }
    
    function getPeopleRelatedAgendaId($event_id)
    {
        $this->db->select('eria_agenda_related.*');
        $this->db->where('event_id', $event_id);
        $result = $this->db->get('eria_agenda_related');

        return $result->result();
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

    function getAllPeoples()
    {
        try {
            $this->db->select('articles.*');
            $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified']);
            $result = $this->db->get('articles');

            $data = $result->result();

            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        } 
    }

    function getAllPeoplesByActive()
    {
        try {
            $this->db->select('articles.*');
            $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified']);
            $this->db->where('published', 1);
            $result = $this->db->get('articles');

            $data = $result->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAuthorIDByName($title)
    {
        $this->db->select('articles.article_id');
        $this->db->where_in('title', $title);
        $this->db->where_in('article_type', ['experts', 'associates', 'keystaffs', 'boardmessages', 'fellows', 'unclassified']); // ['experts', 'keystaffs', 'fellows', 'associates']
        $query = $this->db->get('articles');

        return $query->result();
    }

    function updateArticle($id, $data, $cat, $topic, $related, $editor, $heditor, $author, $hauthor, $mcatogery, $tp, $related_publication, $eria_expert_subcategory)
    {
        try {
            $this->db->set($data);
            $this->db->where('article_id', $id);
            $this->db->update('articles');

            /*
            ** Speakers
            */
            if (!empty($data['presentations'])) {
                $speaker_data = explode(', ', $data['presentations']);

                $this->db->where('event_id', $id);
                $this->db->delete('eria_agenda_related');

                foreach($speaker_data as $value)
                {
                    $data_eria_agenda_related = [
                        'event_id'  => $id,
                        'people_id' => $value,
                    ];

                    $this->db->insert('eria_agenda_related', $data_eria_agenda_related);
                }
            }

            /*
            ** Eria Expert Subcategory
            */
            if (!empty($eria_expert_subcategory)) {
                $this->db->select('article_experts_departements.*');
                $this->db->where('article_id', $id);
                $subcat_query = $this->db->get('article_experts_departements');

                if (empty($subcat_query->result())) {
                    foreach ($eria_expert_subcategory as $subcat) {
                        $data_expert_subcategory = [
                            'article_id'                    => $id,
                            'eria_expert_category_id'       => $data['sub_experts'],
                            'eria_expert_departement_id'    => $subcat,
                        ];

                        $this->db->insert('article_experts_departements', $data_expert_subcategory);
                    }
                } else {
                    $get_subcat = $subcat_query->result();
                    foreach ($get_subcat as $get_) {
                        $getsubcat[] = $get_->eria_expert_subcategory_id;
                    }

                    $this->db->where('article_id', $id);
                    $this->db->delete('article_experts_departements');

                    foreach ($eria_expert_subcategory as $subcat) {
                        $data_expert_subcategory = [
                            'article_id'                    => $id,
                            'eria_expert_category_id'       => $data['sub_experts'],
                            'eria_expert_departement_id'    => $subcat,
                        ];

                        $this->db->insert('article_experts_departements', $data_expert_subcategory);
                    }

                }
            }

            /*
            ** Category
            */
            if (!empty($cat)) {
                $this->db->select('article_categories.*');
                $this->db->where('article_id', $id);
                $cat_query = $this->db->get('article_categories');

                if (empty($cat_query->result())) {
                    foreach ($cat as $cat) {
                        $newA = array(
                            'category_id' => $cat,
                            'article_id' => $id,
                        );

                        $this->db->insert('article_categories', $newA);
                    }
                } else {
                    $get_cat = $cat_query->result();
                    $this->db->where('article_id', $id);
                    $this->db->delete('article_categories');
                    foreach ($cat as $cat) {
                        $newA = array(
                            'category_id' => $cat,
                            'article_id' => $id,
                        );

                        $this->db->insert('article_categories', $newA);
                    }
                }
            }

            /*
            ** Topics
            */
            if (!empty($topic)) {
                $this->db->select('article_topics.*');
                $this->db->where('article_id', $id);
                $topic_query = $this->db->get('article_topics');

                if (empty($topic_query->result())) {
                    foreach ($topic as $cat) {
                        $newA = array(
                            'topic_id' => $cat,
                            'article_id' => $id,
                        );
                        $this->db->insert('article_topics', $newA);
                    }
                } else {
                    $this->db->where('article_id', $id);
                    $this->db->delete('article_topics');
                    foreach ($topic as $cat) {
                        $newA = array(
                            'topic_id' => $cat,
                            'article_id' => $id,
                        );
                        $this->db->insert('article_topics', $newA);
                    }
                }
            }

            /* 
            ** Reminder: previously table in live eria is a (articles_relateds) for related publication 
            **        and then iam create to new table for related publications (article_relateds_publication)
            **        there is a conflict with the related article a new one
            **        Because related article is not there in the DB Live ERIA before
            ** Related Publications
            */
            if (!empty($related_publication)) {

                $this->db->select('article_relateds_publication.*');
                $this->db->where('article_id', $id);
                $relatedpub_query = $this->db->get('article_relateds_publication');

                if (empty($relatedpub_query->result())) {
                    foreach ($related_publication as $relatedpublication) {
                        $newA = array(
                            'to_article_id' => $relatedpublication,
                            'article_id' => $id,
                        );

                        $this->db->insert('article_relateds_publication', $newA);
                    }
                } else {

                    $this->db->where('article_id', $id);
                    $this->db->delete('article_relateds_publication');

                    foreach ($related_publication as $relatedpublication) {
                        $newA = array(
                            'to_article_id' => $relatedpublication,
                            'article_id' => $id,
                        );

                        $this->db->insert('article_relateds_publication', $newA);
                    }
                }
                
            }

            /*
            ** Related Article
            */
            if (!empty($related)) {
                $this->db->select('article_relateds.*');
                $this->db->where('article_id', $id);
                $related_query = $this->db->get('article_relateds');
                if (empty($related_query->result())) {
                    foreach ($related as $cat) {
                        $newA = array(
                            'to_article_id' => $cat,
                            'article_id' => $id,
                        );

                        $this->db->insert('article_relateds', $newA);
                    }
                } else {
                    $this->db->where('article_id', $id);
                    $this->db->delete('article_relateds');

                    foreach ($related as $cat) {
                        $newA = array(
                            'to_article_id' => $cat,
                            'article_id' => $id,
                        );

                        $this->db->insert('article_relateds', $newA);
                    }
                }
            }

            /*
            ** Editor Article Person
            */
            if (!empty($editor)) {
                $this->db->select('article_persons.*');
                $this->db->where('article_id', $id);
                $this->db->where('ap_type', 'Editor');
                $this->db->where('show_type', 'Inside');
                $person1_query = $this->db->get('article_persons');
                
                if (empty($person1_query->result())) {
                    foreach ($editor as $cat) {
                        $neweditor = array(
                            'article_id' => $id,
                            'ap_type' => 'Editor',
                            'ec_id' => $cat,
                            'show_type' => 'Inside',
                        );

                        $this->db->insert('article_persons', $neweditor);
                    }
                } else {
                    $this->db->where('article_id', $id);
                    $this->db->where('ap_type', 'Editor');
                    $this->db->where('show_type', 'Inside');
                    $this->db->delete('article_persons');
                    
                    foreach ($editor as $cat) {
                        $neweditor = array(
                            'article_id' => $id,
                            'ap_type' => 'Editor',
                            'ec_id' => $cat,
                            'show_type' => 'Inside',
                        );

                        $this->db->insert('article_persons', $neweditor);
                    }
                }
            }

            /*
            ** Related Highlight Editor
            */
            if ($heditor) {
                $this->db->select('article_persons.*');
                $this->db->where('article_id', $id);
                $this->db->where('ap_type', 'Editor');
                $this->db->where('show_type', 'Highlite');
                $person2_query = $this->db->get('article_persons');
                
                if (empty($person2_query->result())) {
                    foreach ($heditor as $cat) {
                        $newheditor = array(
                            'article_id' => $id,
                            'ap_type' => 'Editor',
                            'ec_id' => $cat,
                            'show_type' => 'Highlite',
                        );

                        $this->db->insert('article_persons', $newheditor);
                    }
                } else {
                    $this->db->where('article_id', $id);
                    $this->db->where('ap_type', 'Editor');
                    $this->db->where('show_type', 'Highlite');
                    $this->db->delete('article_persons');
                    
                    foreach ($heditor as $cat) {
                        $newA = array(
                            'ec_id' => $cat,
                            'article_id' => $id,
                            'ap_type' => 'Editor',
                            'show_type' => 'Highlite',
                        );
                        
                        $this->db->insert('article_persons', $newA);
                    }
                }
            }

            /*
            ** Article Person Author
            */
            if ($author) {
                $this->db->select('article_persons.*');
                $this->db->where('article_id', $id);
                $this->db->where('ap_type', 'Author');
                $this->db->where('show_type', 'Inside');
                $person3_query = $this->db->get('article_persons');
                if (empty($person3_query->result())) {
                    
                    foreach ($author as $cat) {
                        $newauthor = array(
                            'article_id' => $id,
                            'ap_type' => 'Author',
                            'ec_id' => $cat,
                            'show_type' => 'Inside',
                        );

                        $this->db->insert('article_persons', $newauthor);
                    }

                    
                } else {
                    $this->db->where('article_id', $id);
                    $this->db->where('ap_type', 'Author');
                    $this->db->where('show_type', 'Inside');
                    $this->db->delete('article_persons');

                    foreach ($author as $cat) {
                        $newauthor = array(
                            'article_id' => $id,
                            'ap_type' => 'Author',
                            'ec_id' => $cat,
                            'show_type' => 'Inside',
                        );

                        $this->db->insert('article_persons', $newauthor);
                    }
                }
            }

            /*
            ** Highlight Author
            */
            if ($hauthor) {

                $this->db->select('article_persons.*');
                $this->db->where('article_id', $id);
                $this->db->where('ap_type', 'Author');
                $this->db->where('show_type', 'Highlite');
                $person4_query = $this->db->get('article_persons');
                if (empty($person4_query->result())) {
                    foreach ($hauthor as $cat) {

                        $newhauthor = array(
                            'article_id' => $id,
                            'ap_type' => 'Author',
                            'ec_id' => $cat,
                            'show_type' => 'Highlite',
                        );

                        $this->db->insert('article_persons', $newhauthor);
                    }
                } else {
                    $this->db->where('article_id', $id);
                    $this->db->where('ap_type', 'Author');
                    $this->db->where('show_type', 'Highlite');
                    $this->db->delete('article_persons');
                    foreach ($hauthor as $cat) {

                        $newhauthor = array(
                            'article_id' => $id,
                            'ap_type' => 'Author',
                            'ec_id' => $cat,
                            'show_type' => 'Highlite',
                        );

                        $this->db->insert('article_persons', $newhauthor);
                    }
                }
            }

            /*
            ** Article Multimedia Tag
            */
            if ($mcatogery) {
                $this->db->select('article_persons.*');
                $this->db->where('article_id', $id);
                $multimedia_tag_query = $this->db->get('article_persons');
                if (empty($multimedia_tag_query->result())) {
                    foreach ($mcatogery as $cat) {
                        $newA = array(
                            'cato' => $cat,
                            'a_id' => $id,
                            'am_type' => $tp,
                        );

                        $this->db->insert('article_multimedia_tag', $newA);
                    }
                } else {
                    $this->db->where('a_id', $id);
                    $this->db->delete('article_multimedia_tag');

                    foreach ($mcatogery as $cat) {
                        $newA = array(
                            'cato' => $cat,
                            'a_id' => $id,
                            'am_type' => $tp,
                        );

                        $this->db->insert('article_multimedia_tag', $newA);
                    }
                }
            }

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_article($id)
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

    function insertGalleryImage($article_id, $gallery_image)
    {
        try {
            foreach ($gallery_image as $value) {
                $data = [
                    'article_id'    => $value['article_id'],
                    'image_name'    => $value['image_name'],
                    'modified_date' => $value['modified_date'],
                    'modified_by'   => $value['modified_by'],
                ];

                $this->db->insert('article_images', $data);
                $result = TRUE;
            }

            return $result;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function deleteGalleryImage($image_id)
    {
        try {
            $this->db->where('image_id', $image_id);
            $this->db->delete('article_images');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
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

    function getDuplicateArticleByArticleId($parent_article)
    {
        try {
            $this->db->select('article_duplicates.id as duplicate_id, article_duplicates.parent_article as parentarticle_id, article_duplicates.pages');
            $this->db->where('parent_article', $parent_article);
            $query = $this->db->get('article_duplicates');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
    function getDuplicateArticleByDuplicateArticleId($duplicate_article)
    {
        try {
            $this->db->select('article_duplicates.*');
            $this->db->where('duplicate_article', $duplicate_article);
            $query = $this->db->get('article_duplicates');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getOneArticlesDuplicateParentArticle($duplicate_article)
    {
        try {
            $this->db->select('article_duplicates.*');
            $this->db->where('duplicate_article', $duplicate_article);
            $query = $this->db->get('article_duplicates');

            $data = $query->row();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getDuplicateArticleBySlug($slug)
    {
        try {
            $this->db->select('article_duplicates.*');
            $this->db->where('slug', $slug);
            $query = $this->db->get('article_duplicates');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getDuplicateArticleByDuplicateArticleIdAndPages($duplicate_article, $pages)
    {
        try {
            $this->db->select('article_duplicates.*');
            $this->db->where('duplicate_article', $duplicate_article);
            $this->db->where('pages', $pages);
            $query = $this->db->get('article_duplicates');

            $data = $query->row();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getArticleIDByUri($uri)
    {
        try {
            $this->db->select('articles.article_id, articles.title, articles.uri, articles.article_type');
            $this->db->where('uri', $uri);
            $query = $this->db->get('articles');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getArticleIDByArticleId($article_id)
    {
        try {
            $this->db->select('articles.article_id, articles.article_type');
            $this->db->where('articles.article_id', $article_id);
            $query = $this->db->get('articles');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertduplicates($article_id, $before_data)
    {
        if (!empty($before_data)) {
            $getDuplicateArticleData = $this->getArticleIDByArticleId($article_id);

            if (count($getDuplicateArticleData) > 0) {
                $this->db->where('article_duplicates.parent_article', $article_id);
                $this->db->delete('article_duplicates');
            }
            
            foreach ($before_data as $value) {
                $before_data_article_duplicate = [
                    'parent_article' 		=> $value['parent_article'],
                    'duplicate_article' 	=> $value['duplicate_article'],
                    'pages' 				=> $value['pages'],
                ];

                $this->db->insert('article_duplicates', $before_data_article_duplicate);
            }

            return TRUE;
        } else {
            return FALSE;
        }
        
        
    }

    function getDuplicatArticleByUri($slug)
    {
        try {
            $this->db->select('article_duplicates.*');
            $this->db->where('article_duplicates.slug', $slug);
            $query = $this->db->get('article_duplicates');

            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertArticleDuplicates($article_id, $data_article_duplicate, $slug)
    {
        try {
            $getDuplicateArticleData = $this->getDuplicatArticleByUri($slug); // getArticleIDByArticleId
            
            // if (count($getDuplicateArticleData) > 0) {
            //     $this->db->where('article_duplicates.slug', $slug);
            //     $this->db->where('article_duplicates.parent_article', $article_id);
            //     $this->db->delete('article_duplicates');
            // }
            echo "<pre>";
            print_r($data_article_duplicate);
            exit();
            foreach ($data_article_duplicate as $value) {
                $article_duplicate_data[] = [
                    'parent_article' 		=> $value['parent_article'],
                    'duplicate_article' 	=> $value['duplicate_article'],
                    'pages' 				=> $value['pages'],
                    'slug'                  => $value['slug'],
                ];
                
            }
            echo "<pre>";
            print_r($article_duplicate_data);
            exit();
            $result = $this->db->insert_batch('article_duplicates', $article_duplicate_data);
            if ($result == TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
            
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insert_duplicate_default($article_duplicate)
    {
        $result = $this->db->insert('article_duplicates', $article_duplicate);
        if ($result == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function insert_article_default($article_data, $pages, $parent_article, $slug_duplicate, $current_page_article, $articleTypes, $input_pages)
    {
        /* 
        ** For Table articles
        */
        
        foreach ($article_data as $key => $value) {
            if (!in_array($value['article_type'], $articleTypes)) {
                $articles = [
                    'image_name'        => $value['image_name'],
                    'article_type'      => $value['article_type'],
                    'uri'               => $value['uri'],
                    'pub_type'          => 0,
                    'title'             => $value['title'],
                    'posted_date'       => $value['posted_date'],
                    'author'            => $value['author'],
                    'content'           => $value['content'],
                    'tags'              => $value['tags'],
                    'editor'            => $value['editor'],
                    'published'         => 0,
                    'start_date'        => $value['start_date'],
                    'doc_no'            => $value['doc_no'],
                    'period'            => $value['period'],
                    'article_status'    => $value['article_status'],
                    'venue'             => $value['venue'],
                    'highlight'         => $value['highlight'],
                    'modified_by'       => $value['modified_by'],
                    'modified_date'     => $value['modified_date'],
                    'meta_keywords'     => $value['meta_keywords'],
                    'meta_description'  => $value['meta_description'],
                ];

                $this->db->insert('articles', $articles);
                $duplicate_article = $this->db->insert_id();
                
            } 
        }

        $page_current[0] = $current_page_article;
        
        $merging_page = array_merge($input_pages, $page_current);
        
        $this->db->where('article_duplicates.slug', $slug_duplicate);
        $this->db->where('article_duplicates.parent_article', $parent_article);
        $this->db->delete('article_duplicates');
        
        foreach ($merging_page as $key => $value) {
            $duplicates = [
                'parent_article'        => $parent_article,
                'duplicate_article'     => null,
                'pages'                 => $value,
                'slug'                  => $slug_duplicate
            ];

            $result = $this->db->insert('article_duplicates', $duplicates);
        }
        return TRUE;
    }

    function view_pagePdf($id)
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

    function viewPdf($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('article_id', $id);
            $this->db->order_by("order_id", "asc");
            $query = $this->db->get('eria_pdf');
            $data = $query->result();
            
            $typeData = array();
            foreach ($data as $aid => $query) {
                $typeData[$aid]['pdf_id'] = $query->pdf_id;
                $typeData[$aid]['pdf_title'] = $query->pdf_title;
                $typeData[$aid]['pdf_discription'] = $query->pdf_discription;
                $typeData[$aid]['pdf'] = $query->pdf;
                $typeData[$aid]['order_id'] = $query->order_id;
                $typeData[$aid]['author'] = $this->get_pdfAuthor($query->pdf_id);
            }

            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_pdfAuthor($pdf)
    {
        $this->db->select('*');
        $this->db->where('pdf_id', $pdf);
        $this->db->join('articles', 'articles.article_id = eria_pdf_author.author', 'left');

        $query = $this->db->get('eria_pdf_author');

        return   $query->result();
    }

    function del_PDF($id)
    {
        $this->db->where('pid', $id);
        $this->db->delete('page_pdf');
        return TRUE;
    }

    function getPdfByArticleId($article_id)
    {
        $this->db->select('eria_pdf.pdf_id, eria_pdf.order_id, eria_pdf.article_id');
        $this->db->where('article_id', $article_id);
        $query = $this->db->get('eria_pdf');
        $data = $query->result();

        return $data;
    }

    function getPdfByPdfId($pdf_id)
    {
        $this->db->select('eria_pdf.pdf_id, eria_pdf.order_id, eria_pdf.article_id');
        $this->db->where('pdf_id', $pdf_id);
        $query = $this->db->get('eria_pdf');
        $data = $query->result();

        return $data;
    }

    function getEditPDF($pdf_id)
    {
        try {
            $this->db->select('*');
            $this->db->where('pdf_id', $pdf_id);
            $this->db->order_by("order_id", "asc");
            $query = $this->db->get('eria_pdf');
            $data = $query->result();

            $typeData = array();
            foreach ($data as $aid => $query) {
                $typeData[$aid]['pdf_id'] = $query->pdf_id;
                $typeData[$aid]['pdf_title'] = $query->pdf_title;
                $typeData[$aid]['pdf_discription'] = $query->pdf_discription;
                $typeData[$aid]['pdf'] = $query->pdf;
                $typeData[$aid]['order_id'] = $query->order_id;
                $typeData[$aid]['pdf_type'] = $query->pdf_type;
                $typeData[$aid]['article_id'] = $query->article_id;
                $typeData[$aid]['author'] = $this->get_pdfAuthor($query->pdf_id);
            }

            return $typeData;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getAuthorPDF($pdf_id)
    {
        $this->db->select('eria_pdf_author.*, articles.title');
        $this->db->where('eria_pdf_author.pdf_id', $pdf_id);
        $this->db->join('articles', 'articles.article_id = eria_pdf_author.author');
        $query = $this->db->get('eria_pdf_author');

        return $query->result();
    }

    function delPDF($id)
    {
        $this->db->where('pdf_id', $id);
        $this->db->delete('eria_pdf');
        return TRUE;
    }

    function deletepdfAuthor($id)
    {
        $this->db->where('paid', $id);
        $this->db->delete('eria_pdf_author');
        return TRUE;
    }

    function deleteec($id)
    {
        $this->db->where('ec_id', $id);
        $this->db->delete('eria_expert_categories');
        return TRUE;
    }

    function deleteDepartement($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('eria_departement');

        $this->db->where('eria_departement_id', $id);
        $this->db->delete('eria_expert_departement');
        return TRUE;
    }
    function deleteesc($id)
    {
        $this->db->where('es_id', $id);
        $this->db->delete('eria_expert_sub_categories');
        return TRUE;
    }

    function deleteRese($id)
    {
        $this->db->where('article_id', $id);
        $this->db->delete('articles');
        return TRUE;
    }

    function deleteNN($id)
    {
        $this->db->where('article_id', $id);
        $this->db->delete('articles');
        return TRUE;
    }

    function getMultimediaByCategory($article_type)
    {
        try {
            $this->db->select('*');
            $this->db->where('article_type', $article_type);
            $this->db->where_in('sub_experts', array('7', '8', '20'));
            $this->db->order_by("article_id", "desc");

            $query = $this->db->get('articles');
            $data = $query->result();
            return $data;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_allarticle($type, $limit)
    {
        $this->db->select('*');
        $this->db->where('article_type', $type);
        $this->db->where('published', 1);
        if ($type == 'experts') {
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
        }

        if ($limit) {
            $this->db->limit($limit);
        }

        $this->db->order_by("article_id", "desc");

        $query = $this->db->get('articles');

        return $query;
    }

    function getPage_dash_allarticle($type)
    {
        try {
            $this->db->select('*');
            $this->db->where('article_type', $type);

            if ($type == 'experts') {
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            }
            $this->db->order_by("article_id", "desc");
            $this->db->limit(5);

            $query = $this->db->get('articles');

            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_expallarticle($type, $sub)
    {

        try {
            $this->db->select('*');

            if (count($type) > 0) {
                $this->db->where_in('article_type', $type);
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
                $this->db->join('eria_expert_sub_categories', 'eria_expert_sub_categories.es_id = articles.sc_id', 'left');
            } else {
                $this->db->where('article_type', $type);
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
                $this->db->join('eria_expert_sub_categories', 'eria_expert_sub_categories.es_id = articles.sub_dep_experts', 'left');
            }

            // if ($type == 'experts') {
            //     $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            //     $this->db->join('eria_expert_sub_categories', 'eria_expert_sub_categories.es_id = articles.sc_id', 'left');
            // }

            if ($sub) {
                $this->db->where('articles.sub_experts', $sub);
            }

            $this->db->order_by("article_id", "desc");

            $query = $this->db->get('articles');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_OG()
    {
        try {
            $this->db->select('*');


            $query = $this->db->get('organization_structure');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_subcontent($id)
    {
        try {
            $this->db->select('*');

            $this->db->where('aid', $id);
            $query = $this->db->get('about_us');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_r_subcontent($id)
    {
        try {
            $this->db->select('*');

            $this->db->where('id', $id);
            $query = $this->db->get('research');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_subArticle($type)
    {
        try {
            $this->db->select('*');
            $this->db->where('eria_expert_categories.category', $type);
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');

            $query = $this->db->get('articles');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_allsubArticle()
    {
        try {
            $this->db->select('*');
            $this->db->where_in('articles.article_type', ['experts', 'keystaffs', 'fellows', 'associates']);
            $this->db->where('articles.published', 1);
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');

            $query = $this->db->get('articles');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_country()
    {
        try {
            $this->db->select('*');
            $query = $this->db->get('article_venues');

            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_eria_category_multimedia($parent)
    {
        $query = "SELECT `eria_expert_categories`.`ec_id` FROM `eria_expert_categories` WHERE `parent` = '" . $parent . "'";

        $result_multimedia = $this->db->query($query)->result();

        foreach ($result_multimedia as $multimedia) {
            $result[] = $multimedia->ec_id;
        }

        return $result;
    }

    function getPage_multiallarticle($article_type_, $category_id)
    {
        $type = "news";

        try {
            $this->db->select('*');
            $this->db->where('article_type', $article_type_);

            //$this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
            //$this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');

            //$this->db->where('article_categories.category_id', 178);

            // $this->db->or_where('category_name', 'Webinar');
            // $this->db->or_where('category_name', 'Podcasts');
            // or_where
            if ($category_id) {

                if ($category_id != 'All') {
                    $this->db->where('sub_experts', $category_id);
                } else {

                    $categoryid = $this->get_eria_category_multimedia('multimedia');

                    $this->db->where_in('sub_experts', $categoryid);
                }
            }

            $this->db->order_by('articles.posted_date', 'DESC');

            $query = $this->db->get('articles');

            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_catogeries($type)
    {
        try {
            $this->db->select('*');
            $this->db->where('category_type', $type);
            $query = $this->db->get('categories');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function statusProgrammesCategory($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('category_id', $id);
        $this->db->update('categories');
    }

    function deleteCat($id)
    {
        try {

            $this->db->where('category_id', $id);
            $query = $this->db->delete('categories');

            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_timeLine()
    {
        try {
            $this->db->select('*');
            $query = $this->db->get('eria_timeline');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_time($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('time_id', $id);
            $query = $this->db->get('eria_timeline');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function get_organization($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('oid', $id);
            $query = $this->db->get('organization_structure');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_subcategories_id($es_id)
    {
        $this->db->select('eria_expert_sub_categories.*');
        $this->db->where('eria_expert_sub_categories.es_id', $es_id);
        $query = $this->db->get('eria_expert_sub_categories');

        return $query->result()[0];
    }

    function getPage_categories_id($ec_id)
    {
        $this->db->select('eria_expert_categories.*');
        $this->db->where('eria_expert_categories.ec_id', $ec_id);
        $query = $this->db->get('eria_expert_categories');

        return $query->result()[0];
    }

    function getPage_subcatogeries($type)
    {
        try {
            $this->db->select('categories.*,c.category_name as parent');
            $this->db->where('categories.category_type', $type);
            $this->db->join('categories c', 'c.category_id = categories.parent_id', 'left');

            $query = $this->db->get('categories');

            return $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPeopleInOrganizationStructure($organization_structure_id)
    {
        try {
            $this->db->distinct('`articles`.`title`');
            $this->db->select('`organization_structure_people`.`people_id`,  
                                `organization_structure_people`.`sort`, 
                                `articles`.`title`, 
                                `articles`.`major`, 
                                `articles`.`uri`');
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

    function updateOrg($id, $data)
    {
        try {
            
            $result_data = array(
                'departement_id'    => $data['departement_id'],
                'people_id'         => json_encode($data['people_id']),
                'published'         => $data['published'],
                'modified_date'     => $data['modified_date'],
                'modified_by'       => $data['modified_by'],
            );
            
            $this->db->set($result_data);
            $this->db->where('oid', $id);
            $this->db->update('organization_structure');

            if (!empty($data['people_id'])) {
                $people_ids = $data['people_id'];
                
                $this->db->where('organization_structure_id', $id);
                $this->db->delete('organization_structure_people');

                foreach ($people_ids as $value) {
                    $people_structure = [
                        'organization_structure_id'     => $id,
                        'people_id'                     => $value['people'],
                        'sort'                          => $value['sort'],
                    ];
                    
                    $this->db->insert('organization_structure_people', $people_structure);
                }
                
            }
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
    
    function insertStructure($data)
    {
        try {
            
            $result_data = array(
                'departement_id'    => $data['departement_id'],
                'people_id'         => json_encode($data['people_id']),
                'published'         => $data['published'],
                'modified_date'     => $data['modified_date'],
                'modified_by'       => $data['modified_by'],
            );
            
            $people_ids = $data['people_id'];
            
            $result_structure = $this->db->insert('organization_structure', $result_data);
            $organization_structure_id = $this->db->insert_id();
            
            foreach ($people_ids as $value) {
                $people_structure = [
                    'organization_structure_id'     => $organization_structure_id,
                    'people_id'                     => $value['people'],
                    'sort'                          => $value['sort'],
                ];
                
                $this->db->insert('organization_structure_people', $people_structure);
            }

            return TRUE;

        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
        
    }

    function update_order($pdf_id, $data)
    {
        $this->db->set($data);
        $this->db->where('pdf_id', $pdf_id);
        $result = $this->db->update('eria_pdf');

        return $result;
    }

    function updatePdf($pdf_id, $data, $author)
    {
        $this->db->set($data);
        $this->db->where('pdf_id', $pdf_id);
        $this->db->update('eria_pdf');

        if ($author) {

            $this->db->where('pdf_id', $pdf_id);
            $this->db->delete('eria_pdf_author');

            foreach ($author as $cat) {
                $newA = array(
                    'pdf_id' => $pdf_id,
                    'author' => $cat,
                );

                $this->db->insert('eria_pdf_author', $newA);
            }
        }

        return TRUE;
    }

    function insertPdf($data, $auth)
    {
        $this->db->insert('eria_pdf', $data);
        $a_id = $this->db->insert_id();

        if ($auth) {
            $auth = explode(',', $auth);

            foreach ($auth as $cat) {
                $newA = array(
                    'pdf_id' => $a_id,
                    'author' => $cat,
                );

                $this->db->insert('eria_pdf_author', $newA);
            }
        }

        return TRUE;
    }

    function insert_govPdf($data)
    {
        $this->db->insert('page_pdf', $data);
    }

    function insertTime($data)
    {
        $this->db->insert('eria_timeline', $data);
    }

    function getArticle_sub($aid, $atp, $stp)
    {
        $this->db->select('ec_id');
        $this->db->where('article_id', $aid);
        $this->db->where('ap_type', $atp);
        $this->db->where('show_type', $stp);

        $query = $this->db->get('article_persons')->result();

        $typeData = array();
        foreach ($query as $aid => $query) {
            $typeData[$aid] = $query->ec_id;
        }

        return $typeData;
    }

    function getArticleTopics($id)
    {
        $this->db->select('article_topics.*');
        $this->db->where('article_id', $id);

        $result = $this->db->get('article_topics')->result();

        return $result;
    }

    function getOneArticle($article_id)
    {
        $this->db->select('articles.*');
        $this->db->where('article_id', $article_id);

        $result = $this->db->get('articles')->row();

        return $result;
    }

    function getArticleTopicByArticleId($article_id, $category_type)
    {
        $this->db->select('article_topics.*, categories.*');
        $this->db->where('article_id', $article_id);
        $this->db->where('categories.category_type', $category_type);
        $this->db->join('categories', 'categories.category_id = article_topics.topic_id', 'left');
        $result = $this->db->get('article_topics')->row();

        return $result;
    }

    function get_articleCatogery($aid)
    {
        $this->db->select('category_id');
        $this->db->where('article_id', $aid);

        $query = $this->db->get('article_categories')->result();
        $typeData = array();

        foreach ($query as $aid => $query) {
            $typeData[$aid] = $query->category_id;
        }

        return $typeData;
    }

    function get_articleMultimedia($aid)
    {
        $this->db->select('cato');
        $this->db->where('a_id', $aid);
        //$this->db->where('am_type', 'M');
        $query = $this->db->get('article_multimedia_tag')->result();
        $typeData = array();

        foreach ($query as $aid => $query) {
            $typeData[$aid] = $query->cato;
        }

        return $typeData;
    }

    function get_articleTopic($aid)
    {
        $this->db->select('topic_id');
        $this->db->where('article_id', $aid);

        $query = $this->db->get('article_topics')->result();
        $typeData = array();

        foreach ($query as $aid => $query) {
            $typeData[$aid] = $query->topic_id;
        }

        return $typeData;
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

        $query = "SELECT articles.article_id
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

        $typeData = array();

        foreach ($data as $aid => $query) {
            $typeData[$aid] = $query->article_id;
        }

        return $typeData;
    }

    function getArticlePublicationRelated($aid)
    {
        $this->db->select('to_article_id');
        $this->db->where('article_id', $aid);

        $query = $this->db->get('article_relateds_publication')->result();
        $typeData = array();

        foreach ($query as $aid => $query) {
            $typeData[$aid] = $query->to_article_id;
        }

        return $typeData;
    }

    function get_articleRelated($aid)
    {
        $this->db->select('to_article_id');
        $this->db->where('article_id', $aid);
        $query = $this->db->get('article_relateds')->result();

        $typeData = array();
        foreach ($query as $aid => $query) {
            $typeData[$aid] = $query->to_article_id;
        }

        return $typeData;
    }

    function deletetopic($id)
    {
        try {
            $this->db->where('category_id', $id);
            $this->db->delete('categories');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function deleter($id)
    {
        try {
            $this->db->where('article_id', $id);
            $this->db->delete('articles');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function deleteorg($id)
    {
        try {
            $this->db->where('oid', $id);
            $this->db->delete('organization_structure');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function delete_R($id)
    {
        try {
            $this->db->where('article', $id);
            $this->db->delete('eria_recent_updates');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function deletePage($id)
    {
        try {
            $this->db->where('page_id', $id);
            $this->db->delete('pages');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function deleteSubPageChild($id)
    {
        try {
            $this->db->where('id', $id);
            $this->db->delete('pages_sub');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function delete_time($id)
    {
        try {
            $this->db->where('time_id', $id);
            $this->db->delete('eria_timeline');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insertCat($data)
    {
        try {
            $this->db->insert('categories', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insert_expertCat($data)
    {
        try {
            $this->db->insert('eria_expert_categories', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insert_departement($data)
    {
        try {

            $data_departements = [
                'name'      => $data['name_departement'],
                'created'   => date('Y-m-d h:i:s'),
            ];

            $this->db->insert('eria_departement', $data_departements);
            $departement_id = $this->db->insert_id();

            foreach ($data['category_id'] as $value) {
                $data_expert_departement = [
                    'eria_expert_category_id'   => $value,
                    'eria_departement_id'       => $departement_id,
                ];

                $this->db->insert('eria_expert_departement', $data_expert_departement);
            }

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function insert_expert_sCat($data)
    {
        try {
            $this->db->insert('eria_expert_sub_categories', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function update_expertCat($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('ec_id', $id);
            $this->db->update('eria_expert_categories');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getSub($id, $article_type_sub)
    {
        $this->db->select('*');
        $this->db->where('ec_id', $id);
        $this->db->where('article_type_sub', $article_type_sub);
        $query = $this->db->get('eria_expert_sub_categories');

        return   $query->result();
    }

    function update_departement($id, $data)
    {
        try {

            $data_departements = [
                'name'      => $data['name_departement'],
                'created'   => date('Y-m-d h:i:s'),
            ];

            $this->db->set($data_departements);
            $this->db->where('id', $id);
            $this->db->update('eria_departement');

            $getRelatedDepartment = $this->Page_model->getExpertDepartementRelatedAllCategories($id);

            foreach ($getRelatedDepartment as $value) {
                $this->db->where('id', $value->id);
                $this->db->delete('eria_expert_departement');
            }


            foreach ($data['category_id'] as $key => $value) {
                $data_expert_departement = [
                    'eria_expert_category_id'   => $value,
                    'eria_departement_id'       => $id,
                ];

                $this->db->insert('eria_expert_departement', $data_expert_departement);
            }

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function update_expertsCat($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('es_id', $id);
            $this->db->update('eria_expert_sub_categories');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
    function getPage_expertsCat($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('es_id', $id);

            $query = $this->db->get('eria_expert_sub_categories');
            return $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function getPage_expertssCat($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('es_id', $id);

            $query = $this->db->get('eria_expert_sub_categories');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
    function getPage_cat($id)
    {
        try {
            $this->db->select('*');
            $this->db->where('category_id', $id);
            $query = $this->db->get('categories');

            return   $query->row();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updatecat($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('category_id', $id);
            $this->db->update('categories');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function updateTime($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('time_id', $id);
            $this->db->update('eria_timeline');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function publish_time($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('time_id', $id);
        $this->db->update('eria_timeline');
    }

    function deleteCategory($id)
    {
        try {
            $this->db->where('category_id', $id);
            $this->db->delete('categories');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }

    function publish($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('category_id', $id);
        $this->db->update('categories');
    }

    function publishR($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('article_id', $id);
        $this->db->update('articles');
    }

    function publishSubPageChild($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('id', $id);
        $this->db->update('pages_sub');
    }

    function publishRCard($c_id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('c_id', $c_id);
        $this->db->update('eria_card');
    }

    function publishCardRandom($c_id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('c_id', $c_id);
        $this->db->update('eria_card_randoms');
    }

    function deleteCardRese($id)
    {
        $this->db->where('c_id', $id);
        $this->db->delete('eria_card');
        return TRUE;
    }

    function deleteCardRandom($id)
    {
        $this->db->where('c_id', $id);
        $this->db->delete('eria_card_randoms');
        return TRUE;
    }

    function publishO($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('oid', $id);
        $this->db->update('organization_structure');
    }

    function publishPage($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('page_id', $id);
        $this->db->update('pages');
    }

    function publishSubPage($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('page_id', $id);
        $this->db->update('pages');
    }

    function publishCd($id, $pub)
    {
        $this->db->set('published', $pub);
        $this->db->where('c_id', $id);
        $this->db->update('eria_card');
    }

    function deletePub($id)
    {
        try {
            $this->db->where('np_id', $id);
            $this->db->delete('pub_slider');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }
}