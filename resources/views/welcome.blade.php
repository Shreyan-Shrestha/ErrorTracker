 <style>
        input[type="text"] {
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="text"]:focus {
            border-color: #66afe9;
            outline: none;
        }
    </style>
<x-layout title="Homepage | ErrorTracker" class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="flex container transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <form class="mt-3 p-3 w-16 md:w-32 lg:w-64 mx-auto flex flex-col col" action="{{ route('errors.store') }}" method="POST">
            @csrf
            <label for="region">Region:</label>
            <input class="outline-amber-300" type="text" name="region" placeholder="Enter Region"></input>
            <label for="branch">Branch:</label>
            <input class="outline-amber-300" name="branch" type="text"/>
            <label for="issue" >Issue</label>
            <input name="issue" class="outline-amber-300" type="text"/>
            <label class="w-full mt-3" for="start_time">Select Start time:</label>
            <input type="datetime" id="nepali-datepicker-with-mini-english-dates" name="start_time" class="mt-3" placeholder="Select Date:" />
            <label for="severity">Severity</label>
            <input type="text" class="outline-amber-300" name="severity"/>
            <button class="bg-blue-500 text-white p-3 mt-3" type="submit">Store</button>
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