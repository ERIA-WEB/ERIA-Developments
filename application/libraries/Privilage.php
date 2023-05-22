<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Phpfastcache\CacheManager;
use \Phpfastcache\Config\ConfigurationOption;

class privilage
{
	public function login($username, $u_id, $privilage, $g_id)
	{
		if ($username == "") {
			redirect(base_url());
		}		
		else
		{
			$ci =& get_instance();
			//$ci->db->select('*');
			if ($u_id == 1 or $u_id == 4)
			{
				return TRUE;	
			}
			
			if ($privilage == "dashboard")
			{
				return TRUE;
			} else {
				$ci->db->select('*');
				$ci->db->from('group_privilage AS group_privilage');
				$ci->db->join('privilages', 'privilages.id = group_privilage.prid', 'left');
				$ci->db->where('group_privilage.prid', $privilage);
				$ci->db->where('group_privilage.status', 1);
				$ci->db->where('group_privilage.group_id', $g_id);

				$query = $ci->db->get();

				$num = $query->num_rows();
				if ($num == 0) {
					return FALSE;
				} else {
					return $num;
				}
			}
		}
	}
	
	public function report($username, $u_id, $privilage)
	{
		if ($username == "") {
			redirect(base_url());
		} else {
			$ci = &get_instance();
			//$ci->db->select('*');

			if ($u_id == 1 or $u_id == 4) {
				return TRUE;
			}
			if ($privilage == "dashboard") {
				return FALSE;
			} else {


				$ci->db->select('*');
				$ci->db->from('user_sub_privilage AS user_sub_privilage');

				$ci->db->join('privilages_sub', 'privilages_sub.spid = user_sub_privilage.spid', 'left');
				$ci->db->where('user_sub_privilage.pid', $privilage);
				$ci->db->where('user_sub_privilage.uspstatus', 1);
				$ci->db->where('user_sub_privilage.user_id', $u_id);

				$query = $ci->db->get();

				$num = count($query->row());
				if ($num == 0) {
					$tdate = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));


					return $tdate;
				} else {


					$asdate = $query->row('spname');
					if ($asdate == '14 Days') {
						$tdate = date('Y-m-d', strtotime('-14 day', strtotime(date('Y-m-d'))));
					} else if ($asdate == '7 Days') {
						$tdate = date('Y-m-d', strtotime('-7 day', strtotime(date('Y-m-d'))));
					} else if ($asdate == '30 Days') {
						$tdate = date('Y-m-d', strtotime('-30 day', strtotime(date('Y-m-d'))));
					} else if ($asdate == '60 Days') {
						$tdate = date('Y-m-d', strtotime('-60 day', strtotime(date('Y-m-d'))));
					} else if ($asdate == 'All') {
						$tdate = FALSE;
					}

					return $tdate;
				}
			}
		}
	}

	public function edit($param_action, $user_id, $url_slug, $id)
	{
		$ci = &get_instance();
		$ci->db->select('users.user_id,users.group_id,users.username,user_groups.group_name');
		$ci->db->from('users');

		$ci->db->join('user_groups', 'user_groups.group_id = users.group_id', 'left');
		$ci->db->where('users.user_id', $user_id);

		$query = $ci->db->get();

		$group_data = $query->result();

		foreach ($group_data as $group) {
			if ($group->group_name == 'Admin') {
				$result['edit'] = '<a class="btn btn-info" href="' . base_url() . 'system-content/' . $url_slug . $id . '">
                                        	<i class="fa fa-edit"></i> 
										</a>';
			} else {
				$result['edit'] = '<a class="btn btn-info" href="#">
                                        	<i class="fa fa-edit"></i> 
										</a>';
			}
		}

		return $result;
	}

	public function status($param_action, $user_id, $id, $btnstatus)
	{
		$ci = &get_instance();
		$ci->db->select('users.user_id,users.group_id,users.username,user_groups.group_name');
		$ci->db->from('users');

		$ci->db->join('user_groups', 'user_groups.group_id = users.group_id', 'left');
		$ci->db->where('users.user_id', $user_id);

		$query = $ci->db->get();

		$group_data = $query->result();

		foreach ($group_data as $group) {
			if ($group->group_name == 'Admin') {

				$result['status'] = '<a href="#confirm" data-id="' . $id . '" ' . $btnstatus . '>
                                                <i class="fa fa-check-square" aria-hidden="true"></i> 
											</a>';
			} else {
				$result['status'] = '<a href="#" class="btn btn-warning pub-callback">
                                            	<i class="fa fa-check-square" aria-hidden="true"></i> 
											</a>';
			}
		}

		return $result;
	}

	public function delete($param_action, $user_id, $id)
	{
		$ci = &get_instance();
		$ci->db->select('users.user_id,users.group_id,users.username,user_groups.group_name');
		$ci->db->from('users');

		$ci->db->join('user_groups', 'user_groups.group_id = users.group_id', 'left');
		$ci->db->where('users.user_id', $user_id);

		$query = $ci->db->get();

		$group_data = $query->result();

		foreach ($group_data as $group) {
			if ($group->group_name == 'Admin') {

				$result['delete'] = '<a href="#confirm" data-id="' . $id .
				'" data-placement="left" class="btn btn-danger confirmation-callback">
                                            <i class="fa fa-trash"></i> 
										</a>';
			} else {
				$result['delete'] = '<a href="#" class="btn btn-danger confirmation-callback">
                                            <i class="fa fa-trash"></i> 
										</a>';
			}
		}

		return $result;
	}

	public function clean_caracther($string)
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	function timeExpired($param_key)
	{
		if ($param_key == 'listnews') {
			$time = 600; // 1 hour = 3600 seconds
		} else {
			$time = 120;
		}
		
		return $time;
	}

	public function cacheManager($result_data, $param_key)
	{
		CacheManager::setDefaultConfig(new ConfigurationOption([
			'path' => APPPATH . '/cache-cms',
		]));

		$this->InstanceCache = CacheManager::getInstance('files');

		$key_cache = "getPage_allarticle_" . $param_key ."_". time();
		$CachedString = $this->InstanceCache->getItem($key_cache);

		if (!$CachedString->isHit()) {
			$results = $result_data;
			$CachedString->set($results)->expiresAfter($this->timeExpired($param_key)); // 1 hour = 3600 seconds
			$this->InstanceCache->save($CachedString);
		} else {
			$results = $CachedString->get();
		}

		return $results;
	}

	public function detectPage($param1, $param2)
	{
		$whitelist = array('127.0.0.1', "::1", "localhost");

		if (in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
			$parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

			$urlArray = explode('/', $parse_url);
			if (in_array($param1, $urlArray)) {
				$breadcumb = $param1;
			} else {
				$breadcumb = $param2;
			}
		} else {
			$parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');

			$urlArray = explode('/', $parse_url);
			if (in_array($param1, $urlArray)) {
				$breadcumb = $param1;
			} else {
				$breadcumb = $param2;
			}
		}

		return $breadcumb;
	}

	function RemoveBS($Str)
	{
		$StrArr = str_split($Str);
		$NewStr = '';
		foreach ($StrArr as $Char) {
			$CharNo = ord($Char);
			if ($CharNo == 163) {
				$NewStr .= $Char;
				continue;
			} // keep £ 
			if (
				$CharNo > 31 && $CharNo < 127
			) {
				$NewStr .= $Char;
			}
		}
		return $NewStr;
	}

	function getPageAction($id)
	{
		$ci =& get_instance();
		
		$page_action = [
						0 => [
							'card_id'       => '2',
							'areaList'      => $ci->Page_model->getPage_allarticle('news', 200)->result(),
							'contentData'   => $ci->Card_model->getPageCardRandoms($id),
							'action'        => site_url('system-content/Card/editCardRandomLatesNews'),
							'content'       => 'back-end/content/Card/randoms/latest-news',
						],
						1 => [
							'card_id'       => '3',
							'areaList'      => $ci->Page_model->getMultimediaByCategory('multimedia'),
							'contentData'   => $ci->Card_model->getPageCardRandoms($id),
							'action'        => site_url('system-content/Card/editCardRandomMultimedia'),
							'content'       => 'back-end/content/Card/randoms/multimedia',
						],
						3 => [
							'card_id'       => '5',
							'areaList'      => '',
							'contentData'   => $ci->Card_model->getPageCardRandoms($id),
							'action'        => site_url('system-content/Card/editCardRandomQuicklinks'),
							'content'       => 'back-end/content/Card/randoms/quick-links',
						],
						4 => [
							'card_id'       => '6',
							'areaList'      => '',
							'contentData'   => $ci->Card_model->getPageCardRandoms($id),
							'action'        => site_url('system-content/Card/editCardRandomRelatedCategories'),
							'content'       => 'back-end/content/Card/randoms/related-categories',
						],
					];
					
		return $page_action;
	}

	function getCardPage($page_id, $card_random_id)
	{
		try {
            $ci =& get_instance();

			$ci->db->select('eria_card_randoms_pages.card_random_id, eria_card_randoms_pages.page_id, eria_card_randoms.*');
			$ci->db->from('eria_card_randoms_pages');
			$ci->db->join('eria_card_randoms', 'eria_card_randoms.c_id = eria_card_randoms_pages.card_random_id', 'inner');
			$ci->db->where('eria_card_randoms_pages.page_id', $page_id);
			$ci->db->where('eria_card_randoms_pages.card_random_id', $card_random_id);
			$results  = $ci->db->get()->row();

			return $results;
        } catch (Exception $err) {
            return show_error($err->getMessage());
        }
		
	}

	function duplicationPage($pages, $article_id, $title, $key, $site_url, $slug)
	{
		$ci =& get_instance();
		$template_pages = [
			0 => [
				'value' 	=> 'publications',
				'name' 		=> 'RESEARCH / PUBLICATIONS',
			],
			1 => [
				'value' 	=> 'articles',
				'name' 		=> 'PROGRAMMES',
			],
			2 => [
				'value' 	=> 'news',
				'name' 		=> 'UPDATES / NEWS',
			],
			3 => [
				'value' 	=> 'events',
				'name' 		=> 'EVENTS',
			],
			4 => [
				'value' 	=> 'multimedia',
				'name' 		=> 'MULTIMEDIA',
			],
		];

		$html = '';
		$html .= '<div class="modal fade" id="modal'.$key.'" tabindex="-1" role="dialog"
						aria-labelledby="exampleModalLabel'.$key.'" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title bold" id="exampleModalLabel'.$key.'">
										Duplicate Page "'.$title.'"
									</h5>
									<button type="button" class="close" data-dismiss="modal"
										aria-label="Close"
										style="position: absolute;right: 15px;top: 15px;">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form method="POST" enctype="multipart/form-data" accept-charset="utf-8"
									action="'.$site_url.'">
									<div class="modal-body">
										<input type="hidden" value="'.$article_id.'"
											name="article_id">
										<input type="hidden" value="'.$slug.'"
											name="slug">
										<input type="hidden" value="'.$pages.'"
											name="current_page">
										<div class="form-group">';
										
										$article_duplicate = $ci->Page_model->getDuplicateArticleBySlug($slug);
										
										$page_article = array();
										if (!empty($article_duplicate)) {
											foreach ($article_duplicate as $key => $value) {
												if ($value->pages == 'publications') {
													$value_page = 'publications';
												} else {
													$value_page = $value->pages;
												}
												$page_article[] = $value_page;
											}
										} else {
											$page_article = array();
										}
										
										
										if (count($page_article) == 5) {
											$disabled = 'disabled';
										} else {
											$disabled = '';
										}
										
										foreach ($template_pages as $i => $value) {
											if (in_array($value['value'], $page_article)) {
												$checked = 'checked="true"';
												$disabled_check = 'disabled';
											} else {
												$checked = '';
												$disabled_check = '';
											}
											if ($value['value'] != $pages) {
												
												$html .= '<div class="controls">
																	<input style="width: 25px;float: left;margin-right: 15px;margin-top: -6px;" 
																	type="checkbox" value="'.$value['value'].'" class="form-control" 
																	id="category_name'.$i.'" name="pages[]" '.$checked.' '.$disabled_check.'>
																	'.$value['name'].'                                                         
																</div>'; 
											}
										}

		$html .= '						</div>
									</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary"
									data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" '.$disabled.'>Save
									changes</button>
							</div>
						</form>
					</div>
				</div>
				</div>';
				
		return $html;
	}

	function insertDuplicatePage($input, $users)
	{
		$ci =& get_instance();
		$get_data_before = $ci->Page_model->getOneArticle($input['article_id']);
        
		$article_slug = $get_data_before->uri;
		
        if (isset($input['pages'])) {
			$getResultDuplicateArticle = $ci->Page_model->getArticleIDByUri($article_slug);
			
			foreach ($getResultDuplicateArticle as $key => $value) {
				$uri_slug_articles[] = $value->uri;
				$articleTypes[] = $value->article_type;
			}
			
			$parent_article = $input['article_id'];
			$slug_duplicate = $input['slug'];
			$current_page_article = $input['current_page'];
			
			foreach ($input['pages'] as $key => $value) {
				$data_duplicate[] = array(
					'image_name'        => $get_data_before->image_name,
					'article_type'      => $value,
					'uri'               => $get_data_before->uri,
					'pub_type'          => 0,
					'title'             => $get_data_before->title,
					'posted_date'       => $get_data_before->posted_date,
					'author'            => $get_data_before->author,
					'content'           => $get_data_before->content,
					'tags'              => $get_data_before->tags,
					'editor'            => $get_data_before->editor,
					'published'         => 0, // $get_data_before->published
					'start_date'        => $get_data_before->start_date,
					'doc_no'            => $get_data_before->doc_no,
					'period'            => $get_data_before->period,
					'article_status'    => $get_data_before->article_status,
					'venue'             => $get_data_before->venue,
					'highlight'         => $get_data_before->highlight,
					'modified_by'       => $users['user_id'],
					'modified_date'     => date('Y-m-d H:i:s'),
					'meta_keywords'     => $get_data_before->meta_keywords,
					'meta_description'  => $get_data_before->meta_description,
				);
			}
			$result = $ci->Page_model->insert_article_default($data_duplicate, $value, $parent_article, $slug_duplicate, $current_page_article, $articleTypes, $input['pages']);
			
        } else {
			$result = FALSE;
		}

		return $result;
	}
}