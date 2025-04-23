<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\F1Controller;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FantasyTeamController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\DriverStatsController;
use App\Http\Controllers\CommentController;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('forums', ForumController::class);

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/allUsers', [ProfileController::class, 'allUsers']);
    Route::patch('/users/{id}/updateAdmin', [ProfileController::class, 'updateAdmin'])->name('users.updateAdmin');
});
Route::get('/upload', [ImageController::class, 'create']);
 Route::post('/upload', [ImageController::class, 'store'])->name('image.store');
  Route::get('/gallery', [ImageController::class, 'index']);
   Route::get('/image/{id}', [ImageController::class, 'show']);
Route::post('/gallery', [ImageController::class, 'index']);
Route::get('/insertTeam',[TeamController::class,'insert']);
 Route::post('/createTeam',[TeamController::class,'create']);
 Route::get('/editTeam/{id}', [TeamController::class, 'edit'])->name('team.edit');
 Route::patch('/editTeam/{id}', [TeamController::class, 'update'])->name('team.update');

// Forum Routes
Route::resource('forums', ForumController::class); // Full CRUD for forums
Route::post('/forums/{postId}/comment', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::get('/editForum/{id}', [ForumController::class, 'edit'])->name('forum.edit');
Route::patch('/editTeam/{id}', [ForumController::class, 'update'])->name('forum.update');
Route::get('/createForum', [ForumController::class, 'insert'])->name('forum.insert');
Route::get('/forums', [ForumController::class, 'index'])->name('forum.index');

// Driver Stats Routes
Route::prefix('driverstats')->group(function () {
    Route::get('/', [DriverStatsController::class, 'index']);
    Route::get('/{id}', [DriverStatsController::class, 'show']);
    Route::post('/', [DriverStatsController::class, 'store']);
    Route::put('/{id}', [DriverStatsController::class, 'update']);
    Route::delete('/{id}', [DriverStatsController::class, 'destroy']);
});

// Drivers Routes
Route::resource('drivers', DriverController::class); // Full CRUD for drivers
Route::get('/editDriver/{id}', [DriverController::class, 'edit'])->name('driver.edit');
Route::patch('/editDriver/{id}', [DriverController::class, 'update'])->name('driver.update');
Route::get('/editDriver/{id}', [DriverController::class, 'edit'])->name('driver.edit');

// Teams Routes
Route::resource('teams', TeamController::class); // Full CRUD for teams
Route::get('/editTeam/{id}',[TeamController::class,'edit'])->name('team.update');

// Fantasy Team Routes
Route::prefix('fantasy-team')->group(function () {
    Route::get('/', [FantasyTeamController::class, 'showTeam'])->name('fantasy.show');
    Route::post('/add-driver', [FantasyTeamController::class, 'addDriverToTeam']);
    Route::post('/add-team', [FantasyTeamController::class, 'addTeamToLeague']);
    Route::get('/add-team', [FantasyTeamController::class, 'showAddTeamForm']);
    Route::post('/remove-driver', [FantasyTeamController::class, 'removeDriverFromTeam'])->name('fantasy.remove-driver');
    Route::post('/remove-team', [FantasyTeamController::class, 'removeTeamFromLeague'])->name('fantasy.remove-team');
    Route::get('/{id}/points', [FantasyTeamController::class, 'calculatePoints']);
});

// Fantasy League Routes
Route::prefix('fantasy')->group(function () {
    Route::get('/', [FantasyTeamController::class, 'index']);
    Route::get('/create', [FantasyTeamController::class, 'create']);
    Route::post('/store', [FantasyTeamController::class, 'store']);
});

// Leaderboard Route
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

// Admin Routes (Requires Admin Middleware)
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/points', [FantasyTeamController::class, 'editPoints']);
    Route::post('/admin/points', [FantasyTeamController::class, 'updatePoints']);

// Images Routes
Route::resource('images', ImageController::class); // Full CRUD for images

// F1 Routes
Route::prefix('f1')->group(function () {
    Route::get('/', [F1Controller::class, 'getF1Data']);
    Route::get('/{driverId}', [F1Controller::class, 'getF1Data']);
});

// Authentication Routes
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

// Session Test Route (Debugging)
Route::get('/store-session', function () {
    session(['key' => 'value']);
    return 'Session key has been stored!';
});
Route::delete('/forums/{id}', [ForumController::class, 'destroy'])->name('forum.destroy');

// Include Laravel's Authentication Routes
require __DIR__ . '/auth.php';

