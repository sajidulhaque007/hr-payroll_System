<?php

use Illuminate\Support\Facades\DB;
use App\Models\Employee;
        function employees(){
             return App\Models\Employee::select('id','name','code')->get();
        }









