<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/* Public Routes */

Route::get('crm-login', function () {
    // return redirect(route('login'));

    return View::make('my-crm::auth.login');
})->name('my-crm.login');

// Route::post('crm-login', function () {
//     //
// });
Route::post('crm-login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('laravel-crm.login');
Route::post('crm-logout', function () {
    //
})->name('laravel-crm.logout');

Route::get('crm-register', function () {
    return redirect(route('register'));
})->name('laravel-crm.register');

Route::post('crm-register', function () {
    //
});

Route::get('crm-password/reset', function () {
    //
})->name('laravel-crm.password.request');

Route::post('crm-password/email', function () {
    //
});

Route::get('crm-password/reset/{token}', function () {
    //
})->name('laravel-crm.password.reset');

Route::post('crm-password/reset', function () {
    //
})->name('laravel-crm.password.update');

Route::get('crm-password/confirm', function () {
    //
})->name('laravel-crm.password.confirm');

Route::get('crm-password/confirm', function () {
    //
});

Route::group(['prefix' => 'p'], function () {
    Route::prefix('quotes')->group(function () {
        Route::get('{quote:external_id}', 'Kv\MyCrm\Http\Controllers\Portal\QuoteController@show')
            ->name('laravel-crm.portal.quotes.show');

        Route::post('{quote:external_id}', 'Kv\MyCrm\Http\Controllers\Portal\QuoteController@process')
            ->name('laravel-crm.portal.quotes.process');
    });

    Route::prefix('invoices')->group(function () {
        Route::get('{invoice:external_id}', 'Kv\MyCrm\Http\Controllers\Portal\InvoiceController@show')
            ->name('laravel-crm.portal.invoices.show');

        Route::post('{invoice:external_id}', 'Kv\MyCrm\Http\Controllers\Portal\InvoiceController@process')
            ->name('laravel-crm.portal.invoices.process');
    });
});

/* Private Routes */

/* Dashboard */

Route::get('/', 'Kv\MyCrm\Http\Controllers\DashboardController@index')
    ->middleware('auth.my-crm')
    ->name('laravel-crm.dashboard');

/* Leads */

Route::group(['prefix' => 'leads','middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\LeadController@index')
        ->name('laravel-crm.leads.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Lead']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\LeadController@search')
        ->name('laravel-crm.leads.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Lead']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\LeadController@index')
        ->name('laravel-crm.leads.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Lead']);

    Route::get('list', 'Kv\MyCrm\Http\Controllers\LeadController@list')
        ->name('laravel-crm.leads.list')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Lead']);

    Route::get('board', 'Kv\MyCrm\Http\Controllers\LeadController@board')
        ->name('laravel-crm.leads.board')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Lead']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\LeadController@create')
        ->name('laravel-crm.leads.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Lead']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\LeadController@store')
        ->name('laravel-crm.leads.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Lead']);

    Route::get('{lead}', 'Kv\MyCrm\Http\Controllers\LeadController@show')
        ->name('laravel-crm.leads.show')
        ->middleware(['can:view,lead']);

    Route::get('{lead}/edit', 'Kv\MyCrm\Http\Controllers\LeadController@edit')
        ->name('laravel-crm.leads.edit')
        ->middleware(['can:update,lead']);

    Route::put('{lead}', 'Kv\MyCrm\Http\Controllers\LeadController@update')
        ->name('laravel-crm.leads.update')
        ->middleware(['can:update,lead']);

    Route::delete('{lead}', 'Kv\MyCrm\Http\Controllers\LeadController@destroy')
        ->name('laravel-crm.leads.destroy')
        ->middleware(['can:delete,lead']);

    Route::get('{lead}/convert', 'Kv\MyCrm\Http\Controllers\LeadController@convertToDeal')
        ->name('laravel-crm.leads.convert-to-deal')
        ->middleware(['can:update,lead']);

    Route::post('{lead}/convert', 'Kv\MyCrm\Http\Controllers\LeadController@storeAsDeal')
        ->name('laravel-crm.leads.store-as-deal')
        ->middleware(['can:update,lead']);
});

/* Deals */

Route::group(['prefix' => 'deals', 'middleware' => 'auth.my-crm'], function () {
    Route::get('create-product', 'Kv\MyCrm\Http\Controllers\DealProductController@createProduct')
        ->name('laravel-crm.deal-products.create-product');

    Route::any('filter', 'Kv\MyCrm\Http\Controllers\DealController@index')
        ->name('laravel-crm.deals.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Deal']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\DealController@search')
        ->name('laravel-crm.deals.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Deal']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\DealController@index')
        ->name('laravel-crm.deals.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Deal']);

    Route::get('list', 'Kv\MyCrm\Http\Controllers\DealController@list')
        ->name('laravel-crm.deals.list')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Deal']);

    Route::get('board', 'Kv\MyCrm\Http\Controllers\DealController@board')
        ->name('laravel-crm.deals.board')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Deal']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\DealController@create')
        ->name('laravel-crm.deals.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Deal']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\DealController@store')
        ->name('laravel-crm.deals.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Deal']);

    Route::get('{deal}', 'Kv\MyCrm\Http\Controllers\DealController@show')
        ->name('laravel-crm.deals.show')
        ->middleware(['can:view,deal']);

    Route::get('{deal}/edit', 'Kv\MyCrm\Http\Controllers\DealController@edit')
        ->name('laravel-crm.deals.edit')
        ->middleware(['can:update,deal']);

    Route::put('{deal}', 'Kv\MyCrm\Http\Controllers\DealController@update')
        ->name('laravel-crm.deals.update')
        ->middleware(['can:update,deal']);

    Route::delete('{deal}', 'Kv\MyCrm\Http\Controllers\DealController@destroy')
        ->name('laravel-crm.deals.destroy')
        ->middleware(['can:delete,deal']);

    Route::get('{deal}/won', 'Kv\MyCrm\Http\Controllers\DealController@won')
        ->name('laravel-crm.deals.won')
        ->middleware(['can:update,deal']);

    Route::get('{deal}/lost', 'Kv\MyCrm\Http\Controllers\DealController@lost')
        ->name('laravel-crm.deals.lost')
        ->middleware(['can:update,deal']);

    Route::get('{deal}/reopen', 'Kv\MyCrm\Http\Controllers\DealController@reopen')
        ->name('laravel-crm.deals.reopen')
        ->middleware(['can:update,deal']);

    /* Deal Products */

    Route::group(['prefix' => '{deal}/products', 'middleware' => 'auth.my-crm'], function () {
        Route::get('', 'Kv\MyCrm\Http\Controllers\DealProductController@index')
            ->name('laravel-crm.deal-products.index');

        Route::get('create', 'Kv\MyCrm\Http\Controllers\DealProductController@create')
            ->name('laravel-crm.deal-products.create');

        Route::post('', 'Kv\MyCrm\Http\Controllers\DealProductController@store')
            ->name('laravel-crm.deal-products.store');

        Route::get('{product}', 'Kv\MyCrm\Http\Controllers\DealProductController@show')
            ->name('laravel-crm.deal-products.show');

        Route::get('{product}/edit', 'Kv\MyCrm\Http\Controllers\DealProductController@edit')
            ->name('laravel-crm.deal-products.edit');

        Route::put('{product}', 'Kv\MyCrm\Http\Controllers\DealProductController@update')
            ->name('laravel-crm.deal-products.update');

        Route::delete('{product}', 'Kv\MyCrm\Http\Controllers\DealProductController@destroy')
            ->name('laravel-crm.deal-products.destroy');
    });
});

