@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.blog.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.blogs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row my-3">
                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-5">
                    <label class="required" for="date">{{ trans('cruds.blog.fields.date') }}</label>
                    <input class="form-control" type="date" name="date" id="date" value="{{ old('date', '') }}" placeholder="YYYY-MM-DD" required>
                    @error('date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-4 col-md-6 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.title') }}</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', '') }}">
                    @error('title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-8 col-md-8 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.photo') }}</label>
                    <div class="needslick dropzone" id="image-dropzone">

                    </div>
                    @error('images')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-8 col-md-8 col-sm-12 mb-5">
                    <label for="">{{ trans('cruds.blog.fields.body') }}</label>
                    <textarea name="body" id="" cols="30" rows="10" class="cke-editor" >{{ old('body', '') }}</textarea>
                    @error('body')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            </div>
            <div class="form-group ">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')

    <script>

let uploadedImageMap = {}
        Dropzone.options.imageDropzone ={
            url: "{{ route('admin.blogs.storeMedia') }}",
            maxFilesize: 2,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            success: function(file, response) {

                $('form').append('<input type="hidden" name="images[]" value="'+response.name + '">')
                uploadedImageMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove();
                file.previewElement.remove();
                let name = file.file_name || uploadedImageMap[file.name];
                $('input[name="images[]"][value="' + name + '"]').remove();

                $.ajax({
                    url: "{{ route('admin.blogs.deleteMedia') }}", // Change this to the appropriate delete route
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        file_name: name
                    },
                    success: function(response) {
                        console.log("File deleted successfully:", response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting file:", error);
                    }
                });
            },
            init: function () {
                @if(isset($project) && $project->document)
                    var files =
                    {!! json_encode($project->document) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
                    }
                @endif
            }
        }

        ClassicEditor
            .create( document.querySelector( '.cke-editor' ) )
            .catch( error => {
                console.error( error );
        } )

        $(function () {
            let date = document.querySelector('#date');
            if(date) {
                date.flatpickr({
                    dateFormat: "Y-m-d",
                })
            }
        })
    </script>

@endsection
