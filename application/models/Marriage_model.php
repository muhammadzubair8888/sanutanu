<?php

class Marriage_model extends CI_Model 
{
	public function get_all_religions()
	{
		return $this->db->get('religions');
	}
	public function get_all_comunities($id)
	{
		return $this->db->where('religion_id' , $id)->get('community');
	}
	public function getallcomunities()
	{
		return $this->db->get('community');
	}
	public function get_all_countries()
	{
		return $this->db->get('countries');
	}
	public function getusermerrageprofiles($id)
	{
		$qry = "SELECT * FROM marriage_profile LEFT JOIN religions ON marriage_profile.relegion = religions.ID WHERE users_id = $id;";
		return $this->db->query($qry);
	}

	public function get_marriage_profile($id)
	{
		return $this->db->where('marriage_profile_id' , $id)->get('marriage_profile');
	}
	public function get_patner_profile($id)
	{
		return $this->db->where('marriage_profile_id' , $id)->get('partner_profile');
	}

	public function getphoto($id)
	{
		return $this->db->where('status' , 'photo')->where('tomarriageid' , $id)->get('data_against_requests');
	}


	public function getcontact($id)
	{
		return $this->db->where('status' , 'contact')->where('tomarriageid' , $id)->get('data_against_requests');
	}

	public function getfavourities($id)
	{
		return $this->db->where('tomarriageprofile' , $id)->get('marriage_favourities');
	}

	public function getreligionname($id)
	{
		return $this->db->where('ID' , $id)->get('religions');
	}
	public function getcountryname($id)
	{
		return $this->db->where('ID' , $id)->get('countries');
	}
	public function getstatename($id)
	{
		return $this->db->where('ID' , $id)->get('states');
	}
	public function getcityname($id)
	{
		return $this->db->where('ID' , $id)->get('cities');
	}

	public function getcomunityname($id)
	{
		return $this->db->where('ID' , $id)->get('community');
	}

	public function getuser($id)
	{
		return $this->db->where('ID' , $id)->get('users');
	}

	public function getphotorequests($id)
	{
		return $this->db->where('to_marriage_profile_id' , $id)->get('marriage_requests');
	}

	public function getphotorequestrecieved($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where('user_id' , $userid)->where('to_marriage_profile_id' , $id)->where('name' , 'Photos')->where('status' , 0)->get('marriage_requests')->num_rows();
	}

	public function getphotorequestrecievedold($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where('user_id' , $userid)->where('name' , 'Photos')->where('to_marriage_profile_id' , $id)->where('status' , 1)->get('marriage_requests')->num_rows();
	}

	public function getphotorequestsent($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where('from_id' , $userid)->where('from_marriage_profile_id' , $id)->where('name' , 'Photos')->where('status' , 0)->get('marriage_requests')->num_rows();
	}

	public function getphotorequestsentold($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where('from_id' , $userid)->where('from_marriage_profile_id' , $id)->where('name' , 'Photos')->where('status' , 1)->get('marriage_requests')->num_rows();
	}

	public function getcontactrequestrecieved($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where('user_id' , $userid)->where('to_marriage_profile_id' , $id)->where('name' , 'Contact')->where('status' , 0)->get('marriage_requests')->num_rows();
	}

	public function getcontactrequestrecievedold($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where('user_id' , $userid)->where('to_marriage_profile_id' , $id)->where('name' , 'Contact')->where('status' , 1)->get('marriage_requests')->num_rows();
	}


	public function getcontactrequestsent($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where('from_id' , $userid)->where('from_marriage_profile_id' , $id)->where('name' , 'Contact')->where('status' , 0)->get('marriage_requests')->num_rows();
	}


	public function getcontactrequestsentold($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where('from_id' , $userid)->where('from_marriage_profile_id' , $id)->where('name' , 'Contact')->where('status' , 1)->get('marriage_requests')->num_rows();
	}


	public function getmarriageprofilebyuser()
	{
		$userid = $this->user->info->ID;
		return $this->db->where('users_id' , $userid)->get('marriage_profile');
	}
	public function getmonths()
	{
	 return	array(
	 	    
			array('value'=>'01','name'=>'January'),
			array('value'=>'02','name'=>'February'),
			array('value'=>'03','name'=>'March'),
			array('value'=>'04','name'=>'April'),
			array('value'=>'05','name'=>'May'),
			array('value'=>'06','name'=>'June'),
			array('value'=>'07','name'=>'July'),
			array('value'=>'08','name'=>'August'),
			array('value'=>'09','name'=>'September'),
			array('value'=>'10','name'=>'October'),
			array('value'=>'11','name'=>'November'),
			array('value'=>'12','name'=>'December')
		);
	}