/* Quotes */

Route::group(['prefix' => 'quotes', 'middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\QuoteController@index')
        ->name('laravel-crm.quotes.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Quote']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\QuoteController@search')
        ->name('laravel-crm.quotes.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Quote']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\QuoteController@index')
        ->name('laravel-crm.quotes.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Quote']);

    Route::get('list', 'Kv\MyCrm\Http\Controllers\QuoteController@list')
        ->name('laravel-crm.quotes.list')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Quote']);

    Route::get('board', 'Kv\MyCrm\Http\Controllers\QuoteController@board')
        ->name('laravel-crm.quotes.board')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Quote']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\QuoteController@create')
        ->name('laravel-crm.quotes.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Quote']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\QuoteController@store')
        ->name('laravel-crm.quotes.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Quote']);

    Route::get('{quote}', 'Kv\MyCrm\Http\Controllers\QuoteController@show')
        ->name('laravel-crm.quotes.show')
        ->middleware(['can:view,quote']);

    Route::get('{quote}/edit', 'Kv\MyCrm\Http\Controllers\QuoteController@edit')
        ->name('laravel-crm.quotes.edit')
        ->middleware(['can:update,quote']);

    Route::put('{quote}', 'Kv\MyCrm\Http\Controllers\QuoteController@update')
        ->name('laravel-crm.quotes.update')
        ->middleware(['can:update,quote']);

    Route::delete('{quote}', 'Kv\MyCrm\Http\Controllers\QuoteController@destroy')
        ->name('laravel-crm.quotes.destroy')
        ->middleware(['can:delete,quote']);

    Route::get('{quote}/accept', 'Kv\MyCrm\Http\Controllers\QuoteController@accept')
        ->name('laravel-crm.quotes.accept')
        ->middleware(['can:update,quote']);

    Route::get('{quote}/reject', 'Kv\MyCrm\Http\Controllers\QuoteController@reject')
        ->name('laravel-crm.quotes.reject')
        ->middleware(['can:update,quote']);

    Route::get('{quote}/unaccept', 'Kv\MyCrm\Http\Controllers\QuoteController@unaccept')
        ->name('laravel-crm.quotes.unaccept')
        ->middleware(['can:update,quote']);

    Route::get('{quote}/unreject', 'Kv\MyCrm\Http\Controllers\QuoteController@unreject')
        ->name('laravel-crm.quotes.unreject')
        ->middleware(['can:update,quote']);

    Route::post('{quote}/send', 'Kv\MyCrm\Http\Controllers\QuoteController@send')
        ->name('laravel-crm.quotes.send')
        ->middleware(['can:update,quote']);

    Route::get('{quote}/download', 'Kv\MyCrm\Http\Controllers\QuoteController@download')
        ->name('laravel-crm.quotes.download')
        ->middleware(['can:view,quote']);

    /* Quote Products */

    Route::group(['prefix' => '{quote}/products', 'middleware' => 'auth.my-crm'], function () {
        Route::get('', 'Kv\MyCrm\Http\Controllers\QuoteProductController@index')
            ->name('laravel-crm.quote-products.index');

        Route::get('create', 'Kv\MyCrm\Http\Controllers\QuoteProductController@create')
            ->name('laravel-crm.quote-products.create');

        Route::post('', 'Kv\MyCrm\Http\Controllers\QuoteProductController@store')
            ->name('laravel-crm.quote-products.store');

        Route::get('{product}', 'Kv\MyCrm\Http\Controllers\QuoteProductController@show')
            ->name('laravel-crm.quote-products.show');

        Route::get('{product}/edit', 'Kv\MyCrm\Http\Controllers\QuoteProductController@edit')
            ->name('laravel-crm.quote-products.edit');

        Route::put('{product}', 'Kv\MyCrm\Http\Controllers\QuoteProductController@update')
            ->name('laravel-crm.quote-products.update');

        Route::delete('{product}', 'Kv\MyCrm\Http\Controllers\QuoteProductController@destroy')
            ->name('laravel-crm.quote-products.destroy');
    });
});

/* Orders */

Route::group(['prefix' => 'orders', 'middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\OrderController@index')
        ->name('laravel-crm.orders.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Order']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\OrderController@search')
        ->name('laravel-crm.orders.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Order']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\OrderController@index')
        ->name('laravel-crm.orders.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Order']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\OrderController@create')
        ->name('laravel-crm.orders.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Order']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\OrderController@store')
        ->name('laravel-crm.orders.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Order']);

    Route::get('{order}', 'Kv\MyCrm\Http\Controllers\OrderController@show')
        ->name('laravel-crm.orders.show')
        ->middleware(['can:view,order']);

    Route::get('{order}/edit', 'Kv\MyCrm\Http\Controllers\OrderController@edit')
        ->name('laravel-crm.orders.edit')
        ->middleware(['can:update,order']);

    Route::put('{order}', 'Kv\MyCrm\Http\Controllers\OrderController@update')
        ->name('laravel-crm.orders.update')
        ->middleware(['can:update,order']);

    Route::delete('{order}', 'Kv\MyCrm\Http\Controllers\OrderController@destroy')
        ->name('laravel-crm.orders.destroy')
        ->middleware(['can:delete,order']);

    Route::get('{order}/create-delivery', 'Kv\MyCrm\Http\Controllers\OrderController@createDelivery')
        ->name('laravel-crm.orders.create-delivery')
        ->middleware(['can:update,order', 'can:create,Kv\MyCrm\Models\Order']);

    Route::get('{order}/download', 'Kv\MyCrm\Http\Controllers\OrderController@download')
        ->name('laravel-crm.orders.download')
        ->middleware(['can:view,order']);

    /* Order Products */

    Route::group(['prefix' => '{order}/products', 'middleware' => 'auth.my-crm'], function () {
        Route::get('', 'Kv\MyCrm\Http\Controllers\OrderProductController@index')
            ->name('laravel-crm.order-products.index');

        Route::get('create', 'Kv\MyCrm\Http\Controllers\OrderProductController@create')
            ->name('laravel-crm.order-products.create');

        Route::post('', 'Kv\MyCrm\Http\Controllers\OrderProductController@store')
            ->name('laravel-crm.order-products.store');

        Route::get('{product}', 'Kv\MyCrm\Http\Controllers\OrderProductController@show')
            ->name('laravel-crm.order-products.show');

        Route::get('{product}/edit', 'Kv\MyCrm\Http\Controllers\OrderProductController@edit')
            ->name('laravel-crm.order-products.edit');

        Route::put('{product}', 'Kv\MyCrm\Http\Controllers\OrderProductController@update')
            ->name('laravel-crm.order-products.update');

        Route::delete('{product}', 'Kv\MyCrm\Http\Controllers\OrderProductController@destroy')
            ->name('laravel-crm.order-products.destroy');
    });
});

