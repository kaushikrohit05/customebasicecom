<?php 
// My database Class called myDBC
class dbclass
{
 
	// our mysqli object instance
	public $mysqli = null;	
	// Class constructor override
	public $site_location;
 	public $img_type;
	public $encryptionMethod;
	public $secretHash;
	public $iv;
	public $day_hr;

	
	
	public function __construct() 
	{
		include_once ("dbconfig.php");        
		$this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if ($this->mysqli->connect_errno)
		{
			echo "Error MySQLi: ( ". $this->mysqli->connect_errno. ") " . $this->mysqli->connect_error;
			exit();
		}
		//$this->mysqli->set_charset("utf8"); 
		
		$this->encryptionMethod = "AES-256-CBC";
		$this->secretHash = "la0gYU5HJ54p34pejzGtpEcOHeE4P6u3";
		$this->iv = mcrypt_create_iv(16, MCRYPT_RAND);
	
		$this->site_location=array('All','US','CA','UK','AU');
		$this->img_type=array('jpg','png');
		$this->day_hr=array('01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30','24:00','24:30','CLOSE');
		
	}
	

 
	// Class deconstructor override
	public function __destruct(){ $this->CloseDB();  }
 
	// runs a sql query
    public function runQuery($qry) {
        $result = $this->mysqli->query($qry);
		if($result){
    		 return $result;
		}else{
    		die('Error : ('. $this->mysqli->errno .') '. $this->mysqli->error);
		}


       
    }
 
	// runs multiple sql queres
    public function runMultipleQueries($qry) {
        $result = $this->mysqli->multi_query($qry);
        return $result;
    }
 
	// Close database connection
    public function CloseDB() {
        $this->mysqli->close();
    }
 
	// Escape the string get ready to insert or update
    public function clearText($text) {
		if(isset($text))
		{
			$value=$text;
			}
		
        $value = trim(str_replace("'","/",$value));
		$value = trim(str_replace('"',' ',$value));
        return $this->mysqli->real_escape_string($value);
		//return $this->mysqli->mysqli_real_escape_string($text);
		//mysqli_real_escape_string(
    }
 
	// Get the last insert id 
    public function lastInsertID() {
        return $this->mysqli->insert_id;
    }
 
	// Gets the total count and returns integer
	public function totalCount($fieldname, $tablename, $where = "") 
	{
	$q = "SELECT count(".$fieldname.") FROM ". $tablename . " " . $where;
	$result = $this->mysqli->query($q);
	$count = 0;
	if ($result) {
		while ($row = mysqli_fetch_array($result)) {
		$count = $row[0];
	   }
	  }
	  return $count;
	}	
	
	public function data_encript($key)
	{
		$encryptedText = base64_encode(openssl_encrypt($key,$this->encryptionMethod,$this->secretHash, 0, $this->iv));
		return $encryptedText;
	}
	
	public function data_decrypt($key)
	{
		$decryptedText = openssl_decrypt(base64_decode($key),$this->encryptionMethod,$this->secretHash, 0, $this->iv);
		return $decryptedText;
	}
	
	
	public function encrypt($string)
	{
        openssl_public_encrypt($string,$encryptedstring,$this->secretHash);
        return $encryptedstring;
    }
	
	
	public function decrypt($string)
	{
		openssl_private_decrypt($string,$decryptedstring,$this->secretHash);
		return $decryptedstring;
	}
	
	
	public function admin_login_chk()
	{
		if($_SESSION['sess_admin']=="")
		{
			 header("location:login.php");
			exit();
		}
		 
	}
		
	public function login_chk()
	{
		if(!$_SESSION['sess_user'])
		{
			header("location:login.php");
			exit();
		}
	}
    
  	public function manager_login_chk()
	{ 
		if(!$_SESSION['sess_manager'])
		{
			header("location:login.php");
			exit();
		}
	}
    
