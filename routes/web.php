<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\KhsController;
use App\Http\Controllers\LovController;
use App\Http\Controllers\SpController;
use App\Http\Controllers\TagihanController;
use App\Http\Middleware\RoleAdmin;
use App\Http\Middleware\RoleMitra;
use App\Http\Middleware\RoleProcurement;
use App\Http\Middleware\RoleUser;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function(){
    if(Auth::check()){
        if(Auth::user()->master_users->auth_role_id == 2){
            return redirect()->route('tagihan.indexPro');
        }
        if(Auth::user()->master_users->auth_role_id == 3){
            return redirect()->route('tagihan.indexUser');
        }
        if(Auth::user()->master_users->auth_role_id == 4){
            return redirect()->route('tagihan.index');
        }
        // return redirect()->route('dashboard.index');
    }
    return redirect()->route('auth.login');
})->name('anchor');

Route::prefix('error')->group(function () {
    Route::controller(ErrorController::class)->group(function () {
        Route::get('/403', function(){
            return view('errors.403');
        })->name('error.403');

        Route::get('/404', function(){
            return view('errors.404');
        })->name('error.404');
    });
});

Route::prefix('auth')->group(function () {
    Route::name('auth.')->group(function () {
        Route::controller(AuthController::class)->group(function () {

            Route::middleware('guest')->group(function(){

                Route::get('/login', 'login')->name('login');
                Route::get('/register', 'register')->name('register');
                Route::get('/forgot', 'forgot')->name('forgot');

            });

            Route::middleware('auth:web')->group(function(){

                Route::get('/logout', 'logout')->name('logout');

            });

        });
    });
});

