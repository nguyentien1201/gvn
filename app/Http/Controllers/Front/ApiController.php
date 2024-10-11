<?php


namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Mail;
use App\Models\GreenBeta;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use App\Models\GreenAlpha;
use App\Models\GreenStockNas100;
use DB;
use App\Models\SubGroup;
use App\Models\Ma;
use Illuminate\Support\Facades\Cache;
use App\Models\GroupCap;
use App\Models\SubGroupCapDetail;
use DateTime;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\ConstantModel;
use App\Models\Subscription;
class ApiController
{
    public function postSignal(Request $request)
    {
        $request = Request::all();
        \Log::info('api_request');
        \Log::info($request);
        return  ['status' => 'success', 'message' => 'Recived signal'];
    }
}