/* Invoices */

Route::group(['prefix' => 'invoices', 'middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\InvoiceController@index')
        ->name('laravel-crm.invoices.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Invoice']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\InvoiceController@search')
        ->name('laravel-crm.invoices.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Invoice']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\InvoiceController@index')
        ->name('laravel-crm.invoices.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Invoice']);

    Route::get('create/{model?}/{id?}', 'Kv\MyCrm\Http\Controllers\InvoiceController@create')
        ->name('laravel-crm.invoices.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Invoice']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\InvoiceController@store')
        ->name('laravel-crm.invoices.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Invoice']);

    Route::get('{invoice}', 'Kv\MyCrm\Http\Controllers\InvoiceController@show')
        ->name('laravel-crm.invoices.show')
        ->middleware(['can:view,invoice']);

    Route::get('{invoice}/edit', 'Kv\MyCrm\Http\Controllers\InvoiceController@edit')
        ->name('laravel-crm.invoices.edit')
        ->middleware(['can:update,invoice']);

    Route::put('{invoice}', 'Kv\MyCrm\Http\Controllers\InvoiceController@update')
        ->name('laravel-crm.invoices.update')
        ->middleware(['can:update,invoice']);

    Route::delete('{invoice}', 'Kv\MyCrm\Http\Controllers\InvoiceController@destroy')
        ->name('laravel-crm.invoices.destroy')
        ->middleware(['can:delete,invoice']);

    Route::post('{invoice}/send', 'Kv\MyCrm\Http\Controllers\InvoiceController@send')
        ->name('laravel-crm.invoices.send')
        ->middleware(['can:update,invoice']);

    Route::post('{invoice}/pay', 'Kv\MyCrm\Http\Controllers\InvoiceController@pay')
        ->name('laravel-crm.invoices.pay')
        ->middleware(['can:update,invoice']);

    Route::get('{invoice}/download', 'Kv\MyCrm\Http\Controllers\InvoiceController@download')
        ->name('laravel-crm.invoices.download')
        ->middleware(['can:view,invoice']);
});

/* Deliveries */

Route::group(['prefix' => 'deliveries', 'middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\DeliveryController@index')
        ->name('laravel-crm.deliveries.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Delivery']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\DeliveryController@search')
        ->name('laravel-crm.deliveries.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Delivery']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\DeliveryController@index')
        ->name('laravel-crm.deliveries.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Delivery']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\DeliveryController@create')
        ->name('laravel-crm.deliveries.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Delivery']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\DeliveryController@store')
        ->name('laravel-crm.deliveries.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Delivery']);

    Route::get('{delivery}', 'Kv\MyCrm\Http\Controllers\DeliveryController@show')
        ->name('laravel-crm.deliveries.show')
        ->middleware(['can:view,delivery']);

    Route::get('{delivery}/edit', 'Kv\MyCrm\Http\Controllers\DeliveryController@edit')
        ->name('laravel-crm.deliveries.edit')
        ->middleware(['can:update,delivery']);

    Route::put('{delivery}', 'Kv\MyCrm\Http\Controllers\DeliveryController@update')
        ->name('laravel-crm.deliveries.update')
        ->middleware(['can:update,delivery']);

    Route::delete('{delivery}', 'Kv\MyCrm\Http\Controllers\DeliveryController@destroy')
        ->name('laravel-crm.deliveries.destroy')
        ->middleware(['can:delete,delivery']);

    Route::get('{delivery}/download', 'Kv\MyCrm\Http\Controllers\DeliveryController@download')
        ->name('laravel-crm.deliveries.download')
        ->middleware(['can:view,delivery']);
});

/* Purchase Orders */

