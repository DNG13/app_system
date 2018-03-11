<?php

namespace App\Actions\AppVolunteer;

use App\Abstracts\Action;
use App\Models\AppVolunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListAction extends Action
{

    public function __construct()
    {

    }

    public function run(Request $request)
    {
        $keyword = $request->get('search');

        $query = AppVolunteer::select('*')
            ->orderby($request->order_by ?? 'id', $request->order ?? 'asc');

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::user()->id);
        }

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('skills', 'LIKE', "%$keyword%")
                    ->orWhere('nickname', 'LIKE', "%$keyword%")
                    ->orWhere('city', 'LIKE', "%$keyword%")
                    ->orWhere('status', 'LIKE', "%$keyword%");
            });
        }

        return $query->paginate();
    }
}