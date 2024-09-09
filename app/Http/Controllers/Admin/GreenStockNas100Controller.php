<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GreenBeta\StoreGreenBetaRequest;
use App\Http\Requests\GreenBeta\UpdateGreenBetaRequest;
use App\Imports\GreenBetaImport;
use App\Models\ConstantModel;
use App\Models\MstStock;
use App\Models\GreenAlpha;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\GreenStockNas100;
use GuzzleHttp\Client;
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use App\Service\GoogleDriveService;
class GreenStockNas100Controller extends AdminController
{
    private $greenBeta;
    private $nas100;
    protected $googleDriveService;
    public function __construct()
    {
        $this->googleDriveService = new GoogleDriveService();
        $this->nas100 = new GreenStockNas100();
        $this->greenBeta = new GreenAlpha();
    }
    public function index()
    {

        $signals = $this->nas100->getListNas100();
        return view('admin.nas100.index',compact('signals'));
    }

    public function import(Request $request) {
        $isCompany = false;
        if($request->isCompany == 'on'){
            $isCompany=true;
        }
        $this->nas100->import($isCompany);
        return redirect()->route('admin.nas100.index')->with('success', __('panel.success'));
    }
}
