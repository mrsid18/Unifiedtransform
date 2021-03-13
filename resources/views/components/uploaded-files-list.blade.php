<div class="table-responsive">
  <table class="table table-bordered table-data-div table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">@lang('File Name')</th>
        @if($upload_type == 'syllabus' && $parent == 'class')
          <th scope="col">@lang('Class')</th>
        @elseif($upload_type == 'routine')
          <th scope="col">@lang('Class')</th>
        @elseif($upload_type == 'papers')
          <th scope="col">@lang('Class')</th>
          <th scope="col">@lang('Subject')</th>
          <th scope="col">@lang('Year')</th>
        @elseif($upload_type == 'certificate')
          <th scope="col">Certificates</th>
        @endif
        {{-- @if($upload_type!='papers')
        <th scope="col">@lang('Is Active')</th>
        @endif --}}
        <th scope="col">@lang('Action')</th>
      </tr>
    </thead>
    <tbody>
      @foreach($files as $file)
      <tr>
        <td>{{($loop->index + 1)}}</td>
        <td><a href="{{url($file->file_path)}}" target="_blank">{{$file->title}}</a></td>
        @if($upload_type == 'syllabus' && $parent == 'class')
          <td>{{$file->myclass->class_number}}</td>
          @elseif($upload_type == 'papers')
          <td>{{$file->myclass->class_number}}</td>
          <td>{{$file->subject}}</td>
          <td>{{$file->year}}</td>
        @elseif($upload_type == 'routine')
          {{-- <td>{{$file->section->class_id}}</td> --}}
          @foreach ($classes as $class)
              @if($file->section->class_id == $class->id )
              <td>Class {{$class->class_number}} Section {{$file->section->section_number}}</td>
              @endif
          @endforeach
        @elseif($upload_type == 'certificate')
          @isset($file->student->name)
            <td>{{$file->student->name}}</td>
          @endisset
          @empty($file->student)
            <td>Student Code: <span style="color: #d93025;">{{$file->given_to}}</span> does not exist</td>
          @endempty
        @endif
        {{-- @if($upload_type!='papers')
        <td>{{($file->active === 1)?'Yes':'No'}}</td>
        @endif --}}
        <td>
          <a href="{{url('academic/remove/'.$upload_type.'/'.$file->id)}}" class="btn btn-danger btn-sm" role="button"><i class="material-icons">delete</i> @lang('Remove')</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
