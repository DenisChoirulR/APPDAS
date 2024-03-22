<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CooperativeContract\CooperativeContractController;
use App\Http\Controllers\Api\Realization\RealizationController;
use App\Http\Controllers\Api\RealizationItem\RealizationItemController;
use App\Http\Controllers\Api\WorkOrder\WorkOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'getUser']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'cooperative-contracts'], function () {
        Route::get('/', [CooperativeContractController::class, 'index']);
        Route::get('/get-all', [CooperativeContractController::class, 'getAll']);
        Route::get('/get-detail', [CooperativeContractController::class, 'show']);
    });

    Route::group(['prefix' => 'work-orders'], function () {
        Route::get('/', [WorkOrderController::class, 'index']);
        Route::get('/get-all', [WorkOrderController::class, 'getAll']);
        Route::get('/{workOrder}', [WorkOrderController::class, 'show']);
        Route::get('/{workOrder}/export', [WorkOrderController::class, 'export']);
    });

    Route::group(['prefix' => 'realizations'], function () {
        Route::get('/get-all', [RealizationController::class, 'getAll']);
        Route::post('/store-image', [RealizationController::class, 'storeImage']);
        Route::get('/{realization}', [RealizationController::class, 'show']);
        Route::post('/{realization}/sync', [RealizationController::class, 'sync']);
        Route::get('/{realization}/export', [RealizationController::class, 'export']);
        Route::get('/{realization}/get-plants', [RealizationController::class, 'getPlants']);
        Route::get('/{realization}/get-planting-statuses', [RealizationController::class, 'getPlantingStatuses']);
    });

    Route::group(['prefix' => 'realization-items'], function () {
        Route::get('/get-all', [RealizationItemController::class, 'getAll']);
        Route::post('/', [RealizationItemController::class, 'store']);
        Route::post('/{realizationItem}', [RealizationItemController::class, 'update']);
    });
});

