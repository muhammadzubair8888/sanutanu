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
      return array('Error'=> 'Invalid Username and password');
    }
  }

  function checktoken($token)
  {
    return $this->db->get_where('users',array('token'=>$token))->num_rows();
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
 public function update_user($email, $data) 
  {
    $this->db->where("ID", $email)->update("users", $data);
  }
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
//get user value through id
  public function get_users_data($id)
 {
   $q = $this->db->select('*')->from('users')->where('id',$id)->get();
   return $q->result();
}
 
  public function read($userid ){
   
      // $query = $this->db->query("select * from `feed_item`");
      // return $query->result_array();
       $this->db->select('*');
       $this->db->from('feed_item');
       $this->db->join('users','users.id = feed_item.userid');
    
       $query = $this->db->get()->row();
       return $query;
}
//get record of feed item table
  public function information($id,$username) 
  {
      $q = $this->db->select('*')->from('feed_item')->join('users','users.id = feed_item.userid')->where('userid',$id)->or_where('username',$username)->get();
      return $q->result();

  }
  public function get_user_by_username($username) 
  {
    return $this->db->where("username", $username)->get("users");
  }
  //get user value through id and name
  public function get_user_username($id,$username)
  {
   $q = $this->db->select('*')->from('users')->where('id',$id)->or_where('username',$username)->get();
   return $q->result();
  }
 

   public function get_id($id,$username) {
    $q = $this->db->select('*')->from('feed_item')->where('userid',$id)->or_where('userid',$username)->get();
    return $q->result();
}

}
?>