	public function getbloodgroup()
	{
	 return	array(
			array('value'=>'A+','name'=>'A+'),
			array('value'=>'A-','name'=>'A-'),
			array('value'=>'B+','name'=>'B+'),
			array('value'=>'B-','name'=>'B-'),
			array('value'=>'AB+','name'=>'AB+)'),
			array('value'=>'AB-','name'=>'AB-'),
			array('value'=>'O+','name'=>'O+'),
			array('value'=>'O-','name'>'O-')
		);
	}

	public function getquicksearch($look , $photo , $agefrom, $ageto, $religions , $comunity, $country)
	{
		$qry = " SELECT * FROM marriage_profile WHERE ID > '0' ";
		if ($look !='') {
			$qry .= " AND gender = '$look' ";
		}
		if ($photo) {
			$qry .= " AND profileimage != '' ";
		}
		if ($agefrom > 0 ) {
			$qry .= " AND age >= '$agefrom' ";
		}
		if ($ageto > 0) {
			$qry .= " AND age <= '$ageto' ";
		}
		if ($religions > 0) {
			$qry .= " AND relegion = '$religions' ";
		}
		if ($comunity > 0) {
			$qry .= " AND relegion_comunity = '$comunity' ";
		}
		if ($country > 0) {
			$qry .= " AND country = '$country' ";
		}
		//echo $qry;
		return $this->db->query($qry);
	}


	public function get_new_profiles($page=0)
	{
		$id = $this->user->info->ID;
		$limit = 6;
		$limit2 = $page*$limit;
		return $this->db->where('users_id !=',$id)->where('status',1)->order_by('ID', 'DESC')->limit($limit,$limit2)->get('marriage_profile');
	}



	public function get_new_profiles_all_rows()
	{
		$id = $this->user->info->ID;
		return $this->db->where('users_id !=',$id)->get('marriage_profile');
	}

    public function getmothertongue()
	{
	 return	array(
			array('value'=>'Arabic','name'=>'Arabic'),
			array('value'=>'Arunachali','name'=>'Arunachali'),
			array('value'=>'Assamese','name'=>'Assamese'),
			array('value'=>'Awadhi','name'=>'Awadhi'),
			array('value'=>'Baluchi','name'=>'Baluchi'),
			array('value'=>'Bengali','name'=>'Bengali'),
			array('value'=>'Bhojpuri','name'=>'Bhojpuri'),
			array('value'=>'Bhutia','name'=>'Bhutia'),
			array('value'=>'Brahui','name'=>'Brahui'),
			array('value'=>'Brij','name'=>'Brij'),
			array('value'=>'Burmese','name'=>'Burmese'),
			array('value'=>'Chattisgarhi','name'=>'Chattisgarhi'),
			array('value'=>'Chinese','name'=>'Chinese'),
			array('value'=>'Coorgi','name'=>'Coorgi'),
			array('value'=>'Dogri','name'=>'Dogri'),
			array('value'=>'English','name'=>'English'),
			array('value'=>'French','name'=>'French'),
			array('value'=>'Garhwali','name'=>'Garhwali'),
			array('value'=>'Garo','name'=>'Garo'),
			array('value'=>'Gujarati','name'=>'Gujarati'),
			array('value'=>'Haryanavi','name'=>'Haryanavi'),
			array('value'=>'Himachali/Pahari','name'=>'Himachali/Pahari'),
			array('value'=>'Hindi','name'=>'Hindi'),
			array('value'=>'Hindko','name'=>'Hindko'),
			array('value'=>'Kakbarak','name'=>'Kakbarak'),
			array('value'=>'Kanauji','name'=>'Kanauji'),
			array('value'=>'Kannada','name'=>'Kannada'),
			array('value'=>'Kashmiri','name'=>'Kashmiri'),
			array('value'=>'Khandesi','name'=>'Khandesi'),
			array('value'=>'Khasi','name'=>'Khasi'),
			array('value'=>'Konkani','name'=>'Konkani'),
			array('value'=>'Koshali','name'=>'Koshali'),
			array('value'=>'Kumaoni','name'=>'Kumaoni'),
			array('value'=>'Kutchi','name'=>'Kutchi'),
			array('value'=>'Ladakhi','name'=>'Ladakhi'),
			array('value'=>'Lepcha','name'=>'Lepcha'),
			array('value'=>'Magahi','name'=>'Magahi'),
			array('value'=>'Maithili','name'=>'Maithili'),
			array('value'=>'Malay','name'=>'Malay'),
			array('value'=>'Malayalam','name'=>'Malayalam'),
			array('value'=>'Manipuri','name'=>'Manipuri'),
			array('value'=>'Marathi','name'=>'Marathi'),
			array('value'=>'Marwari','name'=>'Marwari'),
			array('value'=>'Miji','name'=>'Miji'),
			array('value'=>'Mizo','name'=>'Mizo'),
			array('value'=>'Monpa','name'=>'Monpa'),
			array('value'=>'Nepali','name'=>'Nepali'),
			array('value'=>'Odia','name'=>'Odia'),
			array('value'=>'Other','name'=>'Other'),
			array('value'=>'Pashto','name'=>'Pashto'),
            array('value'=>'Persian','name'=>'Persian'),
			array('value'=>'Punjabi','name'=>'Punjabi'),
			array('value'=>'Rajasthani','name'=>'Rajasthani'),
			array('value'=>'Sanskrit','name'=>'Sanskrit'),
			array('value'=>'Russian','name'=>'Russian'),
			array('value'=>'Santhali','name'=>'Santhali'),
			array('value'=>'Seraiki','name'=>'Seraiki'),
			array('value'=>'Sindhi','name'=>'Sindhi'),
			array('value'=>'Sinhala','name'=>'Sinhala'),
			array('value'=>'Spanish','name'=>'Spanish'),
            array('value'=>'Swedish','name'=>'Swedish'),
			array('value'=>'Tagalog','name'=>'Tagalog'),
			array('value'=>'Tamil','name'=>'Tamil'),
			array('value'=>'Telugu','name'=>'Telugu'),
			array('value'=>'Tulu','name'=>'Tulu'),
			array('value'=>'Urdu','name'=>'Urdu')

		);
	}
	public function getstar()
	{
	 return	array(
			array('value'=>'Anuradha','name'=>'Anuradha'),
			array('value'=>'Aswini','name'=>'Aswini'),
			array('value'=>'Ashlisha','name'=>'Ashlisha'),
			array('value'=>'Bahrani','name'=>'Bahrani'),
			array('value'=>'Chitra','name'=>'Chitra'),
			array('value'=>'Danistha','name'=>'Danistha'),
			array('value'=>'Hanista','name'=>'Hanista'),
			array('value'=>'Jasika','name'=>'Jasika'),
			array('value'=>'Kythikta','name'=>'Kythikta'),
			array('value'=>'Anuradha','name'=>'Maka'),
			array('value'=>'Moal','name'=>'Moal'),
			array('value'=>'Margasira','name'=>'Margasira'),
			array('value'=>'Poorvabarhabula','name'=>'Poorvabarhabula'),
			array('value'=>'PoorvaPalgunhi','name'=>'PoorvaPalgunhi'),
			array('value'=>'poorvashada','name'=>'poorvashada')
		);
	}

