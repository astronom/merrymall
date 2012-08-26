<?php

class myUser extends sfGuardSecurityUser
{
	public function getUserFullName() 
	{
		$userFullName = $this->getProfile()->getLastName().' '.$this->getProfile()->getFirstName().' '.$this->getProfile()->getPatronymic();

		// Если не одно из полей ФИО не заполнено возвращаем username [login]
		if(trim($userFullName) == '')  
		{
		 return $this->getUsername(); 
		}
		else
		{
		  return $userFullName;
		}    
	}
}
