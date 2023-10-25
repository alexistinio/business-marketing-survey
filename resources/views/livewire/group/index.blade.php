<div>
    <x-loading />
    <div class="flex flex-wrap gap-4 items-center justify-center mb-14">
        @forelse ($groups as $group)
            <div class="card w-80 bg-base-100 shadow-xl image-full">
                <figure><img src="{{ asset('images/'.$group->image) }}" alt="Shoes" /></figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $group->title }}</h2>
                    <p style="color:transparent">{{ Str::limit($group->description, 150, '...') }}</p>
                    
                    <div class="card-actions justify-end">
                        @if ($my_groups->contains($group->id))
                            <button wire:click="leaveGroup('{{$group->id}}')" class="btn btn-error btn-sm normal-case text-white">Leave Group</button>
                        @endif

                        <a href="{{ route('group.view', ['id' => $group->id]) }}" class="btn btn-primary btn-sm normal-case">View More</a>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
