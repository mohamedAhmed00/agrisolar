<?php

Route::prefix('_admin_')->group(function() {
    Auth::routes();
});


Route::get('convert', function(){
    return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\CustomerExport(), 'customer2.xlsx');
});
