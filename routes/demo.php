<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard/v1', function () {
  return view('demo-pages/dashboard-v1');
});
Route::get('/dashboard/v2', function () {
  return view('demo-pages/dashboard-v2');
});
Route::get('/dashboard/v3', function () {
  return view('demo-pages/dashboard-v3');
});
Route::get('/email/inbox', function () {
  return view('demo-pages/email-inbox');
});
Route::get('/email/compose', function () {
  return view('demo-pages/email-compose');
});
Route::get('/email/detail', function () {
  return view('demo-pages/email-detail');
});
Route::get('/widget', function () {
  return view('demo-pages/widget');
});
Route::get('/ui/general', function () {
  return view('demo-pages/ui-general');
});
Route::get('/ui/typography', function () {
  return view('demo-pages/ui-typography');
});
Route::get('/ui/tabs-accordions', function () {
  return view('demo-pages/ui-tabs-accordions');
});
Route::get('/ui/unlimited-nav-tabs', function () {
  return view('demo-pages/ui-unlimited-nav-tabs');
});
Route::get('/ui/modal-notification', function () {
  return view('demo-pages/ui-modal-notification');
});
Route::get('/ui/widget-boxes', function () {
  return view('demo-pages/ui-widget-boxes');
});
Route::get('/ui/media-object', function () {
  return view('demo-pages/ui-media-object');
});
Route::get('/ui/buttons', function () {
  return view('demo-pages/ui-buttons');
});
Route::get('/ui/icons', function () {
  return view('demo-pages/ui-icons');
});
Route::get('/ui/simple-line-icons', function () {
  return view('demo-pages/ui-simple-line-icons');
});
Route::get('/ui/ionicons', function () {
  return view('demo-pages/ui-ionicons');
});
Route::get('/ui/tree-view', function () {
  return view('demo-pages/ui-tree-view');
});
Route::get('/ui/language-bar-icon', function () {
  return view('demo-pages/ui-language-bar-icon');
});
Route::get('/ui/social-buttons', function () {
  return view('demo-pages/ui-social-buttons');
});
Route::get('/ui/intro-js', function () {
  return view('demo-pages/ui-intro-js');
});
Route::get('/bootstrap-4', function () {
  return view('demo-pages/bootstrap-4');
});
Route::get('/form/elements', function () {
  return view('demo-pages/form-elements');
});
Route::get('/form/plugins', function () {
  return view('demo-pages/form-plugins');
});
Route::get('/form/slider-switcher', function () {
  return view('demo-pages/form-slider-switcher');
});
Route::get('/form/validation', function () {
  return view('demo-pages/form-validation');
});
Route::get('/form/wizards', function () {
  return view('demo-pages/form-wizards');
});
Route::get('/form/wizards-validation', function () {
  return view('demo-pages/form-wizards-validation');
});
Route::get('/form/wysiwyg', function () {
  return view('demo-pages/form-wysiwyg');
});
Route::get('/form/x-editable', function () {
  return view('demo-pages/form-x-editable');
});
Route::get('/form/multiple-file-upload', function () {
  return view('demo-pages/form-multiple-file-upload');
});
Route::get('/form/summernote', function () {
  return view('demo-pages/form-summernote');
});
Route::get('/form/dropzone', function () {
  return view('demo-pages/form-dropzone');
});
Route::get('/table/basic', function () {
  return view('demo-pages/table-basic');
});
Route::get('/table/manage/default', function () {
  return view('demo-pages/table-manage-default');
});
Route::get('/table/manage/autofill', function () {
  return view('demo-pages/table-manage-autofill');
});
Route::get('/table/manage/buttons', function () {
  return view('demo-pages/table-manage-buttons');
});
Route::get('/table/manage/colreorder', function () {
  return view('demo-pages/table-manage-colreorder');
});
Route::get('/table/manage/fixed-column', function () {
  return view('demo-pages/table-manage-fixed-column');
});
Route::get('/table/manage/fixed-header', function () {
  return view('demo-pages/table-manage-fixed-header');
});
Route::get('/table/manage/keytable', function () {
  return view('demo-pages/table-manage-keytable');
});
Route::get('/table/manage/responsive', function () {
  return view('demo-pages/table-manage-responsive');
});
Route::get('/table/manage/rowreorder', function () {
  return view('demo-pages/table-manage-rowreorder');
});
Route::get('/table/manage/scroller', function () {
  return view('demo-pages/table-manage-scroller');
});
Route::get('/table/manage/select', function () {
  return view('demo-pages/table-manage-select');
});
Route::get('/table/manage/combine', function () {
  return view('demo-pages/table-manage-combine');
});
Route::get('/email-template/system', function () {
  return view('demo-pages/email-template-system');
});
Route::get('/email-template/newsletter', function () {
  return view('demo-pages/email-template-newsletter');
});
Route::get('/chart/flot', function () {
  return view('demo-pages/chart-flot');
});
Route::get('/chart/morris', function () {
  return view('demo-pages/chart-morris');
});
Route::get('/chart/js', function () {
  return view('demo-pages/chart-js');
});
Route::get('/chart/d3', function () {
  return view('demo-pages/chart-d3');
});
Route::get('/chart/apex', function () {
  return view('demo-pages/chart-apex');
});
Route::get('/calendar', function () {
  return view('demo-pages/calendar');
});
Route::get('/map/vector', function () {
  return view('demo-pages/map-vector');
});
Route::get('/map/google', function () {
  return view('demo-pages/map-google');
});
Route::get('/gallery/v1', function () {
  return view('demo-pages/gallery-v1');
});
Route::get('/gallery/v2', function () {
  return view('demo-pages/gallery-v2');
});
Route::get('/page-option/page-blank', function () {
  return view('demo-pages/page-blank');
});
Route::get('/page-option/page-with-footer', function () {
  return view('demo-pages/page-with-footer');
});
Route::get('/page-option/page-without-sidebar', function () {
  return view('demo-pages/page-without-sidebar');
});
Route::get('/page-option/page-with-right-sidebar', function () {
  return view('demo-pages/page-with-right-sidebar');
});
Route::get('/page-option/page-with-minified-sidebar', function () {
  return view('demo-pages/page-with-minified-sidebar');
});
Route::get('/page-option/page-with-two-sidebar', function () {
  return view('demo-pages/page-with-two-sidebar');
});
Route::get('/page-option/page-full-height', function () {
  return view('demo-pages/page-full-height');
});
Route::get('/page-option/page-with-wide-sidebar', function () {
  return view('demo-pages/page-with-wide-sidebar');
});
Route::get('/page-option/page-with-light-sidebar', function () {
  return view('demo-pages/page-with-light-sidebar');
});
Route::get('/page-option/page-with-mega-menu', function () {
  return view('demo-pages/page-with-mega-menu');
});
Route::get('/page-option/page-with-top-menu', function () {
  return view('demo-pages/page-with-top-menu');
});
Route::get('/page-option/page-with-boxed-layout', function () {
  return view('demo-pages/page-with-boxed-layout');
});
Route::get('/page-option/page-with-mixed-menu', function () {
  return view('demo-pages/page-with-mixed-menu');
});
Route::get('/page-option/boxed-layout-with-mixed-menu', function () {
  return view('demo-pages/page-boxed-layout-with-mixed-menu');
});
Route::get('/page-option/page-with-transparent-sidebar', function () {
  return view('demo-pages/page-with-transparent-sidebar');
});
Route::get('/page-option/page-with-search-sidebar', function () {
  return view('demo-pages/page-with-search-sidebar');
});
Route::get('/extra/timeline', function () {
  return view('demo-pages/extra-timeline');
});
Route::get('/extra/coming-soon', function () {
  return view('demo-pages/extra-coming-soon');
});
Route::get('/extra/search-result', function () {
  return view('demo-pages/extra-search-result');
});
Route::get('/extra/invoice', function () {
  return view('demo-pages/extra-invoice');
});
Route::get('/extra/error-page', function () {
  return view('demo-pages/extra-error-page');
});
Route::get('/extra/profile', function () {
  return view('demo-pages/extra-profile');
});
Route::get('/extra/scrum-board', function () {
  return view('demo-pages/extra-scrum-board');
});
Route::get('/extra/cookie-acceptance-banner', function () {
  return view('demo-pages/extra-cookie-acceptance-banner');
});
Route::get('/login/v1', function () {
  return view('demo-pages/login-v1');
});
Route::get('/login/v2', function () {
  return view('demo-pages/login-v2');
});
Route::get('/login/v3', function () {
  return view('demo-pages/login-v3');
});
Route::get('/register/v3', function () {
  return view('demo-pages/register-v3');
});
Route::get('/helper/css', function () {
  return view('demo-pages/helper-css');
});