	public function operator_login_chk()
	{ 
		if(!$_SESSION['sess_operator'])
		{
			header("location:login.php");
			exit();
		}
	}
	public function day_hr_select($fname, $selected_time = '01:00')
	{ 
		echo '<select class="form-control input-sm" name="'.$fname.'"  id="'.$fname.'" required>';
		for($i=0;$i<count($this->day_hr);$i++)
		{
			echo "<option value='".$this->day_hr[$i]."' ";
			if($selected_time == $this->day_hr[$i]){ 
				echo " selected "; 
			}
			echo " >".$this->day_hr[$i]."</option>";
		}
		echo '</select>';
	}
	
 

    
 
	public function show_message()
	{
		if($_SESSION['session_message'])
		{
			if($_SESSION['session_message_type']==1)
			{
				$msgtypecss=' alert-success ';
			}
			if($_SESSION['session_message_type']==2)
			{
				$msgtypecss=' alert-danger ';
			}
  
			
			
			echo '<div class="alert '.$msgtypecss.'"  role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '.$_SESSION['session_message'].'</div>'; 
			$_SESSION['session_message']="";
			$_SESSION['session_message_type']="";
		}
	}
   
    
    
	
	public function status($id)
	{
		if($id==1)
		{
			return "Active";
		}
		else if($id==0)
		{
			return "Inactive";
		}
	}	

	public function inDBDate ($dt){
		$date = explode("/", $dt);
		$mm = $date[1];
		$dd = $date[0];
		$yyyy = $date[2];
		return $yyyy."-".$mm."-".$dd; 
	}
	
	public function outDBDate ($dt){
		$date = explode("-", $dt);
		$yyyy = $date[0];
		$mm = $date[1];
		$dd = $date[2];
		return $dd."/".$mm."/".$yyyy; 
	}
		//17-Apr-2015 23:50:34
		//'YYYY-MM-DD HH:MM:SS
	public function outDBDateTime($dt){
		$date = explode(" ", $dt);
		$tdate = $date[0];
		$ttime = $date[1];
		return $this->outDBDate($tdate)." ".$ttime; 
	}

	public function inDBDateTime($dt){
		$date = explode(" ", $dt);
		$tdate = $date[0];
		$ttime = $date[1];
		return $this->inDBDate($tdate)." ".$ttime; 
	}
 
	
	public function fetchval($colname,$chkval,$checkcol,$tbl)
	{
		  $query="Select $colname from $tbl where $checkcol='$chkval'";
		$sql = $this->mysqli->query($query);
		if($sql->num_rows>0)
		{	 
			$data=mysqli_fetch_array($sql);
			return $data[0];  
		}
		else
		{
			return "0";
		}
	}
		
 
		
		
	public function pagedata($page_name)
	{
		$sql="select * from tbl_pages where page_alise='".$page_name."' and published='1'";
		$query=$this->runQuery($sql);
		if($query->num_rows>0)
		{
			$data=mysqli_fetch_array($query);
			return $data;
		}		 
	}	
	
 
	
 
	
	public function convertCurrency($amount, $from, $to)
	{
    	$url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
	    $data = file_get_contents($url);
    	preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
	    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    	return round($converted, 3);
	}
	
	public function generateRandomString($length = 10)
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
	    $randomString = '';
    	for ($i = 0; $i < $length; $i++)
		{
        	$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
	}
	
	
	