Route::group(['prefix' => 'purchase-orders', 'middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@index')
        ->name('laravel-crm.purchase-orders.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\PurchaseOrder']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@search')
        ->name('laravel-crm.purchase-orders.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\PurchaseOrder']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@index')
        ->name('laravel-crm.purchase-orders.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\PurchaseOrder']);

    Route::get('create/{model?}/{id?}', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@create')
        ->name('laravel-crm.purchase-orders.create')
        ->middleware(['can:create,Kv\MyCrm\Models\PurchaseOrder']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@store')
        ->name('laravel-crm.purchase-orders.store')
        ->middleware(['can:create,Kv\MyCrm\Models\PurchaseOrder']);

    Route::get('{purchaseOrder}', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@show')
        ->name('laravel-crm.purchase-orders.show')
        ->middleware(['can:view,purchaseOrder']);

    Route::get('{purchaseOrder}/edit', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@edit')
        ->name('laravel-crm.purchase-orders.edit')
        ->middleware(['can:update,purchaseOrder']);

    Route::put('{purchaseOrder}', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@update')
        ->name('laravel-crm.purchase-orders.update')
        ->middleware(['can:update,purchaseOrder']);

    Route::delete('{purchaseOrder}', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@destroy')
        ->name('laravel-crm.purchase-orders.destroy')
        ->middleware(['can:delete,purchaseOrder']);

    Route::post('{purchaseOrder}/send', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@send')
        ->name('laravel-crm.purchase-orders.send')
        ->middleware(['can:update,purchaseOrder']);

    Route::get('{purchaseOrder}/download', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@download')
        ->name('laravel-crm.purchase-orders.download')
        ->middleware(['can:view,purchaseOrder']);

    Route::post('multiple', 'Kv\MyCrm\Http\Controllers\PurchaseOrderController@storeMultiple')
        ->name('laravel-crm.purchase-orders.store-multiple')
        ->middleware(['can:create,Kv\MyCrm\Models\PurchaseOrder']);
});

/* Activities */

Route::group(['prefix' => 'activities', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\ActivityController@index')
        ->name('laravel-crm.activities.index');

    Route::get('create', 'Kv\MyCrm\Http\Controllers\ActivityController@create')
        ->name('laravel-crm.activities.create');

    Route::post('', 'Kv\MyCrm\Http\Controllers\ActivityController@store')
        ->name('laravel-crm.activities.store');

    Route::get('{activity}', 'Kv\MyCrm\Http\Controllers\ActivityController@show')
        ->name('laravel-crm.activities.show');

    Route::get('{activity}/edit', 'Kv\MyCrm\Http\Controllers\ActivityController@edit')
        ->name('laravel-crm.activities.edit');

    Route::put('{activity}', 'Kv\MyCrm\Http\Controllers\ActivityController@update')
        ->name('laravel-crm.activities.update');

    Route::delete('{activity}', 'Kv\MyCrm\Http\Controllers\ActivityController@destroy')
        ->name('laravel-crm.activities.destroy');
});

/* Tasks */

Route::group(['prefix' => 'tasks', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\TaskController@index')
        ->name('laravel-crm.tasks.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Task']);

    /*Route::get('create', 'Kv\MyCrm\Http\Controllers\TaskController@create')
        ->name('laravel-crm.tasks.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Task']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\TaskController@store')
        ->name('laravel-crm.tasks.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Task']);

    Route::get('{task}', 'Kv\MyCrm\Http\Controllers\TaskController@show')
        ->name('laravel-crm.tasks.show')
        ->middleware(['can:view,task']);

    Route::get('{task}/edit', 'Kv\MyCrm\Http\Controllers\TaskController@edit')
        ->name('laravel-crm.tasks.edit')
        ->middleware(['can:update,task']);

    Route::put('{task}', 'Kv\MyCrm\Http\Controllers\TaskController@update')
        ->name('laravel-crm.tasks.update')
        ->middleware(['can:update,task']);*/

    Route::delete('{task}', 'Kv\MyCrm\Http\Controllers\TaskController@destroy')
        ->name('laravel-crm.tasks.destroy')
        ->middleware(['can:delete,task']);

    /*Route::post('search', 'Kv\MyCrm\Http\Controllers\TaskController@search')
        ->name('laravel-crm.tasks.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Task']);*/

    Route::get('{task}/complete', 'Kv\MyCrm\Http\Controllers\TaskController@complete')
        ->name('laravel-crm.tasks.complete')
        ->middleware(['can:update,task']);
});

/* Notes */

Route::group(['prefix' => 'notes', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\NoteController@index')
        ->name('laravel-crm.notes.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Note']);

    /*Route::get('create', 'Kv\MyCrm\Http\Controllers\NoteController@create')
        ->name('laravel-crm.notes.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Note']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\NoteController@store')
        ->name('laravel-crm.notes.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Note']);

    Route::get('{note}', 'Kv\MyCrm\Http\Controllers\NoteController@show')
        ->name('laravel-crm.notes.show')
        ->middleware(['can:view,note']);

    Route::get('{note}/edit', 'Kv\MyCrm\Http\Controllers\NoteController@edit')
        ->name('laravel-crm.notes.edit')
        ->middleware(['can:update,note']);

    Route::put('{note}', 'Kv\MyCrm\Http\Controllers\NoteController@update')
        ->name('laravel-crm.notes.update')
        ->middleware(['can:update,note']);*/

    Route::delete('{note}', 'Kv\MyCrm\Http\Controllers\NoteController@destroy')
        ->name('laravel-crm.notes.destroy')
        ->middleware(['can:delete,note']);
});

/* Calls */

Route::group(['prefix' => 'calls', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\CallController@index')
        ->name('laravel-crm.calls.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Call']);

    /*Route::get('create', 'Kv\MyCrm\Http\Controllers\CallController@create')
        ->name('laravel-crm.calls.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Call']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\CallController@store')
        ->name('laravel-crm.calls.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Call']);

    Route::get('{call}', 'Kv\MyCrm\Http\Controllers\CallController@show')
        ->name('laravel-crm.calls.show')
        ->middleware(['can:view,call']);

    Route::get('{call}/edit', 'Kv\MyCrm\Http\Controllers\CallController@edit')
        ->name('laravel-crm.calls.edit')
        ->middleware(['can:update,call']);

    Route::put('{call}', 'Kv\MyCrm\Http\Controllers\CallController@update')
        ->name('laravel-crm.calls.update')
        ->middleware(['can:update,call']);*/

    Route::delete('{call}', 'Kv\MyCrm\Http\Controllers\CallController@destroy')
        ->name('laravel-crm.calls.destroy')
        ->middleware(['can:delete,call']);

    /*Route::post('search', 'Kv\MyCrm\Http\Controllers\CallController@search')
        ->name('laravel-crm.calls.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Call']);*/

    Route::get('{call}/complete', 'Kv\MyCrm\Http\Controllers\CallController@complete')
        ->name('laravel-crm.calls.complete')
        ->middleware(['can:update,call']);
});

/* Meetings */

Route::group(['prefix' => 'meetings', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\MeetingController@index')
        ->name('laravel-crm.meetings.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Meeting']);

    /*Route::get('create', 'Kv\MyCrm\Http\Controllers\MeetingController@create')
        ->name('laravel-crm.meetings.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Meeting']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\MeetingController@store')
        ->name('laravel-crm.meetings.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Meeting']);

    Route::get('{meeting}', 'Kv\MyCrm\Http\Controllers\MeetingController@show')
        ->name('laravel-crm.meetings.show')
        ->middleware(['can:view,meeting']);

    Route::get('{meeting}/edit', 'Kv\MyCrm\Http\Controllers\MeetingController@edit')
        ->name('laravel-crm.meetings.edit')
        ->middleware(['can:update,meeting']);

    Route::put('{meeting}', 'Kv\MyCrm\Http\Controllers\MeetingController@update')
        ->name('laravel-crm.meetings.update')
        ->middleware(['can:update,meeting']);*/

    Route::delete('{meeting}', 'Kv\MyCrm\Http\Controllers\MeetingController@destroy')
        ->name('laravel-crm.meetings.destroy')
        ->middleware(['can:delete,meeting']);

    /*Route::post('search', 'Kv\MyCrm\Http\Controllers\MeetingController@search')
        ->name('laravel-crm.meetings.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Meeting']);*/

    Route::get('{meeting}/complete', 'Kv\MyCrm\Http\Controllers\MeetingController@complete')
        ->name('laravel-crm.meetings.complete')
        ->middleware(['can:update,meeting']);
});

/* Lunches */

Route::group(['prefix' => 'lunches', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\LunchController@index')
        ->name('laravel-crm.lunches.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Lunch']);

    /*Route::get('create', 'Kv\MyCrm\Http\Controllers\LunchController@create')
        ->name('laravel-crm.lunches.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Lunch']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\LunchController@store')
        ->name('laravel-crm.lunches.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Lunch']);

    Route::get('{lunch}', 'Kv\MyCrm\Http\Controllers\LunchController@show')
        ->name('laravel-crm.lunches.show')
        ->middleware(['can:view,lunch']);

    Route::get('{lunch}/edit', 'Kv\MyCrm\Http\Controllers\LunchController@edit')
        ->name('laravel-crm.lunches.edit')
        ->middleware(['can:update,lunch']);

    Route::put('{lunch}', 'Kv\MyCrm\Http\Controllers\LunchController@update')
        ->name('laravel-crm.lunches.update')
        ->middleware(['can:update,lunch']);*/

    Route::delete('{lunch}', 'Kv\MyCrm\Http\Controllers\LunchController@destroy')
        ->name('laravel-crm.lunches.destroy')
        ->middleware(['can:delete,lunch']);

    /*Route::post('search', 'Kv\MyCrm\Http\Controllers\LunchController@search')
        ->name('laravel-crm.lunches.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Lunch']);*/

    Route::get('{lunch}/complete', 'Kv\MyCrm\Http\Controllers\LunchController@complete')
        ->name('laravel-crm.lunches.complete')
        ->middleware(['can:update,lunch']);
});

/* Files */

Route::group(['prefix' => 'files', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\FileController@index')
        ->name('laravel-crm.files.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\File']);

    /*Route::get('create', 'Kv\MyCrm\Http\Controllers\FileController@create')
        ->name('laravel-crm.files.create')
        ->middleware(['can:create,Kv\MyCrm\Models\File']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\FileController@store')
        ->name('laravel-crm.files.store')
        ->middleware(['can:create,Kv\MyCrm\Models\File']);

    Route::get('{file}', 'Kv\MyCrm\Http\Controllers\FileController@show')
        ->name('laravel-crm.files.show')
        ->middleware(['can:view,file']);

    Route::get('{file}/edit', 'Kv\MyCrm\Http\Controllers\FileController@edit')
        ->name('laravel-crm.files.edit')
        ->middleware(['can:update,file']);

    Route::put('{file}', 'Kv\MyCrm\Http\Controllers\FileController@update')
        ->name('laravel-crm.files.update')
        ->middleware(['can:update,file']);*/

    Route::delete('{file}', 'Kv\MyCrm\Http\Controllers\FileController@destroy')
        ->name('laravel-crm.files.destroy')
        ->middleware(['can:delete,file']);

    /*Route::post('search', 'Kv\MyCrm\Http\Controllers\FileController@search')
        ->name('laravel-crm.files.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\File']);*/

    Route::get('{file}/complete', 'Kv\MyCrm\Http\Controllers\FileController@complete')
        ->name('laravel-crm.files.complete')
        ->middleware(['can:update,file']);
});

