<?php

namespace myapp;

class MyController extends \harpya\ufw\Controller  {

	public function welcome() {
            \harpya\ufw\Application::getInstance()
                    ->getView()
                    ->display('welcome.tpl');
	}

}
