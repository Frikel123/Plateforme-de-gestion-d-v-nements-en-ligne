<div>
    <li class="dropdown dropdown-list-toggle">
        <a href="#" data-toggle="dropdown"
            class="nav-link nav-link-lg message-toggle @if ($unreadExists) beep @endif">
            <i class="far fa-envelope"></i>
        </a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">Messages
                <div class="float-right">
                    <a wire:click="markAsReadAll" href="#" class="remove"
                        style="text-decoration: none; color: inherit; cursor:pointer">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> make as read
                    </a>
                </div>
            </div>
            <div class="dropdown-list-content dropdown-list-message">
                @forelse($messages as $message)
                    @if ($message->read_at == null)
                        <div class="row align-items-center">
                            <div style="width: 100%;">
                                <a href="{{ route('Messages.show', $message->id) }}" class="dropdown-item">
                                    <div class="dropdown-item-desc ml-0">
                                        <div class="d-flex align-items-center justify-content-between time p-0">
                                            <p><b>{{ $message->name }}</b></p>
                                            <p>{{ $message->created_at ? $message->created_at->diffForHumans() : 'No date available' }}
                                            </p>
                                        </div>
                                        <p>{{ $message->message }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="card">
                        <div class="card-body">
                            <div class="empty-state">
                                <div class="empty-state-icon" style="background-color: #e7391e;"><i
                                        class="fas fa-question"></i></div>
                                <h2>We couldn't find any Message</h2>
                                <a href="/admin/Messages" class="btn btn-primary btn-lg mt-4"
                                    style="background-color: #e7391e;border: none;font-size: large;">See the old
                                    messages</a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="dropdown-footer text-center">
                <a href="/admin/Messages" class="text-primary">View All <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </li>
</div>
