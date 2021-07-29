@extends("layouts.dashboard")
@section("content")
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Wallet</h1>
        <form action="" method="post">
            @csrf
            <div class="row gx-5">
                <div class="col-xl-4" style="margin-bottom: 10px">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="card-title">
                                {{$account->number??""}}
                            </div>
                            <div class="card-subtitle mb-4">Bank: {{$account->bank??""}}</div>
                            <div class="card-subtitle mb-4">Account name: {{$account->name??""}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="aname">Account Name</label>
                                        <input type="text" name="aname" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="anumber">Account Number</label>
                                        <input type="text" name="anumber" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone">Bank Name</label>
                                        <input type="tel" name="bname" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Sort Code</label>
                                        <input type="text" name="scode" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="reset" class="btn-lg btn-secondary">Reset</button>
                            <button type="submit" class="btn-lg btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
