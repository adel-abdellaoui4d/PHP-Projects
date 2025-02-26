@extends('layouts.app')

@section('content')

  <div class="container m-auto text-center pt-15 pb-25">
     <h1 class="text-6xl font-bold mt-10">Edit Post</h1>
  </div>

  <div class="container my-158 m-auto  pt-15 pb-5">
    <form action="/blog" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf
      @method('PUT')
      <!-- Title Input -->
      <input 
        type="text" 
        name="title" 
        value="{{ $post -> title}}"" 
        class="w-full text-6xl rounded-lg shadow-lg border-b p-5"
      >

      <!-- Description Textarea -->
      <textarea 
  class="w-full h-64 text-l rounded-lg shadow-lg border-b p-5" 
  name="description" 
  placeholder="Description"
>{{ $post -> description}} </textarea>
      
      <!-- Image Upload -->
      <div class="mb-5">
        <label 
          class="bg-gray-200 
                 hover:bg-gray-700 
                 text-gray-700 
                 hover:text-gray-200 
                 transition duration-300 
                 cursor-pointer 
                 p-5 rounded-lg 
                 font-bold 
                 uppercase"
        >
          <span>Select an image to upload</span>
          <input type="file" name="image" class="hidden">
        </label>
      </div>

      <!-- Submit Button -->
      <button  class="bg-blue-500 
               hover:bg-blue-700 
               text-white 
               font-bold 
               py-3 
               px-6 
               rounded-lg 
               uppercase 
               transition duration-300">
        Submit
      </button>
    </form>
  </div>
@endsection
