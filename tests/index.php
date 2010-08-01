<?php header('Content-Type: text/html; charset=utf-8')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>PHP-UTF8 Tests</title>
	<style type="text/css">
		html, body { background-color: #fff;padding: 0;margin: 0 }
		body { font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Verdana, Arial, sans-serif }
		#wrapper { margin: 0 auto;width: 90% }
		ul { margin: 1.5em 0;list-style: none;overflow: auto }
		ul li { line-height: 1.4em }
		a:link, a:visited { color: #4A7DA9;text-decoration: none }
		a:hover, a:active { text-decoration: underline }
		a.run-test { float: left;clear: both;width: 300px }
		a.choose-engine { float: left;width: auto;margin-right: 0.5em }
	</style>
</head>
<body>

	<ul>
		<li>
			<a class="run-test" href="runtests.php">RUN ALL TESTS</a>
			<a class="choose-engine" href="runtests.php?engine=mbstring">[mbstring]</a>
			<a class="choose-engine" href="runtests.php?engine=native">[native]</a>
		</li>
	</ul>

	<ul>
		<?php
		foreach( glob(dirname(__FILE__).'/cases/*.test.php') as $filename )
		{
			$filename = htmlspecialchars(end(explode('/', $filename)));
		?>
			<li>
				<a class="run-test" href="./cases/<?php echo $filename?>"><?php echo $filename?></a>
				<a class="choose-engine" href="./cases/<?php echo $filename?>?engine=mbstring">[mbstring]</a>
				<a class="choose-engine" href="./cases/<?php echo $filename?>?engine=native">[native]</a>
			</li>
		<?php
		}
		?>
	</ul>

</body>
</html>
