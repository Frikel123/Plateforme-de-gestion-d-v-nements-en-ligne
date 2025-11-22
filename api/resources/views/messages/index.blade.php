@extends('dashboard.admin.dashboard')
@section('title', 'Profile')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="sendReplayMailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="sendReplayMailForm">
                    @csrf
                    <div id="responseMessage" class="mt-3"
                        style="color:green; text-align:center; font-size:25px; font-weight:bold;"></div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Send replay to all messages</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times fs-4 text-dark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="emailSubject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="emailSubject" placeholder="Email subject"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="emailMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="emailMessage" rows="4" placeholder="Your message" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modalsendMailBtn">Send Replay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4>All Messages</h4>
            <button class="btn btn-success d-block" id="sendReplayBtn" data-bs-toggle="modal"
                data-bs-target="#sendReplayMailModal">Send Replay (all)</button>
        </div>
        <div class="card-body">
            <ul class="list-unstyled list-unstyled-border">
                @foreach ($messages as $message)
                    <li class="media">
                        <a href="{{ route('Messages.show', $message->id) }}">
                            <div class="media-body">
                                <div class="float-right text-primary">{{ $message->created_at->diffForHumans() }}</div>
                                <div class="media-title">{{ $message->name }}</div>
                        </a>
                        <span class="text-small text-dark">{{ $message->message }}.</span>
                        <form id="delete-form-{{ $message->id }}" action="{{ route('Messages.destroy', $message->id) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn float-right">
                                <div class=" float-right text-danger" style="font-size: 17px;"><i class="fa fa-trash"></i>
                                </div>
                            </button>
                        </form>
        </div>
        </li>
        @endforeach
        </ul>

    </div>
    </div>
@endsection


@section('scripts')
    {{-- script for send replay to all new users that cames from contact section in landing page --}}
    <script>
        const sendReplayMailForm = document.getElementById('sendReplayMailForm');
        sendReplayMailForm.addEventListener('submit', async function(e) {
            e.preventDefault()
            const responseMessageElement = document.getElementById('responseMessage');
            const replaySubject = document.getElementById('emailSubject').value;
            const replayMessage = document.getElementById('emailMessage').value;
            try {
                this.querySelector("button[type='submit']").setAttribute('disabled', true)
                const response = await fetch('/admin/messages/replay', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        replaySubject,
                        replayMessage
                    })
                });

                if (response.ok) {
                    this.querySelector("button[type='submit']").removeAttribute('disabled')
                    const {
                        message
                    } = await response.json();

                    closeModal(responseMessageElement, message, 'sendReplayMailModal')
                }
            } catch (error) {
                console.log("Error: " + error)
                responseMessageElement.textContent = 'An error occurred while sending the email.';
            }

        })
    </script>
@endsection
