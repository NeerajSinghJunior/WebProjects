<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\cms;
class CmsController extends Controller
{
    public function add() {
        return view('admin.cms.add');
    }
    //Adding CMS function
    public function store()
    {
        try {
            request()->validate([
                'title' => 'required|unique:cms|max:30',
                'link' => 'required|url',
            ]);
            $cms = new cms();
            $cms->title = request()->title;
            // $cms->body = request()->body;
            $cms->link = request()->link;
            $cms->save();
            return redirect()->back()->with('success', 'Page has been inserted successfully');
        }
        catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    //Updating CMS function
    public function edit($id)
    {
        $cms = cms::where('id', $id)->first();
        return view('admin.cms.edit', compact('cms'));

    }
    //Update CMS function
    public function update($id)
    {
        try {
            request()->validate([
                'title' => 'required|unique:cms,title,'.$id.'|max:30',
                'link' => 'required|url',
            ]);
            $cms = cms::where('id', $id)->first();
            $cms->title = request()->title;
            // $cms->body = request()->body;
            $cms->link = request()->link;
            $cms->save();
            return redirect()->back()->with('success', 'Page has been updated successfully');
        }
        catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    //delete CMS function
    public function delete($id)
    {
        try {
            $cms = cms::where('id', $id)->first();
            $cms->status = 0;
            $cms->save();
            return redirect()->back()->with('success', 'Page has been deleted successfully');
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
            $pages = cms::all()->where('status', 1);
            return view('admin.cms.list', compact('pages'));
        }
        catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

