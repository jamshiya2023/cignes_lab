@extends('layout.maintemplate')
@section('content')


<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row g-2 row-deck">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Registered Customers</h6>
                                
                            </div>
                            <div class="card-body">
                                <table id="myAllDoctor" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Place</th>
                                            <th>Age</th>
                                            <th>Registered Date</th>
                                            <th>Details</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Jaison Peter</td>
                                            <td>9895432166</td>
                                            <td>Calicut</td>
                                            <td>38</td>
                                            <td>Jan 16, 2022</td>
                                            <td><a href="#" class="btn btn-primary badge">View</a></td>
                                            <td>
                                                <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                <ul class="dropdown-menu shadow border-0 p-2">
                                                    <li><a class="dropdown-item" href="update-department.php">Update</a></li>
                                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>John Smith</td>
                                            <td>9895432166</td>
                                            <td>Calicut</td>
                                            <td>38</td>
                                            <td>Jan 16, 2022</td>
                                            <td><a href="#" class="btn btn-primary badge">View</a></td>
                                            <td>
                                                <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                <ul class="dropdown-menu shadow border-0 p-2">
                                                    <li><a class="dropdown-item" href="update-department.php">Update</a></li>
                                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>3</td>
                                            <td>Carol D'cruz</td>
                                            <td>9895432166</td>
                                            <td>Calicut</td>
                                            <td>38</td>
                                            <td>Jan 16, 2022</td>
                                            <td><a href="#" class="btn btn-primary badge">View</a></td>
                                            <td>
                                                <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                <ul class="dropdown-menu shadow border-0 p-2">
                                                    <li><a class="dropdown-item" href="update-department.php">Update</a></li>
                                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>4</td>
                                            <td>Noel Joseph</td>
                                            <td>9895432166</td>
                                            <td>Calicut</td>
                                            <td>38</td>
                                            <td>Jan 16, 2022</td>
                                            <td><a href="#" class="btn btn-primary badge">View</a></td>
                                            <td>
                                                <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                <ul class="dropdown-menu shadow border-0 p-2">
                                                    <li><a class="dropdown-item" href="update-department.php">Update</a></li>
                                                    <li><a class="dropdown-item" href="#">Block</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal -->
                            
                            
                        </div>
                    </div>
                </div> <!-- .row end -->

            </div>
        </div>

@endsection
