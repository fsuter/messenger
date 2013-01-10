<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Fabien Udriot <fudriot@cobweb.ch>, Cobweb
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package messenger
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Messenger_Validator_Email {

	/**
	 * Validate emails to be used in the Swiftmailer framework
	 *
	 * @throws Tx_Messenger_Exception_InvalidEmailFormatException
	 * @param $emails
	 * @return boolean
	 */
	public function validate($emails) {
		foreach ($emails as $email => $name) {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$message = sprintf('Email provided is not valid, given value "%s"', $email);
				throw new Tx_Messenger_Exception_InvalidEmailFormatException($message, 1350297165);
			}
			if (strlen($name) <= 0) {
				$message = sprintf('Name should not be empty, given value "%s"', $name);
				throw new Tx_Messenger_Exception_InvalidEmailFormatException($message, 1350297170);
			}
		}
		return TRUE;
	}
}
?>