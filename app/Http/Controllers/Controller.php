<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @param $sortFields
     * @return array
     */
    protected function prepareSort(Request $request, $sortFields ): array
    {
        //icons: fa-sort , fa-sort-amount-asc, fa-sort-amount-desc

        $data = $request->all();

        $orderBy = $data['order_by'] ?? 'id';
        $order = $data['order'] ?? 'asc';
        if (!empty($data['order_by'])) {
            unset($data['order_by']);
        }
        if (!empty($data['order'])) {
            unset($data['order']);
        }
        if (!empty($data['_token'])) {
            unset($data['_token']);
        }
        $sort = [];

        $queryString = http_build_query($data);

        foreach ($sortFields as $field) {

            $link = $request->path() . '?' . (!empty($queryString) ? $queryString . '&' : '') . 'order_by=' . $field;

            if ($field == $orderBy) {
                if ($order == 'asc') {
                    $sort[$field]['link'] = $link . '&order=desc';
                    $sort[$field]['icon'] = 'fa-sort-amount-asc';
                } else {
                    $sort[$field]['link'] = $link . '&order=asc';
                    $sort[$field]['icon'] = 'fa-sort-amount-desc';
                }
            } else {
                $sort[$field]['link'] = $link . '&order=asc';
                $sort[$field]['icon'] = 'fa-sort';
            }
        }

        return $sort;
    }
}
