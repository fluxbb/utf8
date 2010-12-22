<?php header('Content-Type: text/html; charset=utf-8')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>php-utf8 Unit Tests</title>
	<style type="text/css">
body {
  margin-top: 1.0em;
  background-color: #ffffff;
  font-family: 'Sorts Mill Goudy', Georgia, 'DejaVu Serif', 'Bitstream Vera Serif', serif;
  color: #000000 }
#container {
  margin: 0 auto;
  width: 700px }
h1 {
  font-size: 3.8em;
  color: #000000;
  margin: 0.5em 0 }
h2 {
  font-size: 1.7em;
  margin: 0.75em 0;
  line-height: 1.2em }
a:link, a:visited { color: #000;text-decoration: underline  }
a:hover, a:active { color: #c00  }
p, ul, ol, pre { margin: 1.5em 0 }
pre {
  background: #000;
  font-size: 0.8em;
  color: #fff;
  padding: 0.8em }
pre, code {
  font-family: 'DejaVu Sans Mono', Consolas, Inconsolata, 'Lucida Console', monospace }
pre {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px }
	</style>
</head>
<body>

<div id="container">
	<h1>php-utf8 Unit Tests</h1>

	<p>Choose an option:</p>

	<ul>
		<li><a href="index.php?run">Run unit tests: Automatic</a></li>
		<li><a href="index.php?run&engine=mbstring">Run unit tests: Mbtring</a></li>
		<li><a href="index.php?run&engine=native">Run unit tests: Native</a></li>
	</ul>


<?php

if (isset($_GET['run']))
{
	echo '<h2>Report</h2>'."\n\n".'<pre><code>';
	require './runtests.php';
	echo '</code></pre>';
}

?>
</div>

</body>
</html>
