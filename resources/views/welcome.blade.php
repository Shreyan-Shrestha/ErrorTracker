<x-layout title="Homepage | ErrorTracker" class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="flex">
        <h1 class="2xl text-blue-700 flex">
            <span class="text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                    <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                </svg>
            </span>
            Report Error:
        </h1>
    </div>

    <div class="transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <form class="mt-3 p-3 md:w-64 lg:w-98 mx-auto grid gap-3 w-full" action="{{ route('errors.store') }}" method="POST">
            @csrf
            <fieldset class="fieldset rounded-box border p-4 flex">
                <legend class="legend">Location</legend>
                <label class="input w-full">
                    <input type="text" class="grow" name="region" placeholder="Enter Region" autocomplete="off">
                </label>

                <label class="input w-full">
                    <input name="branch" class="grow" type="text" placeholder=" Branch" autocomplete="off">
                </label>
            </fieldset>

            <label class="input w-full mt-5">
                <input name="issue" class="grow" type="text" placeholder="Issue" autocomplete="off">
            </label>

            <label class="input w-full">
                <input type="text" class="grow" name="severity" placeholder="Severity" autocomplete="off">
            </label>

            <label class="input w-full" for="nepali-datepicker-with-mini-english-dates">
                <input type="datetime" class="grow" id="nepali-datepicker-with-mini-english-dates" name="start_time" class="grow" placeholder="Select Start Time" autocomplete="off">
            </label>

            <button class="btn btn-primary mt-5" type="submit">Store</button>
        </form>
    </div>

    <script type="text/javascript">
        window.onload = function() {
            var miniEnglishDatesInput = document.getElementById(
                "nepali-datepicker-with-mini-english-dates"
            );
            miniEnglishDatesInput.NepaliDatePicker({
                miniEnglishDates: true,
            });
        };
    </script>
</x-layout>