<?php

use Illuminate\Support\Facades\Route;
use Molitor\PostCalendar\Http\Controllers\PostCalendarController;

Route::get('/calendar', [PostCalendarController::class, 'index'])->name('post-calendar.index');
Route::get('/calendar/day/{date}', [PostCalendarController::class, 'showDay'])->name('post-calendar.day');
