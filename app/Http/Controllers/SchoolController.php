<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Establishment;
use App\Models\Activity;

class SchoolController extends Controller
{
    public function new_school()
    {
        if (Auth::user()->type == 'office') {
            return view('school.new_school');
        } else {
            return back()->with('fail', 'यो सुविधा निषेधित गरिएको छ ।');
        }
    }

    public function new_school_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'iemis_code' => 'required',
            'school_type' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_again' => 'required|same:password',
            'province' => 'required',
            'district' => 'required',
            'municipality' => 'required',
            'ward' => 'required',
            'd1' => 'required',
            'd2' => 'required',
            'd3' => 'required',
            'd4' => 'required',
            'rd1' => 'required',
            'rd2' => 'required',
            'rd3' => 'required',
            'rd4' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->iemis_code = $request->iemis_code;
        $user->school_type = $request->school_type;
        $user->email = $request->email;
        $user->type = 'school';
        $user->password = Hash::make($request->password);
        $user->province = $request->province;
        $user->district = $request->district;
        $user->municipality = $request->municipality;
        $user->ward = $request->ward;
        $user->d1 = $request->d1;
        $user->d2 = $request->d2;
        $user->d3 = $request->d3;
        $user->d4 = $request->d4;
        $user->rd1 = $request->rd1;
        $user->rd2 = $request->rd2;
        $user->rd3 = $request->rd3;
        $user->rd4 = $request->rd4;
        $user->status = 1;
        $user->created_by = Auth::user()->name;
        $user->save();

        $activity = new Activity();
        $activity->user_id = Auth::user()->id;
        $activity->activity = auth()->user()->name . ' ले विद्यालय थप गर्नुभयो ।';
        $activity->remarks = $request->name;
        $activity->save();

        return redirect()->route('schools')->with('pass', 'नयाँ विद्यालय थप गरिएको छ ।');
    }

    public function schools()
    {
        if (Auth::user()->type == 'school') {
            $schools = User::where('type', 'school')->where('id', Auth::user()->id)->get();
        } else {
            $schools = User::where('type', 'school')->get();
        }

        return view('school.schools', ['schools' => $schools]);
    }

    public function school($id)
    {
        if (Auth::user()->type == 'school') {
            $school = User::find(Auth::user()->id);
        } else {
            $school = User::find($id);
        }

        $teacherCounts = $school->teachers()
            ->select('type', 'level', \DB::raw('count(*) as total'))
            ->groupBy('type', 'level')
            ->get();

        $teacherCountsByType = $school->teachers()
            ->select('type', \DB::raw('count(*) as total'))
            ->groupBy('type')
            ->get();

        $teacherCountsByLevel = $school->teachers()
            ->select('level', \DB::raw('count(*) as total'))
            ->groupBy('level')
            ->get();

        $totalTeachers = $school->teachers()->count();

        return view('school.school', [
            'school' => $school,
            'teacherCounts' => $teacherCounts,
            'teacherCountsByType' => $teacherCountsByType,
            'teacherCountsByLevel' => $teacherCountsByLevel,
            'totalTeachers' => $totalTeachers
        ]);
    }

    public function edit_school($id)
    {
        if (Auth::user()->type == 'school') {
            $school = User::find(Auth::user()->id);
        } else {
            $school = User::find($id);
        }

        return view('school.edit_school', ['school' => $school]);
    }

    public function edit_school_action(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'iemis_code' => 'required',
            'school_type' => 'required',
            'province' => 'required',
            'district' => 'required',
            'municipality' => 'required',
            'ward' => 'required',
            'd1' => 'required',
            'd2' => 'required',
            'd3' => 'required',
            'd4' => 'required',
            'rd1' => 'required',
            'rd2' => 'required',
            'rd3' => 'required',
            'rd4' => 'required'
        ]);

        $school = User::find($id);
        $school->name = $request->name;
        $school->iemis_code = $request->iemis_code;
        $school->school_type = $request->school_type;
        $school->province = $request->province;
        $school->district = $request->district;
        $school->municipality = $request->municipality;
        $school->ward = $request->ward;
        $school->d1 = $request->d1;
        $school->d2 = $request->d2;
        $school->d3 = $request->d3;
        $school->d4 = $request->d4;
        $school->rd1 = $request->rd1;
        $school->rd2 = $request->rd2;
        $school->rd3 = $request->rd3;
        $school->rd4 = $request->rd4;

        $activity = new Activity();
        $activity->user_id = Auth::user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $request->name . ' को विवरण अपडेट गर्नुभयो ।';
        $activity->save();

        $school->update();

        return redirect()->route('school', ['id' => $id])->with('pass', "विद्यालयको विवरण अपडेट गरिएको छ ।");
    }

    public function delete_school($id)
    {
        $school = User::findOrFail($id);



        if (Auth::user()->type !== 'office') {
            return back()->with('fail', 'यो सुविधा उपलब्ध छैन ।');
        }

        $school->delete();

        $activity = new Activity();
        $activity->user_id = Auth::user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $school->name . '  डिलिट गर्नुभयो ।';
        $activity->save();

        return redirect()->route('schools')->with('pass', 'विद्यालय डिलिट गरिएको छ ।');
    }



    public function update_password($id)
    {  
        if (Auth::user()->type == 'school') {
            $id = Auth::user()->id;
        }
        
        $school = User::find($id);
        return view('school.update_password', ['school' => $school]);
    }

    public function update_password_action(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_again' => 'required|same:password',
        ]);

        $school = User::find($id);
        $school->password = Hash::make($request->password);
        $school->update();

        $activity = new Activity();
        $activity->user_id = Auth::user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $school->name . ' को पासवर्ड अपडेट गर्नुभयो ।';
        $activity->save();

        return redirect()->route('schools')->with('pass', 'पासवर्ड अपडेट गरिएको छ ।');
    }
}
