<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\SalaryController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\CatrgoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\RoleController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () { 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin-logout');
Route::get('/logout', [AdminController::class, 'AdminLogoutPage'])->name('admin-logout-page');

Route::middleware(['auth'])->group(function(){

Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin-profile');
Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin-profile-store');

Route::get('/change/password', [AdminController::class, 'ChangePassword'])->name('change.password');
Route::post('/update/password', [AdminController::class, 'UpdatePassword'])->name('update-password');

// all emplyee route 
Route::controller(EmployeeController::class)->group(function(){
Route::get('/all/employee', 'AllEmployee')->name('all-employee')->middleware('permission::employee.all');
Route::get('/add/employee', 'AddEmployee')->name('add-employee')->middleware('permission::employee.add');
Route::post('/store/employee', 'StoreEmployee')->name('employee-store');
Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit-employee');
Route::post('/update/employee', 'UpdateEmployee')->name('employee-update');
Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete-employee');
});

// customer all route 
Route::controller(CustomerController::class)->group(function(){
    Route::get('/all/customer', 'AllCustomer')->name('all-customer')->middleware('permission::customer.all');;
    Route::get('/add/customer', 'AddCustomer')->name('add-cutomer');
    Route::post('/store/customer', 'StoreCustomer')->name('customer-store');
    Route::get('/edit/customer/{id}', 'EditCustomer')->name('edit-customer');
    Route::post('/update/customer', 'UpdateCustomer')->name('customer-update');
    Route::get('/delete/customer/{id}', 'DeleteCustomer')->name('delete-customer');
});

Route::controller(SupplierController::class)->group(function(){
    Route::get('/all/supplier', 'AllSupplier')->name('all-supplier');
    Route::get('/add/supplier', 'AddSupplier')->name('add-supplier');
    Route::post('/store/supplier', 'StoreSupplier')->name('supplier-store');
    Route::get('/edit/supplier/{id}', 'EditSupplier')->name('edit-supplier');
    Route::post('/update/supplier', 'UpdateSupplier')->name('supplier-update');
    Route::get('/delete/supplier/{id}', 'DeleteSupplier')->name('delete-supplier');
    Route::get('/details/supplier/{id}', 'DetailsSupplier')->name('details-supplier');
});
// advance salary 
Route::controller(SalaryController::class)->group(function(){
    Route::get('/add/advance/salary', 'AddAdvanceSalary')->name('add-advance-salary');
    Route::post('/advance/salary/store', 'AdvanceSalaryStore')->name('advance-salary-store');
    Route::get('/all/advance/salary', 'AllAdvanceSalary')->name('all-advance-salary');
    Route::get('/edit/advance/salary/{id}', 'EditAdvanceSalary')->name('edit-advance-salary');
    Route::post('/advance/salary/update', 'AdvanceSalaryUpdate')->name('advance-salary-update');
});

Route::controller(SalaryController::class)->group(function(){
    Route::get('/pay/salary', 'PaySalary')->name('pay-salary');
    Route::get('/pay/now/{id}', 'PayNow')->name('pay-now');
    Route::post('/employee/salary/store', 'EmployeeSalaryStore')->name('employee-salary-store');
    Route::get('/month/salary', 'MonthSalary')->name('month-salary');
});
// atyendance all route 
Route::controller(AttendanceController::class)->group(function(){
    Route::get('/employee/attendance/list', 'EmployeeAttendanceList')->name('employee-attendance-list');
    Route::get('/add/employee/attend', 'AddEmployeeAttendance')->name('add-employee-attend');
    Route::post('/employee/attend/store', 'EmployeeAttendanceStore')->name('employee-attendance-store');
    Route::get('/employee/attend/edit/{date}', 'EmployeeAttendanceEdit')->name('employee-attend-edit');
    Route::get('/employee/attend/view/{date}', 'EmployeeAttendanceView')->name('employee-attend-view');
});
// category all route 
Route::controller(CatrgoryController::class)->group(function(){
    Route::get('/all/category', 'AllCategory')->name('all-category');
    Route::post('/add/category', 'AddCategory')->name('add-category');
    Route::get('/edit/category/{id}', 'EditCategory')->name('edit-category');
    Route::post('/update/category', 'CategoryUpdate')->name('category-update');
    Route::get('/delete/category/{id}', 'CategoryDelete')->name('delete-category');
});
// all product route 
Route::controller(ProductController::class)->group(function(){
    Route::get('/all/product', 'AllProduct')->name('all-product');
    Route::get('/add/product', 'AddProduct')->name('add-product');
    Route::post('/store/product', 'StoreProduct')->name('product-store');
    Route::get('/edit/product/{id}', 'EditProduct')->name('edit-product');
    Route::post('/update/product', 'UpdateProduct')->name('product-update');
    Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete-product');
    Route::get('/barcode/product/{id}', 'BarcodeProduct')->name('barcode-product');
    Route::get('/import/product', 'ImportProduct')->name('import-product');
    Route::get('/export', 'Export')->name('export');
    Route::post('/import', 'Import')->name('import');
});
// expense all route 
Route::controller(ExpenseController::class)->group(function(){
    Route::get('/add/expense', 'AddExpense')->name('add-expense');
    Route::post('/store/expense', 'StroreExpense')->name('expense-store');
    Route::get('/today/expense', 'TodayExpense')->name('today-expense');
    Route::get('/edit/expense/{id}', 'EditExpense')->name('edit-expense');
    Route::post('/update/expense', 'UpdateExpense')->name('expense-update');
    Route::get('/month/expense', 'MonthExpense')->name('month-expense');
    Route::get('/year/expense', 'YearExpense')->name('year-expense');
});
// pos all route
Route::controller(PosController::class)->group(function(){
    Route::get('/pos', 'POS')->name('pos');
    Route::post('/add-cart', 'AddCart');
    Route::get('/all/item', 'AllItem');
    Route::post('/cart/update/{rowId}', 'CartUpdate');
    Route::get('/cart-remove/{rowId}', 'CartRemove');
    Route::post('/create-invoice', 'CreateInvoice');
});

// order all route 
Route::controller(OrderController::class)->group(function(){
    Route::post('/final/invoice', 'FinalInvoice');
    Route::get('/pending/order', 'PendingOrder')->name('pending-order');
    Route::get('/order/details/{order_id}', 'OrderDetails')->name('order-details');
    Route::post('/order/status/update', 'OrderStatusUpdate')->name('order-status-update');
    Route::get('/complete/order', 'CompleteOrder')->name('complete-order');
    Route::get('/stcok', 'StockManage')->name('stock-manage');
    Route::get('/order/invoice-download/{order_id}', 'OrderInvoice');
});

// permision all route 
Route::controller(RoleController::class)->group(function(){
    Route::get('/all/permission', 'AllPermission')->name('all.permission');
    Route::get('/add/permission', 'AddPermission')->name('add-permission');
    Route::post('/store/permission', 'StorePermission')->name('permission-store');
    Route::get('/edit/permission/{id}', 'EditPermission')->name('edit-permission');
    Route::post('/update/permission', 'UpdatePermission')->name('permission-update');
    Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete-permission');
});
// all roles
Route::controller(RoleController::class)->group(function(){
    Route::get('/all/role', 'AllRoles')->name('all.roles');
    Route::get('/add/role', 'AddRoles')->name('add-roles');
    Route::post('/store/role', 'storeRoles')->name('role-store');
    Route::get('/edit/role/{id}', 'EditRoles')->name('edit-role');
    Route::post('/update/role', 'UpdateRoles')->name('role-update');
    Route::get('/delete/role/{id}', 'DeleteRoles')->name('delete-role');
});
//add roles in permission 
Route::controller(RoleController::class)->group(function(){
    Route::get('/add/role/permission', 'AddRolesPermission')->name('add.roles.permission');
    Route::post('/store/role/permission', 'StoreRolesPermission')->name('role-permission-store');
    Route::get('/all/role/permission', 'AllRolesPermission')->name('all.roles.permission');
    Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('admin-edit-roles');
    Route::post('/role/permission/update/{id}', 'RolePermissionUpdate')->name('role-permission-update');
    Route::get('/role/permission/delete/{id}', 'RolePermissionDelete')->name('admin-delete-roles');
});

// admin usert all route 
Route::controller(AdminController::class)->group(function(){
    Route::get('/all/admin', 'AllAdmin')->name('all.admin');
    Route::get('/add/admin', 'AddAdmin')->name('add-admin');
    Route::post('/store/admin', 'StoreAdmin')->name('admin-store');
    Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit-admin');
    Route::post('/update/admin', 'UpdateAdmin')->name('admin-update');
    Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete-admin');

    // database backup
    Route::get('/database/basebackup', 'DatabaseBackup')->name('database-backup');
    Route::get('/backup/now', 'BackupNow');
    Route::get('{getFilename}', 'DownloadDatabase');
    Route::get('/delete/database/{getFilename}', 'DeleteDatabase');
});

}); 

// end usert middleware 

require __DIR__.'/auth.php';
