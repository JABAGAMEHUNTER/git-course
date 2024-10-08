@extends('admin.layouts.app')
<div class="center">
    <nav class="mt-3.5 mr-3.5">
        @include('admin.produtos._partials.menu1')
    </nav>
    <nav class="mt-3.5 mr-3.5">
        @include('admin.produtos._partials.menu2')
    </nav>
   <div class="containter border md:mx-auto py-2 px-4 font-semibold">
    @section('title', 'Novo Produto')

    @section('content')
    <h1 class="text-white">Cadastrar Novo Produto</h1>

    <form action="{{ route('produtos.store') }}" method="post" enctype="multipart/form-data">
        @include('admin.produtos._partials.form')
    </form>
    
    </div>
    <nav class="ml-3.5 mr-3.5">  
    @include('admin.produtos._partials.footer')
    </nav>
</div>

