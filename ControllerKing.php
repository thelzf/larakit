<?php

namespace App\Http\Controllers\Gerenciar;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use DateInterval;
use DateTime;
use Date;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class controllerKing extends Controller
{
    private $create;
    private $id;

    public static function day($x)
    {

    }

    public static function more18y($date)
    {

    }

    public static function age($date)
    {

    }

    public static function moreagethan($date,$age)
    {

    }

    public static function formatDate($date,$format)
    {
        // Y-m-d
        // d-m-Y
        // Y/m/d
        // d/m/Y
        // Ymd
        // dmy
        // Y.m.d
        // d.m.Y
    }


    public function create($parametter)
    {
        $this->create = $parametter;
        return $this;
    }

    public function id($id)
    {
        $this->id = $id;
        return $this;
    }



}