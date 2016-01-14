<?php

namespace Project;


class ConsoleFirstCommand implements ConsoleCommand
{

	public $foo;



	public function setFoo(Foo $foo)
	{
		$this->foo = $foo;
	}

}
