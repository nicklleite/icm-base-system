<?php namespace App\Controllers;

class Home extends BaseController {

	public function index() {
		echo getenv('app.clickSignServices.documents.upload');
	}

}
