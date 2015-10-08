<?PHP

class feedinstagram extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$datos['titulo'] = 'Feed instagram';
		
		$this->load->view('header',$datos);
		$this->load->view('instagram');
		$this->load->view('footer');
		
	}
	
}
