<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Training;
use App\Models\User;
use App\Models\Activity;

class TrainingController extends Controller
{
    public function new_training($teacher_id)
    {
        $teacher = Teacher::with('user')->find($teacher_id);
        return view('training.new_training', ['teacher' => $teacher]);
    }


    public function new_training_action(Request $request, $teacher_id)
    {
        $request->validate([
            'training_type' => 'required|string|max:255',
            'completed_date' => 'required',
            'remarks' => 'nullable|string|max:255',
        ]);

        $training = new Training();
        $training->teacher_id = $teacher_id;
        $training->training_type = $request->training_type;
        $training->completed_date = $request->completed_date;
        $training->remarks = $request->remarks;
        $training->created_by = auth()->user()->name;
        $training->save();



        $teacher = Teacher::find($teacher_id);
        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $teacher->name .' को तालिम सम्बन्धि विवरण थप गर्नुभयो।';
        $activity->remarks = $request->training_type .' | '. $request->completed_date;
        $activity->save();
        



        return redirect()->route('teacher', ['id' => $teacher_id])->with('pass', 'तालिम सम्बन्धि विवरण थप गरिएको छ।');
    }




    public function edit_training($training_id)
    {
        $training = Training::find($training_id);
    
        return view('training.edit_training', ['training' => $training]);
    }

    public function edit_training_action(Request $request, $training_id)
    {
        $request->validate([
            'training_type' => 'required|string|max:255',
            'completed_date' => 'required',
            'remarks' => 'nullable|string|max:255',
        ]);

        $training = Training::find($training_id);
        $training->training_type = $request->training_type;
        $training->completed_date = $request->completed_date;
        $training->remarks = $request->remarks;

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $training->teacher->name .' को तालिम सम्बन्धि विवरण अपडेट गर्नुभयो।';
        $activity->remarks = $request->training_type .' | '. $request->completed_date;
        $activity->save();

        $training->update();

        return redirect()->route('teacher', ['id' => $training->teacher_id])->with('pass', 'तालिम सम्बन्धि विवरण अपडेट गरिएको छ।');
    }
    public function delete_training($training_id)
    {
        $training = Training::find($training_id);
        $teacher_id = $training->teacher_id;

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $training->teacher->name .' को तालिम सम्बन्धि विवरण डिलिट गर्नुभयो।';
        $activity->remarks = $training->training_type .' | '. $training->completed_date;
        $activity->save();
        $training->delete();

        return redirect()->route('teacher', ['id' => $teacher_id])->with('pass', 'तालिम सम्बन्धि विवरण डिलिट गरिएको छ।');
    }
}
