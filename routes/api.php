<?php

use App\Http\Controllers\Api\HomePageContrller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/homepage',[HomePageContrller::class,'index']);