	public function site_mails($to, $subject, $mail_message)
	{
	
$mail_header="
<table width='700' border='0' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; border-bottom:2px solid #F5F5F5 '><tr>
<td width='120'><a href='http://www.fashiononline.in' target='_blank'><img src='http://www.fashiononline.in/images/logo.jpg' alt='' width='105' height='100' style='border:2px solid #df6b8e;'></a></td>
<td align='right' style='line-height:20px '> (10am - 8pm) 7Days  Support<br>  +91 965-0000-148<br>
support@fashiononline.in</td>
  </tr></table>";


$mail_body="<table width='700' border='0' cellpadding='10' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; border-bottom:2px solid #F5F5F5 '><tr><td>";
$mail_body.=$mail_message;
$mail_body.="</td></tr></table>";


$mail_footer = "<table width='700' border='0' cellpadding='5' cellspacing='0' style='font-family:Arial, Helvetica, sans-serif; font-size:13px; border-bottom:2px solid #F5F5F5  '>
  <tr>
    <td>We hope to see you again soon. <br>
<strong><br>
Fashiononline.in <br>
<br>
</strong></td>
</tr></table>";

$mail_message = $mail_header.$mail_body.$mail_footer;
 
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: < support@fashiononline.in > \r\n";
$headers .= "Reply-To: support@fashiononline.in \r\n"; 
mail($to, $subject, $mail_message, $headers);
	
 }
 
 
		function get_comboval($tbl,$value_field,$label_field,$chkcol,$colval)
	{
 		$query= "select $value_field,$label_field from $tbl where $chkcol='$colval'";
		$sql=$this->runQuery($query); 
		while($data=mysqli_fetch_array($sql))
		{	
			echo "<option value='$data[$value_field]'>$data[$label_field]</option>";
		}
	}

function edit_comboval($tbl,$value_field,$label_field,$compare_value_field_with,$chkcol,$colval)
	{
 		 $query= "select $value_field,$label_field from $tbl where $chkcol='$colval'";
		$sql=$this->runQuery($query); 
		while($data=mysqli_fetch_array($sql))
		{	
			echo "<option value='$data[$value_field]' ";
			if($data[$value_field]==$compare_value_field_with)
			{ 
				echo " Selected ";
			}
			echo " > $data[$label_field]</option>";
		}
	}
 
 
 
 
	
////////////////////////////////////////////////////////////////////
	
	var $php_self;
	var $rows_per_page = 10; //Number of records to display per page
	var $total_rows = 0; //Total number of rows returned by the query
	var $links_per_page = 5; //Number of links to display per page
	var $append = ""; //Paremeters to append to pagination links
	var $sql = "";
	var $debug = false;
	//var $conn = false;
	var $page = 1;
	var $max_pages = 0;
	var $offset = 0;
 
 	/**
	 * Constructor
	 *
	 * @param resource $connection Mysql connection link
	 * @param string $sql SQL query to paginate. Example : SELECT * FROM users
	 * @param integer $rows_per_page Number of records to display per page. Defaults to 10
	 * @param integer $links_per_page Number of links to display per page. Defaults to 5
	 * @param string $append Parameters to be appended to pagination links 
	 */
	
	public function PS_Pagination($sql, $rows_per_page = 10, $links_per_page = 5, $append = "") {
		//$this->conn = $connection;
		$this->sql = $sql;
		
		$this->rows_per_page = (int)$rows_per_page;
		if (intval($links_per_page ) > 0) {
			$this->links_per_page = (int)$links_per_page;
		} else {
			$this->links_per_page = 5;
		}
		$this->append = $append;
		$this->php_self = htmlspecialchars($_SERVER['PHP_SELF'] );
		if (isset($_GET['page'] )) {
			$this->page = intval($_GET['page'] );
		}
		 
	}
	
	/**
	 * Executes the SQL query and initializes internal variables
	 *
	 * @access public
	 * @return resource
	 */
	public function paginate() {
		//$db		=	new dbclass();
		//Check for valid mysql connection
		//if (! $this->conn || ! is_resource($this->conn )) {
		//	if ($this->debug)
		//		echo "MySQL connection missing<br />";
		//	return false;
		//}
		//echo $this->sql;
		$all_rs = $this->runQuery($this->sql);
		 //print_r($all_rs);
		$this->total_rows = $all_rs->num_rows;
		//@mysqli_close($all_rs );
		
		//Return FALSE if no rows found
		if ($this->total_rows == 0) {
			if ($this->debug)
				echo "Query returned zero rows.";
			return FALSE;
		}
		else
		{
		
		//Max number of pages
		$this->max_pages = ceil($this->total_rows / $this->rows_per_page );
		if ($this->links_per_page > $this->max_pages) {
			$this->links_per_page = $this->max_pages;
		}
		
		//Check the page value just in case someone is trying to input an aribitrary value
		if ($this->page > $this->max_pages || $this->page <= 0) {
			$this->page = 1;
		}
		
		//Calculate Offset
		$this->offset = $this->rows_per_page * ($this->page - 1);
		
		//Fetch the required result set
		$rs = $this->runQuery($this->sql . " LIMIT {$this->offset}, {$this->rows_per_page}" );
		return $rs;
		}
		

	}
	
