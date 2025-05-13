<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\User;
use App\Models\Activity;

class EstablishmentController extends Controller
{
    public function new_establishment($school_id)
    {
        $school = User::find($school_id);
        return view('establishment.new_establishment', ['school' => $school]);
    }

    public function new_establishment_action(Request $request, $school_id)
    {
        $request->validate([
            'school_level' => 'required',
            'establishment_type' => 'required',
            'date' => 'required'
        ]);

        $new_establishment = new Establishment();
        $new_establishment->user_id = $school_id;
        $new_establishment->school_level = $request->school_level;
        $new_establishment->establishment_type = $request->establishment_type;
        $new_establishment->created_by = auth()->user()->name;
        $new_establishment->date = $request->date;
        $new_establishment->save();

        $school = User::find($school_id);
        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $school->name .' को स्थापना/ईजाजत सम्बन्धि विवरण थप गर्नुभयो।';
        $activity->remarks = $request->school_level .' | ' . $request->date;
        $activity->save();



        return redirect()->route('school', ['id' => $school_id])
            ->with('pass', 'स्थापना/ईजाजत सम्बन्धी विवरण सुरक्षित गरियो।');
    }


    public function edit_establishment($establishment_id)
    {
        $establishment = Establishment::with('user')->find($establishment_id);
        return view('establishment.edit_establishment', ['establishment' => $establishment]);
    }

    public function edit_establishment_action(Request $request, $establishment_id)
    {
        $request->validate([
            'school_level' => 'required',
            'establishment_type' => 'required',
            'date' => 'required'
        ]);

        $establishment = Establishment::with('user')->find($establishment_id);
        $establishment->school_level = $request->school_level;
        $establishment->establishment_type = $request->establishment_type;
        $establishment->created_by = auth()->user()->name;
        $establishment->date = $request->date;
        $establishment->save();

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $establishment->user->name .' को स्थापना/ईजाजत सम्बन्धि विवरण अपडेट गर्नुभयो।';
        $activity->remarks = $request->school_level .' | ' . $request->date;
        $activity->save();

        return redirect()->route('school', ['id' => $establishment->user_id])
            ->with('pass', 'स्थापना/ईजाजत सम्बन्धी विवरण अपडेट गरियो।');
    }

    public function delete_establishment($establishment_id)
    {
        $establishment = Establishment::with('user')->find($establishment_id);
        $school_id = $establishment->user_id;

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $establishment->user->name .' को स्थापना/ईजाजत सम्बन्धि विवरण डिलिट गर्नुभयो।';
        $activity->remarks = $establishment->establishment_type . ' | ' . $establishment->school_level .' | ' . $establishment->date ;
        $activity->save();
        $establishment->delete();



        return redirect()->route('school', ['id' => $school_id])
            ->with('pass', 'स्थापना/ईजाजत सम्बन्धी विवरण डिलिड गरियो ।');
    }
}
