@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">


                <div class="page-title-box justify-content-between d-flex align-items-md-center flex-md-row flex-column">
                    <h4 class="page-title">Welcome to Your Dashboard</h4>
                </div>
                {{-- box container --}}
                <div class="shadow p-4 rounded border bg-body text-body">

                    <h2 class="fw-semibold mb-3 text-dark">Hello, {{ Auth::user()->name }}</h2>

                    <p class="text-muted mb-4">
                        This is your dashboard. Use the navigation menu to access different sections like form
                        submissions,
                        profile updates, and more.
                    </p>


                </div>

            </div>
        </div>
    </div>
@endsection
