<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Uleave;
use App\Models\Activity;

class UleaveController extends Controller
{
    public function new_uleave($teacher_id)
    {
        $teacher = Teacher::with('user')->find($teacher_id);
        $uleave_count = $teacher->uleaves()->count();

        if ($uleave_count > 0) {
            return back()->with('fail', 'एक पटक भन्दा वढी असाधारण विदा सम्बन्धि विवरण थप गर्न मिल्दैन।');
        } else {
            return view('uleave.new_uleave', ['teacher' => $teacher]);
        }
    }

    public function new_uleave_action(Request $request, $teacher_id)
    {
        $request->validate([
            'leave_from' => 'required|string|max:255',
            'leave_to' => 'required|string|max:255',
        ]);

        $uleave = new Uleave();
        $uleave->teacher_id = $teacher_id;
        $uleave->leave_from = $request->leave_from;
        $uleave->leave_to = $request->leave_to;
        $uleave->remarks = $request->remarks;
        $uleave->created_by = auth()->user()->name;

        $teacher = Teacher::find($teacher_id);

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $teacher->name . ' को असाधारण विदा सम्बन्धि विवरण थप गर्नुभयो।';
        $activity->remarks = $request->leave_from . ' देखि ' . $request->leave_to . ' सम्म';
        $activity->save();

        $uleave->save();

        return redirect()->route('teacher', ['id' => $teacher_id])->with('pass', 'असाधारण विदा सम्बन्धि विवरण थप गरिएको छ।');
    }

    public function edit_uleave($uleave_id)
    {
        $uleave = Uleave::find($uleave_id);

        return view('uleave.edit_uleave', ['uleave' => $uleave]);
    }
    public function edit_uleave_action(Request $request, $uleave_id)
    {
        $request->validate([
            'leave_from' => 'required|string|max:255',
            'leave_to' => 'required|string|max:255',
        ]);

        $uleave = Uleave::find($uleave_id);
        $uleave->leave_from = $request->leave_from;
        $uleave->leave_to = $request->leave_to;
        $uleave->remarks = $request->remarks;
        $uleave->created_by = auth()->user()->name;

        $teacher = Teacher::find($uleave->teacher_id);

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $teacher->name . ' को असाधारण विदा सम्बन्धि विवरण सम्पादन गर्नुभयो।';
        $activity->remarks = $request->leave_from . ' देखि ' . $request->leave_to . ' सम्म';
        $activity->save();

        $uleave->update();

        return redirect()->route('teacher', ['id' => $uleave->teacher_id])->with('pass', 'असाधारण विदा सम्बन्धि विवरण सम्पादन गरिएको छ।');
    }
    public function delete_uleave($uleave_id)
    {
        $uleave = Uleave::find($uleave_id);
        $teacher = Teacher::find($uleave->teacher_id);

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $teacher->name . ' को असाधारण विदा सम्बन्धि विवरण डिलिट गर्नुभयो।';
        $activity->remarks = $uleave->leave_from . ' देखि ' . $uleave->leave_to . ' सम्म';
        $activity->save();

        $uleave->delete();

        return redirect()->route('teacher', ['id' => $uleave->teacher_id])->with('pass', 'असाधारण विदा सम्बन्धि विवरण डिलिट गरिएको छ।');
    }
}
