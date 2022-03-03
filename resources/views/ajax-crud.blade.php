@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Users List
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" onclick="showModal('Add New User','Save')"
                                type="button">Add New</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Disctrict</th>
                                    <th>Upazila</th>
                                    <th>Postal Code</th>
                                    <th>Verified Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modal.modal-xl')
@endsection

@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="{{ asset('css/dropify.min.css') }}">
<style>
    .required label:first-child::after {
        content: "* ";
        color: red;
        font-weight: bold;
    }

</style>
@endpush

@push('script')
<script src="https://kit.fontawesome.com/92da958448.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('js/dropify.min.js') }}"></script>
<script>
    let _token = "{{ csrf_token() }}";

    var table;

    $(document).ready(function () {
        table = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "responsive": true,
            "bInfo": true,
            "bFilter": false,
            "lengthMenu": [
                [5, 10, 15, 25, 50, 100, 1000, 10000, -1],
                [5, 10, 15, 25, 50, 100, 1000, 10000, "All"]
            ],
            "pageLength": 5,
            "language": {
                processing: `<img src="{{ asset('storage/svg/Swing-Preloader.svg') }}" alt="loading icon" />`,
                emptyTable: '<strong class="text-danger>No data Found</strong>',
                infoEmpty: '',
                zeroRecords: '<strong class="text-danger>No data Found</strong>'
            },
            "ajax": {
                "url": "{{ route('user.list') }}",
                "type": "POST",
                "data": function (data) {
                    data._token = _token;
                }
            }
        });
    });


    $('.dropify').dropify();

    function showModal(title, save) {
        $('#storeForm')[0].reset();
        $('#storeForm').find('.is-invalid').removeClass('is-invalid');
        $('#storeForm').find('.error').remove();
        $('.dropify-clear').trigger('click');

        $("#saveDataModal").modal('toggle', {
            keyboard: false,
            backdrop: 'static',
        });
        $("#saveDataModal .modal-title").text(title);
        $("#saveDataModal #save-btn").text(save);
    };

    $(document).on('click', '#save-btn', function () {
        let storeForm = document.getElementById('storeForm');
        let formData = new FormData(storeForm);
        store_form_data(formData);
    });

    function store_form_data(formData) {
        $.ajax({
            url: "{{ route('user.store') }}",
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                $('#storeForm').find('.is-invalid').removeClass('is-invalid');
                $('#storeForm').find('.error').remove();
                if (data.status == false) {
                    $.each(data.errors, function (key, value) {
                        $('#storeForm #' + key).addClass('is-invalid');
                        $('#storeForm #' + key).parent().append(
                            '<div class="alert alert-danger mt-1 error">' + value + '</div>');
                    });
                } else {
                    flashMessage(data.status, data.message);
                    $("#saveDataModal").modal('hide');
                }
            },
            error: function (xhr, ajaxOption, thrownError) {
                console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
            }
        });
    }

    function upazilaList(district_id) {
        if (district_id) {
            $.ajax({
                url: "{{ route('upazila.list') }}",
                type: "POST",
                data: {
                    district_id: district_id,
                    _token: _token
                },
                dataType: "JSON",
                success: function (data) {
                    $('#upazila_id').html(''),
                        $('#upazila_id').html(data)
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        };
    };

    function flashMessage(status, message) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        switch (status) {
            case 'success':
                toastr.success(message, 'SUCCESS');
                break;
            case 'error':
                toastr.error(message, 'ERROR');
                break;
            case 'info':
                toastr.info(message, 'INFO');
                break;
            case 'warning':
                toastr.warning(message, 'WARNING');
                break;
        }
    };

</script>
@endpush
