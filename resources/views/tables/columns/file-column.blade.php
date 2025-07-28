@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    $fileName = $getState();
    $disk = $disk ?? 'public';
    $filePath = isset($directory) ? "$directory/$fileName" : $fileName;

    $url = Storage::disk($disk)->exists($filePath)
        ? Storage::disk($disk)->url($filePath)
        : null;

    $extension = Str::lower(Str::afterLast($fileName, '.'));
@endphp

@if ($url)
    <div class="text-left space-y-2">
        @if($extension === 'pdf')
            <embed type="application/pdf" src="{{ $url }}" class="max-w-sm size-20 rounded-md bg-gray-100 object-cover overflow-hidden">
        @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
            <img src="{{ $url }}" alt="{{ $fileName }}" class="max-w-sm size-20 rounded-md bg-gray-100 object-cover overflow-hidden">
        @endif

        <a href="{{ $url }}" class="font-bold text-xs text-primary-500" target="_blank">
            <span>Preview</span>
        </a>
    </div>
@else
    <span class="text-sm text-red-500">File not found</span>
@endif
