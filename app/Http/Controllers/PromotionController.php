<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Promotion;
use App\Models\Activity;


class PromotionController extends Controller
{
    public function new_promotion($teacher_id)
    {
        $teacher = Teacher::with('user')->find($teacher_id);
        return view('promotion.new_promotion', ['teacher' => $teacher]);
    }

    public function new_promotion_action(Request $request, $teacher_id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'date' => 'required|string|max:255'
        ]);

        $promotion = new Promotion();
        $promotion->teacher_id = $teacher_id;
        $promotion->type = $request->type;
        $promotion->level = $request->level;
        $promotion->class = $request->class;
        $promotion->date = $request->date;
        $promotion->remarks = $request->remarks;
 
        $promotion->created_by = auth()->user()->name;


        $teacher = Teacher::find($teacher_id);
        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $teacher->name .' को बढुवा नियुक्ति सम्बन्धि विवरण थप गर्नुभयो।';
        $activity->remarks = $request->type .' | '. $request->level .' | ' . $request->class .' | ' . $request->date;
        $activity->save();



        $promotion->save();

        return redirect()->route('teacher', ['id' => $teacher_id])->with('pass', 'बढुवा सम्बन्धि विवरण थप गरिएको छ।');
    }

    public function edit_promotion($promotion_id)
    {
        $promotion = Promotion::find($promotion_id);

        return view('promotion.edit_promotion', ['promotion' => $promotion]);
    }
    public function edit_promotion_action(Request $request, $promotion_id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'date' => 'required|string|max:255'
        ]);

        $promotion = Promotion::find($promotion_id);
        $promotion->type = $request->type;
        $promotion->level = $request->level;
        $promotion->class = $request->class;
        $promotion->date = $request->date;
        $promotion->remarks = $request->remarks;

        $teacher = Teacher::find($promotion->teacher_id);
        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $teacher->name .' को बढुवा नियुक्ति सम्बन्धि विवरण अपडेट गर्नुभयो।';
        $activity->remarks = $request->type .' | '. $request->level .' | ' . $request->class .' | ' . $request->date;
        $activity->save();

        $promotion->update();

        return redirect()->route('teacher', ['id' => $promotion->teacher_id])->with('pass', 'बढुवा सम्बन्धि विवरण अपडेट गरिएको छ।');
    }
    public function delete_promotion($promotion_id)
    {
        $promotion = Promotion::find($promotion_id);
        $teacher = Teacher::find($promotion->teacher_id);

        $activity = new Activity();
        $activity->user_id = auth()->user()->id;
        $activity->activity = auth()->user()->name. ' ले '. $teacher->name .' को बढुवा नियुक्ति सम्बन्धि विवरण डिलिट गर्नुभयो।';
        $activity->remarks = $promotion->type .' | '. $promotion->level .' | ' . $promotion->class .' | ' . $promotion->date;
        $activity->save();

        $promotion->delete();

        return redirect()->route('teacher', ['id' => $teacher->id])->with('pass', 'बढुवा सम्बन्धि विवरण डिलिट गरिएको छ।');
    }
}
