<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Activity;
use Nilambar\NepaliDate\NepaliDate;
use Carbon\Carbon;

class TeacherController extends Controller
{
    public function new_teacher($school_id)
    {
        $school = User::find($school_id);
        return view('teacher.new_teacher', ['school' => $school]);
    }

    public function new_teacher_action(Request $request, $school_id)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'level' => 'required',
            'class' => 'required',
            'province' => 'required',
            'district' => 'required',
            'municipality' => 'required',
            'ward' => 'required',
            'type' => 'required',
            'license_number' => 'required',
            'dob_in_certificate' => 'required',
            'dob_in_citizenship' => 'required',
            'latest_qualification' => 'required',
            'first_appointment_date' => 'required',
            'studied_subject' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'required',
        ]);

        $new_teacher = new Teacher();
        $new_teacher->user_id = $school_id;
        $new_teacher->name = $request->name;
        $new_teacher->gender = $request->gender;
        $new_teacher->province = $request->province;
        $new_teacher->district = $request->district;
        $new_teacher->municipality = $request->municipality;
        $new_teacher->ward = $request->ward;
        $new_teacher->type = $request->type;
        $new_teacher->level = $request->level;
        $new_teacher->class = $request->class;
        $new_teacher->sheetroll_number = $request->sheetroll_number;
        $new_teacher->epf_number = $request->epf_number;
        $new_teacher->license_number = $request->license_number;
        $new_teacher->insurance_number = $request->insurance_number;
        $new_teacher->dob_in_certificate = $request->dob_in_certificate;
        $new_teacher->dob_in_citizenship = $request->dob_in_citizenship;
        $new_teacher->latest_qualification = $request->latest_qualification;
        $new_teacher->first_appointment_date = $request->first_appointment_date;
        $new_teacher->studied_subject = $request->studied_subject;
        $new_teacher->appointment_subject = $request->appointment_subject;
        $new_teacher->teaching_subject = $request->teaching_subject;
        $new_teacher->account_number = $request->account_number;
        $new_teacher->phone_number = $request->phone_number;
        $new_teacher->email = $request->email;
        $new_teacher->created_by = auth()->user()->name;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('teacher/photo', 'public');
            $new_teacher->photo = $path;
        } else {
            $new_teacher->photo = 'image/no_photo.png';
        }

        $school = User::find($school_id);
        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $school->name . ' मा नयाँ शिक्षक थप गर्नुभयो।';
        $activity->remarks = $request->name;
        $activity->save();

        $new_teacher->save();

        return redirect()->route('school', ['id' => $school_id])
            ->with('pass', 'नयाँ शिक्षक सम्बन्धी विवरण सुरक्षित गरियो।');
    }

    public function teacher($id)
    {
        $teacher = Teacher::with('user')->find($id);

        $str = ['१', '२', '३', '४', '५', '६', '७', '८', '९', '०'];
        $replace = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

        $dob_in_citizenship = str_replace($str, $replace, $teacher->dob_in_citizenship);
        $dob_in_citizenship = explode('-', $dob_in_citizenship);
        $ny = $dob_in_citizenship[0];
        $nm = $dob_in_citizenship[1];
        $nd = $dob_in_citizenship[2];

        $obj = new NepaliDate();
        $date = $obj->convertBsToAd($ny, $nm, $nd);
        $date = $date['year'] . '-' . $date['month'] . '-' . $date['day'];

        $date = Carbon::parse($date);
        $date = $date->addYears(60);

        $is_future = $date->isFuture();
    

        $sixty_years = $date->diffForHumans();

        return view('teacher.teacher', [
            'teacher' => $teacher,
            'sixty_years' => $sixty_years,
            'is_future' => $is_future
        ]);
    }

    public function edit_teacher($id)
    {
        $teacher = Teacher::with('user')->find($id);
        return view('teacher.edit_teacher', ['teacher' => $teacher]);
    }

    public function edit_teacher_action(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'level' => 'required',
            'class' => 'required',
            'province' => 'required',
            'district' => 'required',
            'municipality' => 'required',
            'ward' => 'required',
            'type' => 'required',
            'license_number' => 'required',
            'dob_in_certificate' => 'required',
            'dob_in_citizenship' => 'required',
            'latest_qualification' => 'required',
            'first_appointment_date' => 'required',
            'studied_subject' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => 'required',
        ]);

        $teacher = Teacher::find($id);
        $teacher->name = $request->name;
        $teacher->gender = $request->gender;
        $teacher->province = $request->province;
        $teacher->district = $request->district;
        $teacher->municipality = $request->municipality;
        $teacher->ward = $request->ward;
        $teacher->type = $request->type;
        $teacher->level = $request->level;
        $teacher->class = $request->class;
        $teacher->sheetroll_number = $request->sheetroll_number;
        $teacher->epf_number = $request->epf_number;
        $teacher->license_number = $request->license_number;
        $teacher->insurance_number = $request->insurance_number;
        $teacher->dob_in_certificate = $request->dob_in_certificate;
        $teacher->dob_in_citizenship = $request->dob_in_citizenship;
        $teacher->latest_qualification = $request->latest_qualification;
        $teacher->first_appointment_date = $request->first_appointment_date;
        $teacher->studied_subject = $request->studied_subject;
        $teacher->appointment_subject = $request->appointment_subject;
        $teacher->teaching_subject = $request->teaching_subject;
        $teacher->account_number = $request->account_number;
        $teacher->phone_number = $request->phone_number;
        $teacher->email = $request->email;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('teacher/photo', 'public');
            $teacher->photo = $path;
        }

        $teacher->update();

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $teacher->name . ' को विवरण अपडेट गर्नुभयो।';
        $activity->remarks = $teacher->name;
        $activity->save();

        return redirect()->route('teacher', ['id' => $id])
            ->with('pass', 'शिक्षक सम्बन्धी विवरण अपडेट गरिएको छ ।');
    }

    public function delete_photo($id)
    {
        $teacher = Teacher::find($id);
        if (\Storage::disk('public')->exists($teacher->photo) && $teacher->photo !== 'image/no_photo.png') {
            \Storage::disk('public')->delete($teacher->photo);
        }
        $teacher->photo = 'image/no_photo.png';
        $teacher->update();

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $teacher->name . ' को फोटो डिलिट गर्नुभयो।';
        $activity->remarks = $teacher->name;
        $activity->save();

        return redirect()->route('edit_teacher', ['id' => $id])
            ->with('pass', 'शिक्षक को फोटो डिलिट गरिएको छ ।');
    }

    public function transfer_teacher($id)
    {
        $teacher = Teacher::with('user')->find($id);
        $schools = User::where('type', 'school')->get();
        return view('teacher.transfer_teacher', [
            'teacher' => $teacher,
            'schools' => $schools,
        ]);
    }

    public function transfer_teacher_action(Request $request, $id)
    {
        $request->validate([
            'school' => 'required',
        ]);

        $teacher = Teacher::with('user')->find($id);
        $old_school = $teacher->user->id;
        $old_school_name = $teacher->user->name;
        $teacher->user_id = $request->school;
        $new_school_name = User::find($request->school)->name;
        $teacher->update();

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $teacher->name . ' को सरुवा गर्नुभयो।';
        $activity->remarks = $old_school_name . ' बाट ' . $new_school_name;
        $activity->save();

        return redirect()->route('school', ['id' => $old_school])
            ->with('pass', 'शिक्षक को सरुवा गरिएको छ ।');
    }

    public function delete_teacher($id)
    {
        $teacher = Teacher::with('user')->find($id);

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $teacher->name . ' को  विवरण डिलिट गर्नुभयो।';
        $activity->save();

        $teacher->delete();

        return redirect()->route('school', ['id' => $teacher->user->id])
            ->with('pass', 'शिक्षक को विवरण डिलिट गरिएको छ ।');
    }

    public function restore_teacher($id)
    {
        $teacher = Teacher::with('user')->onlyTrashed()->find($id);
        $school = User::find($teacher->user_id);

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name . ' ले ' . $teacher->name . ' को पुनःस्थापना गर्नुभयो।';
        $activity->remarks = $teacher->name;
        $activity->save();

        $teacher->restore();

        return redirect()->route('school', ['id' => $school->id])
            ->with('pass', 'शिक्षक को पुनःस्थापना गरिएको छ ।');
    }
}
