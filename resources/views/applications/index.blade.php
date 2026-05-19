<x-layout class="justify-content-center align-items-center dflex">
<div class="p-3 container mx-auto mt-5 gap-x-2">
    <h1 class="text-center text-4xl text-amber-700">Applications:</h1>
    <a class="btn btn-xs sm:btn-sm md:btn-md lg:btn-lg xl:btn-xl" href=" applications.create">Add Application</a>
    @if($applications->isEmpty())
        <p class="text-3xl">No applications added yet</p>
    @else
        @foreach($applications as $app)
            <p class="text-red dflex justify-between bg-red-100 mt-3 p-3 rounded-3xl "><span class="ms-3">  {{ $loop->iteration }}. </span>   <span> {{ $app->name }}</span></p>
        @endforeach
    @endif
</div>
</x-layout>
