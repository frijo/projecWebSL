<?php
//include("php_sample_rabbitmq/send.php");
class UploadController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function SaveSong()
	{

		
			$file = Input::file('audio');
			$destination = public_path().'/UploadsSongs/';
			$filename =Input::file('audio')->getClientOriginalName();
			$extension=Input::file('audio')->getClientOriginalExtension(); 			
			$extToConv=Input::get('extTo');
			$ServerDestination='/var/www/project1/public/UploadsSongs/'.$filename;
			//$carpeta='/var/www/project1/public/UploadsSongs/';
			//opendir($carpeta);
			//$destino=$carpeta.$_FILES['audio']['tmp_name'];
			//$ext = Input::get('ext');
		if($extension=='mp3'|| $extension=='WAV')
		{
			try{
				//copy($_FILES['audio']['tmp_name'],$destino);
				move_uploaded_file($filename,$destination);// NO da error pero no mueve el audio a la carpeta
				//$file ->move(public_path().'/UploadsSongs/',$filename.".".$extension);

					/*Songs::Create(array(
						'name'=>$filename,
						'from'=>$ServerDestination,
						'to'=>$extToConv

						));*/
						$song = new Songs;
			    		$song->name = $filename;
						$song->from = $ServerDestination;
						$song->to = $extToConv;
						$song->save();




				//$file ->move($destination,$filename);
				//File::move(public_path().'/UploadsSongs/',$filename);
				//Input::file('audio')->move(public_path().'/UploadsSongs', Input::file('audio')->getClientOriginalName());
				//$file = Input::file('audio')->move($destination, $filename);
 				//$file->move(public_path().'/UploadsSongs/',$filename.".".$extension);
 				//Input::file('audio')->move($destination);
				Session::flash('message', 'Nice!'." ".$filename ." " ."was upload");
				return Redirect::to('/');
			}
			catch(Exception $e) {

				Session::flash('message', 'Error.Your Song Dont was move');
				return Redirect::to('/'); 
    		}
		}
		else
		{
			Session::flash('message', 'Error.The format file not is supported ');
				return Redirect::to('/'); 

		}
	}
}