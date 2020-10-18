<?php

class Feed_Model extends CI_Model 
{

	public function add_post($data) 
	{
		$this->db->insert("feed_item", $data);
		return $this->db->insert_ID();
	}

	public function get_home_feed($user, $page, $type="feed") 
	{
		$friends = unserialize($user->info->friends);
		$this->db->group_start();
		if(is_array($friends)) {
			foreach($friends as $friend) {
				$this->db->or_group_start();
				$this->db->or_where("feed_item.userid", $friend);
				$this->db->where("feed_item.post_as !=", "page");
				$this->db->group_end();
			}
		}
		$this->db->or_where("feed_item.userid", $user->info->ID);

		$this->db->or_where("feed_item.postfor", 1);

		$pages = unserialize($user->info->pages);
		if(is_array($pages)) {
			foreach($pages as $pageid) {
				$this->db->or_where("feed_item.pageid", $pageid);
			}
		}
		$this->db->group_end();

		if($type=="feed")
		{
			$this->db->where('feed_item.posttype !=','story');
		}
		if($type=="story")
		{
			$this->db->where('feed_item.posttype !=','feed');
		}
		return $this->db
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor, feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $user->info->ID, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $user->info->ID, "LEFT OUTER")
			->join("user_saved_posts", "user_saved_posts.postid = feed_item.ID AND user_saved_posts.userid = " . $user->info->ID, "left outer")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $user->info->ID, "LEFT OUTER")
			->limit(10, $page)
			->order_by("feed_item.ID", "DESC")
			->get("feed_item");
	}

    public function get_group_posts($groupid, $userid, $group) 
	{
		$this->db->where("feed_item.groupid", $groupid);

		return $this->db
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor,feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $userid, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $userid, "LEFT OUTER")
			->join("user_saved_posts", "user_saved_posts.postid = feed_item.ID AND user_saved_posts.userid = " . $userid, "left outer")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $userid, "LEFT OUTER")
			->order_by("feed_item.ID", "DESC")
			->limit(10, $group)
			->get("feed_item");
	}
	public function get_all_feed($userid, $page, $type="feed") 
	{

		if($type=="feed")
		{
			$this->db->where('feed_item.posttype !=','story');
		}
		if($type=="story")
		{
			$this->db->where('feed_item.posttype !=','feed');
		}

		return $this->db
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor,feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $userid, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $userid, "LEFT OUTER")
			->join("user_saved_posts", "user_saved_posts.postid = feed_item.ID AND user_saved_posts.userid = " . $userid, "left outer")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $userid, "LEFT OUTER")
			->order_by("feed_item.ID", "DESC")
			->limit(10,$page)
			->get("feed_item");
	}

	public function get_hashtag_feed($hashtag, $userid, $page, $type="feed") 
	{
		$hashtag = "#" . $hashtag;
		$this->db->like("feed_item.content", $hashtag);
		if($type=="feed")
		{
			$this->db->where('feed_item.posttype !=','story');
		}
		if($type=="story")
		{
			$this->db->where('feed_item.posttype !=','feed');
		}

		return $this->db
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor,feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $userid, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $userid, "LEFT OUTER")
			->join("user_saved_posts", "user_saved_posts.postid = feed_item.ID AND user_saved_posts.userid = " . $userid, "left outer")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $userid, "LEFT OUTER")
			->order_by("feed_item.ID", "DESC")
			->limit(10,$page)
			->get("feed_item");
	}

	public function get_saved_feed($userid, $page, $type="feed") 
	{
		$this->db->where("user_saved_posts.userid", $userid);

		if($type=="feed")
		{
			$this->db->where('feed_item.posttype !=','story');
		}
		if($type=="story")
		{
			$this->db->where('feed_item.posttype !=','feed');
		}

		return $this->db
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor,feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("feed_item", "feed_item.ID = user_saved_posts.postid")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $userid, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $userid, "LEFT OUTER")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $userid, "LEFT OUTER")
			->order_by("feed_item.ID", "DESC")
			->limit(10, $page)
			->get("user_saved_posts");
	}

	public function get_user_posts_only($userid, $page, $type="feed") 
	{
		$this->db->where("feed_item.userid", $userid);
		$this->db->where("feed_item.hide_profile", 0);
		if($type=="feed")
		{
			$this->db->where('feed_item.posttype !=','story');
		}
		if($type=="story")
		{
			$this->db->where('feed_item.posttype !=','feed');
		}

		return $this->db
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor,feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $userid, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $userid, "LEFT OUTER")
			->join("user_saved_posts", "user_saved_posts.postid = feed_item.ID AND user_saved_posts.userid = " . $userid, "left outer")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $userid, "LEFT OUTER")
			->order_by("feed_item.ID", "DESC")
			->limit(10, $page)
			->get("feed_item");
	}

	public function get_page_posts($pageid, $userid, $page) 
	{
		$this->db->where("feed_item.pageid", $pageid);

		return $this->db
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor,feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $userid, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $userid, "LEFT OUTER")
			->join("user_saved_posts", "user_saved_posts.postid = feed_item.ID AND user_saved_posts.userid = " . $userid, "left outer")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $userid, "LEFT OUTER")
			->order_by("feed_item.ID", "DESC")
			->limit(10, $page)
			->get("feed_item");
	}

	public function get_promoted_posts($userid, $type="feed") 
	{
		if($type=="feed")
		{
			$this->db->where('feed_item.posttype !=','story');
		}
		if($type=="story")
		{
			$this->db->where('feed_item.posttype !=','feed');
		}

		return $this->db
			->where("promoted_posts.status", 2)
			->where("promoted_posts.pageviews >", 0)
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor,feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				promoted_posts.pageviews, promoted_posts.status, promoted_posts.ID as promoted_id,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("feed_item", "feed_item.ID = promoted_posts.postid")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $userid, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $userid, "LEFT OUTER")
			->join("user_saved_posts", "user_saved_posts.postid = feed_item.ID AND user_saved_posts.userid = " . $userid, "left outer")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $userid, "LEFT OUTER")
			->order_by("RAND()")
			->limit(3)
			->get("promoted_posts");
	}

	public function get_post($id, $userid) 
	{
		return $this->db
			->where("feed_item.ID", $id)
			->select("feed_item.ID, feed_item.content, feed_item.post_as, feed_item.postfor,feed_item.groupid,
				feed_item.timestamp, feed_item.userid, feed_item.likes, feed_item.dislikes,
				feed_item.comments, feed_item.location, feed_item.user_flag,
				feed_item.profile_userid, feed_item.template, feed_item.site_flag,
				feed_item.pollid, feed_item.share_postid, feed_item.member_only,
				user_images.ID as imageid, user_images.file_name as image_file_name,
				user_images.file_url as image_file_url,
				user_videos.ID as videoid, user_videos.file_name as video_file_name,
				user_videos.youtube_id, user_videos.extension as video_extension,
				users.username, users.first_name, users.last_name, users.avatar,
				users.posts_view, users.email, users.email_notification,
				users.verified,
				feed_likes.ID as likeid, feed_likes.type as like_type,
				profile.username as p_username, profile.first_name as p_first_name,
				profile.last_name as p_last_name, profile.avatar as p_avatar,
				profile.verified as p_verified,
				profile.online_timestamp as p_online_timestamp,
				user_albums.ID as albumid, user_albums.name as album_name,
				pages.ID as pageid, pages.name as page_name, 
				pages.profile_avatar as page_avatar, pages.slug as page_slug,
				calendar_events.title as event_title, calendar_events.description as event_description,
				calendar_events.start as event_start, calendar_events.end as event_end,
				calendar_events.location as event_location, calendar_events.ID as eventid,
				page_users.roleid,
				user_saved_posts.ID as savepostid,
				feed_item_subscribers.ID as subid,
				feed_item_polls.question as poll_question, feed_item_polls.type as poll_type,
				feed_item_polls.votes as poll_votes,
				user_blog_posts.Id as blog_postid, user_blog_posts.title as blog_post_title,
				user_blog_posts.image as blog_post_image")
			->join("users", "users.ID = feed_item.userid")
			->join("user_images", "user_images.ID = feed_item.imageid", "left outer")
			->join("user_videos", "user_videos.ID = feed_item.videoid", "left outer")
			->join("user_albums", "user_albums.ID = user_images.albumid", "left outer")
			->join("users as profile", "profile.ID = feed_item.profile_userid", "left outer")
			->join("feed_item_polls", "feed_item_polls.ID = feed_item.pollid", "left outer")
			->join("user_blog_posts", "user_blog_posts.ID = feed_item.blog_postid", "left outer")
			->join("pages", "pages.ID = feed_item.pageid", "left outer")
			->join("page_users", "page_users.pageid = feed_item.pageid AND page_users.userid = " . $userid, "LEFT OUTER")
			->join("calendar_events", "calendar_events.ID = feed_item.eventid", "left outer")
			->join("feed_likes", "feed_likes.postid = feed_item.ID AND feed_likes.userid = " . $userid, "LEFT OUTER")
			->join("user_saved_posts", "user_saved_posts.postid = feed_item.ID AND user_saved_posts.userid = " . $userid, "left outer")
			->join("feed_item_subscribers", "feed_item_subscribers.postid = feed_item.ID and feed_item_subscribers.userid = " . $userid, "LEFT OUTER")
			->get("feed_item");
	}

	public function update_post($id, $data) 
	{
		$this->db->where("ID", $id)->update("feed_item", $data);
	}

	public function delete_post($id) 
	{
		$this->db->where("ID", $id)->delete("feed_item");
	}

	public function report_abuse_post($postid, $reason) 
	{
		$data = array();
		$data['postid'] = $postid;
		$data['reason'] = $reason;
		$data['fromid'] = $this->user->info->ID;
		$data['timestamp'] = strtotime(date('Y-m-d H:i:s'));
		$this->db->insert("report_abuse_posts", $data);
	}


	public function is_post_reported($postid) 
	{
		$data = array();
		$data['postid'] = $postid;
		$data['fromid'] = $this->user->info->ID;
		return $this->db->get_where('report_abuse_posts', $data)->num_rows();
	}

	public function get_post_like($id, $userid) 
	{
		return $this->db
			->where("feed_likes.postid", $id)
			->where("feed_likes.userid", $userid)
			->get("feed_likes");
	}

	public function delete_like_post($id) 
	{
		$this->db->where("ID", $id)->delete("feed_likes");
	}

	public function add_post_like($data) 
	{
		$this->db->insert("feed_likes", $data);
	}

	public function add_image($data) 
	{
		$this->db->insert("user_images", $data);
		return $this->db->insert_ID();
	}

	public function add_video($data) 
	{
		$this->db->insert("user_videos", $data);
		return $this->db->insert_ID();
	}

	public function get_post_likes($id) 
	{
		return $this->db->where("feed_likes.postid", $id)
			->select("users.username, users.first_name, users.last_name,
				users.online_timestamp, users.avatar, feed_likes.type")
			->join("users", "users.ID = feed_likes.userid")
			->get("feed_likes");
	}

	public function get_single_comment($id, $userid, $commentid) 
	{
		return $this->db
			->where("feed_item_comments.ID", $commentid)
			->where("feed_item_comments.postid", $id)
			->select("feed_item_comments.ID, feed_item_comments.timestamp, feed_item_comments.comment,
				feed_item_comments.userid, feed_item_comments.likes, feed_item_comments.replies,
				users.username, users.first_name, users.last_name, users.online_timestamp,
				users.avatar, users.verified,
				feed_item_comment_likes.ID as commentlikeid")
			->join("users", "users.ID = feed_item_comments.userid")
			->join("feed_item_comment_likes", "feed_item_comment_likes.commentid = feed_item_comments.ID AND feed_item_comment_likes.userid = " . $userid, "LEFT OUTER")
			->get("feed_item_comments");
	}
	
	public function get_feed_comments($id, $userid, $page) 
	{
		return $this->db
			->where("feed_item_comments.postid", $id)
			->select("feed_item_comments.ID, feed_item_comments.timestamp, feed_item_comments.comment,
				feed_item_comments.userid, feed_item_comments.likes, feed_item_comments.replies,
				users.username, users.first_name, users.last_name, users.online_timestamp,
				users.avatar, users.verified,
				feed_item_comment_likes.ID as commentlikeid")
			->join("users", "users.ID = feed_item_comments.userid")
			->join("feed_item_comment_likes", "feed_item_comment_likes.commentid = feed_item_comments.ID AND feed_item_comment_likes.userid = " . $userid, "LEFT OUTER")
			->limit(5, $page)
			->order_by("ID", "DESC")
			->get("feed_item_comments");
	}

	public function add_comment($data) 
	{
		$this->db->insert("feed_item_comments", $data);
		return $this->db->insert_ID();
	}

	public function get_comment($id) 
	{
		return $this->db
			->where("feed_item_comments.ID", $id)
			->select("feed_item_comments.ID, feed_item_comments.postid,
				feed_item_comments.userid, feed_item_comments.comment,
				feed_item_comments.timestamp, feed_item_comments.likes,
				feed_item_comments.commentid, feed_item_comments.replies,
				feed_item.comments, feed_item.ID as feeditemid,
				users.ID as userid, users.username, users.email, users.email_notification,
				users.verified,
				fc.postid as fcpostid, fc_item.comments as fc_item_comments")
			->join("feed_item", "feed_item.ID = feed_item_comments.postid", "left outer")
			->join("feed_item_comments as fc", "fc.ID = feed_item_comments.commentid", "left outer")
			->join("feed_item as fc_item", "fc_item.ID = fc.postid", "left outer")
			->join("users", "users.ID = feed_item_comments.userid")
			->get("feed_item_comments");
	}

	public function increment_post($id) {
		$this->db->where("ID", $id)->set("comments", "comments+1", FALSE)->update("feed_item");
	}

	public function get_comment_like($id, $userid) 
	{
		return $this->db->where("commentid", $id)
			->where("userid", $userid)->get("feed_item_comment_likes");
	}

	public function update_comment($id, $data) 
	{
		$this->db->where("ID", $id)->update("feed_item_comments", $data);
	}

	public function delete_comment_like($id) 
	{
		$this->db->where("ID", $id)->delete("feed_item_comment_likes");
	}

	public function add_comment_like($data) 
	{
		$this->db->insert("feed_item_comment_likes", $data);
	}

	public function get_comment_replies($id, $userid, $page) 
	{
		return $this->db
			->where("feed_item_comments.commentid", $id)
			->select("feed_item_comments.ID, feed_item_comments.commentid, feed_item_comments.timestamp, feed_item_comments.comment,
				feed_item_comments.userid, feed_item_comments.likes,
				users.username, users.first_name, users.last_name, users.online_timestamp,
				users.avatar, users.verified,
				feed_item_comment_likes.ID as commentlikeid")
			->join("users", "users.ID = feed_item_comments.userid")
			->join("feed_item_comment_likes", "feed_item_comment_likes.commentid = feed_item_comments.ID AND feed_item_comment_likes.userid = " . $userid, "LEFT OUTER")
			->order_by("ID", "DESC")
			->get("feed_item_comments");
	}

	public function add_feed_users($data) 
	{
		$this->db->insert("feed_item_users", $data);
	}

	public function get_feed_users($id) 
	{
		return $this->db->where("feed_item_users.postid", $id)
			->select("users.username, users.first_name, users.last_name")
			->join("users", "users.ID = feed_item_users.userid")
			->get("feed_item_users");
	}

	public function delete_feed_users($id) {
		$this->db->where("postid", $id)->delete("feed_item_users");
	}

	public function add_feed_image($data) 
	{
		$this->db->insert("feed_item_images", $data);
	}

	public function get_feed_images($id) 
	{
		return $this->db
			->where("feed_item_images.postid", $id)
			->select("user_images.file_name, user_images.ID as imageid,
				user_images.file_url, user_images.name, user_images.description,
				user_albums.ID as albumid, user_albums.name as album_name")
			->join("user_images", "user_images.ID = feed_item_images.imageid")
			->join("user_albums", "user_albums.ID = user_images.albumid")
			->get("feed_item_images");
	}

	public function add_hashtag($data) 
	{
		$this->db->insert("feed_hashtags", $data);
	}

	public function get_hashtag($tag) 
	{
		return $this->db->where("hashtag", $tag)->get("feed_hashtags");
	}

	public function increment_hashtag($id) 
	{
		$this->db->where("ID", $id)->set("count", "count+1", FALSE)->update("feed_hashtags");
	}

	public function get_trending_hashtags($limit) 
	{
		return $this->db->limit($limit)->order_by("COUNT", "DESC")->get("feed_hashtags");
	}

	public function get_user_save_post($id, $userid) 
	{
		return $this->db->where("postid", $id)->where("userid", $userid)->get("user_saved_posts");
	}

	public function add_saved_post($data) 
	{
		$this->db->insert("user_saved_posts", $data);
	}

	public function delete_saved_post($id) 
	{
		$this->db->where("ID", $id)->delete("user_saved_posts");
	}

	public function add_tagged_user($data) 
	{
		$this->db->insert("feed_tagged_users", $data);
	}

	public function get_feed_tag($id, $userid) 
	{
		return $this->db->where("postid", $id)->where("userid", $userid)->get("feed_tagged_users");
	}

	public function add_feed_subscriber($data) 
	{
		$this->db->insert("feed_item_subscribers", $data);
	}

	public function get_feed_subscriber($id, $userid) 
	{
		return $this->db->where("postid", $id)->where("userid", $userid)->get("feed_item_subscribers");
	}

	public function get_feed_subscribers($id) 
	{
		return $this->db
			->where("postid", $id)
			->select("users.ID, users.username, users.email, users.email_notification,
				users.verified")
			->join("users", "users.ID = feed_item_subscribers.userid", "left outer")
			->get("feed_item_subscribers");
	}

	public function delete_feed_subscribe($id) 
	{
		$this->db->where("ID", $id)->delete("feed_item_subscribers");
	}

	public function delete_comment($id) 
	{
		$this->db->where("ID", $id)->delete("feed_item_comments");
	}

	public function add_feed_site($data) 
	{
		$this->db->insert("feed_item_urls", $data);
	}

	public function get_feed_urls($id) 
	{
		return $this->db->where("postid", $id)->get("feed_item_urls");
	}

	public function get_posts_with_image($id) 
	{
		return $this->db->where("imageid", $id)->get("feed_item");
	}

	public function decrease_post_pageviews($id) 
	{
		$this->db->where("ID", $id)->set("pageviews", "pageviews-1", FALSE)->update("promoted_posts");
	}

	public function add_feed_poll($data) 
	{
		$this->db->insert("feed_item_polls", $data);
		return $this->db->insert_ID();
	}

	public function delete_feed_poll($id) 
	{
		$this->db->where("ID", $id)->delete("feed_item_polls");
	}

	public function delete_feed_poll_answers($pollid) 
	{
		$this->db->where("pollid", $pollid)->delete("feed_item_poll_answers");
	}

	public function add_feed_poll_answer($data) 
	{
		$this->db->insert("feed_item_poll_answers", $data);
	}

	public function update_feed_poll($id, $data) 
	{
		$this->db->where("ID", $id)->update("feed_item_polls", $data);
	}

	public function get_poll_answers($pollid, $userid) 
	{
		return $this->db
			->where("feed_item_poll_answers.pollid", $pollid)
			->select("feed_item_poll_answers.ID, feed_item_poll_answers.answer,
				feed_item_poll_answers.votes,
				feed_item_poll_votes.ID as voteid")
			->join("feed_item_poll_votes", "feed_item_poll_votes.answerid = feed_item_poll_answers.ID AND feed_item_poll_votes.userid = " . $userid, "left outer")
			->get("feed_item_poll_answers");
	}

	public function get_poll_answer($pollid, $answerid) 
	{
		return $this->db->where("pollid", $pollid)->where("ID", $answerid)->get("feed_item_poll_answers");
	}

	public function delete_poll_answer($id) 
	{
		$this->db->where("ID", $id)->delete("feed_item_poll_answers");
	}

	public function update_poll_answer($id, $data) 
	{
		$this->db->where("ID", $id)->update("feed_item_poll_answers", $data);
	}

	public function increment_poll_answer($id) 
	{
		$this->db->where("ID", $id)->set("votes", "votes+1", FALSE)->update("feed_item_poll_answers");
	}

	public function increment_poll($id) 
	{
		$this->db->where("ID", $id)->set("votes", "votes+1", FALSE)->update("feed_item_polls");
	}

	public function add_poll_vote($data) 
	{
		$this->db->insert("feed_item_poll_votes", $data);
	}

	public function get_user_vote($pollid, $userid) 
	{
		return $this->db->where("pollid", $pollid)->where("userid", $userid)->get("feed_item_poll_votes");
	}

	public function update_like($id, $data) 
	{
		$this->db->where("ID" ,$id)->update("feed_likes", $data);
	}

	public function get_user_stories($id)
	{
		$timestamp = strtotime(date('Y-m-d', strtotime( '-24 hours', time() )));
		return $this->db->get_where('feed_item',array('userid'=>$id,'posttype !='=>'feed','timestamp >='=>$timestamp));
	}

	public function get_user_last_story_timestamp($id)
	{
		$timestamp = strtotime(date('Y-m-d', strtotime( '-24 hours', time() )));
		return $this->db->order_by('ID','DESC')->limit('1')->select('timestamp')->get_where('feed_item',array('userid'=>$id,'posttype !='=>'feed','timestamp >='=>$timestamp));
	}

	public function get_user_last_story($id)
	{
		$timestamp = strtotime(date('Y-m-d', strtotime( '-24 hours', time() )));
		$postid = $this->db->order_by('ID','DESC')->limit('1')->select('ID')->get_where('feed_item',array('userid'=>$id,'posttype !='=>'feed','timestamp >='=>$timestamp))->row()->ID;
		return $this->get_post($postid, $this->user->info->ID);
	}

	public function get_users_have_stories()
	{
		$friends = $this->db->select('friendid')->where('userid',$this->user->info->ID)->get('user_friends');
		if($friends->num_rows()>0)
		{
			$friendsids = $friends->result_array();
		}
		$k=0;
		$ids = array();
		foreach($friendsids as $row)
		{
			$ids[$k] = $row['friendid'];
			$k++;
		}
		$timestamp = strtotime(date('Y-m-d', strtotime( '-24 hours', time() )));
		return $this->db->group_by('userid')->select('userid')->where('posttype !=','feed')->where('timestamp >=',$timestamp)->where_in('userid',$ids)->get('feed_item');
	}

	public function get_users_have_stories_home()
	{
		$friends = $this->db->select('friendid')->where('userid',$this->user->info->ID)->get('user_friends');
		$friendsids = array();
		if($friends->num_rows()>0)
		{
			$friendsids = $friends->result_array();
		}
		$k=0;
		$ids = array();
		foreach($friendsids as $row)
		{
			$ids[$k] = $row['friendid'];
			$k++;
		}
		$ids[$k] = '-1';
		$timestamp = strtotime(date('Y-m-d', strtotime( '-24 hours', time() )));
		return $this->db->order_by('ID','DESC')->limit('2')->group_by('userid')->select('userid')->where('posttype !=','feed')->where('timestamp >=',$timestamp)->where_in('userid',$ids)->get('feed_item');
		
	}

	public function story_duration()
	{
		if($this->db->select('story_time')->get('site_settings')->num_rows()>0)
		{
			return $this->db->select('story_time')->get('site_settings')->row()->story_time * 1000;
		}
		else
		{
			return 5000;
		}
		
	}

	public function add_story_viewer($postid, $userid)
	{
		$data = array( 'postid'=>$postid, 'userid' => $userid );
		$this->db->insert('story_viewers',$data);
	}

	public function get_story_viewers($postid)
	{
		$data = array('postid'=>$postid);
		return $this->db->get_where('story_viewers',$data);
	}

	public function check_story_viewer($postid, $userid)
	{
		$data = array('postid'=>$postid, 'userid'=>$userid);
		return $this->db->get_where('story_viewers',$data)->num_rows();
	}

	public function get_page_cat_id($name)
	{
		$r = 0;
		$cat = $this->db->select('ID')->from('page_categories')->where('name',$name)->get();
		if($cat->num_rows()>0)
		{
			$c = $cat->row();
			$r = $c->ID;
		}

		return $r;
	}

	public function is_business_or_celebrity($postid)
	{
		$r=0;
		$post = $this->db->select('pageid')->from('feed_item')->where('ID',$postid)->get();
		if($post->num_rows()>0)
		{
			$p = $post->row();
			if($p->pageid>0)
			{
				$pgi = $this->db->select('categoryid')->from('pages')->where('ID',$p->pageid)->get();
				if($pgi->num_rows()>0)
				{
						$r=1;
				}
			}
		}
		return $r;
	}


	public function get_post_by_image($imageid)
	{
		/*$r=0;
		$post = $this->db->select('postfor')->from('feed_item')->where('imageid',$imageid)->get();
		if($post->num_rows()>0)
		{
			$r = $post->row()->postfor;
		}*/
		return $this->db->select('*')->from('feed_item')->where('imageid',$imageid)->get();//$r;
	}

	public function isRtl($value) {
	    $rtlChar = '/[\x{0590}-\x{083F}]|[\x{08A0}-\x{08FF}]|[\x{FB1D}-\x{FDFF}]|[\x{FE70}-\x{FEFF}]/u';
	    return preg_match($rtlChar, $value) != 0;
	}
    public function get_imageid_by_postid($id)
	{
		return $this->db->where('ID',$id)->get("feed_item")->row()->imageid;
	}


}

?>