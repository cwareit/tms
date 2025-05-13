<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class SearchController extends Controller
{
    public function search_teacher()
    {
        return view('search.search_teacher');
    }

    public function search_teacher_action(Request $request)
    {
        $query = Teacher::query();

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('level')) {
            $query->where('level', 'LIKE', '%' . $request->input('level') . '%');
        }

        if ($request->filled('class')) {
            $query->where('class', 'LIKE', '%' . $request->input('class') . '%');
        }

        $teachers = $query->get();

        return view('search.search_teacher', ['teachers' => $teachers]);
    }
}
