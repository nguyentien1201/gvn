<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\ConstantModel;
use App\Models\PromotionCustomer;
use App\Models\Token;
use App\Service\TelnyxApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $routeName = $request->route()->getName();
        $status = ConstantModel::$STATUS;
        $background = ConstantModel::$STATUS_BACKGROUND;
        $tokens = Token::orderBy('website', 'asc')->get();
        view()->share([
            'routeName' => $routeName,
            'status' => $status,
            'background' => $background,
            'tokens' => $tokens
        ]);
    }

    public function home()
    {
        return view('home');
    }

    public function testSendMessage(Request $request)
    {
        $message = $request->message;
        $phone = Helper::formatPhone($request->phone);
        if ($phone && $message) {
            $messageInfo['message'] = $message;
            try {
                (new TelnyxApiService())->sendMessage($messageInfo, $phone, 'SMS');
                echo "success";
            } catch (\Exception $e) {
                echo "failed";
                Log::error($e->getMessage());
            }
        }
    }

}
