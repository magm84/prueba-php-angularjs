<?PHP 

class github extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$datos['titulo'] = 'Issues Github';
		
		$this->load->view('header',$datos);
		$this->load->view('github');
		$this->load->view('footer');
	}
	
}
