<?php

Class Page_model extends CI_Model
{
    function getPage_content($id)
    {


        try {
            $this->db->select('*');
            $this->db->where('page_id', $id);
            $query = $this->db->get('pages');

            return   $query->row();
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

    function insertpSlider($data)
    {



        try {
            $this->db->insert('pub_slider', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }


    }

    function inserRecent($id,$sort)
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



    function updateFeature($asean ,$pub,$updates,$multimedia)
    {


        $this->db->set('feature',NULL);
        $this->db->update('articles');


        $this->db->set('feature','asean');
        $this->db->where('article_id', $asean);
        $this->db->update('articles');


        $this->db->set('feature','pub');
        $this->db->where('article_id', $pub);
        $this->db->update('articles');


        $this->db->set('feature','updates');
        $this->db->where('article_id', $updates);
        $this->db->update('articles');


        $this->db->set('feature','multimedia');
        $this->db->where('article_id', $multimedia);
        $this->db->update('articles');


        return TRUE;




    }




    function updatePage($id,$data)
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


    function update_Pslider($id,$data)
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


    function updateAbout($id,$data)
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

    function updateResearch($id,$data)
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


    function getFeature($type)
    {


        try {
            $this->db->select('*');
            $this->db->where('feature', $type);
            $query = $this->db->get('articles');
            return   $query->row();
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

    
      function getExpert_subCatogeries($pid)
    {

     try {
            $this->db->select('*');
            $this->db->where('es_status', 1);
            $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = eria_expert_sub_categories.ec_id', 'left');
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
            $query = $this->db->get('pages');

            return   $query->result();
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }


    }





    function updateArticle($id,$data,$cat,$topic,$related,$editor,$heditor,$author,$hauthor,$mcatogery,$tp)
    {



        try {
            $this->db->set($data);
            $this->db->where('article_id', $id);
            $this->db->update('articles');



            $this->db->where('article_id', $id);
            $this->db->delete('article_categories');


            $this->db->where('article_id', $id);
            $this->db->delete('article_topics');


            $this->db->where('article_id', $id);
            $this->db->delete('article_relateds');

            $this->db->where('article_id', $id);
            $this->db->delete('article_persons');


            $this->db->where('a_id', $id);
            $this->db->delete('article_multimedia_tag');


            if($cat)
            {
                foreach ($cat as $cat)
                {

                    $newA = array(
                        'category_id'=> $cat,
                        'article_id' => $id,
                    );
                    $this->db->insert('article_categories', $newA);


                }
            }


            if($topic)
            {
                foreach ($topic as $cat)
                {

                    $newA = array(
                        'topic_id'=> $cat,
                        'article_id' => $id,
                    );
                    $this->db->insert('article_topics', $newA);


                }
            }


            if($related)
            {
                foreach ($related as $cat)
                {

                    $newA = array(
                        'to_article_id'=> $cat,
                        'article_id' => $id,
                    );
                    $this->db->insert('article_relateds', $newA);


                }
            }



            if($editor)
            {
                foreach ($editor as $cat)
                {

                    $newA = array(
                        'ec_id'=> $cat,
                        'article_id' => $id,
                        'ap_type'=> 'Editor',
                        'show_type' => 'Inside',
                    );
                    $this->db->insert('article_persons', $newA);


                }
            }
            if($heditor)
            {
                foreach ($heditor as $cat)
                {

                    $newA = array(
                        'ec_id'=> $cat,
                        'article_id' => $id,
                        'ap_type'=> 'Editor',
                        'show_type' => 'Highlite',
                    );
                    $this->db->insert('article_persons', $newA);


                }
            }

            if($author)
            {
                foreach ($author as $cat)
                {

                    $newA = array(
                        'ec_id'=> $cat,
                        'article_id' => $id,
                        'ap_type'=> 'Author',
                        'show_type' => 'Inside',
                    );
                    $this->db->insert('article_persons', $newA);


                }
            }
            if($hauthor)
            {
                foreach ($hauthor as $cat)
                {

                    $newA = array(
                        'ec_id'=> $cat,
                        'article_id' => $id,
                        'ap_type'=> 'Author',
                        'show_type' => 'Highlite',
                    );
                    $this->db->insert('article_persons', $newA);


                }
            }

            if($mcatogery)
            {
                foreach ($mcatogery as $cat)
                {

                    $newA = array(
                        'cato'=> $cat,
                        'a_id' => $id,
                        'am_type'=> $tp,
                    );
                    $this->db->insert('article_multimedia_tag', $newA);


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
            $query = $this->db->get('eria_pdf');
            $data =   $query->result();

            $typeData=array();
            foreach ($data AS $aid => $query)
            {


                $typeData[$aid]['pdf_id'] = $query->pdf_id;
                $typeData[$aid]['pdf_title'] = $query->pdf_title;
                $typeData[$aid]['pdf_discription'] = $query->pdf_discription;
                $typeData[$aid]['pdf'] = $query->pdf;

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


        $this -> db -> where('pid', $id);
        $this -> db -> delete('page_pdf');
        return TRUE;


    }


    function delPDF($id)
    {


        $this -> db -> where('pdf_id', $id);
        $this -> db -> delete('eria_pdf');
        return TRUE;


    }

    function deletepdfAuthor($id)
    {


        $this -> db -> where('paid', $id);
        $this -> db -> delete('eria_pdf_author');
        return TRUE;


    }
    function deleteec($id)
    {

        $this -> db -> where('ec_id', $id);
        $this -> db -> delete('eria_expert_categories');
        return TRUE;

    }
  function deleteesc($id)
    {

        $this -> db -> where('es_id', $id);
        $this -> db -> delete('eria_expert_sub_categories');
        return TRUE;

    }
    
    function deleteRese($id)
    {

        $this -> db -> where('article_id', $id);
        $this -> db -> delete('articles');
        return TRUE;

    }
     function deleteNN($id)
    {

        $this -> db -> where('article_id', $id);
        $this -> db -> delete('articles');
        return TRUE;

    }
    
    function getPage_allarticle($type,$limit)
    {


        try {
            $this->db->select('*');
            $this->db->where('article_type', $type);

            if($type=='experts')
            {
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            }
            if($limit)
            {
                $this->db->limit($limit);
            }
            $this->db->order_by("article_id", "desc");


            $query = $this->db->get('articles');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }




    function getPage_dash_allarticle($type)
    {


        try {
            $this->db->select('*');
            $this->db->where('article_type', $type);

            if($type=='experts')
            {
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
            }
            $this->db->order_by("article_id","desc");
            $this->db->limit(5);

            $query = $this->db->get('articles');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }




    function getPage_expallarticle($type,$sub)
    {


        try {
            $this->db->select('*');
            $this->db->where('article_type', $type);

            if($type=='experts')
            {
                $this->db->join('eria_expert_categories', 'eria_expert_categories.ec_id = articles.sub_experts', 'left');
                $this->db->join('eria_expert_sub_categories', 'eria_expert_sub_categories.es_id = articles.sc_id', 'left');
            }

            if($sub)
            {
                $this->db->where('articles.sub_experts', $sub);
            }
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

            $this->db->where('articles.article_type', 'experts');
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

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }



    }



    function getPage_multiallarticle()
    {
        $type="news";

        try {
            $this->db->select('*');
            $this->db->where('article_type', 'multimedia');

            //$this->db->join('article_categories', 'article_categories.article_id = articles.article_id', 'left');
            //$this->db->join('categories', 'categories.category_id = article_categories.category_id', 'left');

            //$this->db->where('article_categories.category_id', 178);

           // $this->db->or_where('category_name', 'Webinar');
           // $this->db->or_where('category_name', 'Podcasts');
           // or_where



            $query = $this->db->get('articles');

            return   $query;
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

    
    function deleteCat($id)
    {
        
         try {
            
            $this->db->where('category_id', $id);
            $query = $this->db->delete('categories');

            return   $query;
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



    function updateOrg($id,$data)
    {



        try {
            $this->db->set($data);
            $this->db->where('oid', $id);
            $this->db->update('organization_structure');
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }



    }



    function getPage_subcatogeries($type)
    {


        try {
            $this->db->select('categories.*,c.category_name as parent');
            $this->db->where('categories.category_type', $type);
            $this->db->join('categories c', 'c.category_id = categories.parent_id', 'left');
            $query = $this->db->get('categories');

            return   $query;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
    }


    function insertStructure($data)
    {
        $this->db->insert('organization_structure', $data);
    }

    function insertPdf($data,$auth)
    {
        $this->db->insert('eria_pdf', $data);
        $a_id = $this->db->insert_id();



        if($auth)
        {

            $auth=explode(',', $auth);

            foreach ($auth as $cat)
            {

                $newA = array(
                    'pdf_id'=> $a_id,
                    'author' => $cat,
                );
                $this->db->insert('eria_pdf_author', $newA);


            }
        }





    }




    function insert_govPdf($data)
    {
        $this->db->insert('page_pdf', $data);
    }





    function insertTime($data)
    {
        $this->db->insert('eria_timeline', $data);
    }

    function insertArticle($data,$cat,$topic,$related,$editor,$heditor,$author,$hauthor,$mcatogery,$type)
    {



        try {
            $this->db->insert('articles', $data);
            $a_id = $this->db->insert_id();
            if($cat)
            {
               foreach ($cat as $cat)
               {

                   $newA = array(
                       'category_id'=> $cat,
                       'article_id' => $a_id,
                   );
                   $this->db->insert('article_categories', $newA);


               }
            }


            if($topic)
            {
                foreach ($topic as $cat)
                {

                    $newA = array(
                        'topic_id'=> $cat,
                        'article_id' => $a_id,
                    );
                    $this->db->insert('article_topics', $newA);


                }
            }


            if($related)
            {
                foreach ($related as $cat)
                {

                    $newA = array(
                        'to_article_id'=> $cat,
                        'article_id' => $a_id,
                    );
                    $this->db->insert('article_relateds', $newA);


                }
            }

            if($editor)
            {
                foreach ($editor as $cat)
                {

                    $newA = array(
                        'ec_id'=> $cat,
                        'article_id' => $a_id,
                        'ap_type'=> 'Editor',
                        'show_type' => 'Inside',
                    );
                    $this->db->insert('article_persons', $newA);


                }
            }
            if($heditor)
            {
                foreach ($heditor as $cat)
                {

                    $newA = array(
                        'ec_id'=> $cat,
                        'article_id' => $a_id,
                        'ap_type'=> 'Editor',
                        'show_type' => 'Highlite',
                    );
                    $this->db->insert('article_persons', $newA);


                }
            }

            if($author)
            {
                foreach ($author as $cat)
                {

                    $newA = array(
                        'ec_id'=> $cat,
                        'article_id' => $a_id,
                        'ap_type'=> 'Author',
                        'show_type' => 'Inside',
                    );
                    $this->db->insert('article_persons', $newA);


                }
            }
            if($hauthor)
            {
                foreach ($hauthor as $cat)
                {

                    $newA = array(
                        'ec_id'=> $cat,
                        'article_id' => $a_id,
                        'ap_type'=> 'Author',
                        'show_type' => 'Highlite',
                    );
                    $this->db->insert('article_persons', $newA);


                }
            }

            if($mcatogery)
            {
                foreach ($mcatogery as $cat)
                {

                    $newA = array(
                        'cato'=> $cat,
                        'a_id' => $a_id,
                        'am_type'=> $type,
                    );
                    $this->db->insert('article_multimedia_tag', $newA);


                }
            }





            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }


    }


    function getArticle_sub($aid,$atp,$stp)
    {


        $this->db->select('ec_id');
        $this->db->where('article_id', $aid);
        $this->db->where('ap_type', $atp);
        $this->db->where('show_type', $stp);
        $query = $this->db->get('article_persons')->result();



        $typeData=array();
        foreach ($query AS $aid => $query)
        {


            $typeData[$aid]= $query->ec_id;
        }

        return $typeData;


    }

    function get_articleCatogery($aid)
    {

        $this->db->select('category_id');
        $this->db->where('article_id', $aid);
        $query = $this->db->get('article_categories')->result();



        $typeData=array();
        foreach ($query AS $aid => $query)
        {


            $typeData[$aid]= $query->category_id;
        }

        return $typeData;

    }

    function get_articleMultimedia($aid)
    {

        $this->db->select('cato');
        $this->db->where('a_id', $aid);
        //$this->db->where('am_type', 'M');
        $query = $this->db->get('article_multimedia_tag')->result();



        $typeData=array();
        foreach ($query AS $aid => $query)
        {


            $typeData[$aid]= $query->cato;
        }

        return $typeData;

    }


    function get_articleTopic($aid)
    {

        $this->db->select('topic_id');
        $this->db->where('article_id', $aid);
        $query = $this->db->get('article_topics')->result();



        $typeData=array();
        foreach ($query AS $aid => $query)
        {


            $typeData[$aid]= $query->topic_id;
        }

        return $typeData;

    }



    function get_articleRelated($aid)
    {

        $this->db->select('to_article_id');
        $this->db->where('article_id', $aid);
        $query = $this->db->get('article_relateds')->result();



        $typeData=array();
        foreach ($query AS $aid => $query)
        {


            $typeData[$aid]= $query->to_article_id;
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
    
      function insert_expert_sCat($data)
    {



        try {
            $this->db->insert('eria_expert_sub_categories', $data);
            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }


    }
    
    
    function update_expertCat($id,$data)
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
    
    
    function getSub($id)
    {
        
            $this->db->select('*');
            $this->db->where('ec_id', $id);
            $query = $this->db->get('eria_expert_sub_categories');

            return   $query->result();
            
            
    }
    function update_expertsCat($id,$data)
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

            return   $query->row();
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


    function updatecat($id,$data)
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


    function updateTime($id,$data)
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

    function publish_time($id,$pub)
    {

        $this->db->set('published', $pub);
        $this->db->where('time_id', $id);
        $this->db->update('eria_timeline');

    }



    function publish($id,$pub)
    {

        $this->db->set('published', $pub);
        $this->db->where('category_id', $id);
        $this->db->update('categories');

    }

    function publishR($id,$pub)
    {

        $this->db->set('published', $pub);
        $this->db->where('article_id', $id);
        $this->db->update('articles');

    }

    function publishO($id,$pub)
    {

        $this->db->set('published', $pub);
        $this->db->where('oid', $id);
        $this->db->update('organization_structure');

    }

    function publishPage($id,$pub)
    {

        $this->db->set('published', $pub);
        $this->db->where('page_id', $id);
        $this->db->update('pages');

    }

    function publishCd($id,$pub)
    {

        $this->db->set('published', $pub);
        $this->db->where('c_id', $id);
        $this->db->update('eria_card');

    }




    function deletePub($id)
    {

        try {

            $this -> db -> where('np_id', $id);
            $this -> db -> delete('pub_slider');

            return TRUE;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }

    }


}