<x-app-layout>
    <div class="container flex flex-wrap pt-4 pb-10 m-auto mt-2 md:mt-15 lg:px-12 xl:px-6">
        <div class="text-sm breadcrumbs">
            <ul>
              <li><a href="/">Home</a></li> 
              <li><a href="{{ route('user-management.index') }}">User Management</a></li>
              <li>Edit</li>
            </ul>
          </div>
          
        <div class="w-full md:mt-2 lg:mt-2 sm:mt-5">
           @livewire('user-management.edit', ['id' => $id])
        </div>
    </div>
</x-app-layout>