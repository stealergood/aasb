<?php


function is_logged_in()

{

    $ci = get_instance();

    if (!$ci->session->userdata('logged_in')) {

        $ci->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert"><b>Kesalahan !!</b> Harap Login Dahulu.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

        redirect('login');

    } 

}