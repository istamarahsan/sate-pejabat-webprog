@extends('layouts.app')

@section('content')
<div class="flex flex-grow">
  <div class="border border-zinc-800 border-y-0 border-l-0 flex flex-col">
    <div class="mt-2 px-2">
      <div class="h-1/2 border border-t-0 border-x-0 border-zinc-800"></div>
    </div>
    <div class="flex flex-col">
      <a href="{{route('admin.staff.manage')}}" class="py-3 px-5 mt-2 w-full transition-colors duration-200 text-left text-sm font-semibold text-zinc-100 {{ Request::is('admin/*/manage-staff') ? "bg-zinc-800 hover:bg-zinc-600" : "hover:bg-zinc-800" }}">
        Staffs
      </a>
      <a href="{{route('admin.products.index')}}" class="py-3 px-5 mt-2 w-full transition-colors duration-200 text-left text-sm font-semibold text-zinc-100 {{ Request::is('admin/*/products') ? "bg-zinc-800 hover:bg-zinc-600" : "hover:bg-zinc-800" }}">
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