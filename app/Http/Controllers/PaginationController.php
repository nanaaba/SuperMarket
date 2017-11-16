<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Request;

class PaginationController extends Controller {

    public function paginate($items, $perPage = 12) {
        //Get current page form url e.g. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // set url
        //Slice the collection to get the items to display in current page

        $currentPageItems = array_slice($items, ($currentPage - 1) * $perPage, $perPage, true);


        $paginate = new LengthAwarePaginator($currentPageItems, count($items), $perPage);
// set url
        $paginate = $paginate->setPath(Request::url());
        return $paginate;
    }

}