    public function getmoonsign()
	{
	 return	array(
			array('value'=>'Mesh','name'=>'Mesh'),
			array('value'=>'Virshbah','name'=>'Virshbah'),
			array('value'=>'Mithun','name'=>'Mithun'),
			array('value'=>'Kark','name'=>'Kark'),
			array('value'=>'Simha','name'=>'Simha'),
			array('value'=>'Kanya','name'=>'Kanya'),
			array('value'=>'Vrishchik','name'=>'Vrishchik'),
			array('value'=>'Dhanu','name'=>'Dhanu'),
			array('value'=>'Makhra','name'=>'Makhra'),
			array('value'=>'Kumbh','name'=>'Kumbh'),
			array('value'=>'Meen','name'=>'Meen'),
			array('value'=>'Dnt know','name'=>'Dnt know')
          );
	}

	public function getfatheroccupation()
	{
	 return	array(
			array('value'=>'Employed','name'=>'Employed'),
			array('value'=>'Business','name'=>'Business'),
			array('value'=>'Professional','name'=>'Professional'),
			array('value'=>'Retired','name'=>'Retired'),
			array('value'=>'Not Employed','name'=>'Not Employed')
     );
	}
	public function getmotheroccupation()
	{
	 return	array(
			array('value'=>'Employed','name'=>'Employed'),
			array('value'=>'Business','name'=>'Business'),
			array('value'=>'Professional','name'=>'Professional'),
			array('value'=>'Retired','name'=>'Retired'),
			array('value'=>'Not Employed','name'=>'Not Employed')
     );
	}
	
    public function delete_page($id) 
	{
	return	$this->db->where("id", $marriage_profile_id)->delete("marriage_profile");
    }
	
  
	
// Function to Delete selected record from table name students.
    public function delete_profile_id($id)
    {
    $this->db->where('marriage_profile_id', $id);
    $this->db->delete('marriage_profile');
     }

    }

?>