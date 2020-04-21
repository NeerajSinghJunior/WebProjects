<?php
namespace App\Http\Controllers\API;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Notification;
use App\ProgressBar;
use App\Transaction;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
/**
 * login api
 *
 * @return \Illuminate\Http\Response
 */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => true, 'message' => 'success', 'token' => $token, 'user' => $user], $this->successStatus);
        } else {
            return response()->json(['message' => 'error', 'success' => false], 401);
        }
    }
/**
 * Register api
 *
 * @return \Illuminate\Http\Response
 */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'phone' => 'required',
                'c_password' => 'required|same:password',
            ]);
            if ($validator->fails()) {
                $errors = [];
                foreach ($validator->errors()->getMessages() as $fieldName => $msgArr) {
                    $errors[$fieldName] = $msgArr[0];
                }

                return response()->json(['error' => $errors, 'message' => 'error', 'success' => false], 401);
            }
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
            return response()->json(['success' => true, 'message' => 'success', 'user' => $success], $this->successStatus);

        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
/**
 * details api
 *
 * @return \Illuminate\Http\Response
 */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => true, 'message' => 'success', 'user' => $user], $this->successStatus);
    }
    public function settings()
    {
        $settings = Admin::select(['email', 'ether', 'bitcoin', 'site_title', 'site_logo', 'fav_ico', 'captcha_key', 'account_name', 'account_number', 'account_ifsc', 'selling_coin_name', 'coin_value', 'date_to_be_launched', 'white_paper', 'total_supply', 'google2fa_secret', 'google2fa_on'])->first();
        return response()->json(['success' => true, 'message' => 'success', 'settings' => $settings], $this->successStatus);
    }
    public function notifications()
    {
        $notifications = Notification::orderBy('id', 'desc')->get();
        return response()->json(['success' => true, 'message' => 'success', 'notifications' => $notifications], $this->successStatus);
    }
    public function updatePassword()
    {
        $validator = Validator::make(
            request()->all(), [
                'password' => 'required|confirmed',
                'password_old' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors(), 'message' => 'password not updated'], $this->successStatus);
        }
        $User = Auth::user();
        if (Hash::check(request()->password_old, request()->user()->password)) {
            $User->password = bcrypt(request()->password);
            $User->save();
            return response()->json(['success' => true, 'message' => 'password updated'], $this->successStatus);
        } else {
            return response()->json(['success' => false, 'message' => 'old password is wrong'], $this->successStatus);
        }

    }
    public function updateAccount()
    {
        $user = Auth::user();
        $validator = Validator::make(
            request()->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
                'password' => 'nullable|string|min:6|confirmed',
                'password_old' => 'nullable|string|min:6',
                'profile_picture' => 'nullable|image',
            ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors(), 'message' => 'account not updated'], $this->successStatus);
        }
        $input = request()->all();
        if (request()->profile_picture) {
            $input['profile_picture'] = request()->profile_picture->store('profile_pictures');
        }
        if (empty($input['password'])) {
            unset($input['password']);
        } else {
            if (Hash::check(request()->password_old, request()->user()->password)) {
                $input['password'] = bcrypt($input->password);
            }
        }
        $user->update($input);
        return response()->json(['success' => true, 'user' => $input, 'message' => 'account updated'], $this->successStatus);
    }
    public function getTransactions()
    {
        $transactions = Transaction::where('user_id', request()->user()->id)->get();
        $amount = Transaction::where('status', 'COMPLETED')->where('user_id', Auth::user()->id)->sum('coins');
        return response()->json(['success' => true, 'amount' => $amount, 'transactions' => $transactions, 'message' => 'transaction fetched'], $this->successStatus);
    }
    public function updateKYCDetails(Request $request)
    {
        try {

            $auth = Auth::user();
            if ($request->address_proof) {
                $auth->address_proof = $request->address_proof->store('kyc');
            }
            if ($request->id_proof) {
                $auth->id_proof = $request->id_proof->store('kyc');
            }
            if ($request->photo_proof) {
                $auth->photo_proof = $request->photo_proof->store('kyc');
            }
            // dd('hi');
            if (
                !$request->address_proof && !$request->id_proof && !$request->photo_proof &&
                !$auth->address_proof && !$auth->id_proof && !$auth->photo_proof
            ) {
                // dd('hiddd');
                return response()->json(['success' => false, 'message' => 'Please upload atleast one document, to start your verification process.'], $this->successStatus);
            }
            $auth->save();
            return response()->json(['success' => true, 'message' => 'KYC details have been uploaded successfully.', 'user' => $auth], $this->successStatus);
        } catch (Exeception $e) {
            return response()->json(['success' => false, 'message' => 'KYC details not updated.', 'error' => 'KYC details not updated.'], $this->successStatus);
        }
    }
    public function createTransaction()
    {
        $validator = Validator::make(
            request()->all(), [
                'amount' => 'required|string|max:255',
                'coins' => 'required|string|max:255',
                'txn_id' => 'required|string|max:255',
                'screenshot' => 'required|image|max:2048',
                'cash_type' => 'required|string|max:255',
            ]);
        $validator1 = Validator::make(
            request()->all(), [
                'fiat_currency' => 'nullable|required_if:fiat_cash,null',
                'crypto_currency' => 'nullable|required_if:fiat_currency,null',
            ]);
        if ($validator->fails() || $validator1->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors() || $validator1->errors(), 'message' => 'account not updated'], $this->successStatus);
        }
        $Transaction = new Transaction();
        $Transaction->amount = request()->amount;
        $Transaction->coins = request()->coins;
        $Transaction->txn_id = request()->txn_id;
        $Transaction->description = request()->description;
        $Transaction->screenshot = request()->screenshot->store('screenshots');
        $Transaction->cash_type = request()->cash_type;
        $Transaction->user_id = Auth::id();

        if (request()->cash_type == "Fiat Cash") {
            $Transaction->cash_type = request()->cash_type;
            $Transaction->currency = request()->fiat_currency;
        } else {
            $Transaction->cash_type = request()->cash_type;
            $Transaction->currency = request()->crypto_currency;
            if (request()->crypto_currency != 'Others') {
                $Transaction->currency = request()->crypto_currency;
            }
            if (request()->crypto_currency == 'Others') {
                $Transaction->currency = request()->crypto_currency;
                $Transaction->others = request()->other_currency;
            }
        }
        $Transaction->save();
        return response()->json(['success' => true, 'message' => 'Transaction added successfully.', 'transaction' => $Transaction], $this->successStatus);
    }
    public function getProgressBar()
    {
        $progressBars = ProgressBar::where('status', 1)->get();
        return response()->json(['success' => true, 'message' => 'Progress bar fetched successfully.', 'progressBars' => $progressBars], $this->successStatus);

    }
    public function updateTransaction()
    {
        $validator = Validator::make(
            request()->all(), [
                'txn_id' => 'required|string|max:255',
                'wallet_address' => 'nullable|string|max:255',
                'wallet_type' => 'required|string|max:255',
                'wallet_name' => 'nullable|string|max:255',
                'ether' => 'required_without_all:wallet_address,wallet_name|max:255',
            ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors(), 'message' => 'account not updated'], $this->successStatus);
        }
        $auth = Auth::user();

        try {
            $Transaction = Transaction::where(['txn_id' => request()->txn_id, 'user_id' => Auth::user()->id])->first();
            if (!$Transaction) {
                throw new Exception("Error Processing Request", 1);
            }

            $Transaction->ether = request()->ether;
            $Transaction->wallet_type = request()->wallet_type;
            $auth->ether = request()->ether;
            $auth->wallet_address = request()->wallet_address;
            $Transaction->wallet_address = request()->wallet_address;
            $auth->wallet_name = request()->wallet_name;
            $Transaction->wallet_name = request()->wallet_name;
            $auth->save();
            $Transaction->save();
            return response()->json(['success' => true, 'message' => 'Transaction updated successfully.', 'transaction' => $Transaction], $this->successStatus);
        } catch (Exception $e) {

            return response()->json(['success' => false, 'message' => 'Transaction not updated successfully.'], $this->successStatus);
        }
    }

}
