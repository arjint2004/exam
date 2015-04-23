<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        is_adminlogged_in();
        $this->load->model('admin_model');
        $this->load->model('user_model');
    }
    function index()
    {
		$data = array();
        $data['page'] = 'dashboard';
		$this->load->view('admin/main', $data);
    }
    function users()
    {
        $data = array();
        $data['usersdata'] = $this->admin_model->dbselect('users');
        $data['page'] = 'manageusers';
        $this->load->view('admin/main', $data);
    }
    function adduser()
    {
        $data = array();
        if(isset($_POST['registerbttn']))
        {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_exists');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[6]|max_length[20]|callback_username_exists');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirmpassword', 'Confirm password', 'trim|required|xss_clean|matches[password]');
            $this->form_validation->set_rules('enterCode', 'Security Code', 'callback_check_captcha');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
        
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = FALSE;
            }
            else
            {
                $userdetails = array('firstname' => $this->input->post('firstname'),
                                     'lastname'  => $this->input->post('lastname'),
                                     'email'     => $this->input->post('email'),
                                     'username'  => $this->input->post('username'),
                                     'password'  => sha1($this->input->post('password'))
                    );
                if($this->user_model->insert('users', $userdetails))
                {
                    $data['success'] = 'Account created successfully !';
                }
                else
                {
                    $data['error'] = 'An error occurred while creating account, please try again !';
                }

            }
        }
        $data['page'] = 'createuser';
        $this->load->view('admin/main', $data);
    }

    function edituser($userid)
    {
        $data = array();
        if(isset($_POST['updateprofilebttn']))
        {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
        
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = FALSE;
            }
            else
            {
                $userdetails = array('firstname' => $this->input->post('firstname'),
                                     'lastname'  => $this->input->post('lastname'),
                                     'email'     => $this->input->post('email')
                    );
                $indexid = $this->input->post('userid');
                if($this->admin_model->edituserprofile($userdetails, $indexid))
                {
                    $data['success'] = 'Account details updated successfully !';
                }
                else
                {
                    $data['error'] = 'An error occurred while updating the account, please make sure you have entered the correct password !';
                }

            }
        }
        if(isset($_POST['changepasswordbttn']))
        {
            $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|xss_clean|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirmnewpassword', 'Confirm new password', 'trim|required|xss_clean|matches[newpassword]');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = FALSE;
            }
            else
            {
                $userdetails = array('password' => sha1($this->input->post('newpassword'))
                    );
                $indexid = $this->input->post('userid');
                if($this->admin_model->edituserprofile($userdetails, $indexid))
                {
                    $data['success'] = 'Password Changed successfully !';
                }
                else
                {
                    $data['error'] = 'An error occurred while updating the password, please make sure you have entered the correct password !';
                }
            }
        }
        $data['userdetails'] = $this->admin_model->userprofile($userid);
        $data['page'] = 'edituser';
        $this->load->view('admin/main', $data);
    }

    function editcategory($catid)
    {
        $data = array();
        if(isset($_POST['editcategorybttn']))
        {
            $this->form_validation->set_rules('jenjang', 'Jenjang', 'trim|required|xss_clean');
            $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required|xss_clean');
            $this->form_validation->set_rules('catname', 'Nama Pelajaran', 'trim|required|xss_clean');
            $this->form_validation->set_rules('catdesc', 'Deskripsi Pelajaran', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = false;
            }
            else
            {
                $categorydetails = array(
										 'jenjang'=>$this->input->post('jenjang'), 
										 'jurusan'=>$this->input->post('jurusan'), 
										 'catname'=>$this->input->post('catname'), 
                                         'catdesc'=>$this->input->post('catdesc')
                                         );
                $indexid = $this->input->post('catid');
                if($this->admin_model->editcategory($categorydetails, $indexid))
                {
                    $data['success'] = 'Pelajaran Berhasil diubah !';
                }
                else
                {
                    $data['error']   = 'Terjadi Error, Silahkan Ulangi !';
                }
            }
        }
        $data['categorydetails'] = $this->admin_model->getcategory($catid);
		$data['jenjang'] = $this->admin_model->get_jenjang();
		$data['jurusan'] = $this->admin_model->get_jurusan();
        $data['page'] = 'editcategory';
        $this->load->view('admin/main', $data);
    }

    function deleteUser()
    {
        $userid = $_POST['userId'];
        $this->admin_model->deleterecord('users', 'user_id', $userid);
    }
    function deleteadmin()
    {
        $adminid = $_POST['adminId'];
        $this->admin_model->deleterecord('administrators', 'adminid', $adminid);
    }

    function categories()
    {
        $data = array();
        $data['categoriesdata'] = $this->admin_model->dbselect('exam_category');
        $data['page'] = 'managecategories';
        $this->load->view('admin/main', $data);
    }
    function createcategory()
    {
        $data = array();
        if(isset($_POST['savecatbttn']))
        {
            $this->form_validation->set_rules('catname', 'Nama Pelajaran', 'trim|required|xss_clean');
            $this->form_validation->set_rules('catdesc', 'Deskripsi Pelajaran', 'trim|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = false;
            }
            else
            {
                $categorydetails = array('catname'=>$this->input->post('catname'), 
                                         'catdesc'=>$this->input->post('catdesc')
                                         );
                if($this->admin_model->createcategory($categorydetails))
                {
                    $data['success'] = 'Category added successfully !';
					redirect('administrator/categories');
                }
                else
                {
                    $data['error']   = 'An error occurred while adding the category, please try again !';
                }
            }
        }
		$data['jenjang'] = $this->admin_model->get_jenjang();
		$data['jurusan'] = $this->admin_model->get_jurusan();
        $data['page'] = 'createcategory';
        $this->load->view('admin/main', $data);
    }

    function email_exists($email)
    {
        if($this->user_model->email_exists($email))
        {
        $this->form_validation->set_message('email_exists', 'Email already exists. Select another email');
        return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    function username_exists($username)
    {
        if($this->user_model->username_exists($username))
        {
        $this->form_validation->set_message('username_exists', 'Username already exists. Select another username');
        return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function adminemail_exists($email)
    {
        if($this->admin_model->adminemail_exists($email))
        {
        $this->form_validation->set_message('adminemail_exists', 'Email already exists. Select another email');
        return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    function adminusername_exists($username)
    {
        if($this->admin_model->adminusername_exists($username))
        {
        $this->form_validation->set_message('adminusername_exists', 'Username already exists. Select another username');
        return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function exams()
    {
        $data = array();
        $data['exams'] = $this->admin_model->getexams();
        $data['page'] = 'manageexams';
        $this->load->view('admin/main', $data);
    }
    function editexam($examid)
    {
        $data = array();
        if(isset($_POST['saveexambttn']))
        {
            $this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('examname', 'Exam Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('examdesc', 'Exam Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('noofques', 'Number of questions', 'trim|required|xss_clean');
            $this->form_validation->set_rules('duration', 'Duration', 'trim|required|xss_clean');
            $this->form_validation->set_rules('availablefrom', 'Available From', 'trim|required|xss_clean');
            $this->form_validation->set_rules('availableto', 'Available To', 'trim|required|xss_clean');
            $this->form_validation->set_rules('passmark', 'Pass Mark', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = false;
            }
            else
            {
                $examdetails = array('examname'=>$this->input->post('examname'), 
                                         'description'=>$this->input->post('examdesc'),
                                         'catid'=>$this->input->post('category'),
                                         'availablefrom'=>date('Y-m-d', strtotime($this->input->post('availablefrom'))),
                                         'availableto'=>date('Y-m-d', strtotime($this->input->post('availableto'))),
                                         'duration'=>$this->input->post('duration'),
                                         'questions'=>$this->input->post('noofques'),
                                         'passmark'=>$this->input->post('passmark')
                                         );
                $indexid = $this->input->post('examid');
                if($this->admin_model->editexam($examdetails, $indexid))
                {
                    $data['success'] = 'Exam updated successfully !';
                }
                else
                {
                    $data['error']   = 'An error occurred while editing the exam, please try again !';
                }
            }
        }
        $examdetails = $this->admin_model->getexam($examid);
        $data['examdetails'] = $examdetails;
        $data['categories'] = $this->admin_model->get_select_option('exam_category', 'catid', 'catname', $examdetails->catid);
        $data['page'] = 'editexam';
        $this->load->view('admin/main', $data);
    }
    function createexam()
    {
        $data = array();
        if(isset($_POST['saveexambttn']))
        {
            $this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');
            $this->form_validation->set_rules('examname', 'Exam Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('examdesc', 'Exam Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('noofques', 'Number of questions', 'trim|required|xss_clean');
            $this->form_validation->set_rules('duration', 'Duration', 'trim|required|xss_clean');
            $this->form_validation->set_rules('availablefrom', 'Available From', 'trim|required|xss_clean');
            $this->form_validation->set_rules('availableto', 'Available To', 'trim|required|xss_clean');
            $this->form_validation->set_rules('passmark', 'Pass Mark', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = false;
            }
            else
            {
                $examdetails = array('examname'=>$this->input->post('examname'), 
                                         'description'=>$this->input->post('examdesc'),
                                         'catid'=>$this->input->post('category'),
                                         'availablefrom'=>date('Y-m-d', strtotime($this->input->post('availablefrom'))),
                                         'availableto'=>date('Y-m-d', strtotime($this->input->post('availableto'))),
                                         'duration'=>$this->input->post('duration'),
                                         'questions'=>$this->input->post('noofques'),
                                         'passmark'=>$this->input->post('passmark')
                                         );
                if($this->admin_model->createexam($examdetails))
                {
                    $data['success'] = 'Exam added successfully !';
                }
                else
                {
                    $data['error']   = 'An error occurred while adding the exam, please try again !';
                }
            }
        }
        $data['categories'] = $this->admin_model->get_select_option('exam_category', 'catid', 'catname');
        $data['page'] = 'createexam';
        $this->load->view('admin/main', $data);
    }

    function deleteexam()
    {
        $examid = $_POST['examId'];
        $this->admin_model->deleterecord('exams', 'examid', $examid);
    }
     function deletequestion()
    {
        $questionId = $_POST['questionId'];
        $this->admin_model->deleterecord('questions', 'questionid', $questionId);
    }

    function deletecategory()
    {
        $catid = $_POST['catId'];
        $this->admin_model->deleterecord('exam_category', 'catid', $catid);
    }
    function mngquestions($examid)
    {
        $data = array();
        $data['questions'] = $this->admin_model->get_exam_questions($examid);
        $data['examdata'] = $this->admin_model->get_exam_name($examid);
        $data['page'] = 'managequestions';
        $this->load->view('admin/main', $data);
    }
    function createquestion($examid)
    {
        $data = array();
        if(isset($_POST['savequestionbttn']))
        {
            $this->form_validation->set_rules('question', 'Question', 'trim|required|xss_clean');
            $this->form_validation->set_rules('optiona', 'Option A', 'trim|required|xss_clean');
            $this->form_validation->set_rules('optionb', 'Option B', 'trim|required|xss_clean');
            $this->form_validation->set_rules('optionc', 'Option C', 'trim|required|xss_clean');
            $this->form_validation->set_rules('optiond', 'Option D', 'trim|required|xss_clean');
            $this->form_validation->set_rules('correctanswer', 'Correct Answer', 'trim|required|xss_clean');
            $this->form_validation->set_rules('marks', 'Marks', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = false;
            }
            else
            {
                $questiondetails = array('examid'=>$this->input->post('examid'), 
                                         'question'=>$this->input->post('question'),
                                         'optiona'=>$this->input->post('optiona'),
                                         'optionb'=>$this->input->post('optionb'),
                                         'optionc'=>$this->input->post('optionc'),
                                         'optiond'=>$this->input->post('optiond'),
                                         'correctanswer'=>$this->input->post('correctanswer'),
                                         'marks'=>$this->input->post('marks')
                                         );
                if($this->admin_model->createquestion($questiondetails))
                {
                    $data['success'] = 'Question added successfully !';
                }
                else
                {
                    $data['error']   = 'An error occurred while adding the Question, please try again !';
                }
            }

        }
        $data['examid'] = $examid;
        $data['page'] = 'createquestions';
        $this->load->view('admin/main', $data);
    }

    function editquestion($questionid = 0)
    {
        $data = array();
        if(isset($_POST['editquestionbttn']))
        {
            $this->form_validation->set_rules('question', 'Question', 'trim|required|xss_clean');
            $this->form_validation->set_rules('optiona', 'Option A', 'trim|required|xss_clean');
            $this->form_validation->set_rules('optionb', 'Option B', 'trim|required|xss_clean');
            $this->form_validation->set_rules('optionc', 'Option C', 'trim|required|xss_clean');
            $this->form_validation->set_rules('optiond', 'Option D', 'trim|required|xss_clean');
            $this->form_validation->set_rules('correctanswer', 'Correct Answer', 'trim|required|xss_clean');
            $this->form_validation->set_rules('marks', 'Marks', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = false;
            }
            else
            {
                $questionid = $this->input->post('questionid');
                $questiondetails = array('question'=>$this->input->post('question'),
                                         'optiona'=>$this->input->post('optiona'),
                                         'optionb'=>$this->input->post('optionb'),
                                         'optionc'=>$this->input->post('optionc'),
                                         'optiond'=>$this->input->post('optiond'),
                                         'correctanswer'=>$this->input->post('correctanswer'),
                                         'marks'=>$this->input->post('marks')
                                         );
                if($this->admin_model->editquestion($questiondetails, $questionid))
                {
                    $data['success'] = 'Question edited successfully !';
                }
                else
                {
                    $data['error']   = 'An error occurred while editing the Question, please try again !';
                }
            }
        }

        $data['question'] = $this->admin_model->getquestion($questionid);
        $data['page'] = 'editquestion';
        $this->load->view('admin/main', $data);
    }

    function newadmin()
    {
        $data = array();
        if(isset($_POST['createadminbttn']))
        {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_adminemail_exists');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[6]|max_length[20]|callback_adminusername_exists');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirmpassword', 'Confirm password', 'trim|required|xss_clean|matches[password]');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
        
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = FALSE;
            }
            else
            {
                $admindetails = array('firstname' => $this->input->post('firstname'),
                                     'lastname'  => $this->input->post('lastname'),
                                     'email'     => $this->input->post('email'),
                                     'username'  => $this->input->post('username'),
                                     'password'  => sha1($this->input->post('password'))
                    );
                if($this->user_model->insert('administrators', $admindetails))
                {
                    $data['success'] = 'Account created successfully!';
                }
                else
                {
                    $data['error'] = 'An error occurred while creating account, please try again !';
                }

            }
        }
        $data['page'] = 'createadmin';
        $this->load->view('admin/main', $data);
    }
    function administrators()
    {
        $data = array();
        $data['administratorsdata'] = $this->admin_model->dbselect('administrators');
        $data['page'] = 'manageadministrators';
        $this->load->view('admin/main', $data);
    }

    function editadmin($adminid)
    {
        $data = array();
        if(isset($_POST['updateprofilebttn']))
        {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
        
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = FALSE;
            }
            else
            {
                $admindetails = array('firstname' => $this->input->post('firstname'),
                                     'lastname'  => $this->input->post('lastname'),
                                     'email'     => $this->input->post('email')
                    );
                $indexid = $this->input->post('adminid');
                if($this->admin_model->editadminprofile($admindetails, $indexid))
                {
                    $data['success'] = 'Account details updated successfully !';
                }
                else
                {
                    $data['error'] = 'An error occurred while updating the account, please make sure you have entered the correct password !';
                }

            }
        }
        if(isset($_POST['changepasswordbttn']))
        {
            $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|xss_clean|min_length[6]|max_length[20]');
            $this->form_validation->set_rules('confirmnewpassword', 'Confirm new password', 'trim|required|xss_clean|matches[newpassword]');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = FALSE;
            }
            else
            {
                $admindetails = array('password' => sha1($this->input->post('newpassword'))
                    );
                $indexid = $this->input->post('adminid');
                if($this->admin_model->editadminprofile($admindetails, $indexid))
                {
                    $data['success'] = 'Password Changed successfully !';
                }
                else
                {
                    $data['error'] = 'An error occurred while updating the password, please make sure you have entered the correct password !';
                }
            }
        }
        $data['admindetails'] = $this->admin_model->adminprofile($adminid);
        $data['page'] = 'editadmin';
        $this->load->view('admin/main', $data);
    }

     function myprofile()
    {
        $data = array();
        $session = get_session_details();
        if(isset($session->admindetails) && !empty($session->admindetails))
        {
            $loggedadmin = (object)$session->admindetails;
            $adminid = $loggedadmin->adminid;
            
        }
        else
        {
            redirect(base_url().'admin');
        }
        if(isset($_POST['updateprofilebttn']))
        {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
        
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = FALSE;
            }
            else
            {
                $admindetails = array('firstname' => $this->input->post('firstname'),
                                     'lastname'  => $this->input->post('lastname'),
                                     'email'     => $this->input->post('email')
                    );
                $indexid = $this->input->post('adminid');
                $password = $this->input->post('password');
                if($this->admin_model->editmyprofile($admindetails, $indexid, $password))
                {
                    $data['success'] = 'Account details updated successfully !';
                }
                else
                {
                    $data['error'] = 'An error occurred while updating the account, please make sure you own this account and have entered the correct password !';
                }

            }
        }
        
        $data['admindetails'] = $this->admin_model->adminprofile($adminid);
        $data['page'] = 'myprofile';
        $this->load->view('admin/main', $data);
    }
    function changepassword()
    {
        $data = array();
        $session = get_session_details();
        if(isset($session->admindetails) && !empty($session->admindetails))
        {
            $loggedadmin = (object)$session->admindetails;
            $adminid = $loggedadmin->adminid;
            $adminusername = $loggedadmin->adminusername;
            
        }
        else
        {
            redirect(base_url().'admin');
        }

        if(isset($_POST['changepasswordbttn']))
        {
            $this->form_validation->set_rules('currentpassword', 'Current Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('confirmnewpassword', 'Confirm new password', 'trim|required|matches[newpassword]|xss_clean');
            $this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
        
            if($this->form_validation->run() == FALSE) 
            {
                $data['reset'] = FALSE;
            }
            else
            {
                $passworddetails = array('password' => sha1($this->input->post('newpassword')));
                $indexid = $this->input->post('adminid');
                $password = $this->input->post('currentpassword');
                if($this->admin_model->editmyprofile($passworddetails, $indexid, $password))
                {
                    $data['success'] = 'Password updated successfully !';
                }
                else
                {
                    $data['error'] = 'An error occurred while updating your password, please make sure you own this account and have entered the correct password !';
                }

            }
        }
        $data['page'] = 'changepassword';
        $data['adminid'] = $adminid;
        $data['adminusername'] = $adminusername;
        $this->load->view('admin/main', $data);
    }

    function results()
    {
        $data = array();
        $data['page'] = 'viewresults';
        $data['exams'] = $this->admin_model->get_attempted_exams();
        $this->load->view('admin/main', $data);
    }
    function view_results($examid)
    {
        $data = array();
        $data['page'] = 'exam_results';
        $data['exam_results'] = $this->admin_model->get_exam_results($examid);
        $this->load->view('admin/main', $data);
    }
}