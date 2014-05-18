<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Fabien Udriot <fabien.udriot@typo3.org>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Vanilla\Messenger\Validator\EmailValidator.
 */
class EmailValidatorTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var \Vanilla\Messenger\Validator\EmailValidator
	 */
	private $fixture;

	public function setUp() {
		$this->fixture = new \Vanilla\Messenger\Validator\EmailValidator();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function validate() {

	}

	/**
	 * @test
	 * @dataProvider validEmailsProvider
	 */
	public function emailsAreCorrectlyValidated($emails) {
		$this->assertTrue($this->fixture->validate($emails));
	}

	/**
	 * @test
	 * @dataProvider invalidEmailsProvider
	 * @expectedException \Vanilla\Messenger\Exception\InvalidEmailFormatException
	 */
	public function wrongEmailsRaiseException($emails) {
		$this->fixture->validate($emails);
	}

	/**
	 * Valid emails provider
	 *
	 * @return array
	 */
	public function validEmailsProvider() {
		return array(
			array(array('john@doe.ch' => 'John Doe')),
			array(array('john@doe.bar.ch' => 'John Bar')),
		);
	}

	/**
	 * In-valid emails provider
	 *
	 * @return array
	 */
	public function invalidEmailsProvider() {
		return array(
			array(array('john@' => 'John Doe')),
			array(array('john@doe.ch' => '')),
			array(array('' => 'John Doe')),
			array(array('' => '')),
		);
	}
}
?>