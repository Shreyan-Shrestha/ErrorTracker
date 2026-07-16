<div class="navbar gap-4 bg-blue-100">
    <div class="flex-1">
        <input type="text" placeholder="Search... " class="input input-bordered rounded-3xl w-full bg-blue-50" />
    </div>
    <div class="navbar-end">
        <ul class="menu menu-horizontal">
            <li class>
                @auth
                <details>
                    <summary>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </span>
                        {{ auth()->user()->name }}

                    </summary>
                    <ul class="bg-base-100 rounded-t-none p-2 w-full">
                        <li>
                            <a href="#" class="btn">Profile</a>
                        </li>

                        <li class="mt-2">
                            <button class="btn btn-outline btn-error [--color-error:red] hover:text-white px-2 place-content-center" href="#" id="logout-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </details>
                @else
            <li>Sign in</li>
            @endauth
            </li>
        </ul>
    </div>
</div>