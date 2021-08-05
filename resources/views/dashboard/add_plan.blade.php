@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Creat Plan</h1>
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="email">Plan name:</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="amount">Plan Amount:</label>
                                <input type="number" name="amount" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="duration">Plan Duration:</label>
                                <input type="number" name="duration" class="form-control" placeholder="duration in months">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="commission">Plan Commission:</label>
                                <input type="number" name="commission" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
