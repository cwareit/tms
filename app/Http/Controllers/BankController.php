<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;
use App\Models\Activity;

class BankController extends Controller
{
    public function new_bank($school_id)
    {
        $school = User::find($school_id);
        return view('bank.new_bank', ['school' => $school]);
    }

    public function new_bank_action(Request $request, $school_id)
    {
  
        $request->validate([
            'name' => 'required',
            'branch' => 'required',
            'account_number' => 'required'
        ]);

        $new_bank = new Bank();
        $new_bank->user_id = $school_id;
        $new_bank->name = $request->name;
        $new_bank->branch = $request->branch;
        $new_bank->created_by = auth()->user()->name;
        $new_bank->account_number = $request->account_number;
        $new_bank->save();

        $school = User::find($school_id);
        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $school->name .' को बैंक खाता सम्बन्धि विवरण थप गर्नुभयो।';
        $activity->remarks = $request->name;
        $activity->save();

        return redirect()->route('school', ['id' => $school_id])
            ->with('pass', 'बैङ्क सम्बन्धी विवरण सुरक्षित गरियो।');
    }

    public function edit_bank($bank_id)
    {
        $bank = Bank::with('user')->find($bank_id);
        return view('bank.edit_bank', ['bank' => $bank]);
    }
    public function edit_bank_action(Request $request, $bank_id)
    {
        $request->validate([
            'name' => 'required',
            'branch' => 'required',
            'account_number' => 'required'
        ]);

        $bank = Bank::with('user')->find($bank_id);
        $bank->name = $request->name;
        $bank->branch = $request->branch;
        $bank->account_number = $request->account_number;

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $bank->user->name .' को बैंक खाता सम्बन्धि विवरण अपडेट गर्नुभयो।';
        $activity->remarks = $request->name;
        $activity->save();

        $bank->created_by = auth()->user()->name;

        $bank->update();

        return redirect()->route('school', ['id' => $bank->user->id])
            ->with('pass', 'बैङ्क खाता सम्बन्धी विवरण अपडेट गरियो।');
    }


    public function delete_bank($bank_id)
    {
        $bank = Bank::with('user')->find($bank_id);
        $school_id = $bank->user->id;
        $bank->delete();

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $bank->user->name .' को बैंक खाता सम्बन्धि विवरण डिलिट गर्नुभयो ।';
        $activity->remarks = $bank->name;
        $activity->save();

        return redirect()->route('school', ['id' => $school_id])
            ->with('pass', 'बैङ्क खाता सम्बन्धी विवरण डिलिट गरिएको छ ।');
    }
}