	/**
	 * Display the link to the first page
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to 'First'
	 * @return string
	 */
	public function renderFirst($tag = 'First') {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page == 1) {
			return "<li><a href=''>$tag</a></li>";
		} else {
			return '<li><a href="' . $this->php_self . '?page=1&' . $this->append . '">' . $tag . '</a></li>';
		}
	}
	
	/**
	 * Display the link to the last page
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to 'Last'
	 * @return string
	 */
	public function renderLast($tag = 'Last') {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page == $this->max_pages) {
			return "<li><a href=''>$tag</a></li>";
		} else {
			return '<li><a href="' . $this->php_self . '?page=' . $this->max_pages . '&' . $this->append . '">' . $tag . '</a></li>';
		}
	}
	
	/**
	 * Display the next link
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to '>>'
	 * @return string
	 */ 
	public function renderNext($tag = '&raquo;') {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page < $this->max_pages) {
			return '<li><a href="' . $this->php_self . '?page=' . ($this->page + 1) . '&' . $this->append . '" aria-label="Next"><span aria-hidden="true">' . $tag . '</span></a></li>';
		} else {
			return "<li><a href='#' aria-label='Next'><span aria-hidden='true'>$tag</span></a></li>";
		}
	}
	
	/**
	 * Display the previous link
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to '<<'
	 * @return string
	 */
	 
	 
	 
	public function renderPrev($tag = '&laquo;') {
		if ($this->total_rows == 0)
			return FALSE;
		
		if ($this->page > 1) {
			return '<li><a href="' . $this->php_self . '?page=' . ($this->page - 1) . '&' . $this->append . '"  aria-label="Previous"><span aria-hidden="true">' . $tag . '</a></li>';
		} else {
			return "<li><a href=''  aria-label='Previous'><span aria-hidden='true'>$tag</a></li>";
		}
	}
	
	/**
	 * Display the page links
	 *
	 * @access public
	 * @return string
	 */
	public function renderNav($prefix = '<li>', $suffix = '</li>') {
		if ($this->total_rows == 0)
			return FALSE;
		
		$batch = ceil($this->page / $this->links_per_page );
		$end = $batch * $this->links_per_page;
		if ($end == $this->page) {
			//$end = $end + $this->links_per_page - 1;
		//$end = $end + ceil($this->links_per_page/2);
		}
		if ($end > $this->max_pages) {
			$end = $this->max_pages;
		}
		$start = $end - $this->links_per_page + 1;
		$links = '';
		
		for($i = $start; $i <= $end; $i ++) {
			if ($i == $this->page) {
				$links .= $prefix . '<a href="">'. $i .'</a>' . $suffix;
			} else {
				$links .= ' ' . $prefix . '<a href="' . $this->php_self . '?page=' . $i . '&' . $this->append . '">' . $i . '</a>' . $suffix . ' ';
			}
		}
		
		return $links;
	}
	
	/**
	 * Display full pagination navigation
	 *
	 * @access public
	 * @return string
	 */
	public function renderFullNav() {
		return '<nav><ul class="pagination">'. $this->renderFirst() . $this->renderPrev() . $this->renderNav()  . $this->renderNext(). $this->renderLast().'</ul></nav>';
	}
	
	/**
	 * Set debug action_type
	 *
	 * @access public
	 * @param bool $debug Set to TRUE to enable debug messages
	 * @return void
	 */
	public function setDebug($debug) {
		$this->debug = $debug;
	}	
/////////////////////////////////////////////////////////////////////	
} 