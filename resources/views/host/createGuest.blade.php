<x-app-layout>
    <!-- TEST STRUKTUR BACKEND -->

    <!-- Breadcrumb-->
    <div class="container mt-4 px-4 mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('host.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('host.allGuests')}}">All Guests</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Guest</li>
            </ol>
        </nav>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-l text-gray-600 leading-tight mb-4">
                        Create a new Guest
                    </h2>
                    <!--FORM TO ADD A GUEST -->
                    <form method="POST" action="{{ route('host.addGuest') }}">
                        @csrf
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (name)-->
                            <div class="col-md-6">
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required
                                        autofocus />
                                </div>
                            </div>
                            <!-- Form Group (email)-->
                            <div class="col-md-6">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                            </div>
                        </div>
                        <div class="mt-4 mb-4">
                            <x-primary-button>
                                {{ __('Add Guest') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-lg-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Change password card-->
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="font-semibold text-l text-gray-600 leading-tight mb-4 mb-4">Create Invite Link</div>
                    <div class="card-body">
                    </div>
                </div>
                <!-- Security preferences card-->
                <div class="card mb-4">
                    <div class="card-header">Security Preferences</div>
                    <div class="card-body">
                        <!-- Account privacy optinos-->
                        <h5 class="mb-1">Account Privacy</h5>
                        <p class="small text-muted">By setting your account to private, your profile information and
                            posts will not be visible to users outside of your user groups.</p>
                        <form>
                            <div class="form-check">
                                <input class="form-check-input" id="radioPrivacy1" type="radio" name="radioPrivacy"
                                    checked="">
                                <label class="form-check-label" for="radioPrivacy1">Public (posts are available to all
                                    users)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="radioPrivacy2" type="radio" name="radioPrivacy">
                                <label class="form-check-label" for="radioPrivacy2">Private (posts are available to only
                                    users in your groups)</label>
                            </div>
                        </form>
                        <hr class="my-4">
                        <!-- Data sharing options-->
                        <h5 class="mb-1">Data Sharing</h5>
                        <p class="small text-muted">Sharing usage data can help us to improve our products and better
                            serve our users as they navigation through our application. When you agree to share usage
                            data with us, crash reports and usage analytics will be automatically sent to our
                            development team for investigation.</p>
                        <form>
                            <div class="form-check">
                                <input class="form-check-input" id="radioUsage1" type="radio" name="radioUsage"
                                    checked="">
                                <label class="form-check-label" for="radioUsage1">Yes, share data and crash reports with
                                    app developers</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="radioUsage2" type="radio" name="radioUsage">
                                <label class="form-check-label" for="radioUsage2">No, limit my data sharing with app
                                    developers</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Two factor authentication card-->
                <div class="card mb-4">
                    <div class="card-header">Two-Factor Authentication</div>
                    <div class="card-body">
                        <p>Add another level of security to your account by enabling two-factor authentication. We will
                            send you a text message to verify your login attempts on unrecognized devices and browsers.
                        </p>
                        <form>
                            <div class="form-check">
                                <input class="form-check-input" id="twoFactorOn" type="radio" name="twoFactor"
                                    checked="">
                                <label class="form-check-label" for="twoFactorOn">On</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" id="twoFactorOff" type="radio" name="twoFactor">
                                <label class="form-check-label" for="twoFactorOff">Off</label>
                            </div>
                            <div class="mt-3">
                                <label class="small mb-1" for="twoFactorSMS">SMS Number</label>
                                <input class="form-control" id="twoFactorSMS" type="tel"
                                    placeholder="Enter a phone number" value="555-123-4567">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Delete account card-->
                <div class="card mb-4">
                    <div class="card-header">Delete Account</div>
                    <div class="card-body">
                        <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to
                            delete your account, select the button below.</p>
                        <button class="btn btn-danger-soft text-danger" type="button">I understand, delete my
                            account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>