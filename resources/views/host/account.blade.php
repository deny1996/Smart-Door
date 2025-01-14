<x-app-layout>
    <style>
        .custom-card:hover {
            transform: none !important;
        }

        .custom-card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
            height: 100%;
        }

        .custom-card-header {
            padding: 1rem 1.35rem;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control, .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            border: 1px solid #c5ccd6;
            border-radius: 0.35rem;
        }

        .btn-primary, .btn-danger {
            width: 100%; /* Make buttons full-width by default */
        }

        .nav-borders .nav-link {
            color: #69707a;
            padding: 0.5rem;
            margin: 0.5rem 0;
        }

        /* Media Queries */
        @media (min-width: 768px) {
            .btn-primary, .btn-danger {
                width: auto; /* Reset button width for larger screens */
            }

            .form-control {
                padding: 0.875rem 1.125rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .breadcrumb {
                font-size: 0.8rem; /* Smaller breadcrumb text */
            }

            .custom-card {
                padding: 0.5rem;
            }

            .form-control {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
            }

            /* Buttons take full width on extra small devices */
            .btn-primary, .btn-danger {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>

    <!-- Breadcrumb-->
    <div class="container mt-4 px-4 mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('host.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Account</li>
            </ol>
        </nav>
    </div>

    <!--FORM TO EDIT A USER PROFILE -->
    <div class="container-xl px-4 mt-4 mb-4 ">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <!-- Account details card -->
                <div class="card mb-4 custom-card border border-2">
                    <div class="custom-card-header bg-dark text-white">Account Management</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('host.updateAccount', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Form Row -->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name) -->
                                <div class="col-12 col-md-6">
                                    <label class="small mb-1" for="first_name">First name</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text"
                                           placeholder="Enter your first name"
                                           value="{{ old('first_name', $user->first_name) }}" required>
                                </div>
                                <!-- Form Group (last name) -->
                                <div class="col-12 col-md-6">
                                    <label class="small mb-1" for="last_name">Last name</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text"
                                           placeholder="Enter your last name"
                                           value="{{ old('last_name', $user->last_name) }}" required>
                                </div>
                            </div>

                            <!-- Form Group (email address) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email address</label>
                                <input class="form-control" id="email" name="email" type="email"
                                       placeholder="Enter your email address" value="{{ old('email', $user->email) }}"
                                       required>
                            </div>

                            <!-- Form Group (password) -->
                            <div class="mb-3">
                                <label class="small mb-1" for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password"
                                       placeholder="Enter new password (optional)">
                            </div>

                            <!-- Save changes button -->
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </form>

                        <!-- Delete Account -->
                        <form action="{{ route('host.deleteAccount', $user) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger">
                                    <ion-icon name="trash-outline"></ion-icon> Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

