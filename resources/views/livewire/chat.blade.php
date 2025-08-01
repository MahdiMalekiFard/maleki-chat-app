<div>
    <div class="messages" style="height: 300px; overflow-y: scroll;">
            @foreach ($messages as $msg)
                <div><strong>{{ $msg->user->name }}:</strong> {{ $msg->body }}</div>
            @endforeach
    </div>

    <form wire:submit.prevent="sendMessage" class="mt-2">
        <input type="text" wire:model="message" class="form-input w-full" placeholder="Type your message...">
        <button type="submit" class="btn btn-primary mt-2">Send</button>
    </form>
</div>
