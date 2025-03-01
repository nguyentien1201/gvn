<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VnIndex\StoreVnIndexRequest;
use App\Http\Requests\VnIndex\UpdateVnIndexRequest;
use App\Imports\VnIndexImport;
use App\Models\ConstantModel;
use App\Models\MstStock;
use App\Models\GreenAlpha;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\VnIndex;
use GuzzleHttp\Client;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use App\Service\GoogleDriveService;
class VnIndexController extends AdminController
{
    private $vnIndex;
    protected $googleDriveService;
    public function __construct()
    {
        $this->googleDriveService = new GoogleDriveService();
        $this->vnIndex = new VnIndex();
    }
    public function index()
    {

        $signals = $this->vnIndex->getListVnIndex();
        // dd($signals);
        return view('admin.vnindex.index',compact('signals'));
    }

    public function import(Request $request) {
        $isCompany = false;
        if($request->isCompany == 'on'){
            $isCompany=true;
        }
        $this->vnIndex->import($isCompany);
        return redirect()->route('admin.vnindex.index')->with('success', __('panel.success'));
    }
}
