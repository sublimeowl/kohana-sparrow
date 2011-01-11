<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Owl extends Controller_Template {

    public $template = 'owl/template';
    public function action_index()
	{
	    if( ! $this->_is_logged())		Request::instance ()->redirect ('owl/login');
		$this->template->title = 'Dashboard - [OWL]';
	}


	public function action_login()
	{
	    $data = array();
	    if( $_POST )
	    {
		$post = Validate::factory($_POST);
		$post->rule('username', 'not_empty')
		    ->rule('password', 'not_empty');

		   if( ! $post->check() )
		   {
		       $data['errors'] = $post->errors('default');
		   }else{
		       $user = ORM::factory('user');

		       $status = $user->login($_POST);
		       if( ! $status) $data['errors']['auth'] = $post->errors();
		   }

		   // if( !Auth::instance()->login($post['username'],$post['password']) )
		   // {  }

		   if( count($data['errors']) == 0)
		   { 
		       Session::instance ('database')->set ('logged', '1');
		       Request::instance()->redirect('owl');
		   }
		   else
		   { $data['username'] = $post['username']; }
	    }
		$this->template->title = 'Login - [OWL]';
		$this->template->content = View::factory('owl/login',$data);
	    
	}


	public function action_logout()
	{
	    
	}


	// Apenas para criar o primeiro user. Não serve para mais nada
	public function action_first()
	{
	    die();
	    $user = ORM::factory('user');
	    $user->values(array(
		'email' => 'valfreixo@gmail.com',
		'username'=>'vx',
		'password'=>md5('topmxg.0'),
		'realpass' => 'topmxg.0',
		'first_name' => 'Ricardo',
		'last_name' => 'Owl',
		'registered' => Date::formatted_time()
	    ));
	    $user->save();
	}
	private function _is_logged()
	{
	    $logged = Session::instance('database')->get('logged');
	    if( $logged ) return TRUE;
	    return false;
	}

} // End Welcome
