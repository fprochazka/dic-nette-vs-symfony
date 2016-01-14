<?php

namespace Project;



class HomepagePresenter implements IPresenter
{

	/**
	 * @inject
	 * @var NewsletterManager
	 */
	public $newsletterManager;

	/**
	 * @var Foo
	 */
	public $foo;



	public function injectFoo(Foo $foo)
	{
		$this->foo = $foo;
	}

}