Route::middleware('auth:web')->group(function(){

    Route::prefix('dashboard')->group(function () {
        Route::name('dashboard.')->group(function () {
            Route::controller(DashboardController::class)->group(function () {
    
                Route::get('/index', 'index')->name('index');
                Route::get('/index/dt', 'dt')->name('index.dt');
    
            });
        });
    });

    Route::prefix('tagihan')->group(function () {
        Route::name('tagihan.')->group(function () {
            Route::controller(TagihanController::class)->group(function () {
    
                Route::get('/file', 'file')->name('file');
    
            });
        });
    });

    Route::prefix('account')->group(function () {
        Route::name('account.')->group(function () {
            Route::controller(AccountController::class)->group(function () {
                Route::get('/my-account', 'myAccount')->name('myAccount');
            });
        });
    });

    Route::prefix('ba')->group(function () {
        Route::name('ba.')->group(function () {
            Route::controller(TagihanController::class)->group(function () {
                Route::get('/my-account', 'myAccount')->name('myAccount');
                Route::get('/{tagihanId}/file', 'file')->name('file');
            });
        });
    });

    Route::prefix('components')->group(function () {
        Route::name('components.')->group(function () {
            Route::controller(ComponentController::class)->group(function () {
                Route::get('/{id}/designator/{type}', 'designator')->name('designator');
            });
        });
    });

    // Admin role
    Route::middleware([RoleAdmin::class])->group(function () {
        Route::prefix('account')->group(function () {
            Route::name('account.')->group(function () {
                Route::controller(AccountController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{key}/edit', 'edit')->name('edit');
                    Route::get('/dt', 'dt')->name('dt');
                });
            });
        });
    });


    // Procurement Role
    Route::middleware([RoleProcurement::class])->group(function () {

        Route::prefix('account')->group(function () {
            Route::name('account.')->group(function () {
                Route::controller(AccountController::class)->group(function () {
                    
                    Route::get('/mitra', 'mitra')->name('mitra');
                    Route::get('/mitra/dt', 'mitraDt')->name('mitra.dt');
                    Route::get('/mitra/{key}/edit', 'changePassMitra')->name('changePassMitra');

                    Route::get('/mitra/pending', 'mitraPending')->name('mitraPending');
                    Route::get('/mitra/pending/dt', 'mitraPendingDt')->name('mitra.pending.dt');

                });
            });
        });

        Route::prefix('khs')->group(function () {
            Route::name('khs.')->group(function () {
                Route::controller(KhsController::class)->group(function () {
                    
                    Route::get('/index', 'index')->name('index');
                    Route::get('/index/dt', 'dt')->name('index.dt');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{editId}/edit', 'edit')->name('edit');
                    Route::get('/amandemen/{khsId}/create', 'amanCreate')->name('amanCreate');
                    Route::get('/amandemen/{editId}/edit', 'editAman')->name('editAman');
                    Route::get('/amandemen/{id}/delete', 'deleteAman')->name('deleteAman');
                    Route::get('/{khsId}/detail', 'detail')->name('detail');
                    Route::get('/detail/khs-induk/dt', 'detailKhsIndukDt')->name('detailKhsIndukDt');
                    Route::get('/detail/khs-aman/dt', 'detailKhsAmanDt')->name('detailKhsAmanDt');


                });
            });
        });

        Route::prefix('sp')->group(function () {
            Route::name('sp.')->group(function () {
                Route::controller(SpController::class)->group(function () {
            
                    Route::get('/index', 'index')->name('index');
                    Route::get('/index/dt', 'dt')->name('index.dt');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{editId}/edit', 'edit')->name('edit');
                    Route::get('/amandemen/{spId}/create', 'amanCreate')->name('amanCreate');
                    Route::get('/amandemen/{id}/edit', 'editAman')->name('editAman');
                    Route::get('/{spId}/detail', 'detail')->name('detail');

                });
            });
        });

        Route::prefix('tagihan')->group(function () {
            Route::name('tagihan.')->group(function () {
                Route::controller(TagihanController::class)->group(function () {
                    
                    Route::get('/pro/index', 'indexPro')->name('indexPro');
                    Route::get('/pro/index/dt', 'dtPro')->name('indexPro.dt');
                    Route::get('/{tagihanId}/pro/proses', 'prosesPro')->name('prosesPro');
                    Route::get('/{tagihanId}/pro/proses2', 'proses2Pro')->name('proses2Pro');
                    
                });
            });
        });

        Route::prefix('lov')->group(function () {
            Route::name('lov.')->group(function () {
                Route::controller(LovController::class)->group(function () {
                    
                    Route::get('/index', 'index')->name('index');
                    Route::get('/index/dt', 'dtIndex')->name('dtIndex');

                });
            });
        });


    });

    // User Role
    Route::middleware([RoleUser::class])->group(function () {

        Route::prefix('tagihan')->group(function () {
            Route::name('tagihan.')->group(function () {
                Route::controller(TagihanController::class)->group(function () {
                    Route::get('/{tagihanId}/detail', 'detail')->name('detail');
                    Route::get('/user/index', 'indexUser')->name('indexUser');
                    Route::get('/user/index/dt', 'dtUser')->name('indexUser.dt');
                    Route::get('/{tagihanId}/user/proses', 'prosesUser')->name('prosesUser');

                });
            });
        });

    });

    // Mitra role
    Route::middleware([RoleMitra::class])->group(function () {

        Route::prefix('khs')->group(function () {
            Route::name('khs.')->group(function () {
                Route::controller(KhsController::class)->group(function () {
                    
                    Route::get('/index', 'index')->name('index');
                    Route::get('/index/dt', 'dt')->name('index.dt');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/{editId}/edit', 'edit')->name('edit');
                    Route::get('/amandemen/{khsId}/create', 'amanCreate')->name('amanCreate');
                    Route::get('/amandemen/{editId}/edit', 'editAman')->name('editAman');
                    Route::get('/{khsId}/detail', 'detail')->name('detail');


                });
            });
        });

        Route::prefix('sp')->group(function () {
            Route::name('sp.')->group(function () {
                Route::controller(SpController::class)->group(function () {
                    
                    Route::get('/mitra/index', 'indexMitra')->name('indexMitra');
                    Route::get('/mitra/index/dt', 'dtMitra')->name('indexMitra.dt');
                    Route::get('/{spId}/detail', 'detail')->name('detail');


                });
            });
        });

        Route::prefix('tagihan')->group(function () {
            Route::name('tagihan.')->group(function () {
                Route::controller(TagihanController::class)->group(function () {
                    
                    Route::get('/mitra/index', 'index')->name('index');
                    Route::get('/mitra/{spId}/create', 'create')->name('create');
                    Route::get('/mitra/index/dt', 'dtMitra')->name('indexMitra.dt');
                    Route::get('/{tagihanId}/edit', 'edit')->name('edit');
                    Route::get('/{tagihanId}/detail', 'detail')->name('detail');
                    Route::get('/{tagihanId}/revisi', 'revisi')->name('revisi');

                    Route::get('/user/index', 'indexUser')->name('indexUser');
                    Route::get('/user/index/dt', 'dtUser')->name('indexUser.dt');
                    Route::get('/{tagihanId}/user/proses', 'prosesUser')->name('prosesUser');

                    Route::get('/{tagihanId}/invoice', 'invoice')->name('invoice');
                    Route::get('/{tagihanId}/invoice/revisi', 'invoiceRevisi')->name('invoiceRevisi');

                });
            });
        });

    });



    

});

