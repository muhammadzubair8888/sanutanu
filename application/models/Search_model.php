<?php

class Search_Model extends CI_Model 
{

	public function getcountrybycity($cityname)
	{
		$state_id = $this->db->select('state_id')->get_where('cities',array("name"=>$cityname))->row()->state_id;
		$country_id = $this->db->select('country_id')->get_where('states',array("id"=>$state_id))->row()->country_id;
		return $this->db->select('name')->get_where('countries',array("id"=>$country_id))->row()->name;
	}

	public function get_source($id, $type)
	{
		if(strtolower($type)=='page')
		{
			$res = $this->db->select('name, profile_avatar as avatar',FALSE)->get_where('pages',array('ID'=>$id))->row();
		}
		else
		{
			$res = $this->db->select(" CONCAT(first_name,' ',last_name) as name, avatar",FALSE)->get_where('users',array('ID'=>$id))->row();
		}
		return $res;
	}

	public function result($data=array(), $page=0)
	{
		$data = array_map( 'addslashes', $data );
		$ID = $this->user->info->ID;
		$q = $data['q'];
		$searchtype = $data['searchtype'];
		if($data['from']=='you')
		{
			$from = $this->user->info->ID;
			$fromtype = 'user';
		}
		else
		{
			$from = $data['from'];
			$fromtype = $data['fromtype'];
		}

		$type = $data['type'];
		$group = $data['group'];
		$city = $data['city'];
		$ar = explode('-',@$data['date']);
		$y = @$ar[0];
		$m = @$ar[1];
		$uid = $this->user->info->ID;
		$edu = $data['edu'];
		$work = $data['work'];
		//print_r($data);
		$friendsoffriends = $data['fof'];
		$vtype = $data['vtype'];
		$vdate = $data['vdate'];
		$pcat  = $data['pcat'];

		$friends = @$this->db->select('friendid')->where('userid',$uid)->get('user_friends')->result();
		$fids = "'-1'";
		foreach($friends as $f)
		{
			$fids .= ",'".$f->friendid."'";
		}

		$friendsof = $this->db->query(" SELECT userid from user_friends WHERE friendid IN($fids) ")->result();
		$fofids = "'-1'";
		foreach($friendsof as $fo)
		{
			$fofids .= ",'".$fo->userid."'";
		}
			if($page>0)
			{
				$limit = " LIMIT $page, 5 ";
			}
			else
			{
				$limit = " LIMIT 5 ";
			}
		//if($searchtype=='all' || $searchtype=='' || $searchtype=='posts'):
			$qry = "SELECT * FROM ( ";

			
					$qry .= "( SELECT ID, name, 'user' as type FROM ( ";
					$qry .= " SELECT u.*, CONCAT(first_name,' ',last_name) as name, ud.work, ud.school, ud.college, FROM_UNIXTIME(`joined`, '%Y-%m-%d') AS register_date FROM users u LEFT JOIN user_data ud ON u.ID = ud.userid ) users_tbl WHERE ID !='$ID' ";
					if($q!="")
					{
						$qry .=" AND (name LIKE '%$q%' OR username LIKE '%$q%' ) ";
					}
					if($fromtype=='user' && $from>0)
					{
						$qry .=" AND ID = '$from' ";
					}
					if($city!='')
					{
						$qry .=" AND city LIKE '%$city%' ";
					}
					if($y>0)
					{
						$qry .=" AND YEAR(register_date) = '$y' ";
					}
					if($m>0)
					{
						$qry .=" AND MONTH(register_date) = '$m' ";
					}
					if($edu!="")
					{
						$qry .=" AND( school LIKE '%$edu%' OR college LIKE '%$edu%' ) ";
					}

					if($work!="")
					{
						$qry .=" AND work LIKE '%$work%' ";
					}

					if($friendsoffriends>0)
					{
						$qry .= " AND ID IN($fofids) ";
					}

					if($searchtype!='all' && $searchtype!='' && $searchtype !='people')
					{
						$qry .=" AND ID = '-1' ";
					}

					if($fromtype=="" && $from==0 && $from !="friends" && $from !="groupsandpages" && $from !='public' && $type!='seen' && $searchtype!='posts')
					{}
					else
					{
						$qry .=" AND ID = '-1' ";
					}


				
					$qry .= "  $limit ) UNION (";
					$qry .= "SELECT ID,name, 'page' as type FROM (SELECT *, FROM_UNIXTIME(`timestamp`, '%Y-%m-%d') AS create_date FROM pages) pages_tbl WHERE ID >'0' ";
					if($q!="")
					{
						$qry .=" AND (name LIKE '%$q%' OR slug LIKE '%$q%' ) ";
					}
					if($fromtype=='page' && $from>0)
					{
						$qry .=" AND ID = '$from' ";
					}
					if($city!='')
					{
						$qry .=" AND location LIKE '%$city%' ";
					}
					if($y>0)
					{
						$qry .=" AND YEAR(create_date) = '$y' ";
					}
					if($m>0)
					{
						$qry .=" AND MONTH(create_date) = '$m' ";
					}
					if($pcat>0)
					{
						$qry .=" AND categoryid = '$pcat' ";
					}

					if($searchtype!='all' && $searchtype!='' && $searchtype !='pages')
					{
						$qry .=" AND ID = '-1' ";
					}

					if($fromtype=="" && $from==0 && $from !="friends" && $from !="groupsandpages" && $from !='public' && $type!='seen' && $searchtype!='posts')
					{}
					else
					{
						$qry .=" AND ID = '-1' ";
					}

					$qry .= "  $limit ) UNION (";

					$qry .= " 
					SELECT f.ID,f.content as name, 'feed' as type FROM ( 
					SELECT *, FROM_UNIXTIME(`timestamp`, '%Y-%m-%d') AS create_date FROM feed_item ) f 
					LEFT JOIN feed_item_urls fu ON f.ID = fu.postid 
					LEFT JOIN pages p ON f.pageid = p.ID 
					LEFT JOIN feed_likes fl ON f.ID = fl.postid 
					LEFT JOIN feed_item_comments fc ON f.ID = fc.postid 
					LEFT JOIN feed_item_comment_likes fcl ON fc.ID = fcl.commentid
					LEFT JOIN  feed_item fs ON f.share_postid = fs.ID 
					JOIN users u ON f.userid = u.ID 
					WHERE f.ID > '0' AND f.posttype != 'story' AND ( f.postfor='1' OR 
					( f.postfor='3' AND (f.userid = '$uid' OR f.profile_userid='$uid') ) OR 
					( f.postfor='2' AND (f.userid IN( $fids ) OR f.profile_userid IN( $fids )  ) ) 
					)  ";

					if($searchtype=='photos')
					{
						$qry .=" AND f.imageid > '0' ";
					}
					if($searchtype=='videos')
					{
						$qry .=" AND f.videoid > '0' ";
					}

					if($searchtype=='links')
					{
						$qry .=" AND fu.ID > '0' ";
					}

					if($vdate==1)
					{
						$qry .=" AND FROM_UNIXTIME(f.timestamp, '%Y-%m-%d') = CURDATE() ";
					}

					if($vdate==2)
					{
						$qry .=" AND YEARWEEK(FROM_UNIXTIME(f.timestamp, '%Y-%m-%d'), 1) = YEARWEEK(CURDATE(), 1) ";
					}

					if($vdate==3)
					{
						$qry .=" AND MONTH(FROM_UNIXTIME(f.timestamp, '%Y-%m-%d')) = MONTH(CURDATE()) ";
					}

					if($q!="")
					{
						$qry .=" AND (f.content LIKE '%$q%' OR fu.title LIKE '%$q%' OR fu.description LIKE '%$q%' OR fs.content LIKE '%$q%'  ) ";
					}
					if($fromtype=='page' && $from>0)
					{
						$qry .=" AND f.ID = '$from' ";
					}
					if($fromtype=='user' && $from>0)
					{
						$qry .=" AND ((f.userid = '$from' AND f.post_as != 'page') OR (f.profile_userid = '$from') ) ";
					}
					if($from=='friends')
					{
						$qry .=" AND f.userid IN( $fids ) ";
					}
					if($from=='groupsandpages')
					{
						$qry .=" AND f.userid = '$uid' AND pageid > '0' ";
					}
					if($from=='public')
					{
						$qry .=" AND f.userid !='$uid' AND f.userid NOT IN( $fids ) ";
					}
					if($type=='seen')
					{
						$qry .= " AND (f.userid = '$uid' OR fl.userid = '$uid' OR fc.userid = '$uid' OR fcl.userid = '$uid'  OR f.profile_userid = '$uid'  ) ";
					}
					if($city!='')
					{
						$qry .=" AND (u.city LIKE '%$city%' OR p.location LIKE '%$city%' ) ";
					}
					if($y>0)
					{
						$qry .=" AND YEAR(f.create_date) = '$y' ";
					}
					if($m>0)
					{
						$qry .=" AND MONTH(f.create_date) = '$m' ";
					}

					if($searchtype=='people' || $searchtype=='pages')
					{
						$qry .=" AND f.ID = '-1' ";
					}

					$qry .= " group by f.ID $limit ) ";

			$qry .= "  ) searchdata
			 ";
			 //echo $qry.'<br>';
			 return $this->db->query($qry);
			 //echo $qry;
		//endif;
	}
}