@extends('layouts.app')

@section('content')
    <div class="flex flex-grow">
        <div class="border border-zinc-800 border-y-0 border-l-0 flex flex-col">
            <div class="px-2">
                <p class="text-[0.75rem] text-zinc-700 font-bold mb-1">BRANCH</p>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="font-medium rounded-lg text-md px-5 py-2.5 text-center inline-flex items-center border transition-colors duration-200 border-zinc-500 hover:bg-zinc-800" type="button">
                    BRANCH {{ $branchId }}
                    @if(count($branches) > 1)
                      <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                      </svg>
                    @endif
                </button>
                @if(count($branches) > 1)
                  <div id="dropdown" class="z-10 bg-white hidden divide-y divide-gray-100 rounded-lg shadow">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                      @foreach($branches as $branch)
                        @if($branch['id'] != $branchId)
                          <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">BRANCH {{ $branch['id'] }}</a>
                          </li>
                        @endif
                      @endforeach
                    </ul>
                  </div>
                @endif
            </div>
            <div class="mt-2 px-2">
              <div class="h-1/2 border border-t-0 border-x-0 border-zinc-800"></div>
            </div>
            <div class="flex flex-col">
                <a href="manage-staff" class="py-3 px-5 mt-2 w-full transition-colors duration-200 text-left text-sm font-semibold text-zinc-100 {{ Request::is('admin/*/manage-staff') ? "bg-zinc-800 hover:bg-zinc-600" : "hover:bg-zinc-800" }}">
                  Staffs
                </a>
                <a href="products" class="py-3 px-5 mt-2 w-full transition-colors duration-200 text-left text-sm font-semibold text-zinc-100 {{ Request::is('admin/*/products') ? "bg-zinc-800 hover:bg-zinc-600" : "hover:bg-zinc-800" }}">
                  Products
                </a>
                <a class="py-3 px-5 mt-2 w-full transition-colors duration-200 text-left text-sm font-semibold text-zinc-100 {{ Request::is('admin/*/sales') ? "bg-zinc-800 hover:bg-zinc-600" : "hover:bg-zinc-800" }}">
                  Sales
                </a>
            </div>
        </div>
        <div>
            @yield('child-content')
        </div>
    </div>
@endsection