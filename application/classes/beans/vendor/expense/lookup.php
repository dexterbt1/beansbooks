<?php defined('SYSPATH') or die('No direct script access.');
/*
BeansBooks
Copyright (C) System76, Inc.

This file is part of BeansBooks.

BeansBooks is free software; you can redistribute it and/or modify
it under the terms of the BeansBooks Public License.

BeansBooks is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
See the BeansBooks Public License for more details.

You should have received a copy of the BeansBooks Public License
along with BeansBooks; if not, email info@beansbooks.com.
*/

/*
---BEANSAPISPEC---
@action Beans_Vendor_Expense_Lookup
@description Look up a vendor expense.
@required auth_uid
@required auth_key
@required auth_expiration
@required id INTEGER The ID of the #Beans_Vendor_Expense# to retrieve.
@returns expense OBJECT The #Beans_Vendor_Expense# that was requested.
---BEANSENDSPEC---
*/
class Beans_Vendor_Expense_Lookup extends Beans_Vendor_Expense {

	protected $_id;
	protected $_expense;

	public function __construct($data = NULL)
	{
		parent::__construct($data);
		
		$this->_id = ( isset($data->id) ) 
				   ? $data->id
				   : 0;

		$this->_expense = $this->_load_vendor_expense($this->_id);
	}

	protected function _execute()
	{
		if( ! $this->_expense->loaded() )
			throw new Exception("Expense could not be found.");

		return (object)array(
			"expense" => $this->_return_vendor_expense_element($this->_expense),
		);
	}
}