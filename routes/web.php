<?php
  
use Illuminate\Support\Facades\Route;
  
// User Routes
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LivesController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganChartsController;
use App\Http\Controllers\ForgetPasswordController;
// <-- Admin Controller-->
use App\Http\Controllers\Admin\UserData;
use App\Http\Controllers\Admin\ManagePost;
use App\Http\Controllers\Admin\ViewedArticle;
use App\Http\Controllers\Admin\LiveController;
use App\Http\Controllers\Admin\SubController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProfilesController;
use App\Http\Controllers\Admin\MyPostController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\OrganChartController;
// <--Sub Admin Controller-->
use App\Http\Controllers\SubAdmin\UserDatas;
use App\Http\Controllers\SubAdmin\ManagesPost;
use App\Http\Controllers\SubAdmin\EventtController;
use App\Http\Controllers\SubAdmin\ProfiledController;
use App\Http\Controllers\SubAdmin\ArticlessController;
use App\Http\Controllers\SubAdmin\AnalyticssController;
use App\Http\Controllers\SubAdmin\CommentssController;

// <--Auth Management Logi,Registered Logout-->

    //Starting Page
    Route::get('/', [AuthController::class, 'index'])->name('login');

    //Registration
    Route::get('registration', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
    Route::get('home', [AuthController::class, 'home']); 

    //Login
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 

    //Admin Login
    Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'postAdminLogin'])->name('admin.login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    
    //Logout
    Route::get('admin/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('subadmin/logout', [AuthController::class, 'admin.logout'])->name('admin.logout');


//Recovery Paasword
Route::get('/forget-password',[ForgetPasswordController::class,'forgetPassword'])->name('forget.password');
Route::get('/reset-password/{token}',[ForgetPasswordController::class,'resetPassword'])->name('reset.password');
Route::post('/reset-password',[ForgetPasswordController::class,'resetPasswordPost'])->name('reset.password.post');
Route::post('/forget-password',[ForgetPasswordController::class,'forgetPasswordPost'])->name('forget.password.post');

Route::middleware('auth', 'admin')->group(function () {

    //Admin Article Management
    Route::get('/admin/articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::post('/admin/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('articles/{articles}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::put('articles/{articles}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::get('/admin/articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::delete('articles/{articles}', [ArticleController::class, 'destroy'])->name('admin.articles.destroy');

    //Admin Users Management
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
    //Admin Subadmin create
    Route::get('admin/sub', [SubController::class, 'index'])->name('admin.sub.index');
    Route::post('admin/sub', [SubController::class, 'store'])->name('admin.sub.store');
    Route::get('admin/sub/create', [SubController::class, 'create'])->name('admin.sub.create');
    Route::get('admin/sub/{user}/edit', [SubController::class, 'edit'])->name('admin.sub.edit');
    Route::put('admin/sub/{user}', [SubController::class, 'update'])->name('admin.sub.update');
    Route::delete('admin/sub/{user}', [SubController::class, 'destroy'])->name('admin.sub.destroy');

    //Admin Live Management
    Route::get('admin/live/create', [LiveController::class, 'create'])->name('admin.live.create');
    Route::post('admin/live', [LiveController::class, 'store'])->name('admin.live.store');
    Route::post('/admin/live/end', [App\Http\Controllers\Admin\LiveController::class, 'endLiveStream'])->name('admin.live.end');
    
    //Admin Dashboards
    Route::get('admin/dashboards', [AnalyticsController::class, 'index'])->name('admin.dashboards');

    //Activity Logs
    Route::get('admin/activity_logs', [ActivityLogController::class, 'index'])->name('admin.activity_logs');
    Route::get('/admin/activity_logs', [AnalyticsController::class, 'fetchRecentActivities'])->name('admin.activity_logs');

    
    Route::get('/admin/activityrecords', [ActivityLogController::class, 'index'])->name('admin.activityrecords.index');
    Route::post('/admin/activity/clear', [ActivityLogController::class, 'clearAllActivityLogs'])->name('admin.activity.clear');


    //Admin Profile Management
    Route::get('admin/profile', [AnalyticsController::class, 'show'])->name('admin.profile');
    Route::get('admin/profile/edit', [ProfilesController::class, 'edit'])->name('admin.profile.edit');
    Route::put('admin/profile/update', [ProfilesController::class, 'update'])->name('admin.profile.update');
    Route::delete('admin/profile/delete', [ProfilesController::class, 'destroy'])->name('admin.profile.destroy');
    Route::put('admin/password/update', [ProfilesController::class, 'updatePassword'])->name('admin.password.update');

    //Banning Users
    Route::post('/admin/users/ban/{id}', [UserController::class, 'ban'])->name('admin.users.ban');
    Route::post('/admin/users/{user}/unban', [UserController::class, 'unban'])->name('admin.users.unban');
    Route::get('/admin/users/{user}/ban', [UserController::class, 'banForm'])->name('admin.users.ban.form');

    //Admin Comment Management
    Route::get('/admin/comments', [CommentsController::class, 'index'])->name('admin.comments.index');
    Route::delete('/admin/comments/{comments}', [CommentsController::class, 'destroy'])->name('admin.comments.destroy');

    // Admin User Approve Management
    Route::post('admin/reject/{user}', [AuthController::class, 'rejectRegistration'])->name('admin.reject');
    Route::get('admin/registrations', [AuthController::class, 'showRegistrations'])->name('admin.registrations');
    Route::post('admin/approve/{user}', [AuthController::class, 'approveRegistration'])->name('admin.approve');
    Route::delete('/admin/users/{user}/reject', [UserController::class, 'rejectRegistration'])->name('admin.reject.registration');
    Route::get('admin/users/pending_accounts', [AuthController::class, 'showPending'])->name('admin.users.pending_accounts');
    Route::put('/admin/users/{user}/approve', [UserController::class, 'approveRegistration'])->name('admin.approve.registration');
    Route::get('/admin/users/pending_accounts', [UserController::class, 'showRegistrations'])->name('admin/users/pending_accounts');
    Route::get('/admin/users/backup', [UserController::class, 'backup'])->name('admin.users.backup');
    Route::get('/admin/users/import', [UserController::class, 'showImportForm'])->name('admin.users.showImportForm');
    Route::post('/admin/users/import', [UserController::class, 'import'])->name('admin.users.import');
    Route::post('/admin/delete-all', [AuthController::class, 'deleteAllPendingRegistrations'])->name('admin.delete.all');

    

    //Search
    Route::get('admin/users/search_suggestions', [UserController::class, 'searchSuggestions'])->name('admin.users.search_suggestions');

    Route::get('admin/sub/search_suggestions', [SubController::class, 'searchSuggestions'])->name('admin.sub.search_suggestions');


    //Admin Student Records
    Route::get('admin/userdata', [UserData::class, 'index'])->name('admin.userdata.index');
    Route::post('admin/userdata', [UserData::class, 'store'])->name('admin.userdata.store');
 
    //Admin Post Management
    Route::get('admin/managepost', [ManagePost::class, 'index'])->name('admin.managepost.index');  
    Route::post('admin/managepost', [ManagePost::class, 'store'])->name('admin.managepost.store');  
    Route::get('admin/managepost/{post}/edit', [ManagePost::class, 'edit'])->name('admin.managepost.edit');  
    Route::get('admin/managepost/create', [ManagePost::class, 'create'])->name('admin.managepost.create');  
    Route::put('admin/managepost/{post}', [ManagePost::class, 'update'])->name('admin.managepost.update');  
    Route::patch('admin/managepost/{post}', [ManagePost::class, 'update'])->name('admin.managepost.update');  
    Route::delete('admin/managepost/{post}', [ManagePost::class, 'destroy'])->name('admin.managepost.destroy'); 


});

    //Gallery Show
    Route::get('gallery', [GalleryController::class, 'showGallery'])->name('gallery.show');

    //Organization Chart
    Route::get('/organation', [OrganChartsController::class, 'index'])->name('orgnation.index');

    //News Articles
    Route::get('articles', [ArticlesController::class, 'index'])->name('articles.index');
    Route::get('/articles/{id}', [ArticlesController::class, 'show'])->name('articles.show');



Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    //Admin Uploading Images/Videos
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('gallery/{items}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    //Admin Organziation Chart Management
    Route::get('organ_chart', [OrganChartController::class, 'index'])->name('organ_chart.index');
    Route::post('organ_chart', [OrganChartController::class, 'store'])->name('organ_chart.store');
    Route::get('organ_chart/{id}/edit', [OrganChartController::class, 'edit'])->name('organ_chart.edit');
    Route::put('organ_chart/{id}', [OrganChartController::class, 'update'])->name('organ_chart.update');
    Route::get('organ_chart/create', [OrganChartController::class, 'create'])->name('organ_chart.create');
    Route::delete('organ_chart/{id}', [OrganChartController::class, 'destroy'])->name('organ_chart.destroy'); 

    
});

Route::middleware('auth', 'subadmin')->group(function () {

    //Subadmin Student Records
    Route::get('subadmin/userdata', [UserDatas::class, 'index'])->name('subadmin.userdata.index');
    Route::post('subadmin/userdata', [UserDatas::class, 'store'])->name('subadmin.userdata.store');

    //SubDashbooards
    Route::get('subadmin/dashboards', [AnalyticsController::class, 'index'])->name('admin.dashboards');
    Route::get('subadmin/subdashboards', [AnalyticssController::class, 'index'])->name('subadmin.subdashboards');

    //SubProfile
    Route::get('subadmin/profile', [AnalyticssController::class, 'show'])->name('subadmin.profile');
    Route::get('subadmin/profile/edit', [ProfiledController::class, 'edit'])->name('subadmin.profile.edit');
    Route::put('subadmin/profile/update', [ProfiledController::class, 'update'])->name('subadmin.profile.update');
    Route::delete('subadmin/profile/delete', [ProfiledController::class, 'destroy'])->name('subadmin.profile.destroy');
    Route::put('subadmin/password/update', [ProfiledController::class, 'updatePassword'])->name('subadmin.password.update');

    //SubArticles
    Route::get('/subadmin/article', [ArticlessController::class, 'index'])->name('subadmin.article.index');
    Route::get('article/{articles}/edit', [ArticlessController::class, 'edit'])->name('subadmin.article.edit');
    Route::post('/subadmin/article', [ArticlessController::class, 'store'])->name('subadmin.article.store');
    Route::put('article/{articles}', [ArticlessController::class, 'update'])->name('subadmin.article.update');
    Route::delete('article/{articles}', [ArticlessController::class, 'destroy'])->name('subadmin.article.destroy');
    Route::get('/subadmin/article/create', [ArticlessController::class, 'create'])->name('subadmin.article.create');

    //SubCommentsManagement
    Route::get('/subadmin/comments', [CommentssController::class, 'index'])->name('subadmin.comments.index');
    Route::delete('/subadmin/comments/{comments}', [CommentssController::class, 'destroy'])->name('subadmin.comments.destroy');

    //SubEvent
    Route::post('event', [EventtController::class, 'store'])->name('subadmin.event.store');
    Route::get('event/create', [EventtController::class, 'create'])->name('subadmin.event.create');
    Route::get('event/{event}/edit', [EventtController::class, 'edit'])->name('subadmin.event.edit');
    Route::get('subadmin/event', [EventtController::class, 'index'])->name('subadmin.event.index');
    Route::put('event/{event}', [EventtController::class, 'update'])->name('subadmin.event.update');
    Route::delete('event/{event}', [EventtController::class, 'destroy'])->name('subadmin.event.destroy');

    //SubPostManagement
    Route::get('subadmin/managepost', [ManagesPost::class, 'index'])->name('subadmin.managepost.index');
    Route::post('subadmin/managepost', [ManagesPost::class, 'store'])->name('subadmin.managepost.store');
    Route::get('subadmin/managepost/{post}/edit', [ManagesPost::class, 'edit'])->name('subadmin.managepost.edit');
    Route::get('subadmin/managepost/create', [ManagesPost::class, 'create'])->name('subadmin.managepost.create'); 
    Route::put('subadmin/managepost/{post}', [ManagesPost::class, 'update'])->name('subadmin.managepost.update'); 
    Route::patch('subadmin/managepost/{post}', [ManagesPost::class, 'update'])->name('subadmin.managepost.update');  
    Route::delete('subadmin/managepost/{post}', [ManagesPost::class, 'destroy'])->name('subadmin.managepost.destroy');  

});


// User routes
Route::middleware(['auth'])->group(function () {

    Route::get('/activitylogs', [ActivityLogsController::class, 'index'])->name('activitylogs');
    Route::post('/activitylogs/clear', [ActivityLogsController::class, 'clearAllActivityLogs'])->name('activitylogs.clear');

    //Show articles
    Route::get('news', [EventsController::class, 'index'])->name('news.index');

    //Posting
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/userpost', [PostController::class, 'userpost'])->name('posts.userpost');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    //ShowEvents
    Route::get('events', [EventsController::class, 'index'])->name('events.index');
    Route::get('events', [EventController::class, 'index'])->name('events.index');

    //Upload Profile
    Route::post('/profile/upload-image', [ProfileController::class, 'uploadImage'])->name('profile.uploadImage');

    //Profile Management
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/upload-image', [ProfileController::class, 'uploadImage'])->name('profile.uploadImage');


    

});


// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('events', [EventController::class, 'index'])->name('admin.events.index');
    Route::post('events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('events/{event}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
});

//Other Routes
Route::middleware(['auth', 'is_admin'])->group(function () {

    //Create Post
    Route::get('admin/posts/create', [MyPostController::class, 'create'])->name('admin.posts.create');
    Route::post('admin/posts', [MyPostController::class, 'store'])->name('admin.posts.store');
   

});

    //Notification
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    //Post like
    Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.toggleLike');

    //live show
    Route::get('live-stream', [LivesController::class, 'show'])->name('live.show');

    Route::resource('posts', PostController::class);

    Route::post('/post', [PostController::class, 'store'])->name('posts.store');

    //Artcles Page
    Route::get('/all-articles', [ArticlesController::class, 'showAll'])->name('articles.all');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

    // Like, share, and comment routes
    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('posts/{post}/share', [PostController::class, 'share'])->name('posts.share');
    Route::post('posts/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');
    Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');
    Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('posts.comment');
    Route::post('/posts/{post}/share', [ShareController::class, 'store'])->name('posts.share');

Route::middleware(['role:registered'])->group(function () {

    //Create Post only registered user
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

    });

    //Layout and Nav Bar
    Route::get('/post', [PageController::class, 'post'])->name('post');
    Route::get('/opinion', [PageController::class, 'opinion'])->name('opinion');
    Route::get('/sport', [PageController::class, 'sport'])->name('sport');
    Route::get('/scitech', [PageController::class, 'scitech'])->name('scitech');
    Route::get('/video', [PageController::class, 'video'])->name('video');
    Route::get('/album', [PageController::class, 'album'])->name('album');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/live', [PageController::class, 'live'])->name('live');
    Route::get('/organation', [OrganChartsController::class, 'index'])->name('organation');
    Route::get('events', [EventsController::class, 'index'])->name('events');
    Route::get('articles', [ArticlesController::class, 'index'])->name('articles');
    Route::get('/cartoonist', [PageController::class, 'cartoonist'])->name('cartoonist');
    Route::get('/live', [LiveStreamController::class, 'showLiveStream']);
    Route::get('index', [PageController::class, 'index'])->name('index');

