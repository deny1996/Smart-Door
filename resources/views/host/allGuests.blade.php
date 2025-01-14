<x-app-layout>
    <style>
        /* ===== Career ===== */
        .career-form {
            background-color: #212529;
            background-image: linear-gradient(to left, #212529, #525458, #88898c, #c2c2c4, #ffffff);
            border-radius: 5px;
            padding: 0 16px;
        }

        .career-form .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            border: 0;
            padding: 12px 15px;
            color: #fff;
        }

        .career-form .form-control::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            color: #fff;
        }

        .career-form .form-control::-moz-placeholder {
            /* Firefox 19+ */
            color: #fff;
        }

        .career-form .form-control:-ms-input-placeholder {
            /* IE 10+ */
            color: #fff;
        }

        .career-form .form-control:-moz-placeholder {
            /* Firefox 18- */
            color: #fff;
        }

        .career-form .custom-select {
            background-color: rgba(255, 255, 255, 0.2);
            border: 0;
            padding: 12px 15px;
            color: #fff;
            width: 100%;
            border-radius: 5px;
            text-align: left;
            height: auto;
            background-image: none;
        }

        .career-form .custom-select:focus {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .career-form .select-container {
            position: relative;
        }

        .career-form .select-container:before {
            position: absolute;
            right: 15px;
            top: calc(50% - 14px);
            font-size: 18px;
            color: #ffffff;
            content: '\F2F9';
            font-family: "Material-Design-Iconic-Font";
        }

        .filter-result .job-box {
            background: #fff;
            -webkit-box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
            box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
            border-radius: 10px;
            padding: 10px 35px;
        }

        ul {
            list-style: none;
        }

        .list-disk li {
            list-style: none;
            margin-bottom: 12px;
        }

        .list-disk li:last-child {
            margin-bottom: 0;
        }

        .job-box .img-holder {
            height: 65px;
            width: 65px;
            font-family: "Open Sans", sans-serif;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border-radius: 65px;
        }

        .career-title {
            background-color: #4e63d7;
            color: #fff;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            background-image: -webkit-gradient(linear, left top, right top, from(rgba(78, 99, 215, 0.9)), to(#5a85dd));
            background-image: linear-gradient(to right, rgba(78, 99, 215, 0.9) 0%, #5a85dd 100%);
        }

        .job-overview {
            -webkit-box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
            box-shadow: 0 0 35px 0 rgba(130, 130, 130, 0.2);
            border-radius: 10px;
        }

        @media (min-width: 992px) {
            .job-overview {
                position: -webkit-sticky;
                position: sticky;
                top: 70px;
            }
        }

        .job-overview .job-detail ul {
            margin-bottom: 28px;
        }

        .job-overview .job-detail ul li {
            opacity: 0.75;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .job-overview .job-detail ul li i {
            font-size: 20px;
            position: relative;
            top: 1px;
        }

        .job-overview .overview-bottom,
        .job-overview .overview-top {
            padding: 35px;
        }

        .job-content ul li {
            font-weight: 600;
            opacity: 0.75;
            border-bottom: 1px solid #ccc;
            padding: 10px 5px;
        }

        @media (min-width: 768px) {
            .job-content ul li {
                border-bottom: 0;
                padding: 0;
            }
        }

        .job-content ul li i {
            font-size: 20px;
            position: relative;
            top: 1px;
        }

        .mb-30 {
            margin-bottom: 30px;
        }

        .guest-name {
            font-family: 'Open Sans', sans-serif;
            font-size: 20px;
            font-weight: 400;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
        }

        .guest-email {
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
            margin-left: 5px;
        }

        .hidden {
            display: none;
        }

        #add-guest-button {
            width: 70px;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-color: #9E9FA2;

        }

        #add-guest-button .icon-img {
            width: 50px;
            height: auto;
        }
    </style>
    <!-- Breadcrumb-->
    <div class="container mt-4 px-4 mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('host.dashboard')}}"
                        class=" link-dark link-offset-2 link-underline link-underline-opacity-0">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Guests</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto mb-4">
                <div class="section-title text-center ">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="career-search mb-60">

                    <div class="row career-form mb-60">
                        <div class="col-md-6 col-lg-3 my-3">
                            <button id="add-guest-button" class="btn btn-lg btn-block btn-light btn-custom">
                                <img src="{{ asset('storage/img/User-Add-2-Fill--Streamline-Mingcute-Fill.svg') }}"
                                    alt="Add Guest Icon" class="icon-img">
                            </button>
                        </div>
                    </div>
                    <!-- Hidden "Create Guest" Form -->
                    <div id="create-guest-form" class="hidden mt-4">
                        <div class="mx-auto sm:px-6 lg:px-8" style="width: 100%;">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-800">
                                <div class="p-6 bg-white border border-2">
                                    <h3 class="font-semibold text-l text-gray-600 leading-tight mb-4">Create a new Guest
                                    </h3>

                                    <form method="POST" action="{{ route('host.addGuest') }}">
                                        @csrf
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (name)-->
                                            <div class="col-md-6">
                                                <x-input-label for="name" :value="__('Name')" />
                                                <x-text-input id="name" class="block mt-1 w-full" type="text"
                                                    name="name" required autofocus />
                                            </div>

                                            <!-- Form Group (email)-->
                                            <div class="col-md-6">
                                                <x-input-label for="email" :value="__('Email')" />
                                                <x-text-input id="email" class="block mt-1 w-full" type="email"
                                                    name="email" required />
                                            </div>
                                        </div>

                                        <div class="mt-4 mb-4">
                                            <x-primary-button>{{ __('Add Guest') }}</x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-result">
                        <p class="mb-30 ff-montserrat"></p>

                        @foreach ($guests as $guest)
                            <div class="job-box d-md-flex align-items-center justify-content-between mb-30 border border-2">
                                <div class="job-left my-4 d-md-flex align-items-center flex-wrap">
                                    <div class="img-holder mr-md-4 mb-md-0 mb-4 mx-auto mx-md-0 d-md-none d-lg-flex">
                                        <img src="{{ asset('storage/img/User-3-Fill--Streamline-Mingcute-Fill (2).svg') }}"
                                            class="card-img-top" alt="Profile Icon" style="width: 100%; height: 250px;">
                                    </div>
                                    <div class="job-content">
                                            <h5 class="guest-name text-center text-md-left">{{ucwords($guest->name)}}</h5>
                                        <h5 class="guest-email text-center text-md-left">{{$guest->email}}</h5>
                                    </div>
                                </div>
                                <div class="job-right my-4 flex-shrink-0">

                                    <div class="d-flex justify-content-end">
                                        <button id="edit-guest-button-{{ $guest->id }}" class="btn btn-dark mx-2"
                                            type="button">Edit</button>

                                            <a href="{{route('host.guest-show', $guest)}}">
                                                <button id="show-guest-button-{{ $guest->id }}" class="btn btn-secondary"
                                                type="button">Show</button>
                                        </a>
                                    </div>

                                    <!-- Hidden "Update Guest" -->
                                    <form id="update-guest-form-{{ $guest->id }}" class="hidden" method="POST"
                                        action="{{ route('host.updateGuest', $guest->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (name)-->
                                            <div class="col-md-6">
                                                <x-input-label for="name" :value="__('Name')" />
                                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                                value="{{ old('name', $guest->name) }}" required autofocus />
                                            </div>

                                            <!-- Form Group (email)-->
                                            <div class="col-md-6">
                                                <x-input-label for="email" :value="__('Email')" />
                                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                                value="{{ old('email', $guest->email) }}" required autofocus />
                                            </div>
                                        </div>

                                        <div class="mt-4 mb-2 d-flex justify-content-end">
                                            <x-primary-button>{{ __('Update Guest') }}</x-primary-button>
                                        </div>
                                    </form>

                                    <form id="delete-guest-form-{{ $guest->id }}" class="hidden"
                                        action="{{ route('host.deleteGuest', $guest) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-danger mx-2">
                                                <ion-icon name="trash-outline"></ion-icon> Delete
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
        <!-- Pagination for Guests -->
        <div class="pagination-wrapper mt-5 mb-3">
            {{ $guests->links() }}
        </div>
            </div>
        </div>
    </div>


    <script>
    document.getElementById('add-guest-button').addEventListener('click', function () {
        var form = document.getElementById('create-guest-form');
        form.classList.toggle('hidden');
    });

    @foreach ($guests as $guest)
        document.getElementById('edit-guest-button-{{ $guest->id }}').addEventListener('click', function () {
            var updateForm = document.getElementById('update-guest-form-{{ $guest->id }}');
            var deleteForm = document.getElementById('delete-guest-form-{{ $guest->id }}');
            var editButton = document.getElementById('edit-guest-button-{{ $guest->id }}');
            var showButton = document.getElementById('show-guest-button-{{$guest->id}}');

            updateForm.classList.toggle('hidden');
            deleteForm.classList.toggle('hidden');

            // Transformation of the "Edit" button to "X"
            if (editButton.textContent.trim() === 'Edit') {
                editButton.textContent = 'X';
                editButton.classList.remove('btn-dark');
                editButton.classList.add('btn-dark');
                showButton.classList.add('hidden');  // Hide the "Show" button when editing
            } else {
                editButton.textContent = 'Edit';
                editButton.classList.remove('btn-danger');
                editButton.classList.add('btn-dark');
                showButton.classList.remove('hidden');  // Show the "Show" button when not editing
            }
        });
    @endforeach
</script>

</x-app-layout>