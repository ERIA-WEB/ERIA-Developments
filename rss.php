<?php

session_start();

	$current_dir = dirname(__FILE__);
	require_once($current_dir."/application/controllers/config.php");
	require_once(APPLICATION_PATH."/controller.class.php");
	$classObj = new controller();

	$highlights = $classObj->db_get_rows("SELECT * FROM articles WHERE article_type='publications' AND (pub_type & 1) = 1 AND published=1 AND highlight=1 ORDER BY articles.posted_date DESC ");
			
			$highlight_ids = array();
			$highlight_ids[] = "0";
			if(is_array($highlights)) foreach ($highlights as $highlight) $highlight_ids[] = $highlight['article_id'];
			$highlight_ids = implode(',', $highlight_ids);

	/*$latest_publications = $classObj->db_get_rows("
				SELECT a.*, b.cat_name, b.cat_uri
				FROM `articles` a
				LEFT JOIN (
					SELECT article_id, group_concat(category_name) AS cat_name, group_concat(uri) AS cat_uri
				    FROM `article_topics` asd
				    JOIN categories qwe
				    WHERE asd.topic_id = qwe.category_id
				    GROUP BY article_id
				) b ON a.article_id = b.article_id 
				WHERE a.article_type='publications' AND (a.pub_type & 1) = 1 AND a.published=1 AND a.article_id NOT IN ({$highlight_ids}) ORDER BY a.posted_date DESC limit 100");*/

				$latest_publications = $classObj->db_get_rows("
				select * from (SELECT a.*
				FROM `articles` a
				LEFT JOIN (
					SELECT article_id, group_concat(category_name) AS cat_name, group_concat(uri) AS cat_uri
				    FROM `article_topics` asd
				    JOIN categories qwe
				    WHERE asd.topic_id = qwe.category_id
				    GROUP BY article_id
				) b ON a.article_id = b.article_id 
				WHERE a.article_type='publications' AND (a.pub_type & 1) = 1 AND a.published=1 

union

SELECT a.*
				FROM `articles` a , `article_categories` ac
where  ac.category_id=45 and a.article_id = ac.article_id

) ab
				ORDER BY ab.posted_date DESC limit 100");
	
/*SELECT a.*, b.cat_name, b.cat_uri
				FROM `articles` a
				LEFT JOIN (	
					SELECT article_id, group_concat(category_name) AS cat_name, group_concat(uri) AS cat_uri
				    FROM `article_topics` asd
				    JOIN categories qwe
				    WHERE asd.topic_id = qwe.category_id
				    GROUP BY article_id
				) b ON a.article_id = b.article_id 
				LEFT JOIN article_categories ac ON ac.article_id=a.article_id
				WHERE a.article_type in ('publications','news') AND a.published=1 OR ac.category_id=45
				ORDER BY a.posted_date DESC limit 100*/
 header( "Content-type: text/xml");
 
 echo "<?xml version='1.0' encoding='UTF-8'?>
 <rss xmlns:media='http://search.yahoo.com/mrss/' xmlns:atom='http://www.w3.org/2005/Atom' xmlns:dc='http://purl.org/dc/elements/1.1/' version='2.0'>
 <channel>
 <title>eria.org | RSS</title>
 <link>https://www.eria.org</link>
 <description>ERIA RSS</description>
 <atom:link href='https://www.eria.org/rss.php' rel='self' type='application/rss+xml' />
 <language>en-us</language>";
 foreach ($latest_publications as $item) {
 	$uri = "";
 	echo "<item>";
      echo "<title>".xmlEscape($item["title"])."</title>";
      if($item["article_type"] == 'news')
      {
			$uri = "https://www.eria.org/news-and-views/" .$item["uri"];
      }
      else {
      		$uri = "https://www.eria.org/publications/" .$item["uri"];
      }
      echo "<link>".$uri."</link>";
      echo " <pubDate>".date('r', strtotime($item["posted_date"]))."</pubDate>";
       echo "<author>".$item["author"]."</author>";
       echo "<guid>".$uri."</guid>";
       echo "</item>";
}
 echo "</channel></rss>";

 function xmlEscape($string) {
    return str_replace(array('&', '<', '>', '\'', '"'), array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), $string);
}

?>