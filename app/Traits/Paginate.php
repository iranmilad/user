<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Paginate
{
    private function paginate($query, $columns)
    {
        $request = request();
        $length = $request->input("length");
        $start = $request->input("start");
        $page = $start / $length + 1;
        $_columns = $request->input('columns');

        $this->initUserSearch($query, $_columns);
        $this->initUserOrder($query, $_columns);

        return $query->paginate($length, $columns, "", $page);
    }

    protected function initUserSearch($query, $_columns)
    {
        $request = request();
        $searchValue = $request->input('search')["value"];
        if (trim($searchValue) != "") {
            $query->where(function ($query) use ($_columns, $searchValue) {
                foreach ($_columns as $column) {
                    $col = $column['data'];
                    $searchable = $column['searchable'];
                    if ($searchable != "false") {
                        if (trim($col) != "") {
                            if ($searchable == "relation") {
                                $name = $column['name'];
                                if (trim($name != ''))
                                    $query->orWhereHas($col, function ($query) use ($col, $searchValue, $name) {
                                        $_name = explode("+", $name);
                                        if (sizeof($_name) > 1)
                                            $query->where(DB::raw("concat($_name[0],' ',$_name[1])"), 'like', '%' . $searchValue . '%');
                                        else
                                            $query->where(DB::raw($name), 'like', '%' . $searchValue . '%');
                                    });
                            } else
                                $query->orWhere($col, 'like', '%' . $searchValue . '%');
                        }
                    }

                }
            });
        }
    }

    protected function initUserOrder($query, $_columns)
    {
        $request = request();
        $orders = $request->input('order');
        foreach ($orders as $order){
            $orderColumn = $order['column'];
            if (trim($orderColumn) != '' && $orderColumn > 0) {
                $orderColumn = $_columns[$orderColumn]['data'];
                $orderDir = $order['dir'];
                $query->orderBy($orderColumn, $orderDir);
            } else {
                $orderDir = $order['dir'];
                if ($orderDir)
                    $query->orderBy("id", $orderDir);
                else
                    $query->orderByDesc('id');
            }
        }

    }
}