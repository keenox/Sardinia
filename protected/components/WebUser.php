<?php

class WebUser extends CWebUser {
	/*
	public function login($identity,$duration)
	{
		//$this->setState('_role',$identity->getRole());
		parent::login($identity,$duration);
	}
	*/

	
// Store model to not repeat query.
  private $_model;
  
  
  
  // Load user model.
  public function loadUser($id=null)
    {	
    	$id = Yii::app()->user->id;
        if($this->_model===null)
        {
            if($id===null)
            	$id = -1;
            
            $user = User::model()->findByPk($id);
            $profile = UserProfile::model()->findByPk($id);
            
            $this->_model=$user->attributes
            			+ $profile->attributes + array('JustLoaded'=>true);
        }
        else
        	$this->_model+=array('JustLoaded'=>false);
        	
        return $this->_model;
    }
}

?>