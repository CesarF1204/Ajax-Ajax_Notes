<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
        $this->load->model("Note");
    }
    public function index_json() {
        $data["notes"] = $this->Note->all();
        echo json_encode($data);
    }
    public function index_html() {
        $data["notes"] = $this->Note->all();
        $this->load->view("partials/notes", $data);
    }
    public function create() {
        // this is an associative array with 'author' and 'name' with values user entered in the form
        // this is what $(this).serialize() sent over to this URL
        $new_note = $this->input->post();
        $this->Note->create($new_note);
        // after we create the new post then we can query the database again and it will include the new 
        // one we just included
        $data["notes"] = $this->Note->all();
        // then we respond to the AJAX request with a partial that will use the $data variable to generate      
        // the appropriate html
        $this->load->view("partials/notes", $data);
        
    }
    public function index(){
        $this->load->view('notes/index');
    }
	public function update($id) {
		$values = array('description' => $this->input->post('description'));
		$values = $this->security->xss_clean($values);
		$result = $this->Note->update_note($id, $values);
		$this->session->set_flashdata('success', '<p class="success">Note has been updated.</p>');
		
		redirect(base_url());
	}
	public function delete() {
		$this->Note->delete_note($this->input->post('id'));
		$this->session->set_flashdata('success', '<p class="errors">Note has been removed.</p>');
		redirect(base_url());
	}
}
