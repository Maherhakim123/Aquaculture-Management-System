<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{
    public function index()
    {
        // Load view or echo something
        // echo 'This is the homepage.';
        // Or load a view: $this->load->view('homepage');
        redirect('Homepage/Homepage');
    }

    public function Homepage()
    {
        $this->load->view('Homepage');
    }
}
