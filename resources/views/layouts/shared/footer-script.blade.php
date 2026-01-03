{{-- Jquary --}}
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/metismenu.min.js')}}"></script>
<script src="{{ asset('assets/js/waves.js')}}"></script>
<script src="{{ asset('assets/js/feather.min.js')}}"></script>
<script src="{{ asset('assets/js/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/js/moment.js')}}"></script>

{{--<script src="{{ asset('assets/js/sweetalert.min.js')}}"></script>--}}

<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ asset('plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
<script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{ asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>

<script src="{{ asset('assets/pages/jquery.forms-advanced.js') }}"></script>

@stack('plugin-scripts')

{{-- App js --}}
<script src="{{ asset('assets/js/app.js')}}"></script>

@stack('scripts')
