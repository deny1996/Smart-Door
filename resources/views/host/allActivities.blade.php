<x-app-layout>
    <style>
        #table-header{
            background-color: #273c4d;
        }
        #dropdownSearch {
            display: none; /* Standardmäßig versteckt */
        }
        #dropdownSearch.active {
            display: block; /* Zeigt das Dropdown, wenn die Klasse "active" hinzugefügt wird */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>

    <!-- Breadcrumb -->
    <div class="container mt-4 px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('host.dashboard') }}" class="link-dark link-offset-2 link-underline link-underline-opacity-0">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Door Activities</li>
            </ol>
        </nav>
    </div>

    <div class="relative overflow-x-auto shadow-md border border-2 sm:rounded-lg mt-5 mb-5 pd-4 px-4 max-w-4xl mx-auto">

        <!-- Dropdown Button and Search Input-->
        <div class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between mt-4 mb-4">
            <!-- Search Input -->
            <form action="{{ route('host.search') }}" method="GET">
                <div class="input-group">
                    <div class="col-xs-3">
                        <input type="search" name="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    </div>
                    <button type="submit" class="btn btn-outline-secondary" data-mdb-ripple-init>Search</button>
                </div>
            </form>

            <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" data-dropdown-placement="bottom" class="text-white bg-dark hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Guests <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownSearch" class="z-10 hidden bg-white rounded-lg shadow w-60 dark:bg-gray-700">
                <form action="{{ route('host.filterNachName') }}" method="GET" id="guestFilterForm">
                    <ul class="h-auto px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
                        @foreach ($guests as $guest)
                            <li>
                                <div class="flex items-center ps-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="checkbox-item-{{ $guest->id }}" type="checkbox" name="guests[]" value="{{ $guest->id }}" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" 
                                    {{ in_array($guest->id, request('guests', [])) ? 'checked' : '' }}>
                                    <label for="checkbox-item-{{ $guest->id }}" class="w-full py-2 ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ ucwords($guest->name) }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex justify-end px-3 pb-3">
                        <button type="submit" class="btn btn-secondary text-white bg-gray-700">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Activity</th>
                    <th scope="col" class="px-6 py-3">User</th>
                    <th scope="col" class="px-6 py-3">Guest</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Time</th>
                </tr>
            </thead>
            <tbody>
                @if($audit_logs->isNotEmpty())
                    @foreach ($audit_logs as $audit_log)
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $audit_log->action }}</th>
                            <td class="px-6 py-4">{{ ucwords($audit_log->createdBy->user->first_name) }}</td>
                            <td class="px-6 py-4">{{ ucwords($audit_log->usedBy->guest->name) }}</td>
                            <td class="px-6 py-4">{{ $audit_log->created_at->format("d.m.Y") }}</td>
                            <td class="px-6 py-4">{{ $audit_log->created_at->format("H:i:s") }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center text-muted mt-4 mb-4">No Audit Logs available.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination for Audit Logs -->
        <div class="pagination-wrapper mt-5 mb-3">
            {{ $audit_logs->links() }}
        </div>
    </div>

    <!-- JavaScript for Dropdown -->
    <script>
        const dropdownButton = document.getElementById('dropdownSearchButton');
        const dropdownMenu = document.getElementById('dropdownSearch');

        dropdownButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('active'); // Toggle active class
            dropdownMenu.classList.toggle('hidden'); // Toggle hidden class
        });

        // Optional: Click outside to close the dropdown
        window.addEventListener('click', function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('active');
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
