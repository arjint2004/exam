<?php

class User_model extends CI_Model 
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
        	$this->db->from('users');
        	$result = $this->db->get();
        	if($result->num_rows() > 0)
        	{
                $userdetails = $result->row();
                $userdata['userdetails'] = array('user_username' =>$userdetails->username,
                                      'userid' =>$userdetails->user_id
                                     );
                $this->session->set_userdata($userdata);
        		return true;

        	}
        	else
        	{
        		return false;
        	}
        }
        function recordexam_start($examid, $userid)
        {
            $this->db->select('*');
            $this->db->from('userexam');
            $this->db->where('userid', $userid);
            $this->db->where('examid', $examid);
            $result = $this->db->get();
            if($result->num_rows() > 0)
            {
                $this->db->where('userid', $userid);
                $this->db->where('examid', $examid);

                $this->db->delete('userexam');
                $exam_newstatus = array('userid'=>$userid, 'examid'=>$examid);
                $this->db->set('starttime', 'NOW()', FALSE);
                $this->db->insert('userexam', $exam_newstatus);
            }
            else
            {
                $exam_newstatus = array('userid'=>$userid, 'examid'=>$examid);
                $this->db->set('starttime', 'NOW()', FALSE);
                $this->db->insert('userexam', $exam_newstatus);
            }
        }
        function save_answer($useranswer, $examid, $questionid, $userid)
        {
            $this->db->select('*');
            $this->db->from('userquestions');
            $this->db->where('userid', $userid);
            $this->db->where('examid', $examid);
            $this->db->where('questionid', $questionid);
            $result = $this->db->get();
            if($result->num_rows() > 0)
            {
            $question_status = array('answered' => 'answered', 'useranswer' => $useranswer);
            $this->db->where('userid', $userid);
            $this->db->where('examid', $examid);
            $this->db->where('questionid', $questionid);
            $this->db->update('userquestions',  $question_status);
            }
            else
            {
             $question_status = array('userid' => $userid,
                                      'examid' => $examid,
                                      'questionid' => $questionid,
                                      'answered' => 'answered', 
                                      'useranswer' => $useranswer);
             $this->db->insert('userquestions', $question_status);
            }
        }

        function finish_user_exam($examid, $userid)
        {
            $exam_newstatus = array('endtime' => date('Y-m-d H:i:s'),
                                    'status' => 'completed'
                                    );
             $this->db->where('examid', $examid);
             $this->db->where('userid', $userid);
             $this->db->set('status', 'completed');
             $this->db->set('endtime', 'NOW()', FALSE);
             $this->db->update('userexam');
             
        }
        function exams($userid)
        {
            $this->db->select('*');
            $this->db->from('exam_category');
            $categories_exams = $this->db->get()->result_array();
            foreach ($categories_exams as $x => $category) 
            {
               $this->db->select('*'); 
               $this->db->from('exams');
               $this->db->where('catid', $category['catid']);
               $exams = $this->db->get()->result_array();
               foreach ($exams as $count => $exam) 
               {
                    $this->db->select('userexam.*, SUM(questions.marks) AS maxmarks, exams.passmark');
                    $this->db->from('userexam');
                    $this->db->join('exams', 'exams.examid = userexam.examid');
                    $this->db->join('questions', 'questions.examid = userexam.examid');
                    $this->db->where('userexam.userid', $userid);
                    $this->db->where('userexam.examid', $exam['examid']);
                    $exam_records = $this->db->get();
                    foreach ($exam_records->result_array() as $exam) 
                    {
                    if(strlen(implode($exam)) > 0)
                    {
                        $results = array();
                        $examdata = $exam_records->row();
                        $this->db->select('userquestions.questionid, userquestions.useranswer, questions.correctanswer,questions.marks');
                        $this->db->from('userquestions');
                        $this->db->join('questions', 'questions.questionid = userquestions.questionid');
                        $this->db->where('userquestions.examid', $exam['examid']);
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
                        if($marksobtained > 0)
                        {
                            $exams[$count]['percentage'] = floor(($marksobtained / $examdata->maxmarks) * 100);
                            if($exams[$count]['percentage'] >= $examdata->passmark)
                            {
                                $exams[$count]['passed'] = 'Passed';
                            }
                            else
                            {
                                $exams[$count]['passed'] = 'Failed';
                            }
                        }
                        else
                        {
                            $exams[$count]['percentage'] = 0;
                            $exams[$count]['passed'] = 'Failed';
                        }
                    } 
                    }                        
               }
               $categories_exams[$x]['exams'] = $exams;
            }
            return $categories_exams;
        }

        function examdetails($examid)
        {
           $this->db->select('*'); 
           $this->db->from('exams');
           $this->db->where('examid', $examid);
           $examdetails = $this->db->get()->result_array();
            return $examdetails;
        }
        function userprofile($userid)
        {
           $this->db->select('*'); 
           $this->db->from('users');
           $this->db->where('user_id', $userid);
           $userdetails = $this->db->get()->row();
            return $userdetails;
        }
        function updateprofile($details, $userid, $password)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('user_id', $userid);
            $this->db->where('password', sha1($password));
            $userdata = $this->db->get();
            if($userdata->num_rows() > 0)
            {
                $this->db->where('user_id', $userid);
                $this->db->update('users', $details);
                return true;
            }
            else
            {
                return false;
            }
            
        }
        function update($tablename, $details, $fieldname, $fieldvalue)
        {
            $this->db->where($fieldname, $fieldvalue);
            $this->db->update($tablename, $details);
        }
        function examdata($examid)
        {
            $this->db->select('examid, examname, duration');
            $this->db->from('exams');
            $this->db->where('examid', $examid);
            $result = $this->db->get()->row();
            return $result;
        }
        function get_exam_data($examid)
        {
            $this->db->select('examid, examname, duration');
            $this->db->from('exams');
            $this->db->where('examid', $examid);
            $result = $this->db->get();

            $exam = array();
            $examrow = $result->row();
            $exam['id'] = $examrow->examid;
            $exam['name'] = $examrow->examname;

            $this->db->select('*');
            $this->db->from('questions');
            $this->db->where('examid', $examid);
            $result_questions = $this->db->get();

            $exam['questions'] = array();
            foreach ($result_questions->result_array() as $x => $question) 
            {
                $exam['questions'][$x]['question_id'] = $question['questionid'];
                $exam['questions'][$x]['text'] = $question['question'];
                $answers = array();
                $ansoption1 = array('id' => 'A', 'text' => $question['optiona']);
                $ansoption2 = array('id' => 'B', 'text' => $question['optionb']);
                $ansoption3 = array('id' => 'C', 'text' => $question['optionc']);
                $ansoption4 = array('id' => 'D', 'text' => $question['optiond']);
                
                array_push($answers, $ansoption1);
                array_push($answers, $ansoption2);
                array_push($answers, $ansoption3);
                array_push($answers, $ansoption4);
                $exam['questions'][$x]['answers'] = $answers;
          
            }
            return $exam;
        }
        function exam_results($examid, $userid)
        {
            $this->db->select('userexam.*, exams.examname, SUM(questions.marks) AS maxmarks, exams.passmark');
            $this->db->from('userexam');
            $this->db->join('exams', 'exams.examid = userexam.examid');
            $this->db->join('questions', 'questions.examid = userexam.examid');
            $this->db->where('userexam.userid', $userid);
            $this->db->where('userexam.examid', $examid);
            $exam_records = $this->db->get();
            if($exam_records->num_rows() > 0)
            {
                $results = array();
                $examdata = $exam_records->row();
                $results['duration'] = timeDiff($examdata->starttime, $examdata->endtime);
                $results['examname'] = $examdata->examname;
                $results['totalmarks'] = $examdata->maxmarks;
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
                    else
                    {
                        $this->db->select('*');
                        $this->db->from('questions');
                        $this->db->where('questionid', $questiondata['questionid']);
                        $failed = $this->db->get()->row();
                        
                        $correctanswer = 'option'.strtolower($failed->correctanswer);
                        $youranswer = 'option'.strtolower($questiondata['useranswer']);
                        $question = array('question'=>$failed->question,
                                          'marks' => $failed->marks,
                                          'correctanswer'=>$failed->$correctanswer,
                                          'youranswer' => $failed->$youranswer
                                          );
                        array_push($failedquestions, $question);
                    }
                }
                $results['failedquestions'] = $failedquestions;
                $results['marksobtained'] = $marksobtained;
                $results['percentage'] = floor(($marksobtained / $examdata->maxmarks) * 100);
                if($results['percentage'] >= $examdata->passmark)
                {
                    $results['passed'] = true;
                }
                else
                {
                    $results['passed'] = false;
                }
            }

            return $results;

        }
        function get_exams_attempted($userid)
        {
            $this->db->select('userexam.examid, userexam.status, exams.examname, exams.passmark');
            $this->db->from('userexam');
            $this->db->where('userexam.userid', $userid);
            $this->db->join('exams', 'exams.examid=userexam.examid');
            $examsdone = $this->db->get();
            $results = array();
            foreach ($examsdone->result_array() as $key => $exam) 
            {
            $results[$key]['exampassmark'] = $exam['passmark'];
            $results[$key]['examname'] = $exam['examname'];
            $results[$key]['examid'] = $exam['examid'];
            if($exam['status'] == 'completed')
            {
                $results[$key]['status'] = $exam['status'];
            }
            else
            {
                $results[$key]['status'] = 'Incomplete';
            }
            

            $examid =$exam['examid'];
            $this->db->select('SUM(questions.marks) AS maxmarks');
            $this->db->from('questions');
            $this->db->where('questions.examid', $examid);
            $maxmarks = $this->db->get()->row();

            $this->db->select('userquestions.questionid, userquestions.useranswer, questions.correctanswer,questions.marks');
            $this->db->from('userquestions');
            $this->db->join('questions', 'questions.questionid = userquestions.questionid');
            $this->db->where('userquestions.examid', $examid);
            $this->db->where('userquestions.userid', $userid);
            $allquestions = $this->db->get()->result_array();
            $marksobtained = 0;
            foreach ($allquestions as  $questiondata) 
            {
                if($questiondata['useranswer'] == $questiondata['correctanswer'])
                {
                    $marksobtained += $questiondata['marks'];
                }
            }
            $totalmarks = $maxmarks->maxmarks;
            $results[$key]['percentage'] = floor(($marksobtained / $totalmarks) * 100);  
            if($results[$key]['percentage'] >= $results[$key]['exampassmark'])
            {
                $results[$key]['passed'] = true;
            }
            else
            {
                $results[$key]['passed'] = false;
            } 
        }   
            return  $results;
        }
}
?>