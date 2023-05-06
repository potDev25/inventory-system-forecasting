<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Notifications\VerifyEmail;

class AuthController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();
        $last_id = $user->id;

        $token = $last_id.hash('sha256', \Str::random(120));
        $verifyUrl = route('verify', ['token'=>$token, 'service'=>'Email_verification']);

        VerifyUser::create([
            'user_id' => $last_id,
            'token' => $token
        ]);

        $message = 'Dear <b>'.$request->email.'<b>';
        $message = 'Thanks for signing up, please verify to complete your set up.';

        $email_data = [
            'recipient' => $request->email,
            'fromEmail' => $request->email,
            'fromName' => 'Inventory System',
            'subject' => 'Email Verification',
            'body' => $message,
            'actionLink' => $verifyUrl,
        ];

        Mail::send('mailer.userEmail', $email_data, function($message) use ($email_data){
            $message->to($email_data['recipient'])
                    ->from($email_data['fromEmail'], $email_data['fromName'])
                    ->subject($email_data['subject']);
        });

        if($save){
            return redirect()->back()->with('alert-success', 'Please verify your email, we have sent the confirmation link');
        }
        return redirect()->back()->with('alert-danger', 'Something wrong! please try again later');
    }

    public function verify(Request $request){
        $token = $request->token;
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(!is_null($verifyUser)){
            $user = $verifyUser->user;

            if(!$user->email_verified){
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();

                return redirect('/')->with('alert-success', 'Your are now verified, please login using your email and password')->with('verifiedEmail', $user->email);
            }
            return redirect('/')->with('alert-info', 'Your email is already verify.')->with('verifiedEmail', $user->email);
        }
    }

    public function check(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user->allow){
            return redirect()->back()->with('alert-danger', 'Sorry we cannot let you log in! Please try again later');
        }else{
            $cred = $request->only('email', 'password');
            if(Auth::attempt($cred)){
                $user->active = 1;
                $user->save();
                return redirect('/home');
            }
            return redirect()->back()->with('alert-danger', 'Invalid credentials');
        }

        
    }

    public function logout(User $user){
        $out = $user::where('id', Auth::user()->id)->first();
        $out->active = 0;
        $out->save();
        Auth::logout();
        return redirect('/');
    }
}
