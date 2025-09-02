<?php

namespace Ravenna\AirefsAnalytics\Http\Controllers;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController as BaseCpController;

class ArCpController extends BaseCpController
{

    public function index()
    {
        return view('airefs-analytics::index');
    }

}
