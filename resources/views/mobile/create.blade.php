@extends('welcome')

@section('content')

<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg mt-10">
<h1 class="text-3xl font-bold mb-6">Create a mobile Post</h1>
<div class="flex justify-end mb-4">
  <form id="upload-form" action="{{ route('social.save.post') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-2 gap-4">
        @for ($i = 1; $i <= 4; $i++)
            <figure class="max-w-lg relative">
                <img id="img-{{ $i }}" class="h-auto max-w-full rounded-lg cursor-pointer" 
                     src="{{ asset('/storage/images/default-camera.jpg') }}" alt="image description">
                <input type="file" id="file-input-{{ $i }}" class="hidden" name="images[]" accept="image/*">
            </figure>
        @endfor
    </div>

    <!-- Description -->
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter a description"></textarea>
        @error('description')
        <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="text-right">
        <button type="submit" class="bg-blue-500 p-4 text-white rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
            Post
        </button>
    </div>
</form>

<script src="https://unpkg.com/browser-image-compression@latest/dist/browser-image-compression.js"></script>
<script>
  // Function to compress and preview image before uploading
  async function handleImageUpload(imgId, inputId) {
    const imgElement = document.getElementById(imgId);
    const fileInput = document.getElementById(inputId);

    imgElement.addEventListener('click', () => {
      fileInput.click();
    });

    fileInput.addEventListener('change', async (event) => {
      const file = event.target.files[0];
      if (file) {
        try {
          // Compress the image
          const compressedBlob = await imageCompression(file, {
            maxSizeMB: 1,   // Max size 1MB
            maxWidthOrHeight: 1920,  // Resize to max width/height 1920px
            useWebWorker: true
          });

          // Convert the Blob back to a File object
          const compressedFile = new File([compressedBlob], file.name, { type: file.type });

          // Preview the compressed image
          const reader = new FileReader();
          reader.onload = (e) => {
            imgElement.src = e.target.result;  // Preview the compressed image
          };
          reader.readAsDataURL(compressedFile);  // Use the compressed file

          // Update the file input with the compressed file
          const dataTransfer = new DataTransfer();
          dataTransfer.items.add(compressedFile);
          fileInput.files = dataTransfer.files;
        } catch (error) {
          console.error("Image compression failed:", error);
        }
      }
    });
  }

  // Apply the function to each image and file input pair
  handleImageUpload('img-1', 'file-input-1');
  handleImageUpload('img-2', 'file-input-2');
  handleImageUpload('img-3', 'file-input-3');
  handleImageUpload('img-4', 'file-input-4');
</script>

</div>  

@endsection