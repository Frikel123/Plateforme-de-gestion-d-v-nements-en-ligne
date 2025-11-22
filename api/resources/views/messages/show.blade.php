@extends('dashboard.admin.dashboard')
@section('title', 'Profile')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="sendSingleReplayMailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <form id="sendSingleReplayMailForm" data-messageId="{{ $message->id }}">
                    @csrf
                    <div id="responseMessage" class="mt-3"
                        style="color:green; text-align:center; font-size:25px; font-weight:bold;"></div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Send replay to {{ $message->name }}</h3>
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


    <section class="section">
        <div class="d-flex align-items-center justify-content-between mt-4">
            <a href="{{ route('Messages.index') }}" class="btn btn-info">Back to the list </a>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sendSingleReplayMailModal">Send
                Email</button>
        </div>
        <div class="section-body">
            <div class="card profile-widget ">
                <div class="profile-widget-header ">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Email</div>
                            <div class="profile-widget-item-value">{{ $message->email }}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Full name</div>
                            <div class="profile-widget-item-value">{{ $message->name }}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Date</div>
                            <div class="profile-widget-item-value">{{ $message->created_at->diffForHumans() }}</div>
                        </div>

                    </div>
                </div>
                <div class="profile-widget-description mb-8">
                    <div class="profile-widget-name">
                        {{ $message->message }}
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    {{-- script for send replay to a specific message --}}
    <script>
        const sendSingleReplayMailForm = document.getElementById('sendSingleReplayMailForm');
        sendSingleReplayMailForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const responseMessageElement = document.getElementById('responseMessage');
            const messageId = this.getAttribute('data-messageId');
            const replaySubject = document.getElementById('emailSubject').value;
            const replayMessage = document.getElementById('emailMessage').value;

            try {
                this.querySelector('button[type="submit"]').setAttribute('disabled', true)
                const response = await fetch('/admin/messages/message/replay', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        replaySubject,
                        replayMessage,
                        messageId
                    })
                })


                if (response.ok) {
                    this.querySelector('button[type="submit"]').removeAttribute('disabled')
                    const {
                        message
                    } = await response.json()
                    closeModal(responseMessageElement, message, 'sendSingleReplayMailModal')
                }

            } catch (error) {
                console.log("Error : " + error)
                responseMessageElement.textContent = 'An error occurred while sending the email.';
            }

        })
    </script>
@endsection
