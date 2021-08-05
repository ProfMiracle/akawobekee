@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Fund wallet</h1>
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Enter amount</label>
                                <input type="number" name="amount" class="form-control" placeholder="Enter amount to fund wallet with">
                            </div>
                            <button type="submit" class="btn-lg btn-primary">Fund</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
