<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function activities(Request $request)
    {
        $activities = Activity::latest('created_at')->paginate(20);

        return view('activity.activities', compact('activities'));
    }
}
