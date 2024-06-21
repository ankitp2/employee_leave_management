<?php

namespace App\Http\Controllers;

use App\Models\Leaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->email == 'admin@chetu.com') {
                $events = array();
                $leaves = DB::table('users')
                    ->select('name','start_date','end_date','description','user_id','status','apply_date','leaves.id','leave_type','emp_id')
                    ->join('leaves', 'leaves.user_id', '=', 'users.id')
                    ->get();
                foreach ($leaves as $leave) {
                    $color = null;
                    if ($leave->status == 'Approved') {
                        $color = '#25E51C';
                    } else if ($leave->status == 'Unapproved') {
                        $color = '#EC110D';
                    }
                    $leave_type = null;
                    if ($leave->leave_type == 'Halfday') {
                        $leave_type = "(H)";
                    } else if ($leave->leave_type == "Fullday") {
                        $leave_type = "(F)";
                    }

                    $events[] = [
                        'id' => $leave->id,
                        'description' => $leave->description,
                        'start' => $leave->start_date,
                        'start_date' => $leave->start_date,
                        'end_date' => $leave->end_date,
                        'end' => $leave->end_date,
                        'name'=> $leave->name,
                        'status' => $leave->status,
                        'apply_date' => $leave->apply_date,
                        'leave_type' => $leave->leave_type,
                        'emp_id' => $leave->emp_id,
                        'color' => $color,
                        'title' => $leave->name . $leave_type,
                    ];
                    $name=DB::table('users')
                    ->select('name','leaves.created_at')
                    ->join('leaves', 'leaves.user_id', '=', 'users.id')
                    ->orderBy('users.id','desc')
                    ->limit(5)
                    ->get();
                }
                $unseen=DB::table('leaves')
                ->where('seen_sts','unseen')
                ->count();
                return view("admin.adminhome", ['events' => $events,'name'=>$name,'unseen'=>$unseen]);
            } else {
                $events = array();
                $leaves = Leaves::all()->where('user_id', Auth::user()->id);
                foreach ($leaves as $leave) {
                    $color = null;
                    if ($leave->status == 'Approved') {
                        $color = '#25E51C';
                    } else if ($leave->status == 'Unapproved') {
                        $color = '#EC110D';
                    }
                    $leave_type = null;
                    if ($leave->leave_type == 'Halfday') {
                        $leave_type = "(H)";
                    } else if ($leave->leave_type == "Fullday") {
                        $leave_type = "(F)";
                    }
                    $events[] = [
                        'id'          => $leave->id,
                        'description' => $leave->description,
                        'start'       => $leave->start_date,
                        'start_date'  => $leave->start_date,
                        'end_date'    => $leave->end_date,
                        'end'         => $leave->end_date,
                        'status'      => $leave->status,
                        'apply_date'  => $leave->apply_date,
                        'leave_type'  => $leave->leave_type,
                        'color'       => $color,
                        'title'       => Auth::user()->name . $leave_type,
                    ];
                }
                return view("democalendar", ['events' => $events]);
            }
        }

        return Redirect::route('login')->with('error', 'Please Login first');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'leave_type' => 'required',
        ]);
        $leaves = Leaves::create([
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'apply_date' => $request->apply_date,
            'user_id' => $request->user_id,
            'leave_type' => $request->leave_type,
        ]);
        return response()->json($leaves);
    }

    /**
     * Display the specified resource.
     */
    public function show(Leaves $leaves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leaves $leaves)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leaves $leaves)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $leaves = Leaves::find($id);
        if (!$leaves) {
            return response()->json([
                'error' => 'Unable to locate the leave'
            ], 404);
        }
        $leaves->delete();
        return $id;
    }
    public function reject(Request $request)
    {
        $id = $request->id;
        $leaves = Leaves::find($id);
        if (!$leaves) {
            return response()->json([
                'error' => 'Unable to locate the leave'
            ], 404);
        }
        $leaves->status='Unapproved';
        $leaves->save();
        return $id;
        ;
    }
    public function revert(Request $request)
    {
        $id = $request->id;
        $leaves = Leaves::find($id);
        if (!$leaves) {
            return response()->json([
                'error' => 'Unable to locate the leave'
            ], 404);
        }
        $leaves->status='Applied';
        $leaves->save();
        return $id;
        ;
    }
    public function approve(Request $request)
    {
        $id = $request->id;
        $leaves = Leaves::find($id);
        if (!$leaves) {
            return response()->json([
                'error' => 'Unable to locate the leave'
            ], 404);
        }
        $leaves->status='Approved';
        $leaves->save();
        return $id;
        ;
    }
    public function notification()
    {
        $notification=DB::table('leaves')
        ->select('*')
        ->orderBy('id','desc')
        ->limit(5)
        ->get();
        //  return response()->json($notification);
        foreach($notification as $x){
             $data=Leaves::find($x->id);
             $data->seen_sts="seen";
             $data->save();
        }
        $unseen=DB::table('leaves')
        ->where('seen_sts','unseen')
        ->count();
           return response()->json($unseen);
    }
}
