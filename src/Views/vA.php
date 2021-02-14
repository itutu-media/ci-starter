<?= doctype(); ?>
<html lang="<?= session('setLang'); ?>">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= isset($pageTitle) ? $pageTitle . ' - ' . getConfig('appName') : getConfig('appName'); ?></title>
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="canonical" href="<?= base_url(); ?>" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  <?php if ($css) {
    foreach ($css as $css) {
      echo link_tag($css);
    }
  } ?>
  <?= link_tag('assets/plugins/global/plugins.bundle.min.css'); ?>
  <?= link_tag('assets/plugins/custom/prismjs/prismjs.bundle.min.css'); ?>
  <?= link_tag('assets/css/style.bundle.min.css'); ?>
  <?= link_tag('assets/css/themes/layout/header/base/dark.min.css'); ?>
  <?= link_tag('assets/css/themes/layout/header/menu/light.min.css'); ?>
  <?= link_tag('assets/css/themes/layout/brand/dark.min.css'); ?>
  <?= link_tag('assets/css/themes/layout/aside/dark.min.css'); ?>
  <?= link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
  <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <a>
      <img alt="Logo" src="<?= site_url('assets/media/logos/logo.png'); ?>" class="img-fluid" style="max-height: 50px;" />
    </a>
    <div class="d-flex align-items-center">
      <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
        <span></span>
      </button>
      <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
        <span class="svg-icon svg-icon-xl">
          <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <polygon points="0 0 24 0 24 24 0 24" />
              <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
              <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
            </g>
          </svg>
          <!--end::Svg Icon-->
        </span>
      </button>
    </div>
  </div>
  <div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
      <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
        <div class="brand flex-column-auto" id="kt_brand" style="background-color: #ffffff;">
          <a class="brand-logo">
            <img alt="Logo" src="<?= site_url('assets/media/logos/logo.png'); ?>" class="img-fluid" style="max-height: 50px;" />
          </a>
          <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
              <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24" />
                  <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                  <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                </g>
              </svg>
              <!--end::Svg Icon-->
            </span>
          </button>
        </div>
        <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
          <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <ul class="menu-nav">
              <?= $sidebar; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
        <div id="kt_header" class="header header-fixed">
          <div class="container-fluid d-flex align-items-stretch justify-content-between">
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
              <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
              </div>
            </div>
            <div class="topbar">
              <div class="dropdown" id="kt_quick_search_toggle">
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                  <div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
                    <span class="svg-icon svg-icon-xl svg-icon-primary">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                          <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                  <div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
                    <form method="get" class="quick-search-form">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <span class="svg-icon svg-icon-lg">
                              <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24" />
                                  <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                  <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                              </svg>
                              <!--end::Svg Icon-->
                            </span>
                          </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search..." />
                        <div class="input-group-append">
                          <span class="input-group-text">
                            <i class="quick-search-close ki ki-close icon-sm text-muted"></i>
                          </span>
                        </div>
                      </div>
                    </form>
                    <div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
                  </div>
                </div>
              </div>
              <div class="dropdown">
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                  <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-primary">
                    <span class="svg-icon svg-icon-xl svg-icon-primary">
                      <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                          <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                    <span class="pulse-ring"></span>
                  </div>
                </div>
                <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                  <form>
                    <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url(<?= site_url('assets/media/misc/bg-1.jpg'); ?>)">
                      <h4 class="d-flex flex-center rounded-top">
                        <span class="text-white">User Notifications</span>
                        <span class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">23 new</span>
                      </h4>
                      <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_general">General</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#topbar_notifications_web">Web</a>
                        </li>
                      </ul>
                    </div>
                    <div class="tab-content">
                      <div class="tab-pane active show p-8" id="topbar_notifications_general" role="tabpanel">
                        <div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300" data-mobile-height="200">
                          <a href="#" class="navi-item">
                            <div class="navi-link">
                              <div class="d-flex align-items-center bg-light-success rounded p-5 mb-1">
                                <span class="svg-icon svg-icon-success mr-5">
                                  <span class="svg-icon svg-icon-lg">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                      </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                  </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                  <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Would be to people</a>
                                  <span class="text-muted font-size-sm">Due in 2 Days</span>
                                </div>
                                <span class="font-weight-bolder text-success py-1 font-size-lg">+50%</span>
                              </div>
                            </div>
                          </a>
                          <a href="#" class="navi-item">
                            <div class="navi-link">
                              <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-1">
                                <span class="svg-icon svg-icon-warning mr-5">
                                  <span class="svg-icon svg-icon-lg">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                        <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                      </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                  </span>
                                </span>
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                  <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Another purpose persuade</a>
                                  <span class="text-muted font-size-sm">Due in 2 Days</span>
                                </div>
                                <span class="font-weight-bolder text-warning py-1 font-size-lg">+28%</span>
                              </div>
                            </div>
                          </a>
                        </div>
                        <div class="d-flex flex-center pt-7">
                          <a href="#" class="btn btn-light-primary font-weight-bold text-center">See All</a>
                        </div>
                      </div>
                      <div class="tab-pane p-8" id="topbar_notifications_web" role="tabpanel">
                        <div class="d-flex flex-center text-center text-muted min-h-200px">All caught up!
                          <br />No new notifications.
                        </div>
                        <div class="d-flex flex-center pt-7">
                          <a href="#" class="btn btn-light-primary font-weight-bold text-center">See All</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="dropdown">
                <?php if (count($langs) > 0) : ?>
                  <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                      <img class="h-20px w-20px rounded-sm" src="<?= site_url('assets/media/svg/flags/' . $langs[session('setLang')]['image']); ?>" alt="<?= $langs[session('setLang')]['name']; ?>" />
                    </div>
                  </div>
                  <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi navi-hover py-4">
                      <?php foreach ($langs as $slug => $lang) : ?>
                        <li class="navi-item">
                          <a href="<?= site_url('support/' . $slug); ?>" class="navi-link">
                            <span class="symbol symbol-20 mr-3">
                              <img src="<?= site_url('assets/media/svg/flags/' . $lang['image']); ?>" alt="<?= $lang['name']; ?>" />
                            </span>
                            <span class="navi-text"><?= $lang['name']; ?></span>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endif; ?>
              </div>
              <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                  <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                  <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?= user()->username; ?></span>
                  <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                    <span class="symbol-label font-size-h5 font-weight-bold"><?= substr(user()->username, 0, 1); ?></span>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
          <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
              <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                  <h5 class="text-dark font-weight-bold my-1 mr-5"><?= $title; ?></h5>
                  <?= adminBreadcrumb($breadCrumb); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="d-flex flex-column-fluid">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <?= $messages; ?>
                </div>
              </div>
              <?= $this->renderSection('content') ?>
            </div>
          </div>
        </div>
        <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
          <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="text-dark order-2 order-md-1">
              <span class="text-muted font-weight-bold mr-2">2020 ©</span>
              <a href="https://itutu-media.id/" target="_blank" class="text-dark-75 text-hover-primary">ITUTUMedia</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
      <h3 class="font-weight-bold m-0">User Profile
        <small class="text-muted font-size-sm ml-2">12 messages</small>
      </h3>
      <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
        <i class="ki ki-close icon-xs text-muted"></i>
      </a>
    </div>
    <div class="offcanvas-content pr-5 mr-n5">
      <div class="d-flex align-items-center mt-5">
        <div class="symbol symbol-100 mr-5">
          <div class="symbol-label" style="background-image:url('<?= site_url(user()->avatar); ?>')"></div>
          <i class="symbol-badge bg-success"></i>
        </div>
        <div class="d-flex flex-column">
          <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?= user()->username; ?></a>
          <div class="text-muted mt-1"><?= user()->email; ?></div>
          <div class="navi mt-2">
            <a href="#" class="navi-item">
              <span class="navi-link p-0 pb-2">
                <span class="navi-icon mr-1">
                  <span class="svg-icon svg-icon-lg svg-icon-primary">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                        <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                      </g>
                    </svg>
                    <!--end::Svg Icon-->
                  </span>
                </span>
                <span class="navi-text text-muted text-hover-primary"><?= user()->email; ?></span>
              </span>
            </a>
            <a href="<?= site_url('logout'); ?>" class="btn btn-sm btn-light-danger font-weight-bolder py-2 px-5">Sign Out</a>
          </div>
        </div>
      </div>
      <div class="separator separator-dashed mt-8 mb-5"></div>
      <div class="navi navi-spacer-x-0 p-0">
        <a href="https://account.smkmuh1wates.sch.id/profile" class="navi-item">
          <div class="navi-link">
            <div class="symbol symbol-40 bg-light mr-3">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-md svg-icon-success">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24" />
                      <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                      <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                    </g>
                  </svg>
                  <!--end::Svg Icon-->
                </span>
              </div>
            </div>
            <div class="navi-text">
              <div class="font-weight-bold">My Account</div>
              <div class="text-muted">Account settings and more
                <span class="label label-light-danger label-inline font-weight-bold">update</span>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="modal fade" id="general-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
          <button type="button" id="modal-ok-button" class="btn btn-danger font-weight-bold" data-action="" data-nya="">OK</button>
        </div>
      </div>
    </div>
  </div>
  <div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
      <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon points="0 0 24 0 24 24 0 24" />
          <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
          <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
        </g>
      </svg>
      <!--end::Svg Icon-->
    </span>
  </div>

  <script>
    var HOST_URL = "<?= current_url(); ?>";
    var BASE_URL = "<?= base_url(); ?>";
  </script>

  <script>
    var KTAppSettings = {
      "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
      },
      "colors": {
        "theme": {
          "base": {
            "white": "#ffffff",
            "primary": "#3699FF",
            "secondary": "#E5EAEE",
            "success": "#1BC5BD",
            "info": "#8950FC",
            "warning": "#FFA800",
            "danger": "#F64E60",
            "light": "#E4E6EF",
            "dark": "#181C32"
          },
          "light": {
            "white": "#ffffff",
            "primary": "#E1F0FF",
            "secondary": "#EBEDF3",
            "success": "#C9F7F5",
            "info": "#EEE5FF",
            "warning": "#FFF4DE",
            "danger": "#FFE2E5",
            "light": "#F3F6F9",
            "dark": "#D6D6E0"
          },
          "inverse": {
            "white": "#ffffff",
            "primary": "#ffffff",
            "secondary": "#3F4254",
            "success": "#ffffff",
            "info": "#ffffff",
            "warning": "#ffffff",
            "danger": "#ffffff",
            "light": "#464E5F",
            "dark": "#ffffff"
          }
        },
        "gray": {
          "gray-100": "#F3F6F9",
          "gray-200": "#EBEDF3",
          "gray-300": "#E4E6EF",
          "gray-400": "#D1D3E0",
          "gray-500": "#B5B5C3",
          "gray-600": "#7E8299",
          "gray-700": "#5E6278",
          "gray-800": "#3F4254",
          "gray-900": "#181C32"
        }
      },
      "font-family": "Poppins"
    };
  </script>
  <?= script_tag('assets/plugins/global/plugins.bundle.min.js'); ?>
  <?= script_tag('assets/plugins/custom/prismjs/prismjs.bundle.min.js'); ?>
  <?= script_tag('assets/js/scripts.bundle.min.js'); ?>
  <?= script_tag('assets/js/main.min.js'); ?>
  <?php if ($js) {
    foreach ($js as $js) {
      echo script_tag($js);
    }
  } ?>
</body>

</html>