<?php


namespace actions {

	Class getUser {

		protected $user;
		protected $bank;

		public function __construct(user $user,bank $bank){
			$this->user = $user;
			$this->bank = $bank;
		}

		public function execute(): Array{
			$this->user->getAllUser();
			$this->bank->getbanks();

			return $this->user->getAllUser();
		}


	}
}