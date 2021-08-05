@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Withdraw
        </button>
        <hr>
        <br>

        <h1 class="h3 mb-4 text-gray-800">Requests</h1>
        <div class="card">
            <div class="card-body">
                <table id='empTable' class="dataTables_wrapper dt-bootstrap4" style="width: 100%">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>Amount</td>
                        <td>Date</td>
                        <td>Status</td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Submit a withdrawal request</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="" method="post">
                    @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" class="form-control" name="amount">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section("custom-script")
    <script type="text/javascript">
        $(document).ready(function(){
            // DataTable
            $('#empTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{url("withdraw-request:ajax?type=$type")}}",
                columns: [
                    { data: 'id' },
                    { data: 'amount' },
                    { data: 'date' },
                    { data: 'status' },
                ]
            });

        });
    </script>
@endsection
