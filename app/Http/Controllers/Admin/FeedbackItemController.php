<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Yajra\Datatables\Datatables;
use App\Models\Feedback;

class FeedbackItemController extends Controller
{
    public function index()
    {
        return view('admin.feeback-items.index');
    }

    public function dataTable()
    {
        $feedbackItems = Feedback::with('user')->get();
        
        return Datatables::of($feedbackItems)
            ->addColumn('action', function ($feedbackItem){
                return '<div><button class="btn btn-danger" onclick="confirmDelete(' . $feedbackItem->id . ')"><i class="fas fa-trash"></i></button></div>';
            })
            ->editColumn('id', function () {
                static $i = 0;
                $i++;
                return $i;
            })
            ->rawColumns(['action'])
            ->toJson();    
    }

    public function destroy($id)
    {
        $Feedback = Feedback::find($id);
        $Feedback->delete();
        return new JsonResponse(['message' => 'Feedback deleted successfully']);
    }
}
