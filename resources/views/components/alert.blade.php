@if(session('success'))
<div role="alert" class="w-xs md:w-2xl alert alert-success px-6 py-2 absolute top-20 left-1/6 md:left-1/4" id="alert-success">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span text-sm md:text-md>{{session('success')}}</span>
  <button class="btn btn-sm btn-ghost btn-circle" onclick="document.getElementById('alert-success').remove()">X</button>
</div>
@endif

@if(session('error'))
<div role="alert" id="alert-error" class="w-sm md:w-2xl mx-auto alert alert-error px-6 mb-2 mt-2">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
  </svg>
  <span>{{session('error')}}</span>
  <button class="btn btn-sm btn-ghost btn-circle" onclick="document.getElementById('alert-error').remove()">X</button>
</div>
@endif