<?php

namespace Project;


class ConsoleSecondCommand implements ConsoleCommand
{

	public $foo;



	public function setFoo(Foo $foo)
	{
		$this->foo = $foo;
	}

}
