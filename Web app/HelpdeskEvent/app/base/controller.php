<?php

namespace base {

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