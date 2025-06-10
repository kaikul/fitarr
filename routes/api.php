<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('users',UserController::class);

    
    Route::apiResource('users', UserController::class);
    
    // User Settings
    Route::prefix('users/{user}')->group(function () {
        Route::get('settings', [UserSettingController::class, 'show']);
        Route::put('settings', [UserSettingController::class, 'update']);
        Route::patch('settings', [UserSettingController::class, 'update']);
    });
    
  
    Route::prefix('groups')->group(function () {
        Route::get('/', [GroupController::class, 'index']);
        Route::post('/', [GroupController::class, 'store']);
        Route::get('{group}', [GroupController::class, 'show']);
        Route::put('{group}', [GroupController::class, 'update']);
        Route::delete('{group}', [GroupController::class, 'destroy']);
        
        // Group Members
        Route::get('{group}/members', [GroupController::class, 'members']);
        Route::post('{group}/members/{user}', [GroupController::class, 'addMember']);
        Route::delete('{group}/members/{user}', [GroupController::class, 'removeMember']);
    });
 
    //workouts
    Route::apiResource('workout-sections', WorkoutSectionController::class);
    Route::put('workout-sections/{workoutSection}/complete', [WorkoutSectionController::class, 'markComplete']);
    
   
    Route::apiResource('exercises', ExerciseController::class);
    
    // Exercises within a workout section
    Route::apiResource('workout-sections.exercises', ExerciseController::class)->shallow();
    
    // Exercise completion and performance tracking
    Route::prefix('exercises/{exercise}')->group(function () {
        Route::put('complete', [ExerciseController::class, 'markComplete']);
        Route::put('performance', [ExerciseController::class, 'updatePerformance']);
        Route::get('history', [ExerciseController::class, 'performanceHistory']);
    });
    
 
    Route::apiResource('exercise-sets', ExerciseSetController::class);
    
    // Exercise sets within an exercise
    Route::apiResource('exercises.exercise-sets', ExerciseSetController::class)->shallow();
    
    // Exercise set management
    Route::prefix('exercise-sets/{exerciseSet}')->group(function () {
        Route::put('reorder', [ExerciseSetController::class, 'reorder']);
        Route::post('duplicate', [ExerciseSetController::class, 'duplicate']);
    });
    
    
    Route::prefix('food')->group(function () {
        Route::apiResource('logs', FoodLogController::class);
        Route::get('daily-summary/{date?}', [FoodLogController::class, 'dailySummary']);
        Route::get('weekly-summary/{date?}', [FoodLogController::class, 'weeklySummary']);
        Route::get('monthly-summary/{date?}', [FoodLogController::class, 'monthlySummary']);
        Route::get('search', [FoodLogController::class, 'searchFood']);
    });
    
  
    Route::prefix('integrations')->group(function () {
        Route::get('/', [UserIntegrationController::class, 'index']);
        
        // Apple Health Integration
        Route::prefix('apple-health')->group(function () {
            Route::post('connect', [UserIntegrationController::class, 'connectAppleHealth']);
            Route::delete('disconnect', [UserIntegrationController::class, 'disconnectAppleHealth']);
            Route::post('sync', [UserIntegrationController::class, 'syncAppleHealth']);
            Route::get('status', [UserIntegrationController::class, 'appleHealthStatus']);
        });
        
        // Garmin Integration
        Route::prefix('garmin')->group(function () {
            Route::post('connect', [UserIntegrationController::class, 'connectGarmin']);
            Route::delete('disconnect', [UserIntegrationController::class, 'disconnectGarmin']);
            Route::post('sync', [UserIntegrationController::class, 'syncGarmin']);
            Route::get('status', [UserIntegrationController::class, 'garminStatus']);
        });
        
        // Fitbit Integration
        Route::prefix('fitbit')->group(function () {
            Route::post('connect', [UserIntegrationController::class, 'connectFitbit']);
            Route::delete('disconnect', [UserIntegrationController::class, 'disconnectFitbit']);
            Route::post('sync', [UserIntegrationController::class, 'syncFitbit']);
            Route::get('status', [UserIntegrationController::class, 'fitbitStatus']);
        });
        
        // Strava Integration
        Route::prefix('strava')->group(function () {
            Route::post('connect', [UserIntegrationController::class, 'connectStrava']);
            Route::delete('disconnect', [UserIntegrationController::class, 'disconnectStrava']);
            Route::post('sync', [UserIntegrationController::class, 'syncStrava']);
            Route::get('status', [UserIntegrationController::class, 'stravaStatus']);
        });
        
        // Google Fit Integration
        Route::prefix('google-fit')->group(function () {
            Route::post('connect', [UserIntegrationController::class, 'connectGoogleFit']);
            Route::delete('disconnect', [UserIntegrationController::class, 'disconnectGoogleFit']);
            Route::post('sync', [UserIntegrationController::class, 'syncGoogleFit']);
            Route::get('status', [UserIntegrationController::class, 'googleFitStatus']);
        });
        
        // Sync operations
        Route::post('sync-all', [UserIntegrationController::class, 'syncAll']);
        Route::put('{integration}/frequency', [UserIntegrationController::class, 'updateSyncFrequency']);
    });
    
    
    Route::prefix('sync-logs')->group(function () {
        Route::get('/', [IntegrationSyncLogController::class, 'index']);
        Route::get('recent', [IntegrationSyncLogController::class, 'recent']);
        Route::get('by-type/{syncType}', [IntegrationSyncLogController::class, 'byType']);
        Route::get('errors', [IntegrationSyncLogController::class, 'errors']);
    });
    
   
    Route::prefix('tracking')->group(function () {
        Route::apiResource('entries', TrackingEntryController::class);
        
        // Calories In tracking
        Route::prefix('calories-in')->group(function () {
            Route::get('/', [TrackingEntryController::class, 'caloriesIn']);
            Route::post('/', [TrackingEntryController::class, 'storeCaloriesIn']);
            Route::get('daily/{date?}', [TrackingEntryController::class, 'dailyCaloriesIn']);
            Route::get('weekly/{date?}', [TrackingEntryController::class, 'weeklyCaloriesIn']);
            Route::get('monthly/{date?}', [TrackingEntryController::class, 'monthlyCaloriesIn']);
        });
        
        // Calories Out tracking
        Route::prefix('calories-out')->group(function () {
            Route::get('/', [TrackingEntryController::class, 'caloriesOut']);
            Route::post('/', [TrackingEntryController::class, 'storeCaloriesOut']);
            Route::get('daily/{date?}', [TrackingEntryController::class, 'dailyCaloriesOut']);
            Route::get('weekly/{date?}', [TrackingEntryController::class, 'weeklyCaloriesOut']);
            Route::get('monthly/{date?}', [TrackingEntryController::class, 'monthlyCaloriesOut']);
        });
        
        // Weight tracking
        Route::prefix('weight')->group(function () {
            Route::get('/', [TrackingEntryController::class, 'weight']);
            Route::post('/', [TrackingEntryController::class, 'storeWeight']);
            Route::get('latest', [TrackingEntryController::class, 'latestWeight']);
            Route::get('history', [TrackingEntryController::class, 'weightHistory']);
            Route::get('chart/{period?}', [TrackingEntryController::class, 'weightChart']);
        });
        
        // Body measurements tracking
        Route::prefix('measurements')->group(function () {
            Route::get('/', [TrackingEntryController::class, 'measurements']);
            Route::post('/', [TrackingEntryController::class, 'storeMeasurement']);
            Route::get('latest', [TrackingEntryController::class, 'latestMeasurements']);
            Route::get('history/{measurementType?}', [TrackingEntryController::class, 'measurementHistory']);
            Route::get('chart/{measurementType}/{period?}', [TrackingEntryController::class, 'measurementChart']);
        });
        
        // Photo progress tracking
        Route::prefix('photos')->group(function () {
            Route::get('/', [TrackingEntryController::class, 'photos']);
            Route::post('/', [TrackingEntryController::class, 'storePhoto']);
            Route::delete('{entry}', [TrackingEntryController::class, 'deletePhoto']);
            Route::get('comparison/{startDate}/{endDate}', [TrackingEntryController::class, 'photoComparison']);
        });
        
        // Dashboard and summaries
        Route::get('dashboard', [TrackingEntryController::class, 'dashboard']);
        Route::get('summary/{date?}', [TrackingEntryController::class, 'dailySummary']);
    });
    
   
    Route::prefix('workouts')->group(function () {
        // Workout sessions (based on WorkoutSection completion tracking)
        Route::get('active', [WorkoutController::class, 'activeWorkouts']);
        Route::get('completed', [WorkoutController::class, 'completedWorkouts']);
        Route::get('scheduled', [WorkoutController::class, 'scheduledWorkouts']);
        
        // Workout templates and planning
        Route::apiResource('templates', WorkoutTemplateController::class);
        Route::post('templates/{template}/clone', [WorkoutTemplateController::class, 'clone']);
        
        // Workout session management
        Route::post('start', [WorkoutController::class, 'startWorkout']);
        Route::put('{workoutSection}/complete', [WorkoutController::class, 'completeWorkout']);
        Route::put('{workoutSection}/pause', [WorkoutController::class, 'pauseWorkout']);
        Route::put('{workoutSection}/resume', [WorkoutController::class, 'resumeWorkout']);
        
        // Workout history and analytics
        Route::get('history', [WorkoutController::class, 'history']);
        Route::get('stats', [WorkoutController::class, 'stats']);
        Route::get('{workoutSection}/details', [WorkoutController::class, 'workoutDetails']);
    });
    
   
    Route::prefix('schedule')->group(function () {
        Route::get('calendar/{year?}/{month?}', [ScheduleController::class, 'calendar']);
        Route::get('today', [ScheduleController::class, 'today']);
        Route::get('upcoming', [ScheduleController::class, 'upcoming']);
        Route::get('week/{date?}', [ScheduleController::class, 'week']);
        
        // Schedule management
        Route::post('workout', [ScheduleController::class, 'scheduleWorkout']);
        Route::put('workout/{scheduleId}', [ScheduleController::class, 'updateSchedule']);
        Route::delete('workout/{scheduleId}', [ScheduleController::class, 'deleteSchedule']);
        Route::post('workout/{scheduleId}/reschedule', [ScheduleController::class, 'reschedule']);
    });
    
    Route::prefix('analytics')->group(function () {
        Route::get('overview', [AnalyticsController::class, 'overview']);
        Route::get('progress', [AnalyticsController::class, 'progressSummary']);
        Route::get('workout-performance', [AnalyticsController::class, 'workoutPerformance']);
        Route::get('nutrition-trends', [AnalyticsController::class, 'nutritionTrends']);
        Route::get('body-composition', [AnalyticsController::class, 'bodyComposition']);
        Route::get('integration-sync-status', [AnalyticsController::class, 'integrationSyncStatus']);
        Route::get('exercise-performance/{exerciseId?}', [AnalyticsController::class, 'exercisePerformance']);
    });
    
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::get('sync-logs/stats', [AdminController::class, 'syncLogStats']);
        Route::post('sync-all-users', [AdminController::class, 'syncAllUsers']);
        Route::get('system-health', [AdminController::class, 'systemHealth']);
    });
    
 
    Route::prefix('utilities')->group(function () {
        Route::post('export-data', [UtilityController::class, 'exportUserData']);
        Route::get('health-check', [UtilityController::class, 'healthCheck']);
        Route::post('cleanup-orphaned-records', [UtilityController::class, 'cleanupOrphanedRecords']);
    });