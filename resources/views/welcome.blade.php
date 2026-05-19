<x-layout title="Homepage | ErrorTracker" class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
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