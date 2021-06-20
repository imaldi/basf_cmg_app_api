<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;


class FormEGateCheckLoadingUnloadingController extends Controller
{
    public function createEgateForm(Request $request)
    {
        return FormEGateCheck::create([
            ''
        ]);
    }
}