/* Clients */

Route::group(['prefix' => 'clients', 'middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\ClientController@index')
        ->name('laravel-crm.clients.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Client']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\ClientController@search')
        ->name('laravel-crm.clients.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Client']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\ClientController@index')
        ->name('laravel-crm.clients.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Client']);

    Route::get('create/{model?}/{id?}', 'Kv\MyCrm\Http\Controllers\ClientController@create')
        ->name('laravel-crm.clients.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Client']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\ClientController@store')
        ->name('laravel-crm.clients.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Client']);

    Route::get('{client}', 'Kv\MyCrm\Http\Controllers\ClientController@show')
        ->name('laravel-crm.clients.show')
        ->middleware(['can:view,client']);

    Route::get('{client}/edit', 'Kv\MyCrm\Http\Controllers\ClientController@edit')
        ->name('laravel-crm.clients.edit')
        ->middleware(['can:update,client']);

    Route::put('{client}', 'Kv\MyCrm\Http\Controllers\ClientController@update')
        ->name('laravel-crm.clients.update')
        ->middleware(['can:update,client']);

    Route::delete('{client}', 'Kv\MyCrm\Http\Controllers\ClientController@destroy')
        ->name('laravel-crm.clients.destroy')
        ->middleware(['can:delete,client']);

    Route::get('{client}/autocomplete', 'Kv\MyCrm\Http\Controllers\ClientController@autocomplete')
        ->name('laravel-crm.clients.autocomplete')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Client']);
});

/* People */

Route::group(['prefix' => 'people', 'middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\PersonController@index')
        ->name('laravel-crm.people.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Person']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\PersonController@search')
        ->name('laravel-crm.people.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Person']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\PersonController@index')
        ->name('laravel-crm.people.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Person']);

    Route::get('create/{model?}/{id?}', 'Kv\MyCrm\Http\Controllers\PersonController@create')
        ->name('laravel-crm.people.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Person']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\PersonController@store')
        ->name('laravel-crm.people.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Person']);

    Route::get('{person}', 'Kv\MyCrm\Http\Controllers\PersonController@show')
        ->name('laravel-crm.people.show')
        ->middleware(['can:view,person']);

    Route::get('{person}/edit', 'Kv\MyCrm\Http\Controllers\PersonController@edit')
        ->name('laravel-crm.people.edit')
        ->middleware(['can:update,person']);

    Route::put('{person}', 'Kv\MyCrm\Http\Controllers\PersonController@update')
        ->name('laravel-crm.people.update')
        ->middleware(['can:update,person']);

    Route::delete('{person}', 'Kv\MyCrm\Http\Controllers\PersonController@destroy')
        ->name('laravel-crm.people.destroy')
        ->middleware(['can:delete,person']);

    Route::get('{person}/autocomplete', 'Kv\MyCrm\Http\Controllers\PersonController@autocomplete')
        ->name('laravel-crm.people.autocomplete')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Person']);
});

/* Organisations */

