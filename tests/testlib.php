<?php

/* ---

	testlib
	~~~~~~~

	testlib is a simple unit testing library.

--- */


class TestLib
{
	protected $title = ''
	        , $directory = ''
	        , $testcases = array();

	public function __construct($testgroup_title, $testgroup_directory)
	{
		$this->title = $testgroup_title;
		$this->directory = $testgroup_directory;
	}

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

			$tests[$class_name] = new $class_name();
		}

		return $tests;
	}

	public function run_tests()
	{
		$this->testcases = $this->_get_tests();

		foreach ($this->testcases as $name => $testcase)
		{
			$testcase->run();
		}

		return $this;
	}

	public function text_report()
	{
		$passed = 0;
		$failed = 0;
		$output = '';

		$output .= '# '.$this->title." #\n\n-----\n\n";

		foreach ($this->testcases as $name => $testcase)
		{
			$output .= $testcase->name()."\n";

			foreach ($testcase->results() as $method => $result)
			{
				$output .= '  '.$method.': '.($result ? 'passed' : 'failed')."\n";
				($result ? $passed++ : $failed++);
			}

			$result .= "\n";
		}

		$output .= "\n-----\n\nResults:\n  Passed: ".$passed."\n  Failed: ".$failed;

		return $output;
	}
}


class TestLibCase
{
	private $methods = array()
	      , $results = array();

	public function __construct()
	{
		$this->methods = $this->_get_tests();
	}

	private function _get_tests()
	{
		$methods = array();

		foreach (get_class_methods($this) as $method)
		{
			if (preg_match('#^test_#', $method))
				$methods[] = $method;
		}

		return $methods;
	}

	private function _add_result($result)
	{
		$backtrace = debug_backtrace();
		$this->results[$backtrace[2]['function']] = $result;
	}

	public function run()
	{
		foreach ($this->methods as $method)
			$this->$method();

		return $this;
	}

	public function name()
	{
		return get_class($this);
	}

	public function results()
	{
		return $this->results;
	}

	public function equal($var1, $var2)
	{
		$this->_add_result($var1 == $var2);

		return $this;
	}
}



















