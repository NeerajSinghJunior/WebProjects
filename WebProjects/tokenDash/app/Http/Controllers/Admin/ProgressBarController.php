<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProgressBar;
class ProgressBarController extends Controller
{
    public function add() {
        return view('admin.progressBar.add');
    }
    //Adding CMS function
    public function store()
    {
        try {
            request()->validate([
                'title' => 'required|unique:progress_bar|max:30',
                'hint' => 'required',
                'progress_bar_date' => 'required'
            ]);
           // if(request()->progress_bar_date!=""){
           //      $Fdate=str_replace("/","-",request()->progress_bar_date);
           //      $progress_bar_date =Date('Y-m-d',strtotime($Fdate)); 

           //  }
            $progressBar = new ProgressBar();
            $progressBar->title = request()->title;
            $progressBar->hint = request()->hint;
            $progressBar->coin_price = request()->token_price;
            $progressBar->notify_before = request()->notify_before;
            $progressBar->progress_bar_date =  request()->progress_bar_date;
            $progressBar->is_completed = request()->is_completed ? 1 : 0;
            $progressBar->save();
            return redirect()->back()->with('success', 'progressBar has been inserted successfully');
        }
        catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    //Update CMS function
    public function update($id)
    {
        // print_r(request()->all());exit;
        try {
            request()->validate([
                'title' => 'required|unique:progress_bar,title,'.$id.'|max:30',
                'hint' => 'required',
                'progress_bar_date' => 'required'
            ]);

            // if(request()->progress_bar_date!=""){
            //     $Fdate=str_replace("/","-",request()->progress_bar_date);
            //     $progress_bar_date =Date('Y-m-d',strtotime($Fdate));
            //     // print_r(request()->all());
            //     // print_r($Fdate);   
            //     // print_r($progress_bar_date);exit;   
            // }
            
            $progressBar = ProgressBar::where('id', $id)->first();
            $progressBar->title = request()->title;
            $progressBar->hint = request()->hint;
            $progressBar->coin_price = request()->token_price;
             $progressBar->notify_before = request()->notify_before;
            $progressBar->progress_bar_date = request()->progress_bar_date;
            $progressBar->is_completed = request()->is_completed ? 1 : 0;
            $progressBar->save();
            return redirect('admin/progressBar/viewAll')->with('success', 'progressBar has been updated successfully');
        }
        catch(Exception $e) {
            return redirect('admin/progressBar/viewAll')->with('error', $e->getMessage());
        }

    }
    //delete CMS function
    public function delete($id)
    {
        try {
            $progressBar = ProgressBar::where('id', $id)->first();
            $progressBar->status = 0;
            $progressBar->save();
            return redirect('admin/progressBar/viewAll')->with('success', 'progressBar has been deleted successfully');
        }
        catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    //View Single CMS function
    public function view($id)
    {

    }
    //View Single CMS function
    public function viewAll()
    {
        try {
            $bar = false;
            if(request()->has('id'))
                $bar = ProgressBar::where('id', request()->input('id'))
                ->where('status', 1)->first();
            // var_dump($bar);exit;
            $progressBars = ProgressBar::all()->where('status', 1);
            return view('admin.progressBar.list', compact('progressBars','bar'));
        }
        catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

