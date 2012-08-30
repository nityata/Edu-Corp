<?php  

		$project = new Project();
		unset($project);
	
	
class Project{
	
	
	private $errors = array();  /* holds error messages */
	private $num_errors;   	/* number of errors in submitted form */
	private $con;			
	private $sql;
	
	public function __construct(){
			//error_log(print_r('Inside constructor', TRUE), 0);
			
			
			$this->con = mysql_connect("localhost","root");
			if (!($this->con))
			  {
			  		$json = array('result' 	=> -2); $encoded = json_encode($json);
					echo $encoded;
					unset($encoded);
					//die('Could not connect: ' . mysql_error());
			  }
			else {
				mysql_select_db("ss2", $this->con);
				$this->processNewMessage();
			}
		
	}

	public function processNewMessage(){
		
		$authors = $_POST['email'];
		$title	= $_POST['name'];
		$guide	= $_POST['website'];
		$abstract	= $_POST['message'];
		$duration = $_POST['duration'];
		$submitter = $_POST['newcontact'];
		$fnames = $_POST['filesname'];
		
		$this->sql = "INSERT INTO project2(submitter,title,abstract,author,guide,duration,files) VALUES ($submitter,'$title','$abstract','$authors','$guide',$duration,'$fnames')";
		
		/* Server Side Data Validation */
		
		/* Email Validation */
		if(!$title || mb_strlen($title = trim($title)) == 0)
			$this->setError('name', 'required field');
	
		/*if(!$authors || mb_strlen($authors = trim($authors)) == 0)
			$this->setError('email', 'required field');*/
		
		if(!$abstract || mb_strlen($abstract = trim($abstract)) == 0)
			$this->setError('message', 'required field');
		
		if(!$duration || mb_strlen($duration = trim($duration)) == 0)
			$this->setError('duration', 'required field');
			
		/* Errors exist */
		//error_log(print_r("Count errors: ".$this->countErrors(), TRUE), 0);
		if($this->countErrors() > 0){
			$json = array(
				'result' => -1, 
				'errors' => array(
								/*array('name' => 'email'		,'value' => $this->error_value('email')),*/
								array('name' => 'name' 		,'value' => $this->error_value('name')),
								array('name' => 'duration'	,'value' => $this->error_value('duration')),
								array('name' => 'message'	,'value' => $this->error_value('message'))
							)
				);				
			$encoded = json_encode($json);
			echo $encoded;
			unset($encoded);
		}
		/* No errors, insert in db*/
		else{
			if (!mysql_query($this->sql,$this->con))
			{
				$json = array('result' 	=> -2); 
			}
			else 
			{
				$json = array('result' 	=> 1); 
			}
			
			$encoded = json_encode($json);
			echo $encoded;
			unset($encoded);
		}
		mysql_close($this->con);
	}
	
	
	public function setError($field, $errmsg){
		$this->errors[$field] 	= $errmsg;
		$this->num_errors 		= count($this->errors);
	}
	
	public function error_value($field){
		if(array_key_exists($field,$this->errors))
			return $this->errors[$field];
		else
			return '';
	}
	
	public function countErrors(){
		return $this->num_errors;
	}
};

?>