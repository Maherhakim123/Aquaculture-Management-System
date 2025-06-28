<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->model('Register_model'); // Load models
    }

	public function register() {
		$this->load->view('register');
	}

	public function login() {
		$this->load->view('login');
	}

	public function add(){
		$userName = $this->input->post('userName');
		$userEmail = $this->input->post('userEmail');
		$userPassword = $this->input->post('userPassword');
		$userIC = $this->input->post('userIC');
		$userPhoneNo = $this->input->post('userPhoneNo');
		$userRole = $this->input->post('userRole');

		//Check for duplicate email
		if ($this->Register_model->email_exists($userEmail)) {
			$data['email_exists'] = true;
			$this->load->view('register', $data);
			return;
		}

		$data = [
			'userName' => $userName,
			'userEmail' => $userEmail,
			'userPassword' => $userPassword,
			'userIC' => $userIC,
			'userPhoneNo' => $userPhoneNo,
			'userRole' => $userRole
		];

		$status = $this->Register_model->add($data);
		if ($status>0){
			redirect('auth/login');
		}
	}

	// Validate Login Based on the role
	public function validate_login() {
    $userEmail = $this->input->post('userEmail');
    $userPassword = $this->input->post('userPassword');

    $this->load->model('Register_model');
    $user = $this->Register_model->get_user_by_email($userEmail);

    if ($user && $user->userPassword == $userPassword) {
        $session_data = [
            'logged_in' => true,
            'userID' => $user->userID,
            'userName' => $user->userName,
            'userRole' => $user->userRole
        ];
        $this->session->set_userdata($session_data);

        // Role-based redirection
        if ($user->userRole == 'Admin PPJIM') {
            redirect('dashboard/PPJIM_Dashboard');
        } elseif ($user->userRole == 'Project Leader') {
            redirect('dashboard/dashboard');
        } else {
            redirect('dashboard/beneficiary_dashboard');
        }
    } else {
        $this->session->set_flashdata('error', 'Invalid email or password.');
        redirect('auth/login');
    }
}

// public function validate_login() {
//     $userEmail = $this->input->post('userEmail');
//     $userPassword = $this->input->post('userPassword');

//     $this->load->model('Register_model');
//     $user = $this->Register_model->get_user_by_email($userEmail);

//     if ($user) {
//         $storedPassword = $user->userPassword;

//         // Only allow hashed passwords
//         if (password_get_info($storedPassword)['algo'] !== 0) {
//             if (password_verify($userPassword, $storedPassword)) {
//                 return $this->login_user($user);
//             } else {
//                 $this->session->set_flashdata('error', 'Incorrect password.');
//             }
//         } else {
//             // Plaintext password found — reject
//             $this->session->set_flashdata('error', 'Unsecured account. Please contact admin to reset your password.');
//         }
//     } else {
//         $this->session->set_flashdata('error', 'Email not found.');
//     }

//     redirect('auth/login');
// }






private function login_user($user) {
    $session_data = [
        'logged_in' => true,
        'userID'    => $user->userID,
        'userName'  => $user->userName,
        'userRole'  => $user->userRole
    ];
    $this->session->set_userdata($session_data);

    // Redirect based on user role
    if ($user->userRole === 'Admin PPJIM') {
        redirect('dashboard/PPJIM_Dashboard');
    } elseif ($user->userRole === 'Project Leader') {
        redirect('dashboard/dashboard');
    } else {
        redirect('dashboard/beneficiary_dashboard');
    }
}



	// Forgot Password
    public function forgot_password() {
    $email = $this->input->post('email');

    if ($email) {
        $this->load->model('Register_model');
        $user = $this->Register_model->get_user_by_email($email);

        if ($user) {
            if ($user->userRole === 'Admin PPJIM') {
                $this->session->set_flashdata('error', 'Admin is not allowed to reset the password.');
                redirect('auth/forgot_password');
            }

            // Generate token
            $token = bin2hex(random_bytes(32));
            $this->Register_model->store_reset_token($user->userEmail, $token);

            $reset_link = base_url('auth/reset_password/' . $token);
            $this->session->set_flashdata('reset_link', $reset_link);
            redirect('auth/forgot_password');
        } else {
            $this->session->set_flashdata('error', 'Email not found.');
            redirect('auth/forgot_password');
        }
    }

	// load view
    $this->load->view('forgot_password');
}




	// Reset Password
	public function reset_password($token = null) {
    $this->load->model('User_model');

    if (!$token || !$this->User_model->is_valid_token($token)) {
        show_error('Invalid or expired token.');
    }

    if ($this->input->method() === 'post') {
        $password = $this->input->post('userPassword'); // 🔧 Plaintext as you want
        $this->User_model->update_password_by_token($token, $password);

        $this->session->set_flashdata('message', 'Password successfully updated.');
        redirect('auth/login');
    }

    $this->load->view('templates/header');
    $this->load->view('reset_password', ['token' => $token]);
}








}
