<!-- CoreUI and necessary plugins-->
<script src="{{ url('admin/vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
<script src="{{ url('admin/vendors/simplebar/js/simplebar.min.js')}}"></script>
<!-- Plugins and scripts required by this view-->
<script src="{{ url('admin/vendors/chart.js/js/chart.min.js')}}"></script>
<script src="{{ url('admin/vendors/@coreui/chartjs/js/coreui-chartjs.js')}}"></script>
<script src="{{ url('admin/vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
<scrip src="{{ url('admin/js/main.js')}}">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.allrecipedataTable') }}",
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'category_name',
                        name: 'category name'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'details',
                        name: 'details',
                        render: function ( data) {
                            return '<div style="max-height: 80px; overflow-y:scroll;">'+data+'</div>';
                        }
                    },
                    {
                        data: 'name',
                        name: 'created_by'
                    },
                    {
                        data: 'status',
                        name: 'Status',
                        render: function(data) {
                            return data == 1 ? "Published" : "Unpublished";
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>