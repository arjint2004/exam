<?php

class Admin_model extends CI_Model 
{
		function username_exists($username)
	    {
	        $this->db->where('username',$username);
	        $query = $this->db->get('users');
	        if ($query->num_rows() > 0)
	        {
	            return true;
	        }
	        else
	        {
	            return false;
	        }
	    }

        function email_exists($email)
        {
        $this->db->where('email',$email);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
        }

        function insert($table, $data=array())
        {
        	$this->db->insert($table, $data);
        	if($this->db->affected_rows() > 0)
        	{
        		return true;
        	}
        	else
        	{
        		return false;
        	}
        }
        function login($username, $password)
        {
        	$this->db->select('*');
        	$this->db->where('username', $username);
        	$this->db->where('password', $password);
        	$this->db->from('administrators');
        	$result = $this->db->get();
        	if($result->num_rows() > 0)
        	{
            $admindetails = $result->row();
            $admindata['admindetails'] = array('adminusername' =>$admindetails->username,
                                  'adminid' =>$admindetails->adminid
                                 );
            $this->session->set_userdata($admindata);
        	return true;

        	}
        	else
        	{
        	return false;
        	}
        }

        function dbselect ($tablename)
        {
            $query = $this->db->query("SELECT * FROM $tablename"); 
            return $query->result_array();
        }
        function edituserprofile($userdetails, $indexid)
        {
            $this->db->where('user_id', $indexid);
            if($this->db->update('users', $userdetails))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        function editadminprofile($admindetails, $indexid)
        {
            $this->db->where('adminid', $indexid);
            if($this->db->update('administrators', $admindetails))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        function userprofile($userid)
        {
           $this->db->select('*'); 
           $this->db->from('users');
           $this->db->where('user_id', $userid);
           $userdetails = $this->db->get()->row();
            return $userdetails;
        }
        function adminprofile($adminid)
        {
           $this->db->select('*'); 
           $this->db->from('administrators');
           $this->db->where('adminid', $adminid);
           $admindetails = $this->db->get()->row();
            return $admindetails;
        }
        function deleterecord($tablename='', $fieldname='', $indexid=0)
        {
            $this->db->where($fieldname, $indexid);
            $this->db->delete($tablename);
        }
        function getcategory($catid)
        {
           $this->db->select('*'); 
           $this->db->from('exam_category');
           $this->db->where('catid', $catid);
           $categorydetails = $this->db->get()->row();
           return $categorydetails;
        }
        function createcategory($categorydetails)
        {
            if($this->db->insert('exam_category', $categorydetails))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        function editcategory($catdetails, $indexid)
        {
            $this->db->where('catid', $indexid);
            if($this->db->update('exam_category', $catdetails))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        function getexams()
        {
            $this->db->select('*', 'exam_category.catname');
            $this->db->from('exams');
            $this->db->join('exam_category', 'exam_category.catid = exams.catid');
            return $this->db->get();
        }
         function get_select_option($table,$id,$name, $selected=0){
        $query = $this->db->get($table);
         $select = '<option value="">-------- Pilih --------</option>';
        if($query->num_rows()>0){
            foreach($query->result_array() as $row){
            $selected_option = ($selected==$row[$id]) ? ' selected="selected" ':' ';
                $select.='<option value="'.$row[$id].'" '. $selected_option.'>'.strtoupper($row[$name]).'</option>';
            }
        }
        return $select;
    }
    function createexam($examdetails)
    {
        if($this->db->insert('exams', $examdetails))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
     function createquestion($questiondetails)
    {
        if($this->db->insert('questions', $questiondetails))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function get_jenjang()
    {
        $this->db->select('*');
        $this->db->from('jenjang');
        $result = $this->db->get();
        return $result->result_array();
    }
    function get_jurusan()
    {
        $this->db->select('*');
        $this->db->from('jurusan');
        $result = $this->db->get();
        return $result->result_array();
    }
    function getexam($id)
    {
        $this->db->select('*');
        $this->db->from('exams');
        $this->db->where('examid', $id);
        $result = $this->db->get();
        return $result->row();
    }

    function getquestion($id)
    {
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('questionid', $id);
        $result = $this->db->get();
        return $result->row();
    }

    function editexam($examdetails, $indexid)
    {
        $this->db->where('examid', $indexid);
        if($this->db->update('exams', $examdetails))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function editquestion($questiondetails, $indexid)
    {
        $this->db->where('questionid', $indexid);
        if($this->db->update('questions', $questiondetails))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function get_exam_questions($examid)
    {
        $this->db->select('*');
        $this->db->from('questions');
        $this->db->where('examid', $examid);
        $result = $this->db->get();
        return $result;
    }
    function get_exam_name($examid)
    {
        $this->db->select('examname, examid, questions');
        $this->db->from('exams');
        $this->db->where('examid', $examid);
        $result = $this->db->get()->row();
        return $result;
    }

    function adminusername_exists($username)
    {
        $this->db->where('username',$username);
        $query = $this->db->get('administrators');
        if ($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function adminemail_exists($email)
    {
    $this->db->where('email',$email);
    $query = $this->db->get('administrators');
    if ($query->num_rows() > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
    }
    function editmyprofile($details, $adminid, $password)
    {
        $this->db->select('*');
        $this->db->from('administrators');
        $this->db->where('adminid', $adminid);
        $this->db->where('password', sha1($password));
        $userdata = $this->db->get();
        if($userdata->num_rows() > 0)
        {
            $this->db->where('adminid', $adminid);
            $this->db->update('administrators', $details);
            return true;
        }
        else
        {
            return false;
        }
    }
    function get_attempted_exams()
    {
        $this->db->select('exams.*, COUNT(userexam.examid) AS attempted_students');
        $this->db->from('exams');
        $this->db->join('userexam', 'userexam.examid = exams.examid', 'left');
        $this->db->group_by("exams.examid"); 
        $exams = $this->db->get();
        return $exams;
    }
    function get_exam_results($examid)
    {
        $this->db->select('exams.examname, exams.passmark');
        $this->db->from('exams');
        $this->db->where('examid', $examid);
        $exam = $this->db->get();
        $results = array();
        if($exam->num_rows() > 0)
        {
            $examdata = $exam->row();
            $results['examname'] = $examdata->examname;
            $results['exampassmark'] = $examdata->passmark;
            $this->db->select('userexam.*, SUM(questions.marks) AS maxmarks, users.firstname, users.lastname, users.email');
            $this->db->from('userexam');
            $this->db->join('questions', 'questions.examid = userexam.examid');
            $this->db->join('users', 'users.user_id = userexam.userid');
            $this->db->where('userexam.examid', $examid);
            $this->db->group_by("userexam.userid"); 
            $exam_records = $this->db->get();
            $users_results = array();
            foreach ($exam_records->result_array() as $key => $exam_result) 
            {
                
                $userid = $exam_result['userid'];
                $maxmarks = $exam_result['maxmarks'];
                $results['totalmarks'] = $exam_result['maxmarks'];
                $this->db->select('userquestions.questionid, userquestions.useranswer, questions.correctanswer,questions.marks');
                $this->db->from('userquestions');
                $this->db->join('questions', 'questions.questionid = userquestions.questionid');
                $this->db->where('userquestions.examid', $examid);
                $this->db->where('userquestions.userid', $userid);
                $allquestions = $this->db->get()->result_array();
                $marksobtained = 0;
                $failedquestions = array();
                foreach ($allquestions as  $questiondata) 
                {
                    if($questiondata['useranswer'] == $questiondata['correctanswer'])
                    {
                        $marksobtained += $questiondata['marks'];
                    }
                }

                $users_results[$key]['user_names'] = $exam_result['firstname'].' '.$exam_result['lastname'];
                $users_results[$key]['user_email'] = $exam_result['email'];
                $users_results[$key]['marksobtained'] = $marksobtained;
                $users_results[$key]['percentage'] = floor(($marksobtained / $maxmarks) * 100);  
                if($users_results[$key]['percentage'] >= $results['exampassmark'])
                {
                    $users_results[$key]['passed'] = true;
                }
                else
                {
                    $users_results[$key]['passed'] = false;
                }         
            }
            $results['users_results'] = $users_results;
            return $results;
        }
    }

        
}
?>