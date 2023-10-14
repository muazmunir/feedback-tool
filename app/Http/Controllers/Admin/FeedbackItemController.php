<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Yajra\Datatables\Datatables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function destroy(Feedback $Feedback)
    {
        $Feedback->delete();
        return new JsonResponse(['message' => 'Feedback deleted successfully']);
    }
}