Route::group(['prefix' => 'organisations', 'middleware' => 'auth.my-crm'], function () {
    Route::any('filter', 'Kv\MyCrm\Http\Controllers\OrganisationController@index')
        ->name('laravel-crm.organisations.filter')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Organisation']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\OrganisationController@search')
        ->name('laravel-crm.organisations.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Organisation']);

    Route::get('', 'Kv\MyCrm\Http\Controllers\OrganisationController@index')
        ->name('laravel-crm.organisations.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Organisation']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\OrganisationController@create')
        ->name('laravel-crm.organisations.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Organisation']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\OrganisationController@store')
        ->name('laravel-crm.organisations.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Organisation']);

    Route::get('{organisation}', 'Kv\MyCrm\Http\Controllers\OrganisationController@show')
        ->name('laravel-crm.organisations.show')
        ->middleware(['can:view,organisation']);

    Route::get('{organisation}/edit', 'Kv\MyCrm\Http\Controllers\OrganisationController@edit')
        ->name('laravel-crm.organisations.edit')
        ->middleware(['can:update,organisation']);

    Route::put('{organisation}', 'Kv\MyCrm\Http\Controllers\OrganisationController@update')
        ->name('laravel-crm.organisations.update')
        ->middleware(['can:update,organisation']);

    Route::delete('{organisation}', 'Kv\MyCrm\Http\Controllers\OrganisationController@destroy')
        ->name('laravel-crm.organisations.destroy')
        ->middleware(['can:delete,organisation']);

    Route::get('{organisation}/autocomplete', 'Kv\MyCrm\Http\Controllers\OrganisationController@autocomplete')
        ->name('laravel-crm.organisations.autocomplete')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Organisation']);
});

/* Users */

Route::group(['prefix' => 'users', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\UserController@index')
        ->name('laravel-crm.users.index')
        ->middleware(['can:viewAny,App\User']);

    Route::get('invite', 'Kv\MyCrm\Http\Controllers\UserController@invite')
        ->name('laravel-crm.users.invite')
        ->middleware(['can:create,App\User']);

    Route::post('invite', 'Kv\MyCrm\Http\Controllers\UserController@sendInvite')
        ->name('laravel-crm.users.sendinvite')
        ->middleware(['can:create,App\User']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\UserController@create')
        ->name('laravel-crm.users.create')
        ->middleware(['can:create,App\User']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\UserController@store')
        ->name('laravel-crm.users.store')
        ->middleware(['can:create,App\User']);

    Route::get('{user}', 'Kv\MyCrm\Http\Controllers\UserController@show')
        ->name('laravel-crm.users.show')
        ->middleware(['can:view,user']);

    Route::get('{user}/edit', 'Kv\MyCrm\Http\Controllers\UserController@edit')
        ->name('laravel-crm.users.edit')
        ->middleware(['can:update,user']);

    Route::put('{user}', 'Kv\MyCrm\Http\Controllers\UserController@update')
        ->name('laravel-crm.users.update')
        ->middleware(['can:update,user']);

    Route::delete('{user}', 'Kv\MyCrm\Http\Controllers\UserController@destroy')
        ->name('laravel-crm.users.destroy')
        ->middleware(['can:delete,user']);
});

/* Teams */

Route::group(['prefix' => 'crm-teams', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\TeamController@index')
        ->name('laravel-crm.teams.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Team']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\TeamController@create')
        ->name('laravel-crm.teams.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Team']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\TeamController@store')
        ->name('laravel-crm.teams.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Team']);

    Route::get('{team}', 'Kv\MyCrm\Http\Controllers\TeamController@show')
        ->name('laravel-crm.teams.show')
        ->middleware(['can:view,team']);

    Route::get('{team}/edit', 'Kv\MyCrm\Http\Controllers\TeamController@edit')
        ->name('laravel-crm.teams.edit')
        ->middleware(['can:update,team']);

    Route::put('{team}', 'Kv\MyCrm\Http\Controllers\TeamController@update')
        ->name('laravel-crm.teams.update')
        ->middleware(['can:update,team']);

    Route::delete('{team}', 'Kv\MyCrm\Http\Controllers\TeamController@destroy')
        ->name('laravel-crm.teams.destroy')
        ->middleware(['can:delete,team']);
});

/* Products */

Route::group(['prefix' => 'products', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\ProductController@index')
        ->name('laravel-crm.products.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Product']);

    Route::any('search', 'Kv\MyCrm\Http\Controllers\ProductController@search')
        ->name('laravel-crm.products.search')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Product']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\ProductController@create')
        ->name('laravel-crm.products.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Product']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\ProductController@store')
        ->name('laravel-crm.products.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Product']);

    Route::get('{product}', 'Kv\MyCrm\Http\Controllers\ProductController@show')
        ->name('laravel-crm.products.show')
        ->middleware(['can:view,product']);

    Route::get('{product}/edit', 'Kv\MyCrm\Http\Controllers\ProductController@edit')
        ->name('laravel-crm.products.edit')
        ->middleware(['can:update,product']);

    Route::put('{product}', 'Kv\MyCrm\Http\Controllers\ProductController@update')
        ->name('laravel-crm.products.update')
        ->middleware(['can:update,product']);

    Route::delete('{product}', 'Kv\MyCrm\Http\Controllers\ProductController@destroy')
        ->name('laravel-crm.products.destroy')
        ->middleware(['can:delete,product']);

    Route::get('{product}/autocomplete', 'Kv\MyCrm\Http\Controllers\ProductController@autocomplete')
        ->name('laravel-crm.products.autocomplete')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Product']);
});

/* Product Categories */

