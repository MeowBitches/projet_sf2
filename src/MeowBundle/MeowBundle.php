<?php

namespace MeowBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MeowBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}