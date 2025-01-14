<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <p><a href="{{route('host.dashboard')}}"> {{ __('Account') }} <br /> </a></p>
    </h2>
  </x-slot>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light display-6 mb-4">Welcome to Your Smart Door {{ucwords(auth::user()->first_name)}}</h1>
        <p class="lead text-body-secondary">Easily manage and control access to your home. Share secure entry links with
          your guests,
          track lock activity, and set custom access permissions—all from one place. Keep your home safe and connected.
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-body-tertiary bg-dark">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">

        <!-- Card 1 -->
        <div class="col d-flex justify-content-center">
          <div class="card shadow-sm">
            <img src="{{ asset('storage/img/User-3-Fill--Streamline-Mingcute-Fill.svg') }}" class="card-img-top"
              alt="Profile Icon" style="width: 100%; height: 250px;">
            <div class="card-body d-flex justify-content-center align-items-center">
              <a href="{{ route('host.account') }}"
                class="link-dark text-center link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                style="font-family: 'Poppins', sans-serif; font-size: 1.2rem;">
                Profile
              </a>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col d-flex justify-content-center">
          <div class="card shadow-sm">
            <img src="{{ asset('storage/img/Group-2-Fill--Streamline-Mingcute-Fill (1).svg') }}" class="card-img-top"
              alt="Guests Icon" style="width: 100%; height: 250px;">
            <div class="card-body d-flex justify-content-center align-items-center">
              <a href="{{ route('host.allGuests') }}"
                class="link-dark text-center link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                style="font-family: 'Poppins', sans-serif; font-size: 1.2rem;">
                Guests
              </a>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col d-flex justify-content-center">
          <div class="card shadow-sm">
            <img src="{{ asset('storage/img/To-Do-Fill--Streamline-Mingcute-Fill.svg') }}" class="card-img-top"
              alt="Activities Icon" style="width: 100%; height: 250px;">
            <div class="card-body d-flex justify-content-center align-items-center">
              <a href="{{ route('host.allActivities') }}"
                class="link-dark text-center link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                style="font-family: 'Poppins', sans-serif; font-size: 1.2rem;">
                Door Activities
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</x-app-layout>