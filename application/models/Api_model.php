<?php
class Api_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function login_api($username,$password)
  {
    $u = $this->db->where('username',$username)->or_where('email',$username)->get('users');
    if($u->num_rows()>0)
    {
      $r = $u->row_array();
      $r['password'];
      $phpass = new PasswordHash(12, false);
      if (!$phpass->CheckPassword($password, $r['password'])) 
      {
          return array('Error'=> 'Invalid Username or password');
      }
      else
      {
        unset($r['password']);
        return $r;
      }
    }
    else
    {
      return array('Error'=> 'Invalid Username or password');
    }
  }

  function checktoken($token)
  {
    return $this->db->get_where('users',array('token'=>$token))->num_rows();
  }
  
  public function checkEmailIsFree($email) 
  {
    $s=$this->db->where("email", $email)->get("users");
    if ($s->num_rows() > 0)
   {
      return false;
    }
     else 
    {
      return true;
    }
  }
  public function check_username_is_free($username) 
  {
    $s=$this->db->where("username", $username)->get("users");
    if($s->num_rows() > 0) {
      return false;
    } 
    else 
    {
      return true;
    }
  }

  public function verify_user($email) 
  {
        $data = array('is_verified' => 1);
        $this->db->where('email', $email);
        $this->db->update('users', $data);
  }

  
 
  public function update_user($email, $data) 
  {
    $this->db->where("ID", $email)->update("users", $data);
  }
 
   
    
    // public function insert_img($data_insert)
    // {
    //  $this->db->insert('users',$data_insert);
    //  }

    
  public function change_psd($username,$password)
  {
    $u = $this->db->where('username',$username)->or_where('email',$username)->get('users');
    if($u->num_rows()>0)
    {
      $r = $u->row();
      $r->password;
      $phpass = new PasswordHash(12, false);
      if (!$phpass->CheckPassword($password, $r->password)) 
      {
        return 0;
      }
      else
      {
        return $u->num_rows();
      }
    }
    else
    {
      return 0;
    }
  }

public function insert_img($data_insert){
$this->db->insert('users',$data_insert);
}
 public function get_user_profile_album($userid) 
    {
        return $this->db
            ->where("user_albums.userid", $userid)
            ->where("feed_album", 2)
            ->select("user_albums.ID, user_albums.name")
            ->get("user_albums");
    }
 public function get_user($userid)
 
  {
   return $this->db->get_where('user_data', array('id' => $id), $limit, $offset);
   
  }

  public function get_users_data() 
  {
  
        $query = $this->db->get("users")->row();

     return $query;
       
  }
  public function get_user_data($userid) 
  {
    return $this->db->where("userid", $userid)->get("user_data");
  }


}
?>