use App\Http\Controllers\DashboardController;

Route::get('/customer/{id}/account', [
    'DashboardController::class', 'getCustomerAccount'
]);