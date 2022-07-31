<?php

namespace App\Http\Controllers\Admin;

use App\Constants\PaymentStates;
use App\Models\Payment;
use App\Traits\Paginate;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use Paginate;

    public function index()
    {
        $now = jdate();
        $currentYear = $now->getYear();
        $currentMonth = $now->getMonth();

        $query = Payment::query()->where("state", PaymentStates::SUCCESS);

        $sumAll = (clone $query)->sum('amount');

        $sumInMonth = (clone $query)->where([[DB::raw('pyear(created_at)'), $currentYear],
            [DB::raw('pmonth(created_at)'), $currentMonth]])->sum('amount');

        $chartData = (clone $query)->whereDate(DB::raw('pdate(created_at)'), '>=', $now->subMonths(6)->format('%Y-%m-%d'))->groupBy(DB::raw("pyear(created_at), pmonth(created_at)"))
            ->orderByDesc(DB::raw("pyear(created_at), pmonth(created_at)"))
            ->get([DB::raw("sum(amount) as sum,pyear(created_at) as year,pmonth(created_at) as month")]);
        // dd($chartData->toArray());
        return view("admin.home", compact("sumAll", "sumInMonth", "chartData"));
    }

}
