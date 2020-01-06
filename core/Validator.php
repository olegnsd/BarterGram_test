<?php

namespace dvijok\core;
class Validator {
	
	public $errors = array();
	public $olds = array();
	public $session;
	public $db;
	
	public function __construct($session, $db = false) {
		
		$this->session = $session;
		$this->db = $db;
		
	}

	public function validateLatin($string) {
		$result = false;
	 
		if (preg_match("/^[\w\d\s.,-]*$/", $string)) {
			$result = true;
		}
	 
		return $result;
	}
	
	public function check($data, $rules, $messages, $useFlash = true, $errorsName = 'errors') {
		
		$diff = array_diff_key($rules, $data);
		foreach($diff as &$value)
		{
			$value = '';
		}
		$data = array_merge($data, $diff);
		foreach($data as $key1 => $d)
		{
			
			foreach($rules as $key2 => $r)
			{

				if($key1 == $key2)
				{
					$rule = $rules[$key2];
					$fieldMessages = false;
					foreach($messages as $key3 => $fieldMessages2)
					{
						if($key3 == $key1)
						{
							
							$fieldMessages = $fieldMessages2;
							break;
						}		
					}
					$rulesParts = explode('|', $rule);

					foreach($rulesParts as $rp) {
						
						
						if($rp)
						{
							
							if($rp == 'required')	
							{

								if(is_array($d))
								{
									$d = array_filter($d);
								}
								if($d == '')
								{
										
									foreach($fieldMessages as $key3 => $m)
									{
											 
										if($key3 == $rp)
										{
											$this->errors[$key2][] = $m;
											break;
										}
											  
									}
									break;		
								}
									
							}

                            if($rp == 'latin')
                            {
                                if(!$this->validateLatin($d))
                                {
									foreach($fieldMessages as $key3 => $m)
									{
										if($key3 == $rp)
										{
											$this->errors[$key2][] = $m;
											break;
										}	  
									}
                                }
                            }
							
							if($rp == 'phoneformat')
							{
								$res = preg_match('/\+\d+\(?\d+\)?\-?\d{2,2}\-?\d{2,2}\-?\d{2,2}/', $d);
								if(!$res)
								{
									foreach($fieldMessages as $key3 => $m)
									{ 
										if($key3 == $rp)
										{
											$this->errors[$key2][] = $m;
											break;
										}	  
									}
									
									
								}
								
							}
							
							if($rp == 'strongpass')
							{
								$passed = true;
								// Check for uppercase
								if ( ! preg_match( '/[A-Z]/', $d ) ) {
									$passed = false;
									//pmpro_setMessage( 'Your password must contain at least 1 uppercase letter.', 'pmpro_error' );
									//return false;
								}
								
								// Check for numbers
								if ( ! preg_match( '/[0-9]/', $d ) ) {
									$passed = false;
									//pmpro_setMessage( 'Your password must contain at least 1 number.', 'pmpro_error' );
									//return false;
								}
								// Check for special characters
								if ( ! preg_match( '/[\W]/', $d ) ) {
									$passed = false;
									//pmpro_setMessage( 'Your password must contain at least 1 special character.', 'pmpro_error' );
									//return false;
								}
								
                                if(!$passed)
                                {
									foreach($fieldMessages as $key3 => $m)
									{
										if($key3 == $rp)
										{
											$this->errors[$key2][] = $m;
											break;
										}	  
									}
                                }
								
							}
							
							if($rp == 'integer')
							{
								
								if(filter_var($d, FILTER_VALIDATE_INT) === false)
								{
									
										foreach($fieldMessages as $key3 => $m)
										{
											
											
											if($key3 == $rp)
											{
												
												$this->errors[$key2][] = $m;
												
												break;
											}
												  
										}
									
									
								}
							}
							
							if($rp == 'number')
							{
								
								if(!is_numeric($d))
								{
									
										foreach($fieldMessages as $key3 => $m)
										{
											
											
											if($key3 == $rp)
											{
												
												$this->errors[$key2][] = $m;
												
												break;
											}
												  
										}
									
									
								}
							}
							
							if(strpos($rp, 'maxlength') === 0)
							{
								$p = explode(':', $rp);
								
								if(isset($p[1]))
								{
									$p[1] = trim($p[1]);
									if($d && strlen($d) > $p[1])
									{
										foreach($fieldMessages as $key3 => $m)
										{
											if($key3 == $p[0])
											{
												$this->errors[$key2][] = $m;
												break;
											}
													  
										}
									}
								}
							}
							if(strpos($rp, 'minlength') === 0)
							{
								$p = explode(':', $rp);
								
								if(isset($p[1]))
								{
									$p[1] = trim($p[1]);
									if($d && strlen($d) < $p[1])
									{
										
										foreach($fieldMessages as $key3 => $m)
										{
											if($key3 == $p[0])
											{
													
												$this->errors[$key2][] = $m;
													
												break;
											}
													  
										}
										
										
									}
								}
							}
				
							if(strpos($rp, 'unique') === 0)
							{
								$p = explode(':', $rp);
								if(isset($p[1]))
								{
									$pp = explode(',', $p[1]);
									
									$pp[0] = trim($pp[0]);
									$pp[1] = trim($pp[1]);
									
									$temp = array();
									$temp[] = $d;
									if(isset($pp[2]))
									{
										$pp[2] = trim($pp[2]);
										$temp[] = $data[$pp[2]];
									}
									else
									{
										$temp[] = $data[$pp[1]];
									}
									
									$res = $this->db->query("SELECT * FROM `".$pp[0]."` WHERE `".$pp[1]."` = ? AND `id` != ?", $temp);
									
									if($res->result->num_rows)
									{
										foreach($fieldMessages as $key3 => $m)
										{
											if($key3 == $p[0])
											{
												$this->errors[$key2][] = $m;
												break;
											}  
										}
									}
								}
								
							}
							if(strpos($rp, 'in_values') === 0)
							{
								$p = explode(':', $rp);
								if(isset($p[1]))
								{
									$pp = explode(',', $p[1]);
									
									
									if(!in_array($d, $pp))
									{
										foreach($fieldMessages as $key3 => $m)
										{
											if($key3 == $p[0])
											{
												$this->errors[$key2][] = $m;
												break;
											}  
										}
									}
								}
								
							}
							if(strpos($rp, 'verify') === 0)
							{
								$p = explode(':', $rp);
								if(isset($p[1]))
								{
									$pp = explode(',', $p[1]);
									$pp[0] = trim($pp[0]);
									$pp[1] = trim($pp[1]);
									$pp[2] = trim($pp[2]);
									$temp = array();
									
									$temp[] = $data[$pp[2]];
									$res = $this->db->query("SELECT * FROM `".$pp[0]."` WHERE `".$pp[2]."` = ?", $temp);
									
									$row = $res->fetch();
									//echo $d.'<br />';
									//echo $row['password'].'<br />';
									//echo password_verify($d, $row['password']);
									//exit;
									if(!password_verify($d, $row['password']))
									{
										foreach($fieldMessages as $key3 => $m)
										{
											if($key3 == $p[0])
											{
												$this->errors[$key2][] = $m;
												break;
											}  
										}
									}
								}
								
							}
							
							if(strpos($rp, 'exists') !== false)
							{
								$p = explode(':', $rp);
								if(isset($p[1]))
								{
									$pp = explode(',', $p[1]);
									$pp[0] = trim($pp[0]);
									$pp[1] = trim($pp[1]);
									$temp = array();
									$temp[] = $d;
									$res = $this->db->query("SELECT * FROM `".$pp[0]."` WHERE `".$pp[1]."` = ?", $temp);
									if(!$res->result->num_rows)
									{
										foreach($fieldMessages as $key3 => $m)
										{
											if($key3 == $p[0])
											{
												$this->errors[$key2][] = $m;
												break;
											}	  
										}
									}
								}
								
							}
							
							if(strpos($rp, 'equals') !== false)
							{
								
								$p = explode(':', $rp);
								
								if(isset($p[1]))
								{
									
									if($p[1] != $d)
									{
										
										foreach($fieldMessages as $key3 => $m)
										{
											
											
											if($key3 == $p[0])
											{
												
												$this->errors[$key2][] = $m;
												
												break;
											}
												  
										}
										
									}
									
								}
								
							}
							
							if(strpos($rp, 'match') !== false)
							{
								
								$p = explode(':', $rp);
								
								if(isset($p[1]))
								{
									
									if($data[$p[1]] != $d)
									{
										
										foreach($fieldMessages as $key3 => $m)
										{
											
											
											if($key3 == $p[0])
											{
												
												$this->errors[$key2][] = $m;
												
												break;
											}
												  
										}
										
									}
									
								}
								
							}
									
							if($rp == 'email')
							{	
						
								if (!filter_var($d, FILTER_VALIDATE_EMAIL)) {
											
											
									foreach($fieldMessages as $key3 => $m)
								    {
										
											 
										if($key3 == $rp)
										{
											
											$this->errors[$key2][] = $m;
											
											break;
										}
											  
									}
								}
							}
						}
					}
				}
			}
		}
		
		if($useFlash)
		{
			
			$this->session->setFlash($errorsName, $this->errors);
		}
		if(count($this->errors) > 0)
		{
			$this->session->setFlash('olds', $data);
			return false;
		}
		return true;

			
		
	}
}