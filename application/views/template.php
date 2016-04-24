<?php $this->load->view('head');?>

<?php
	if ($logged_in != true)
	{
		$this->load->view('header');
	} elseif ($function == 1) {
		$this->load->view('header_admin');
	} else {
		$this->load->view('header_logged');
	}
?>

<?php
	if (isset($data)) {
		$this->load->view($main_content, $data);
	} else {
		$this->load->view($main_content);
	}
?>

<?php $this->load->view('footer'); ?>
