<?php

use App\Http\Controllers\Parent\BookingController as ParentBookingController;
use App\Http\Controllers\Parent\ChildrenController;
use App\Http\Controllers\Parent\ReviewController;
use App\Http\Controllers\Parent\TransactionController as ParentTransactionController;
use App\Http\Controllers\Parent\ProfileController as ParentProfileController;
use App\Http\Controllers\Parent\DashboardController as DashboardParentController;
use App\Http\Controllers\Parent\PaymentsController;
use App\Http\Controllers\Parent\NotificationController as ParentNotificationController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Staff\DashboardController;
use App\Http\Controllers\Staff\ProfileController as StaffProfileController;
use App\Http\Controllers\Staff\TaskController;
use App\Http\Controllers\Staff\ReportController as StaffReportController;
use App\Http\Controllers\Staff\NotificationController as StaffNotificationController;
use App\Models\Child;
use App\Models\StaffReport;
use App\Models\StaffSchedule;
use Illuminate\Support\Facades\Route;

// Route::get('/splash', function () {
//     return view('splash');
// })->name('splash');

// =========================
// 🚀 SPLASH SCREEN ROUTES
// =========================

// Arahkan root "/" ke halaman splash
Route::get('/', function () {
    return redirect()->route('splash');
});

// Halaman Splash Screen
Route::get('/splash', function () {
    return view('splash');
})->name('splash');

// Halaman Landing Page utama setelah splash
Route::get('/landing-page', function () {
    return view('landing-page');
})->name('landing-page');


// Route::get('/landing-page', function () {
//     return view('landing-page'); // Halaman utama kamu (landing page)
// })->name('landing-page');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Route Manajemen Booking Admin
    Route::get('booking', [AdminBookingController::class, 'index'])->name('admin.booking.index');
    Route::post('booking/{id}/verify', [AdminBookingController::class, 'verify'])->name('admin.booking.verify');
    Route::post('booking/{id}/rejected', [AdminBookingController::class, 'rejected'])->name('admin.booking.reject');
    Route::get('booking/{id}/assign-staff', [AdminBookingController::class, 'assignForm'])->name('admin.booking.assign.form');
    Route::post('booking/{id}/assign-staff', [AdminBookingController::class, 'assignStaff'])->name('admin.booking.assign');
    Route::post('booking/{id}/finish', [AdminBookingController::class, 'markAsFinished'])->name('admin.booking.finish');
    Route::delete('booking/{id}/destroy', [AdminBookingController::class, 'destroy'])->name('admin.booking.destroy');

    // Route Manajemen Data Staff
    Route::get('data-staff', [StaffController::class, 'index'])->name('admin.data-staff.index');
    Route::get('data-staff/create', [StaffController::class, 'create'])->name('admin.data-staff.create');
    Route::get('data-staff/{id}/edit', [StaffController::class, 'edit'])->name('admin.data-staff.edit');
    Route::post('data-staff/store', [StaffController::class, 'store'])->name('admin.data-staff.store');
    Route::put('data-staff/{id}/update', [StaffController::class, 'update'])->name('admin.data-staff.update');
    Route::delete('data-staff/{id}/destroy', [StaffController::class, 'destroy'])->name('admin.data-staff.destroy');

    // Route Manajemen Data Parent
    Route::get('data-parent', [ParentController::class, 'index'])->name('admin.data-parent.index');

    // Route Manajemen Data Transaction
    Route::get('transaction', [AdminTransactionController::class, 'index'])->name('admin.transaction.index');

    // Route Manajemen Report
    Route::get('report', [AdminReportController::class, 'index'])->name('admin.report.index');
    Route::get('report/staff-report', [AdminReportController::class, 'indexStaffReport'])->name('admin.report.staff-report');
    Route::get('report/parent-review', [AdminReportController::class, 'indexParentReview'])->name('admin.report.parent-review');
    Route::get('report/income-report', [AdminReportController::class, 'indexIncomeReport'])->name('admin.report.income-report');
    Route::get('report/children-activity', [AdminReportController::class, 'indexChildrenReport'])->name('admin.report.children-report');

    Route::get('/notifications', [AdminNotificationController::class, 'index'])
        ->name('admin.notifications.index');
    Route::get('/notifications/{id}', [AdminNotificationController::class, 'show'])
        ->name('admin.notifications.show');

    Route::delete('/notifications/{id}', [AdminNotificationController::class, 'destroy'])
        ->name('admin.notifications.destroy');

    Route::get('/reports/income/export', [\App\Http\Controllers\Admin\IncomeReportController::class, 'exportPdf'])
    ->name('admin.reports.income.export');

});


