<?php

Route::prefix('_admin_')->group(function() {
    Auth::routes();
});
