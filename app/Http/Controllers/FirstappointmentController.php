<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Firstappointment;
use App\Models\User;
use App\Models\Activity;

class FirstappointmentController extends Controller
{
    public function new_first_appointment($teacher_id)
    {
        $teacher = Teacher::with('user')->find($teacher_id);
        return view('first_appointment.new_first_appointment', ['teacher' => $teacher]);
    }

    public function new_first_appointment_action(Request $request, $teacher_id)
    {
        $request->validate([
            'level' => 'required|string|max:255',
            'class' => 'required',
            'date' => 'required',
            'type' => 'required',

        ]);

        $first_appointment = new Firstappointment();
        $first_appointment->teacher_id = $teacher_id;
        $first_appointment->level = $request->level;
        $first_appointment->class = $request->class;
        $first_appointment->date = $request->date;
        $first_appointment->type = $request->type;
        $first_appointment->remarks = $request->remarks;
        $first_appointment->created_by = auth()->user()->name;
        $first_appointment->save();


        $teacher = Teacher::find($teacher_id);
        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $teacher->name .' को सुरु नियुक्ति मिति सम्बन्धि विवरण थप गर्नुभयो।';
        $activity->remarks = $request->level .' | ' . $request->class .' | ' . $request->date;
        $activity->save();

        return redirect()->route('teacher', ['id' => $teacher_id])->with('pass', 'सुरु नियुक्ति सम्बन्धि विवरण थप गरिएको छ।');
    }

    public function edit_first_appointment($first_appointment_id)
    {
        $first_appointment = Firstappointment::find($first_appointment_id);

        return view('first_appointment.edit_first_appointment', ['first_appointment' => $first_appointment]);
    }
    public function edit_first_appointment_action(Request $request, $first_appointment_id)
    {
        $request->validate([
            'level' => 'required|string|max:255',
            'class' => 'required',
            'date' => 'required',
            'type' => 'required',

        ]);

        $first_appointment = Firstappointment::find($first_appointment_id);
        $first_appointment->level = $request->level;
        $first_appointment->type = $request->type;
        $first_appointment->class = $request->class;
        $first_appointment->date = $request->date;
        $first_appointment->remarks = $request->remarks;

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $first_appointment->teacher->name .' को सुरु नियुक्ति मिति सम्बन्धि विवरण अपडेट गर्नुभयो।';
        $activity->remarks = $request->level .' | ' . $request->class .' | ' . $request->date;
        $activity->save();

        $first_appointment->update();

        return redirect()->route('teacher', ['id' => $first_appointment->teacher_id])->with('pass', 'सुरु नियुक्ति सम्बन्धि विवरण अपडेट गरिएको छ।');
    }

    public function delete_first_appointment($first_appointment_id)
    {
        $first_appointment = Firstappointment::find($first_appointment_id);

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $first_appointment->teacher->name .' को सुरु नियुक्ति मिति सम्बन्धि विवरण डिलिट गर्नुभयो।';
        $activity->remarks = $first_appointment->level .' | ' . $first_appointment->class .' | ' . $first_appointment->date;
        $activity->save();

        $first_appointment->delete();

        return redirect()->route('teacher', ['id' => $first_appointment->teacher_id])->with('pass', 'सुरु नियुक्ति सम्बन्धि विवरण डिलिट गरिएको छ।');
    }

}
