<?php

 $catitems = $this->retreiveCategoryItems($categorycode);

        // Number of items per page
        $perPage = 2;


        // Get the current page from the url if it's not set default to 1
        $page = Input::get('page', 1);

        //Get current page form url e.g. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

// Start displaying items from this number;
        $offSet = ($page * $perPage) - $perPage; // Start displaying items from this number
        //Slice the collection to get the items to display in current page
        $currentPageItems = $catitems->slice(($currentPage - 1) * $perPage, $perPage);
        
        // $itemsForCurrentPage = array_slice($catitems, $offSet, $perPage, true);


      $items=  LengthAwarePaginator($currentPageItems, count($catitems), $perPage);






// Get only the items you need using array_slice (only get 10 items since that's what you need)
        //   $itemsForCurrentPage = array_slice($catitems, $offSet, $perPage, true);
        // Return the paginator with only 10 items but with the count of all items and set the it on the correct page
       // $items = new LengthAwarePaginator($itemsForCurrentPage, count($catitems), $perPage, $page);
        //$items= new LengthAwarePaginator($catitems, count($catitems), $perPage, $page, ['path' => Request::url(), 'query' => Request::query()]);
        return $items;

//        if ($page > count($catitems) or $page < 1) {
//            $page = 1;
//        }
//        $offset = ($page * $perPage) - $perPage;
//        $articles = array_slice($catitems, $offset, $perPage);
//        $datas = \Paginator::make($articles, count($catitems), $perPage);
//
//
//
//        print_r($datas);
//        return;
        $catdetails = $this->retreiveCategoriesDetails($categorycode);
        return view('category')->with('items', $items)->with('details', $catdetails);