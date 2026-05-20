<x-layout class="flex-column justify-center-safe items-center min-h-screen">
<x-navbar></x-navbar>

<div class="container w-98 p-3 mt-5 mx-auto">
    <h1 class="text-2xl text-center">Add new Application</h3>
    <form class="form grid grid-cols-1 justify-items-center gap-4">
        <label class="input mt-3">
            <input type="text" name="git_id" class="grow" required autocomplete="off" placeholder="Enter Git id">
        </label>

        <label class="input">
            <input type="text" name="name" class="grow" required autocomplete="off" placeholder="Enter Application name">
        </label>
    </form>
</div>
</x-layout>