<?php

namespace App\Actions\AppCosplay;

use App\Abstracts\Action;
use App\Models\AppCosplay;
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

        $query = AppCosplay::select('*')
            ->orderby($request->order_by ?? 'id', $request->order ?? 'asc');

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::user()->id);
        }

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'LIKE', "%$keyword%")
                    ->orWhere('fandom', 'LIKE', "%$keyword%")
                    ->orWhere('city', 'LIKE', "%$keyword%");
            });
        }

        if(!empty($request->get('type_id'))) {
            $query->where('type_id', $request->get('type_id'));
        }

        if(!empty($request->get('nickname'))) {
            $nickname = $request->get('nickname');
            $query->with('Profile')->whereHas('Profile', function($q) use ($nickname) {
                $q->where('nickname', 'LIKE', '%' . $nickname . '%');
            });
        }

        if(!empty($request->get('status'))) {
            $query->where('status', $request->get('status'));
        }

        if(!empty($request->get('ids'))) {
            $ids = array_map(function ($value) {
                return (int)trim($value);
            }, explode(',', $request->get('ids')));
            $query->whereIn('id', $ids);
        }

        return $query->get();
    }
}