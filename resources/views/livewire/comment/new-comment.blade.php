<div>
    <div class="d-flex">
        <img src="{{ asset('/images/'.auth()->user()->channel->image) }}" class="rounded-circle" style="height: 40px;">
        <input type="text" wire:model="body" class="my-2 comment-form-control" placeholder="Add Public comment...">
    </div>
    <div class="d-flex justify-content-end align-items-center">
        @if($body)
            <a href="" wire:click.prevent="resetForm">Cancel</a>
            <a href="" wire:click.prevent="addComment" class="mx-2 btn btn-secoundary">Comment</a>
        @endif

    </div>
</div>
