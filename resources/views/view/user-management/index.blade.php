<x-app-layout>
    <div class="container flex flex-wrap pt-4 pb-10 m-auto mt-2 md:mt-15 lg:px-12 xl:px-6">
        <div class="text-sm breadcrumbs px-4">
            <ul>
              <li><a href="/">Home</a></li> 
              <li>User Management</li>
            </ul>
          </div>
          
        <div class="w-full md:mt-2 lg:mt-2 sm:mt-5">
           @livewire('user-management.index')
        </div>
    </div>
</x-app-layout>