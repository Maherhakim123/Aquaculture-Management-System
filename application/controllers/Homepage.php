<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{
    public function index()
    {
        // Load view or echo something
        // echo 'This is the homepage.';
        $this->load->view('Homepage');
        // redirect('Homepage/Homepage');
    }

    // public function Homepage()
    // {
    //     $this->load->view('Homepage');
    // }
}
