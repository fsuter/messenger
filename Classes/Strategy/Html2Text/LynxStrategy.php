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
 * @package messenger
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @see http://www.chuggnutt.com/html2text
 *
 */

class Tx_Messenger_Strategy_Html2Text_LynxStrategy implements Tx_Messenger_Strategy_Html2Text_StrategyInterface {

	/**
	 * @var string
	 */
	protected $lynx = '';

	/**
	 * Constructor
	 *
	 * @return Tx_Messenger_Strategy_Html2Text_LynxStrategy
	 */
	public function __construct() {
		$this->lynx = $this->getLynx();
	}

	/**
	 * Convert a given HTML input to Text
	 *
	 * @param string $input
	 * @return string
	 */
	public function convert($input) {

		$output = '';

		// Only if lynx path exists
		if ($this->lynx) {
			$command = sprintf('echo "%s" | %s --dump -stdin | %s',
				$input,
				$this->lynx,
				"sed -e 's/^   //g'"
			);
			exec($command, $result);
			$output = implode("\n", $result);
		}

		return trim($output);
	}

	/**
	 * Try to guess the lynx binary path
	 *
	 * @return string
	 */
	public function getLynx() {

		if (! empty($this->lynx)) {
			return $this->lynx;
		}

		$lynxPath = '';
		$command = 'which lynx';
		exec($command, $result);
		if (!empty($result)) {
			$lynxPath = $result[0];
		}
		return $lynxPath;
	}

	/**
	 * Set the lynx path
	 *
	 * @param string $lynx
	 */
	public function setLynx($lynx) {
		$this->lynx = $lynx;
	}

	/**
	 * Whether the converter is available
	 *
	 * @return boolean
	 */
	public function available() {
		return !empty($this->lynx);
	}
}

?>