// Route Staff
Route::prefix('staff')->middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('staff.dashboard');

    Route::get('/tasks', [TaskController::class, 'index'])->name('staff.task.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('staff.task.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('staff.task.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('staff.task.show');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('staff.task.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('staff.task.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('staff.task.destroy');
    Route::put('/tasks/{booking}/update-status', [TaskController::class, 'updateStatus'])->name('staff.task.update-status');

    Route::get('report', [StaffReportController::class, 'index'])->name('staff.report.index');
    Route::get('report/create', [StaffReportController::class, 'create'])->name('staff.report.create');
    Route::get('report/{id}/edit', [StaffReportController::class, 'edit'])->name('staff.report.edit');
    Route::post('report/store', [StaffReportController::class, 'store'])->name('staff.report.store');
    Route::put('report/{id}/update', [StaffReportController::class, 'update'])->name('staff.report.update');
    Route::delete('report/{id}/destroy', [StaffReportController::class, 'destroy'])->name('staff.report.destroy');

    Route::get('profile', [StaffProfileController::class, 'index'])->name('staff.profile.index');
    Route::get('profile/{id}/edit', [StaffProfileController::class, 'edit'])->name('staff.profile.edit');
    Route::put('profile/{id}/update', [StaffProfileController::class, 'update'])->name('staff.profile.update');

    Route::get('notification', [StaffNotificationController::class, 'index'])->name('staff.notifications.index');
    Route::get('notification/{id}', [StaffNotificationController::class, 'show'])->name('staff.notifications.show');
});


// Route Parent
Route::prefix('parent')->middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/dashboard', [DashboardParentController::class, 'index'])->name('parent.dashboard');

    // CRUD Data Children
    Route::get('data-children', [ChildrenController::class, 'index'])->name('parent.data-children.index');
    Route::get('data-children/create', [ChildrenController::class, 'create'])->name('parent.data-children.create');
    Route::get('data-children/{id}/edit', [ChildrenController::class, 'edit'])->name('parent.data-children.edit');
    Route::post('data-children/create', [ChildrenController::class, 'store'])->name('parent.data-children.store');
    Route::put('data-children/{id}/update', [ChildrenController::class, 'update'])->name('parent.data-children.update');
    Route::delete('data-children/{id}/destroy', [ChildrenController::class, 'destroy'])->name('parent.data-children.destroy');

    // CRUD Booking
    Route::get('booking', [ParentBookingController::class, 'index'])->name('parent.booking.index');
    Route::get('booking/create', [ParentBookingController::class, 'create'])->name('parent.booking.create');
    Route::get('booking/{id}/edit', [ParentBookingController::class, 'edit'])->name('parent.booking.edit');
    Route::post('booking/store', [ParentBookingController::class, 'store'])->name('parent.booking.store');
    Route::put('booking/{id}/update', [ParentBookingController::class, 'update'])->name('parent.booking.update');
    Route::delete('booking/{id}/destroy', [ParentBookingController::class, 'destroy'])->name('parent.booking.destroy');

    // CRUD Transactions
    Route::get('transaction', [ParentTransactionController::class, 'index'])->name('parent.transaction.index');
    Route::get('/parent/transaction/{id}/qr-view', [ParentTransactionController::class, 'qrView'])->name('parent.transaction.qr-view');

    // CRUD Review
    Route::get('review', [ReviewController::class, 'index'])->name('parent.review.index');
    Route::get('review/create', [ReviewController::class, 'create'])->name('parent.review.create');
    Route::get('review/{id}/edit', [ReviewController::class, 'edit'])->name('parent.review.edit');
    Route::post('review/store', [ReviewController::class, 'store'])->name('parent.review.store');
    Route::put('review/{id}/put', [ReviewController::class, 'update'])->name('parent.review.update');
    Route::delete('review/{id}/destroy', [ReviewController::class, 'destroy'])->name('parent.review.destroy');

    // Manajemen Profile
    Route::get('profile', [ParentProfileController::class, 'index'])->name('parent.profile.index');
    Route::get('profile/edit', [ParentProfileController::class, 'edit'])->name('parent.profile.edit');
    Route::put('profile/update', [ParentProfileController::class, 'update'])->name('parent.profile.update');

    // Manajemen Payments
    Route::get('payments/create', [PaymentsController::class, 'create'])->name('parent.payments.create');
    Route::post('payments/store', [PaymentsController::class, 'store'])->name('parent.payments.store');
    Route::get('/transactions/{id}/upload', [PaymentsController::class, 'uploadForm'])->name('parent.transaction.upload');
    Route::post('/transactions/{id}/upload', [PaymentsController::class, 'uploadStore'])->name('parent.transaction.upload.store');


    Route::get('/notifications', [ParentNotificationController::class, 'index'])->name('parent.notifications.index');
    Route::get('/notifications/{id}', [ParentNotificationController::class, 'show'])->name('parent.notifications.show');
    Route::delete('/notifications/{id}/destroy', [ParentNotificationController::class, 'destroy'])->name('parent.notifications.destroy');
});
require __DIR__ . '/auth.php';
