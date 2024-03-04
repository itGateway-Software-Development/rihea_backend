<!DOCTYPE html>
<html class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/css/pages/app-calendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/fullcalendar/fullcalendar.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

    {{-- fresui --}}
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/css/rtl/core.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/css/rtl/theme-default.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frestui/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('frestui/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('frestui/assets/vendor/css/pages/app-invoice.css') }}" />
    {{-- custom --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('partials.menu')
            {{-- nav and search --}}
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="container-fluid">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">


                            <!-- Style Switcher -->
                            <li class="nav-item me-2 me-xl-0">
                                <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                                    <i class="bx bx-sm"></i>
                                </a>
                            </li>
                            <!--/ Style Switcher -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('frestui/assets/img/avatars/user.png') }}" alt class="rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="pages-account-settings-account.html">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('frestui/assets/img/avatars/user.png') }}" alt
                                                            class="rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block lh-1">
                                                        {{ Auth::user()->name }}
                                                    </span>
                                                    {{-- <small>Admin</small> --}}
                                                </div>

                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();"
                                            href="#">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>

                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper d-none">
                        <div class="d-flex">
                            <input type="text" class="form-control search-input container-fluid border-0"
                                id="searchInput" placeholder="Search..." aria-label="Search..." />
                            {{-- <i class="bx bx-x bx-sm search-toggler cursor-pointer closeSearch"></i> --}}
                        </div>

                    </div>

                </div>
            </nav>
            <div class="layout-page">
                <div class="content-wrapper mt-5" style="position: relative;">
                    <div class="shadow ms-3 rounded d-none" id="searchFilter">

                    </div>
                    <div class="container-xxl flex-grow-1 container-p-y" id="forBlur">

                        @yield('content')
                    </div>

                </div>
            </div>
            {{-- main --}}

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="bg-blur d-none closeSearch"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <!-- Helpers -->
    <script src="{{ asset('frestui/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('frestui/assets/js/config.js') }}"></script>
    <script src="{{ asset('frestui/assets/js/config.js') }}"></script>

    <!-- Core JS -->
    <script src="{{ asset('frestui/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('frestui/assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('frestui/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('frestui/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('frestui/assets/js/forms-pickers.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('frestui/assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/jszip/jszip.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/pdfmake/pdfmake.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/datatables-buttons/buttons.html5.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/datatables-buttons/buttons.print.js') }}"></script>
    <!-- Flat Picker -->
    <script src="{{ asset('frestui/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/moment/moment.js') }}"></script>

    <script src="{{ asset('frestui/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <script src="{{ asset('frestui/assets/js/app-calendar.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('frestui/assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('frestui/assets/js/offcanvas-add-payment.js') }}"></script>
    <script src="{{ asset('frestui/assets/js/offcanvas-send-invoice.js') }}"></script>
    <script src="{{ asset('frestui/assets/js/app-invoice-edit.js') }}"></script>

    {{-- --text-editor--  --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>



    <!-- Main JS -->
    <script src="{{ asset('frestui/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('frestui/assets/js/cards-statistics.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", () => {
                $.ajax({
                    url: "/api/search?search=" + $("#searchInput").val(),
                    method: "GET",
                    success: (data) => {
                        console.log(data);
                        let datas = data.results;
                        let htmls = "";
                        if (datas.length > 0) {

                            datas.forEach((data) => {
                                htmls += `
                                <a class="text-decoration-none" href="${data.url}">
                                    <p class="fw-bold text-dark">${data.model}</p>
                                    <p class="text-black-50">Name : ${data[data.fields[0]]}</p>
                                </a>
                                `;
                            });
                        } else {
                            htmls = `<p class="fw-bold text-dark">There is no data!!!</p>`;
                        }
                        $("#searchFilter").html(htmls);
                    }
                })
                if ($("#searchInput").val()) {
                    $("#searchFilter").removeClass('d-none');
                    $(".bg-blur").removeClass('d-none');
                }
                console.log($("#searchInput").val());
            })

            $('.closeSearch').on("click", () => {
                $(".bg-blur").addClass('d-none');
                $("#searchFilter").addClass('d-none');
            })

            $(".notifications-menu").on('click', function() {
                if (!$(this).hasClass('open')) {
                    $('.notifications-menu .label-warning').hide();
                    $.get('/admin/user-alerts/read');
                }
            });
        });
    </script>
    <script>
        $(() => {

            $('.select-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })
            $('.deselect-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
            $('.select2').select2();
            //csv modal
            let csvModal = new bootstrap.Modal(document.getElementById('csvImportModal'));
            $("button[data-toggle='modal']").on('click', () => {
                csvModal.show();
            })

            $("button[data-dismiss='modal']").on('click', () => {
                csvModal.hide();
            })
        });
    </script>
    @yield('scripts')
</body>

</html>
