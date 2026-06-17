@extends('partials.layout', ['title', 'ErrorTracker | Users'])

@section('content')
<div class="w-full p-6">
    <x-buttons.primary>Add New User</x-buttons.primary>
    <p class="text-2xl lg:text-4xl">Users</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <x-stat-card title="Total Users" value="1,284" change="+12%" desc="this month" iconColor="text-primary" iconBg="bg-blue-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card title="Active Now" value="342" desc="Real-time sessions" iconColor=" text-green-800" iconBg="bg-green-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightning-charge" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>

        <x-stat-card title="Pending invites" value="18" desc="Requiring verification" iconColor="text-orange-800" iconBg="bg-orange-100">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                </svg>
            </x-slot:icon>
        </x-stat-card>
    </div>

    @php
    $headers=['Name', 'Email', 'Role', 'Region', 'Branch','Status', 'Last Active', 'Actions'];
    $count = count($headers);
    @endphp
    <x-table :headers=$headers title="Users">
        <tr class="bg-white hover:bg:base-300 p-4">
            <td colspan="{{ $count }}" class="px-4 py-3 text-center text-gray-500"">
                    No Users added yet. 
                </td>
            </tr>
        </x-table>
    </div>
@endsection