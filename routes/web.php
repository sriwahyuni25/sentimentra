<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TestDataController;
use App\Http\Controllers\TrainDataController;
use App\Http\Controllers\WordcloudController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login.index');
});
Route::get('/singleanalysis', function (){
    return view('admin.singleanalysis.index', ['sentiment' => null,'text' => null]);
});

Route::get('/batch-analysis', function (){
    return view('admin.batchanalysis.index', ['sentiment' => null,'text' => null]);
});

Route::post('/fileanalysis', function (){
    return view('admin.batchanalysis.index', ['sentiment' => null,'text' => null]);
});

Route::get('/history-analysis', [AnalysisController::class, 'historyAnalysis']);

// Route::get('/datatrain', function (){
//     return view('admin.datatrain.index', ['sentiment' => null,'text' => null]);
// });


Route::get('/admin/testdata', [TestDataController::class, 'index'])->name('admin.testdata.index');
Route::get('/download-test-data', [TestDataController::class, 'downloadTestData'])->name('downloadTestData');

Route::get('/admin/traindata', [TrainDataController::class, 'index'])->name('admin.traindata.index');

// Route::post('/wordcloud/process', 'WordCloudController@process')->name('wordcloud.process');

Route::post('/batch-analysiscreate', [AnalysisController::class,'batchAnalysis']);

Route::post('/textanalysis', [AnalysisController::class,'singleAnalysis']);

// Route::get('/batchanalysis', [CobaController::class,'index']);
// Route::post('/batchanalysis', [CobaController::class,'tambah']);
Route::get('/historyanalysis', [AnalysisController::class, 'showData'])->name('show.data');
Route::delete('/historyanalysisdel/delete/{id}', [AnalysisController::class, 'deleteData'])->name('delete.data');
Route::get('/historyanalysisdel/falsestatus/{id}', [AnalysisController::class, 'falsestatus'])->name('false.status');
Route::get('/historyanalysisdel/truestatus/{id}', [AnalysisController::class, 'truestatus'])->name('true.status');
// Route::get('/historyanalysis', function (){
//     return view('admin.historyanalysis.index');
// });

Route::get('/import-csv', [ImportController::class, 'importCsv']);


Route::get('/wordcloudviews', [WordcloudController::class,'index']);

Route::post('/wordcloudaction', [WordcloudController::class,'wordcloudAction'] );

Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::put('/profil/update', [ProfilController::class, 'update'])->name('profile.update');
Route::middleware('auth')->group(function () {
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', LogoutController::class)->name('auth.logout');

Route::middleware(['auth'])->group(function () {
});
Route::get('/dashboard-sentimentra', [DashboardController::class,'admin']);


// Public routes

Route::middleware('public')->group(function () {
    Route::get('/single-analysis', [AnalysisController::class, 'single'])->name('single.analysis');
    // Route::get('/batch-analysis', [AnalysisController::class, 'batch'])->name('batch.analysis');
    Route::get('/wordcloud', [WordcloudController::class, 'index'])->name('wordcloud');
});


Route::middleware('admin')->group(function () {
    Route::get('/history', [AnalysisController::class, 'index'])->name('history');
    Route::get('/testData', [TestDataController::class, 'testData'])->name('test.data');
    Route::get('/trainData', [TrainDataController::class, 'trainData'])->name('train.data');
    Route::get('/profile', [ProfilController::class, 'show'])->name('profile.show');
    Route::post('/profile/edit', [ProfilController::class, 'edit'])->name('profile.edit');
});

Route::get('/test', [DashboardController::class, 'testaja']);
Route::post('/admin/test', [DashboardController::class, 'test']);
Route::post('/addtotestdata', [HistoryController::class, 'addToTestData']);
Route::post('/deletefromtestdata/{id}', [HistoryController::class, 'deleteFromTestData']);
Route::post('/deleteTestData/{id}', [TestDataController::class, 'delete']);
Route::get('/guest-dashboard',[DashboardController::class,'guest'])->name('guest.index');
Route::post('/guest/single-analysis',[DashboardController::class,'singleAnalysis']);
Route::post('/guest/batch-analysis',[DashboardController::class,'batchAnalysis']);



