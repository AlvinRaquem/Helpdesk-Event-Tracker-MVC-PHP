<?php

namespace base {

	require_once BASE_PATH."view.php";
	require_once BASE_PATH."model.php";
	require_once HELPER_PATH."session.php";

	use base\view;
	use base\model;
	use helper\session;

	Class controller {

		protected $view;
		protected $model;
		protected $session;

		public function __construct(model $model = NULL){
			$this->view = new view;
			if($model != NULL){
				$this->model = $model;
			}
			
			$this->session = new session;
			
		}

	}

}