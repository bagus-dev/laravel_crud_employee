@extends('layouts.app', ['title' => 'Employee'])

@section('content')
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-users"></i> EMPLOYEE</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('dashboard.employee.index') }}" method="get">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('dashboard.employee.create') }}" class="btn btn-primary btn-sm" style="padding-top: 10px">
                                            <i class="fa fa-plus-circle"></i>
                                            ADD
                                        </a>
                                    </div>
                                    <input type="text" name="q" class="form-control" placeholder="Find based on employee's name" value="{{ isset($_GET['q']) ? $_GET['q'] : '' }}" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-search"></i>
                                            FIND
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align:center;width:6%">NO.</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">EMAIL ADDRESS</th>
                                        <th scope="col">ADDRESS</th>
                                        <th scope="col" style="width:15%;text-align:center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employees as $no => $employee)
                                        <tr>
                                            <th scope="row" style="text-align: center">{{ ++$no + ($employees->currentPage()-1) * $employees->perPage() }}</th>
                                            <td class="text-center">{{ $employee->name }}</td>
                                            <td class="text-center">{{ $employee->email }}</td>
                                            <td class="text-center">{{ $employee->address }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('dashboard.employee.edit', $employee->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger" id="{{ $employee->id }}" onclick="Delete(this.id)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center small">Data empty</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div style="text-align:center">
                                {{ $employees->links("vendor.pagination.bootstrap-4") }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                icon: "question",
                title: "ARE YOU SURE YOU WANT TO DELETE THIS DATA ?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(`employee/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: {
                            "id": id,
                            "_token": token
                        }
                    })
                    .then(response => {
                        // console.log(response.text())
                        if(!response.ok) {
                            throw new Error(response.text())
                        }

                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then(response => {
                if(response.isConfirmed) {
                    if(response.value.status === "success") {
                        let timerInterval

                        Swal.fire({
                            icon: "success",
                            title: "Data Deleted Successfully!",
                            text: "You are being redirected, please wait...",
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: "OK",
                            timer: 2500,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        }).then(function() {
                            location.reload()
                        })
                    } else {
                        Swal.fire({
                            title: "FAILED!",
                            text: "Data failed to delete",
                            icon: 'error',
                            timer: 1000,
                            showConfirmButton: false,
                            showCancelButton: false,
                            buttons: false
                        })
                    }
                }
            })
        }
    </script>
@endsection