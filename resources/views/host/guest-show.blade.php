<x-app-layout>
    <style>
        /* Card hover effect */
        .card:hover {
            transform: none !important;
        }

        /* Form control styles */
        .form-control {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            border: 1px solid #c5ccd6;
            border-radius: 0.35rem;
        }

        /* Pagination styles */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            padding: 1rem;
        }

        .pagination .page-link {
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 0.25rem;
            border: 1px solid #ccc;
            color: #333;
            text-decoration: none;
        }

        .pagination .page-link:hover {
            background-color: #f0f0f0;
        }

        .pagination .page-item.active .page-link {
            background-color: #333;
            color: white;
            border-color: #333;
        }

        .pagination .disabled .page-link {
            color: #999;
        }
    </style>

    <!-- Breadcrumb -->
    <div class="container mt-4 px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('host.dashboard') }}" class="link-dark">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('host.allGuests') }}" class="link-dark">All Guests</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Guest</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-5 mb-5">
        <!-- Guest Management Form -->
        <div class="container-xl px-4">
            <div class="d-flex justify-content-center">
                <div class="col-xl-10">

                    <!-- Guest Account Management Card -->
                    <div class="card mb-4 border border-2">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-2 mt-2">Guest Account Management</h5>
                        </div>
                        <div class="card-body">

                            <!-- Form to create invite link -->
                            <form action="{{ route('host.sendInvite', $guest->id) }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                                    <h6 class="mb-3"><strong>Create Invite Link</strong></h6>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="enable_two_factor" value="0">
                                        <input type="checkbox" class="form-check-input" id="flexSwitchCheckChecked" name="enable_two_factor" value="1">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">with 2-Factor Auth</label>
                                    </div>
                                </div>

                                <!-- Start Date and Time Fields -->
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="moreTimeStartDate" class="form-label small mb-1">Start Date</label>
                                        <input type="date" class="form-control" id="moreTimeStartDate" name="more_time_start_date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="moreTimeStartTime" class="form-label small mb-1">Start Time</label>
                                        <input type="time" class="form-control" id="moreTimeStartTime" name="more_time_start_time" required>
                                    </div>
                                </div>

                                <!-- End Date and Time Fields -->
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="moreTimeEndDate" class="form-label small mb-1">End Date</label>
                                        <input type="date" class="form-control" id="moreTimeEndDate" name="more_time_end_date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="moreTimeEndTime" class="form-label small mb-1">End Time</label>
                                        <input type="time" class="form-control" id="moreTimeEndTime" name="more_time_end_time" required>
                                    </div>
                                </div>

                                <!-- Generate Invite Link Button -->
                                <div class="d-flex justify-content-end mt-4 mb-4">
                                    <button type="submit" class="btn btn-dark">Generate Invite Link</button>
                                </div>
                            </form>

                            <hr class="my-4" />

                            <h6 class="mt-4"><strong>{{ ucwords($guest->name) }} Links</strong></h6>
                            <div class="relative overflow-x-auto shadow-md border border-2 sm:rounded-lg mt-5 mb-5 max-w-4xl mx-auto">
                                <table class="w-full text-sm text-left text-gray-500 mt-4 mb-4">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">Link id</th>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">valid from</th>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">valid until</th>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($links->isNotEmpty())
                                            @foreach($links as $link)
                                                <tr class="bg-white hover:bg-gray-50">
                                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $link->id }}</th>
                                                    <td class="px-6 py-4">{{ $link->valid_from }}</td>
                                                    <td class="px-6 py-4">{{ $link->expires_at }}</td>
                                                    <td class="px-6 py-4">
                                                        <!-- Delete and resend link button-->
                                                        <div class="d-flex mt-2">
                                                            <form action="{{ route('host.deleteLink', $link) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger mx-2">
                                                                    <ion-icon name="trash-outline"></ion-icon> Delete
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('host.resendInvite', $link) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary">
                                                                    <ion-icon name="paper-plane-outline"></ion-icon> Resend
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-muted text-center">No Links for this Guest available.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                    <div class="pagination-wrapper">
                                        {{ $links->links() }}
                                    </div>

                            </div>

                            <hr class="my-4" />

                            <h6 class="mt-4"><strong>{{ ucwords($guest->name) }} Activities</strong></h6>
                            <div class="relative overflow-x-auto shadow-md border border-2 sm:rounded-lg mt-5 mb-5 max-w-4xl mx-auto">
                                <table class="w-full text-sm text-left text-gray-500 mt-4 mb-4">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">Activity</th>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">User</th>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">Guest</th>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">Date</th>
                                            <th scope="col" class="px-6 py-3 font-medium text-gray-900">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($audit_logs->isNotEmpty())
                                            @foreach($audit_logs as $audit_log)
                                                <tr class="bg-white hover:bg-gray-50">
                                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $audit_log->action }}</th>
                                                    <td class="px-6 py-4">{{ ucwords($audit_log->createdBy->user->first_name) }}</td>
                                                    <td class="px-6 py-4">{{ ucwords($audit_log->usedBy->guest->name) }}</td>
                                                    <td class="px-6 py-4">{{ $audit_log->createdBy->created_at->format("d.m.Y") }}</td>
                                                    <td class="px-6 py-4">{{ $audit_log->createdBy->created_at->format("H:i:s") }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-muted text-center">No Audit Logs available.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                <!-- Pagination for Audit Logs -->
                                    <div class="pagination-wrapper">
                                        {{ $audit_logs->links() }}
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('moreTimeStartDate');
        const startTimeInput = document.getElementById('moreTimeStartTime');
        const endDateInput = document.getElementById('moreTimeEndDate');
        const endTimeInput = document.getElementById('moreTimeEndTime');

        function updateEndDateTime() {
            const startDate = startDateInput.value;
            const startTime = startTimeInput.value;

            if (startDate && startTime) {

                const startDateTime = new Date(`${startDate}T${startTime}`);
                const endDateTime = new Date(startDateTime.getTime() + 2 * 60 * 60 * 1000); 
                const endDate = endDateTime.toISOString().split('T')[0];
                const endTime = endDateTime.toTimeString().split(':').slice(0, 2).join(':');

                endDateInput.value = endDate;
                endTimeInput.value = endTime;
            }
        }

        startDateInput.addEventListener('change', updateEndDateTime);
        startTimeInput.addEventListener('change', updateEndDateTime);
    });
</script>

</x-app-layout>


