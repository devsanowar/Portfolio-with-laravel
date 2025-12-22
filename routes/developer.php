<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/link', function () {
    Artisan::call('storage:link');
    return 'Storage Link Successfully';
});

Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return 'Optimize Clear!.';
})->name('clear');

Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

Route::get('/migrate', function () {
    if (auth()->check()) {
        Artisan::call('migrate');
        return 'Migration completed successfully!';
    }
    abort(403, 'Unauthorized action.');
})->name('migrate');



// Route::get('/q', function () {
//     $secret = request('linkhigher');

//     $validSecret = 'linkhigher123';

//     if ($secret !== $validSecret) {
//         return response()->json([
//             'error' => 'Invalid secret',
//             'hint' => 'Use ?s=linkhigher123'
//         ], 403);
//     }


//     Artisan::call('queue:work', [
//         '--stop-when-empty' => true,
//         '--timeout' => 30
//     ]);

//     return response()->json([
//         'success' => true,
//         'message' => 'Queue processed',
//         'time' => now()->format('H:i:s')
//     ]);
// });
