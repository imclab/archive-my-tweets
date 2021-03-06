<?php

namespace AMWhalen\ArchiveMyTweets;

class ViewTest extends \PHPUnit_Framework_TestCase {

	protected $templateDirectory;

	public function setUp() {
		$this->templateDirectory = dirname(__FILE__) . '/views';
		require_once dirname(__FILE__) . '/../includes.php';
	}

	public function testRenderReturn() {

		$view = new View($this->templateDirectory);
		$renderedTemplate = $view->render('index.php', array('content'=>'content'), true);
		$this->assertEquals('content', $renderedTemplate);

	}

	public function testRender() {

		$view = new View($this->templateDirectory);

		// capture echoed output
		ob_start();
		$view->render('index.php', array('content'=>'content'), false);
		$renderedTemplate = ob_get_clean();

		$this->assertEquals('content', $renderedTemplate);

	}

	/**
	 * Test bad directory exception
	 */
	public function testDirectoryException() {		

		try {
			$view = new View($this->templateDirectory.'/not_a_real_directory');
		} catch (\Exception $e) {
			return;
		}
		$this->fail('An expected exception has not been raised.');

	}

	/**
	 * Test bad template exception
	 */
	public function testTemplateException() {		

		try {
			$view = new View($this->templateDirectory);
			$view->render($this->templateDirectory.'/not_a_real_template.php');
		} catch (\Exception $e) {
			return;
		}
		$this->fail('An expected exception has not been raised.');

	}

}
