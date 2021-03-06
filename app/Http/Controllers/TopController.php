<?php

namespace App\Http\Controllers;

use App\Utils\CalcDistance;
use App\Utils\Upload;
use Illuminate\Http\Request;
use App\Live;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Log;
use Illuminate\Support\Facades\DB;

// CreateLiveで設定したバリデーションをよみこむ
use App\Http\Requests\CreateLive;

class TopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    // top画面を 表示させる
    public function top()
    {
        //ライブ一覧で表示
        return view('welcome');
    }
}
