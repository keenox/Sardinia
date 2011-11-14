<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	const ERROR_NOT_CONFIRMED = 3;
	const ERROR_NOT_VERIFIED = 4;
	const ERROR_DISABLED = 5;
	
	private $id;
	private $type;
	private $show;
	private $status;
	private $_model;
	private $_profile;
	
	public function __construct($type,$user,$pass)
	{
		parent::__construct($user,$pass);
		$this->type = $type;	
	}
	
	public function authenticate()
	{
		switch ($this->type)
		{
			case 'user':
				$model = User::model();
				break;
			case 'admin':
				$model = Administrator::model();
				break;
			default:
				throw new UnexpectedValueException('Bad user type passed to UserIdentity!', 0);
				break;
		}
		
		$ok = $model->findByAttributes(array(
												'user'=>$this->username,
												'pass'=>sha1(md5($this->password.'You\'ll never guess')),
											));
		
		if($ok === null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else{
			if ($this->type == 'user')
			{
				if(!$ok->confirmed)	
					$this->errorCode=self::ERROR_NOT_CONFIRMED;
				else if(!$ok->verified)
					$this->errorCode=self::ERROR_NOT_VERIFIED;
					
				if ($this->errorCode != 100)
					return false;
			}
			
			$this->errorCode=self::ERROR_NONE;
			
			$this->_model = $ok;
			$this->id = $ok->id;
			
			$this->setPersistentStates($this->getPersistentStates() + array('type'=>$this->type));
			
			if ($this->type == 'user')
			{
				$this->status = $ok->status;
				
				$this->_profile = UserProfile::model()->findByPk($this->id);
				$this->show = $this->_profile->fname.' '.$this->_profile->lname;
				
				$this->setPersistentStates($this->getPersistentStates() + $this->_model->attributes + $this->_profile->attributes);
			}
			else
			{
				$this->status = 'admin';
				$this->show = $ok->user;
				
				$this->setPersistentStates($this->getPersistentStates() + $this->_model->attributes); //admin doesn't have a profile
			}
		}
			
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->id;
	}
		
	public function getName()
	{
		return $this->show;
	}
	
	/*
	public function __get($name)
	{
		$ret = $this->_model->$name;
		if ($ret)
		{
			return $ret;
		}
		else
		{
			$ret = $this->_profile->$name;
			if (!$ret)
				return parent::$name;
		}
	}*/
}