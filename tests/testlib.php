<?php

/* ---

	testlib
	~~~~~~~

	testlib is a simple unit testing library.

	Copyright (c) 2010, Frank Smit
	All rights reserved.

	Redistribution and use in source and binary forms, with or without
	modification, are permitted provided that the following conditions are met:
		* Redistributions of source code must retain the above copyright
		  notice, this list of conditions and the following disclaimer.
		* Redistributions in binary form must reproduce the above copyright
		  notice, this list of conditions and the following disclaimer in the
		  documentation and/or other materials provided with the distribution.
		* Neither the name of the <organization> nor the
		  names of its contributors may be used to endorse or promote products
		  derived from this software without specific prior written permission.

	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
	ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
	WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
	DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
	DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
	(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
	LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
	ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
	(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
	SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

--- */


/**
 * A class that looks in a directory for test cases, runs all of them and then
 * prints a text-based report.
 */
class TestLib
{
	protected $title = ''
	        , $directory = ''
	        , $testcases = array();

	/**
	 * Set test group title and directory.
	 *
	 * @access  public
	 * @param   string  $testgroup_title      The title of the test group.
	 * @param   string  $testgroup_directory  The directory where all the test
	 *          cases are located.
	 */
	public function __construct($testgroup_title, $testgroup_directory)
	{
		$this->title = $testgroup_title;
		$this->directory = $testgroup_directory;
	}

	/**
	 * Search the directory for test cases. Once a test case has been found
	 * a instance will be made and stored in an array. All files ending with
	 * Test.php will be loaded. The class inside a file must have the same
	 * name as the file itself (without the extension).
	 *
	 * @access  protected
	 * @return  array  An array with instances of all the test cases.
	 */
	protected function _get_tests()
	{
		$tests = array();
		$d = new DirectoryIterator($this->directory);

		foreach($d as $f)
		{
			if (!$f->isFile() || !preg_match('#Test\.php$#', $f->getBasename()))
				continue;

			require realpath($this->directory.'/'.$f->getFilename());
			$class_name = $f->getBasename('.php');

			$tests[] = new $class_name();
		}

		return $tests;
	}

	/**
	 * Run all the test cases.
	 *
	 * @access  public
	 * @return  object  An instance of the TestLib class for method chaining.
	 */
	public function run_tests()
	{
		$this->testcases = $this->_get_tests();

		foreach ($this->testcases as $testcase)
			$testcase->run();

		return $this;
	}

	/**
	 * Generate a text-based report from the results of the test cases.
	 *
	 * @access  public
	 * @return  string  The generated test report.
	 */
	public function text_report()
	{
		$passed = 0;
		$failed = 0;
		$output = '';

		$output .= '# '.$this->title." #\n\n-----\n";

		foreach ($this->testcases as $testcase)
		{
			$output .= "\n".$testcase->name()."\n";

			foreach ($testcase->results() as $method => $result)
			{
				$output .= '  '.$method.': '.($result ? 'passed' : '*failed*')."\n";
				($result ? $passed++ : $failed++);
			}

			$result .= "\n";
		}

		$output .= "\n-----\n\nResults:\n  Passed: ".$passed."\n  Failed: ".$failed;

		return $output;
	}
}


/**
 * An abstract base class for a test case. This class holds all the methods
 * for testing and storing the results.
 *
 * @abstract
 */
abstract class TestLibTestCase
{
	private $methods = array()
	      , $results = array();

	/**
	 * Load all test methods in the current class ans store them.
	 *
	 * @access  public
	 */
	public function __construct()
	{
		$this->methods = $this->_get_test_methods();
	}

	/**
	 * Look for test methods in the current class. All methods starting with
	 * test_ are stored in an array an are returned.
	 *
	 * @access  private
	 * @return  array  All the names of the test methods.
	 */
	private function _get_test_methods()
	{
		$methods = array();

		foreach (get_class_methods($this) as $method)
		{
			if (preg_match('#^test_#', $method))
				$methods[] = $method;
		}

		return $methods;
	}

	/**
	 * Store the result of a test with the name of the test method in an array.
	 * This function is called methods such as TestLibCase::equal().
	 *
	 * @access  private
	 * @param   boolean  $result  The result of a test.
	 */
	private function _store_result($result)
	{
		$backtrace = debug_backtrace();
		$this->results[$backtrace[2]['function']] = $result;
	}

	/**
	 * Run all the tests in the current test case.
	 *
	 * @access  public
	 */
	public function run()
	{
		foreach ($this->methods as $method)
			$this->$method();
	}

	/**
	 * Return the name of the current test case.
	 *
	 * @access  public
	 */
	public function name()
	{
		return get_class($this);
	}

	/**
	 * Return the results of the test case.
	 *
	 * @access  public
	 * @return  array  An array with all the test results. The method name is
	 *                 is used at the key and the test result is the value.
	 */
	public function results()
	{
		return $this->results;
	}

	/**
	 * Test if two values are equal. This function should be used inside a
	 * test case.
	 *
	 * @access  public
	 * @param   mixed  $var1  The first value.
	 * @param   mixed  $var2  The second value.
	 */
	public function is_equal($var1, $var2)
	{
		$this->_store_result($var1 == $var2);
	}

	/**
	 * Test if a value is true. This function should be used inside a test case.
	 *
	 * @access  public
	 * @param   mixed  $var1  The first value.
	 */
	public function is_true($var1)
	{
		$this->_store_result($var1 === true);
	}

	/**
	 * Test if a value is false. This function should be used inside a test case.
	 *
	 * @access  public
	 * @param   mixed  $var1  The first value.
	 */
	public function is_false($var1)
	{
		$this->_store_result($var1 === false);
	}

	/**
	 * Test if a value is null. This function should be used inside a test case.
	 *
	 * @access  public
	 * @param   mixed  $var1  The first value.
	 */
	public function is_null($var1)
	{
		$this->_store_result(is_null($var1));
	}
}