Route::group(['prefix' => 'product-categories', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\ProductCategoryController@index')
        ->name('laravel-crm.product-categories.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\ProductCategory']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\ProductCategoryController@create')
        ->name('laravel-crm.product-categories.create')
        ->middleware(['can:create,Kv\MyCrm\Models\ProductCategory']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\ProductCategoryController@store')
        ->name('laravel-crm.product-categories.store')
        ->middleware(['can:create,Kv\MyCrm\Models\ProductCategory']);

    Route::get('{productCategory}', 'Kv\MyCrm\Http\Controllers\ProductCategoryController@show')
        ->name('laravel-crm.product-categories.show')
        ->middleware(['can:view,productCategory']);

    Route::get('{productCategory}/edit', 'Kv\MyCrm\Http\Controllers\ProductCategoryController@edit')
        ->name('laravel-crm.product-categories.edit')
        ->middleware(['can:update,productCategory']);

    Route::put('{productCategory}', 'Kv\MyCrm\Http\Controllers\ProductCategoryController@update')
        ->name('laravel-crm.product-categories.update')
        ->middleware(['can:update,productCategory']);

    Route::delete('{productCategory}', 'Kv\MyCrm\Http\Controllers\ProductCategoryController@destroy')
        ->name('laravel-crm.product-categories.destroy')
        ->middleware(['can:delete,productCategory']);
});

/* Product Attributes */

Route::group(['prefix' => 'product-attributes', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\ProductAttributeController@index')
        ->name('laravel-crm.product-attributes.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\productAttribute']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\ProductAttributeController@create')
        ->name('laravel-crm.product-attributes.create')
        ->middleware(['can:create,Kv\MyCrm\Models\productAttribute']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\ProductAttributeController@store')
        ->name('laravel-crm.product-attributes.store')
        ->middleware(['can:create,Kv\MyCrm\Models\productAttribute']);

    Route::get('{productCategory}', 'Kv\MyCrm\Http\Controllers\ProductAttributeController@show')
        ->name('laravel-crm.product-attributes.show')
        ->middleware(['can:view,productAttribute']);

    Route::get('{productCategory}/edit', 'Kv\MyCrm\Http\Controllers\ProductAttributeController@edit')
        ->name('laravel-crm.product-attributes.edit')
        ->middleware(['can:update,productAttribute']);

    Route::put('{productCategory}', 'Kv\MyCrm\Http\Controllers\ProductAttributeController@update')
        ->name('laravel-crm.product-attributes.update')
        ->middleware(['can:update,productAttribute']);

    Route::delete('{productCategory}', 'Kv\MyCrm\Http\Controllers\ProductAttributeController@destroy')
        ->name('laravel-crm.product-attributes.destroy')
        ->middleware(['can:delete,productAttribute']);
});

/* Tax Rates */

Route::group(['prefix' => 'tax-rates', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\TaxRateController@index')
        ->name('laravel-crm.tax-rates.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\TaxRate']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\TaxRateController@create')
        ->name('laravel-crm.tax-rates.create')
        ->middleware(['can:create,Kv\MyCrm\Models\TaxRate']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\TaxRateController@store')
        ->name('laravel-crm.tax-rates.store')
        ->middleware(['can:create,Kv\MyCrm\Models\TaxRate']);

    Route::get('{taxRate}', 'Kv\MyCrm\Http\Controllers\TaxRateController@show')
        ->name('laravel-crm.tax-rates.show')
        ->middleware(['can:view,taxRate']);

    Route::get('{taxRate}/edit', 'Kv\MyCrm\Http\Controllers\TaxRateController@edit')
        ->name('laravel-crm.tax-rates.edit')
        ->middleware(['can:update,taxRate']);

    Route::put('{taxRate}', 'Kv\MyCrm\Http\Controllers\TaxRateController@update')
        ->name('laravel-crm.tax-rates.update')
        ->middleware(['can:update,taxRate']);

    Route::delete('{taxRate}', 'Kv\MyCrm\Http\Controllers\TaxRateController@destroy')
        ->name('laravel-crm.tax-rates.destroy')
        ->middleware(['can:delete,taxRate']);
});

/* Settings */

Route::group(['prefix' => 'settings', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\SettingController@edit')
        ->name('laravel-crm.settings.edit')
        ->middleware(['can:update,Kv\MyCrm\Models\Setting']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\SettingController@update')
        ->name('laravel-crm.settings.update')
        ->middleware(['can:update,Kv\MyCrm\Models\Setting']);
});

/* Updates */
Route::group(['prefix' => 'updates', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\UpdateController@index')
        ->name('laravel-crm.updates.index');
});

/* Roles */
Route::group(['prefix' => 'roles', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\RoleController@index')
        ->name('laravel-crm.roles.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Role']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\RoleController@create')
        ->name('laravel-crm.roles.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Role']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\RoleController@store')
        ->name('laravel-crm.roles.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Role']);

    Route::get('{role}', 'Kv\MyCrm\Http\Controllers\RoleController@show')
        ->name('laravel-crm.roles.show')
        ->middleware(['can:view,role']);

    Route::get('{role}/edit', 'Kv\MyCrm\Http\Controllers\RoleController@edit')
        ->name('laravel-crm.roles.edit')
        ->middleware(['can:update,role']);

    Route::put('{role}', 'Kv\MyCrm\Http\Controllers\RoleController@update')
        ->name('laravel-crm.roles.update')
        ->middleware(['can:update,role']);

    Route::delete('{role}', 'Kv\MyCrm\Http\Controllers\RoleController@destroy')
        ->name('laravel-crm.roles.destroy')
        ->middleware(['can:delete,role']);
});

/* Pipelines */
Route::group(['prefix' => 'pipelines', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\PipelineController@index')
        ->name('laravel-crm.pipelines.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Pipeline']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\PipelineController@create')
        ->name('laravel-crm.pipelines.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Pipeline']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\PipelineController@store')
        ->name('laravel-crm.pipelines.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Pipeline']);

    Route::get('{pipeline}', 'Kv\MyCrm\Http\Controllers\PipelineController@show')
        ->name('laravel-crm.pipelines.show')
        ->middleware(['can:view,pipeline']);

    Route::get('{pipeline}/edit', 'Kv\MyCrm\Http\Controllers\PipelineController@edit')
        ->name('laravel-crm.pipelines.edit')
        ->middleware(['can:update,pipeline']);

    Route::put('{pipeline}', 'Kv\MyCrm\Http\Controllers\PipelineController@update')
        ->name('laravel-crm.pipelines.update')
        ->middleware(['can:update,pipeline']);

    Route::delete('{pipeline}', 'Kv\MyCrm\Http\Controllers\PipelineController@destroy')
        ->name('laravel-crm.pipelines.destroy')
        ->middleware(['can:delete,pipeline']);
});

/* Pipeline Stages */
Route::group(['prefix' => 'pipeline-stages', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\PipelineStageController@index')
        ->name('laravel-crm.pipeline-stages.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\PipelineStage']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\PipelineStageController@create')
        ->name('laravel-crm.pipeline-stages.create')
        ->middleware(['can:create,Kv\MyCrm\Models\PipelineStage']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\PipelineStageController@store')
        ->name('laravel-crm.pipeline-stages.store')
        ->middleware(['can:create,Kv\MyCrm\Models\PipelineStage']);

    Route::get('{pipelineStage}', 'Kv\MyCrm\Http\Controllers\PipelineStageController@show')
        ->name('laravel-crm.pipeline-stages.show')
        ->middleware(['can:view,pipelineStage']);

    Route::get('{pipelineStage}/edit', 'Kv\MyCrm\Http\Controllers\PipelineStageController@edit')
        ->name('laravel-crm.pipeline-stages.edit')
        ->middleware(['can:update,pipelineStage']);

    Route::put('{pipelineStage}', 'Kv\MyCrm\Http\Controllers\PipelineStageController@update')
        ->name('laravel-crm.pipeline-stages.update')
        ->middleware(['can:update,pipelineStage']);

    Route::delete('{pipelineStage}', 'Kv\MyCrm\Http\Controllers\PipelineStageController@destroy')
        ->name('laravel-crm.pipeline-stages.destroy')
        ->middleware(['can:delete,pipelineStage']);
});

/* Labels */
Route::group(['prefix' => 'labels', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\LabelController@index')
        ->name('laravel-crm.labels.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Label']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\LabelController@create')
        ->name('laravel-crm.labels.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Label']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\LabelController@store')
        ->name('laravel-crm.labels.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Label']);

    Route::get('{label}', 'Kv\MyCrm\Http\Controllers\LabelController@show')
        ->name('laravel-crm.labels.show')
        ->middleware(['can:view,label']);

    Route::get('{label}/edit', 'Kv\MyCrm\Http\Controllers\LabelController@edit')
        ->name('laravel-crm.labels.edit')
        ->middleware(['can:update,label']);

    Route::put('{label}', 'Kv\MyCrm\Http\Controllers\LabelController@update')
        ->name('laravel-crm.labels.update')
        ->middleware(['can:update,label']);

    Route::delete('{label}', 'Kv\MyCrm\Http\Controllers\LabelController@destroy')
        ->name('laravel-crm.labels.destroy')
        ->middleware(['can:delete,label']);
});

/* Fields */
Route::group(['prefix' => 'fields', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\FieldController@index')
        ->name('laravel-crm.fields.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\Field']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\FieldController@create')
        ->name('laravel-crm.fields.create')
        ->middleware(['can:create,Kv\MyCrm\Models\Field']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\FieldController@store')
        ->name('laravel-crm.fields.store')
        ->middleware(['can:create,Kv\MyCrm\Models\Field']);

    Route::get('{field}', 'Kv\MyCrm\Http\Controllers\FieldController@show')
        ->name('laravel-crm.fields.show')
        ->middleware(['can:view,field']);

    Route::get('{field}/edit', 'Kv\MyCrm\Http\Controllers\FieldController@edit')
        ->name('laravel-crm.fields.edit')
        ->middleware(['can:update,field']);

    Route::put('{field}', 'Kv\MyCrm\Http\Controllers\FieldController@update')
        ->name('laravel-crm.fields.update')
        ->middleware(['can:update,field']);

    Route::delete('{field}', 'Kv\MyCrm\Http\Controllers\FieldController@destroy')
        ->name('laravel-crm.fields.destroy')
        ->middleware(['can:delete,field']);
});

/* Field Groups */
Route::group(['prefix' => 'field-groups', 'middleware' => 'auth.my-crm'], function () {
    Route::get('', 'Kv\MyCrm\Http\Controllers\FieldGroupController@index')
        ->name('laravel-crm.field-groups.index')
        ->middleware(['can:viewAny,Kv\MyCrm\Models\FieldGroup']);

    Route::get('create', 'Kv\MyCrm\Http\Controllers\FieldGroupController@create')
        ->name('laravel-crm.field-groups.create')
        ->middleware(['can:create,Kv\MyCrm\Models\FieldGroup']);

    Route::post('', 'Kv\MyCrm\Http\Controllers\FieldGroupController@store')
        ->name('laravel-crm.field-groups.store')
        ->middleware(['can:create,Kv\MyCrm\Models\FieldGroup']);

    Route::get('{fieldGroup}', 'Kv\MyCrm\Http\Controllers\FieldGroupController@show')
        ->name('laravel-crm.field-groups.show')
        ->middleware(['can:view,fieldGroup']);

    Route::get('{fieldGroup}/edit', 'Kv\MyCrm\Http\Controllers\FieldGroupController@edit')
        ->name('laravel-crm.field-groups.edit')
        ->middleware(['can:update,fieldGroup']);

    Route::put('{fieldGroup}', 'Kv\MyCrm\Http\Controllers\FieldGroupController@update')
        ->name('laravel-crm.field-groups.update')
        ->middleware(['can:update,fieldGroup']);

    Route::delete('{fieldGroup}', 'Kv\MyCrm\Http\Controllers\FieldGroupController@destroy')
        ->name('laravel-crm.field-groups.destroy')
        ->middleware(['can:delete,fieldGroup']);
});

Route::group(['prefix' => 'integrations', 'middleware' => 'auth.my-crm'], function () {
    Route::group(['prefix' => 'xero'], function () {
        Route::get('', \Kv\MyCrm\Http\Livewire\Integrations\Xero\XeroConnect::class)->name('laravel-crm.integrations.xero');

        Route::get('connect', function () {
            return \Dcblogdev\Xero\Facades\Xero::connect();
        })->name('laravel-crm.integrations.xero.connect');

        Route::get('disconnect', function () {
            if (\Dcblogdev\Xero\Facades\Xero::isConnected()) {
                \Dcblogdev\Xero\Facades\Xero::disconnect();
            }

            return redirect(route('laravel-crm.integrations.xero'));
        })->name('laravel-crm.integrations.xero.disconnect');
    });
});

Route::get('integrations', function () {
    return redirect(route('laravel-crm.integrations.xero'));
})->name('laravel-crm.integrations');

/* CRM (AJAX) */
Route::group(['prefix' => 'crm', 'middleware' => 'auth.my-crm'], function () {
    Route::group(['prefix' => 'people', 'middleware' => 'auth.my-crm'], function () {
        Route::get('{person}/autocomplete', 'Kv\MyCrm\Http\Controllers\PersonController@autocomplete')
            ->name('laravel-crm.people.autocomplete')
            ->middleware(['can:viewAny,Kv\MyCrm\Models\Person']);
    });


    Route::group(['prefix' => 'organisations', 'middleware' => 'auth.my-crm'], function () {
        Route::get('{organisation}/autocomplete', 'Kv\MyCrm\Http\Controllers\OrganisationController@autocomplete')
            ->name('laravel-crm.organisations.autocomplete')
            ->middleware(['can:viewAny,Kv\MyCrm\Models\Organisation']);
    });

    Route::group(['prefix' => 'products', 'middleware' => 'auth.my-crm'], function () {
        Route::get('{product}/autocomplete', 'Kv\MyCrm\Http\Controllers\ProductController@autocomplete')
            ->name('laravel-crm.products.autocomplete')
            ->middleware(['can:viewAny,Kv\MyCrm\Models\Product']);
    });
});

/* Jetstream */
Route::put('/current-team', 'Kv\MyCrm\Http\Controllers\Jetstream\CurrentTeamController@update')
    ->name('current-team.update')
    ->middleware(['auth', 'verified']);
