@extends('layouts.dashboard')
@section('pageTitle', 'Member')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="d-flex align-items-center">
                <h2 class="page-header-title">Users</h2>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_USER">
                    Add User
                </button>
            </div>
        </div>

        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>All users</h4>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="user-table" class="table display responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Type</th>
                            <th>Tools</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/ajax/datatable.js') }}"></script>

        <div id="add_USER" class="modal fade">@include('modal.instUser')</div>
        <div id="edit_USER" class="modal fade">@include('modal.edtUser')</div>
        <div id="remove_USER" class="modal modal-top fade">@include('modal.reUser')</div>
    </div>
@endsection
