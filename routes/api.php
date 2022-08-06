<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\EnsaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\OrientationController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SubModuleController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::domain(env('APP_URL'))->group(function () {
    Route::get('/ensa', [EnsaController::class, 'index']);
    Route::get('/ensa/{id}', [EnsaController::class, 'show']);

    Route::get('/cycle/{id_speciality}', [CycleController::class, 'index']);
    Route::get('/speciality/{id_ensa}', [SpecialityController::class, 'indexFilter']);
    Route::get('/semester/{cycle_id}', [SemesterController::class, 'index']);
    Route::get('/module/semester/{id_semester}', [ModuleController::class, 'indexFilter']);
    Route::get('/module/{id}', [ModuleController::class, 'show']);
    Route::get('/module', [ModuleController::class, 'index']);
    Route::get('/element/{id_module}', [SubModuleController::class, 'index']);
    Route::get('/course/{id_element}/{id_module}', [CourseController::class, 'indexFilter']);

    Route::get('/events/latest', [EventController::class, 'latestEvents']);
    Route::get('/news/latest', [NewsController::class, 'latestNews']);
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{id}', [NewsController::class, 'show']);
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/event/{id}', [EventController::class, 'show']);
    Route::get('/clubs', [ClubController::class, 'index']);
    Route::get('/club/{id}', [ClubController::class, 'show']);
    Route::get('/jobs', [OpportunityController::class, 'indexJobs']);
    Route::get('/internships', [OpportunityController::class, 'indexInternships']);
    Route::get('/orientations/{ensa}/{level}', [OrientationController::class, 'indexFilter']);
    Route::get('/orientations', [OrientationController::class, 'index']);
    Route::get('/website', [WebsiteController::class, 'index']);
    Route::post('/newsletter', [SubscriberController::class, 'store']);
    Route::post('/message', [MessageController::class, 'store']);
    Route::get('/faq', [FAQController::class, 'index']);
    Route::get('/image', [ImageController::class, 'index']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::prefix('admin')->name("admin.")->group(function () {
            Route::apiResource('ensa', EnsaController::class)->except(['index']);
            Route::apiResource('phone', PhoneController::class)->only(["destroy"]);
            Route::apiResource('website', WebsiteController::class)->except(["index"]);
            Route::apiResource('user', UserController::class);
            Route::apiResource('news', NewsController::class);
            Route::apiResource('event', EventController::class);
            Route::apiResource('club', ClubController::class);
            Route::apiResource('faq', FAQController::class);
            Route::apiResource('opportunity', OpportunityController::class);
            Route::apiResource('message', MessageController::class);
            Route::apiResource('subscriber', SubscriberController::class);
            Route::apiResource('orientation', OrientationController::class);

            Route::apiResource('module', ModuleController::class);
            Route::apiResource('element', SubModuleController::class)->except(["index"]);
            Route::apiResource('course', CourseController::class);
            Route::apiResource('speciality', SpecialityController::class);

            Route::post('avatar', [AvatarController::class, "update"]);
            Route::post('image', [ImageController::class, "store"]);

            Route::post('/register', [AuthController::class, 'register']);
        });

        Route::group(['prefix' => 'moderator', 'middleware' => 'isModeratorOfENSA'], function() {
            Route::apiResource('ensa', EnsaController::class)->only([
                "show", "update"
            ]);
            Route::apiResource('event', EventController::class)->only([
                "update", "create"
            ]);
            Route::apiResource('news', NewsController::class)->only([
                "update", "create"
            ]);
            Route::apiResource('club', ClubController::class)->only([
                "update", "create"
            ]);
            Route::apiResource('opportunity', OpportunityController::class)->only([
                "update", "create", "index"
            ]);
        });

        Route::get('/user', function (Request $request) {
            $user = $request->user();
            $user->{"role"} = $user->hasRole("moderator") ? "moderator" : "admin";
            return $user;
        });
    });
});
