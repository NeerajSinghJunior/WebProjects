<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\SurveyList;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use DB;
use Sessoin;

class SurveyController extends BaseController
{
	// Admin dashboard
	public function survey_settings(Request $request)
	{
		$admin=Admin::first();
		return view('admin.survey_settings',['admin'=>$admin]);
	}
	public function save_survey_settings(Request $reqeust)
	{
		$admin=Admin::first();
		$admin->survey_login_id=$reqeust->survey_login_id;
		$admin->survey_api_key=$reqeust->survey_api_key;
		$admin->survey_action=$reqeust->survey_action;
		$admin->save();
		return back()->with('success','Survey settings saved successfully!.');
	
	}
	public function survey_list(Request $request)
	{
		$client = new \GuzzleHttp\Client();
        $total_survey = $client->get('https://api.surveymethods.com/v1/'.LOGIN_ID_SURVEY.'/'.API_KEY_SURVEY.'/integrations/surveycodes/');
        $response = $total_survey->getBody()->getContents();
        $res= json_decode($response);

        foreach ($res->surveys as $key => $value) {
	       $single_survey = $client->get('https://api.surveymethods.com/v1/'.LOGIN_ID_SURVEY.'/'.API_KEY_SURVEY.'/surveys/'.$value->code);
	       $response1 = $single_survey->getBody()->getContents();
	       $survey= json_decode($response1);

	       $check=SurveyList::where('code',$survey->survey->code)->count();

	       if($check==0){
	       		$insert=new SurveyList();
	       }else{
	       	 	$insert=SurveyList::where('code',$survey->survey->code)->first();
	       }
	       // print_r($survey);exit;
	       $insert->code=$survey->survey->code;
	       $insert->date=$survey->survey->created_date;
	       $insert->survey_title=$survey->survey->title;
	       $insert->url=$survey->survey->web_launch_url;
	       $insert->status=$survey->survey->status;
	       $insert->response_count=$survey->survey->response_count;
	       $insert->save();
        }
        	$data=SurveyList::where('status','=','live')->get();

        return view('admin.survey_list',['data'=>$data]);
	}
	public function enable_survey($id,$status)
	{
		SurveyList::where('id',$id)->update(['action'=>$status]);

		return back()->with('success','Survey Status has been changed');
	}



	// user dashboard

	public function index(Request $request)
	{
		$user_id=Auth::user()->id;
		$client = new \GuzzleHttp\Client();
        $total_survey = $client->get('https://api.surveymethods.com/v1/'.LOGIN_ID_SURVEY.'/'.API_KEY_SURVEY.'/integrations/surveycodes/');
        $response = $total_survey->getBody()->getContents();
        $res= json_decode($response);

        foreach ($res->surveys as $key => $value) {
	       $single_survey = $client->get('https://api.surveymethods.com/v1/'.LOGIN_ID_SURVEY.'/'.API_KEY_SURVEY.'/surveys/'.$value->code);
	       $response1 = $single_survey->getBody()->getContents();
	       $survey= json_decode($response1);

	       if($survey->survey->status!="closed"){
		       $check=SurveyList::where('code',$survey->survey->code)->count();

		       if($check==0){
		       		$insert=new SurveyList();
		       }else{
		       	 	$insert=SurveyList::where('code',$survey->survey->code)->first();
		       }
		       // print_r($survey);exit;
			       $insert->code=$survey->survey->code;
			       $insert->date=$survey->survey->created_date;
			       $insert->survey_title=$survey->survey->title;
			       $insert->url=$survey->survey->web_launch_url;
			       $insert->status=$survey->survey->status;
			       $insert->response_count=$survey->survey->response_count;
			       $insert->action=1;
			       $insert->save();
		       }
        }


		$data=SurveyList::where('status','=','live')->where('action','=',1)->orderBy('id','desc')->first();
		if($data!=""&&$data!=NULL)
		{
			$check=DB::table('survey_notify')->where('survey_id',$data->id)->count();

		

			if($check==0){
				$check=DB::table('survey_notify')->insert(['survey_id'=>$data->id,'user_id'=>$user_id,'status'=>1]);
			}

			$request->session()->put('survey_notify_count',0);

		return view('survey',['data'=>$data]);
		}else
		{
			return view('survey',['data'=>""]);
		}
		
	}

	public function single_survey($id,Request $request)
	{
		$user_id=Auth::user()->id;
		$data=SurveyList::where('id','=',$id)->first();

		$check=DB::table('survey_notify')->where('survey_id',$id)->count();

		if($check==0){
			$check=DB::table('survey_notify')->insert(['survey_id'=>$id,'user_id'=>$user_id,'status'=>1]);
		}
		$join_data=DB::table('survey_list')
			->leftjoin('survey_notify','survey_notify.survey_id','survey_list.id')
			->where('survey_list.status','live')
			->where('survey_list.action',1)
			->select('survey_notify.status as Stat')
			->get();

			$count=0;
			foreach ($join_data as $key => $value) {
				if($value->Stat==""){
					$count +=1;
				}
			}
			
			$request->session()->put('survey_notify_count',$count);
			
		return view('survey',['data'=>$data]);
	}
}