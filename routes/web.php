<?php

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RiskController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UpdatesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/change-language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(404);
    }

    App::setLocale($locale);
    // Session
    session()->put('locale', $locale);

    return redirect()->back();
})->name('locale.setting');
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('landing');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/calender', [HomeController::class, 'calender'])->name('calender');
Route::get('/reports', [HomeController::class, 'reports'])->name('reports');

Route::resource('goals', GoalController::class);

Route::resource('departments', DepartmentController::class);


Route::resource('plans', PlanController::class);
Route::get('/plans/{plan}/favorite', [PlanController::class, 'favorite'])->name('plans.favorite');
Route::get('/plans/{plan}/mark_as_read', [PlanController::class, 'read'])->name('plans.mark_as_read');

Route::get('tasks/mytasks', [TaskController::class, 'mytasks'])->name('tasks.mytasks');
Route::resource('tasks', TaskController::class);
Route::get('tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

Route::resource('risk', RiskController::class);
Route::get('risk/{risk}/complete', [RiskController::class, 'complete'])->name('risk.complete');



Route::resource('update', UpdatesController::class);


Route::resource('criteria', CriteriaController::class);
Route::post('criteria/complete', [CriteriaController::class, 'complete'])->name('criteria.complete');


Route::get('/reports/plans', [ReportsController::class, 'plans'])->name('reports.plans');
Route::get('/reports/goals', [ReportsController::class, 'goals'])->name('reports.goals');
Route::get('/reports/tasks', [ReportsController::class, 'tasks'])->name('reports.tasks');
Route::get('/reports/slaks', [ReportsController::class, 'slaks'])->name('reports.slaks');


Route::resource('user', UserController::class);


Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::post('/settings/change_department', [SettingsController::class, 'change_dept'])->name('settings.change_dept');
Route::post('/settings/store_department', [SettingsController::class, 'store_department'])->name('settings.store_department');
