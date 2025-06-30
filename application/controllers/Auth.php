<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
        $this->load->model('Register_model'); // Load models
    }

    public function register()
    {
        $this->load->view('register');
    }

    public function login()
    {
        $this->load->view('login');
    }

    public function add()
    {
        $userName = $this->input->post('userName');
        $userEmail = $this->input->post('userEmail');
        $userPassword = $this->input->post('userPassword');
        $userIC = $this->input->post('userIC');
        $userPhoneNo = $this->input->post('userPhoneNo');
        $userRole = $this->input->post('userRole');

        // Check for duplicate email
        if ($this->Register_model->email_exists($userEmail)) {
            $this->session->set_flashdata('error', 'This email is already registered. Please use another one.');
            redirect('auth/register');

            return;
        }

        $data = [
            'userName' => $userName,
            'userEmail' => $userEmail,
            'userPassword' => password_hash($userPassword, PASSWORD_DEFAULT),
            'userIC' => $userIC,
            'userPhoneNo' => $userPhoneNo,
            'userRole' => $userRole,
        ];

        $status = $this->Register_model->add($data);

        if ($status > 0) {
            $this->session->set_flashdata('success', 'Registration successful! Please log in.');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Registration failed! Please try again.');
            redirect('auth/register');
        }
    }

    // public function add()
    // {
    //     $userName = $this->input->post('userName');
    //     $userEmail = $this->input->post('userEmail');
    //     $userPassword = $this->input->post('userPassword');
    //     $userIC = $this->input->post('userIC');
    //     $userPhoneNo = $this->input->post('userPhoneNo');
    //     $userRole = $this->input->post('userRole');

    //     // Check for duplicate email
    //     if ($this->Register_model->email_exists($userEmail)) {
    //         $data['email_exists'] = true;
    //         $this->load->view('register', $data);

    //         return;
    //     }

    //     $data = [
    //         'userName' => $userName,
    //         'userEmail' => $userEmail,
    //         // 'userPassword' => $userPassword,
    //         'userPassword' => password_hash($userPassword, PASSWORD_DEFAULT),
    //         'userIC' => $userIC,
    //         'userPhoneNo' => $userPhoneNo,
    //         'userRole' => $userRole,
    //     ];

    //     $status = $this->Register_model->add($data);
    //     if ($status > 0) {
    //         redirect('auth/login');
    //     }
    // }

    // Validate Login Based on the role (ASAL)
    // public function validate_login()
    // {
    //     $userEmail = $this->input->post('userEmail');
    //     $userPassword = $this->input->post('userPassword');

    //     $this->load->model('Register_model');
    //     $user = $this->Register_model->get_user_by_email($userEmail);

    //     if ($user && $user->userPassword == $userPassword) {
    //         $session_data = [
    //             'logged_in' => true,
    //             'userID' => $user->userID,
    //             'userName' => $user->userName,
    //             'userRole' => $user->userRole,
    //         ];
    //         $this->session->set_userdata($session_data);

    //         // Role-based redirection
    //         if ($user->userRole == 'Admin PPJIM') {
    //             redirect('dashboard/PPJIM_Dashboard');
    //         } elseif ($user->userRole == 'Project Leader') {
    //             redirect('dashboard/dashboard');
    //         } else {
    //             redirect('dashboard/beneficiary_dashboard');
    //         }
    //     } else {
    //         $this->session->set_flashdata('error', 'Invalid email or password.');
    //         redirect('auth/login');
    //     }
    // }

    // public function validate_login()
    // {
    //     $userEmail = $this->input->post('userEmail');
    //     $userPassword = $this->input->post('userPassword');

    //     $this->load->model('Register_model');
    //     $user = $this->Register_model->get_user_by_email($userEmail);

    //     echo password_hash($userPassword, PASSWORD_DEFAULT);
    //     echo '<br>';
    //     echo $user->userPassword;
    // if ($user && password_verify($userPassword, $user->userPassword)) {
    //     $session_data = [
    //         'logged_in' => true,
    //         'userID' => $user->userID,
    //         'userName' => $user->userName,
    //         'userRole' => $user->userRole,
    //     ];
    //     $this->session->set_userdata($session_data);

    //     // Role-based redirect
    //     if ($user->userRole == 'Admin PPJIM') {
    //         redirect('dashboard/PPJIM_Dashboard');
    //     } elseif ($user->userRole == 'Project Leader') {
    //         redirect('dashboard/dashboard');
    //     } else {
    //         redirect('dashboard/beneficiary_dashboard');
    //     }
    // } else {
    //     $this->session->set_flashdata('error', 'Invalid email or password.');
    //     redirect('auth/login');
    // }
    // }

    // dinn
    // public function validate_login()
    // {
    //     $userEmail = $this->input->post('userEmail');
    //     $userPassword = $this->input->post('userPassword');

    //     $this->load->model('Register_model');
    //     $user = $this->Register_model->get_user_by_email($userEmail);

    //     if ($user && password_verify($userPassword, $user->userPassword)) {
    //         // Login success — set session variables (like your structure)
    //         $_SESSION['logged_in'] = true;
    //         $_SESSION['userID'] = $user->userID;
    //         $_SESSION['userName'] = $user->userName;
    //         $_SESSION['userRole'] = $user->userRole;

    //         // Redirect by role
    //         if ($user->userRole === 'Admin PPJIM') {
    //             redirect(base_url('dashboard/PPJIM_Dashboard'));
    //         } elseif ($user->userRole === 'Project Leader') {
    //             redirect(base_url('dashboard/dashboard'));
    //         } else {
    //             redirect(base_url('dashboard/beneficiary_dashboard'));
    //         }
    //     } else {
    //         // Login failed
    //         $this->session->set_flashdata('error', 'Invalid email or password.');
    //         redirect(base_url('auth/login'));
    //     }
    // }

    public function validate_login()
    {
        $userEmail = $this->input->post('userEmail');
        $userPassword = $this->input->post('userPassword');

        $this->load->model('Register_model');
        $user = $this->Register_model->get_user_by_email($userEmail);

        if ($user && password_verify($userPassword, $user->userPassword)) {
            // Successful login: store session and redirect
            $session_data = [
                'logged_in' => true,
                'userID' => $user->userID,
                'userName' => $user->userName,
                'userRole' => $user->userRole,
            ];
            $this->session->set_userdata($session_data);

            // Redirect based on role
            if ($user->userRole === 'Admin PPJIM') {
                redirect('dashboard/PPJIM_Dashboard');
            } elseif ($user->userRole === 'Project Leader') {
                redirect('dashboard/dashboard');
            } else {
                redirect('dashboard/beneficiary_dashboard');
            }
        } else {
            // Login failed
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('auth/login');
        }
    }

    private function login_user($user)
    {
        $session_data = [
            'logged_in' => true,
            'userID' => $user->userID,
            'userName' => $user->userName,
            'userRole' => $user->userRole,
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
    public function forgot_password()
    {
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

                $reset_link = base_url('auth/reset_password/'.$token);
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
    public function reset_password($token = null)
    {
        $this->load->model('User_model');

        // Check token validity
        if (!$token || !$this->User_model->is_valid_token($token)) {
            show_error('Invalid or expired token.');
        }

        // When form is submitted
        if ($this->input->method() === 'post') {
            $password = $this->input->post('userPassword');

            // Hash the new password before storing
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Update hashed password in database
            $this->User_model->update_password_by_token($token, $hashedPassword);

            $this->session->set_flashdata('message', 'Password successfully updated.');
            redirect('auth/login');
        }

        // Load reset password form
        $this->load->view('templates/header');
        $this->load->view('reset_password', ['token' => $token]);
    }
}
