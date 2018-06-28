<?php

namespace App\Http\Controllers;

use App\Events\TweetSentEvent;
use App\Tweet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class TweetController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
        return view('chat');
    }
	
    public function showTweets(){   
       // $encrypted= Tweet::with('user')->get();
       // $desencrypted=base64_decode($hallo);
        return Tweet::with('user')->get();
    }

    public function sentTweet(Request $request){
        $user = Auth::user();
        
       // $string = $request->input('tweet');
       // $encrypted = base64_encode($string);
     
        $tweet = $user->tweets()->create([
        'tweet' => $request->input('tweet')
        ]);
		broadcast(new TweetSentEvent($user, $tweet))->toOthers();
		
		return ['status' => 'Tweet Sent!'];
     
    }

    public function myProfile ($name){
        $ruta = "public/".$name;
        $files = Storage::files("/public/".$name);   
        $imgUser = explode("/",$files[0]);
        
        return view('profile', ["data" => $imgUser[2]]);  
    }

    public function editUser(Request $request){
        $userId= $request->input('idHidden');

        $user= User::find($userId);

    
        if ($request->hasFile('image')){  
            Storage::deleteDirectory("public/".$user->name);
            $user->name= $request->input('user-name');
            $user->email= $request->input('user-email');
            $user->save();

            $originalName= $request->image->getClientOriginalName();
            $split= explode('.', $originalName);
            $extension= $split[1];

            $imageName= $request->input('user-name').".".$extension;
            $request->image->storeAs('public/'.$request->input('user-name'),$imageName);
        }else{
            if (Storage::files("/public/".$user->name)) {
                $files = Storage::files("/public/".$user->name);   
                $imgUser = explode("/",$files[0]); 
                $split= explode('.', $imgUser[2]);

                $oldFileName= $user->name.'/'.$user->name.'.'.$split[1];

                $newFileName= $request->input('user-name'). '/' .$request->input('user-name').'.'.$split[1];
                if ( $request->input('user-name')!=$user->name){
                    Storage::move($files[0],'public/'.$newFileName);
                    Storage::deleteDirectory("public/".$user->name);
                }
                    
                $user->name= $request->input('user-name');
                $user->email= $request->input('user-email');
                $user->save();

            }else{
                $user->name= $request->input('user-name');
                $user->email= $request->input('user-email');
                $user->save();
            }
            

        }
		return redirect(url('/profile/'.$user->name));
    }
}
