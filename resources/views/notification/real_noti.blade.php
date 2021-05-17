<li class="nav-item dropdown dropdown-notifications">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Notification<span class="caret"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right menu-notification" aria-labelledby="navbarDropdown">
        @foreach (Auth::user()->notifications as $notification)
            <a class="dropdown-item" href="#">
                <span>{{ $notification->data['user'].' da cmt bai cua ban' }}</span><br>
            </a>
        @endforeach
    </div>
</li>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        encrypted: true,
        cluster: "ap1"
    });
    var channel = pusher.subscribe('NotificationEvent');
    channel.bind('send-message', function(data) {
        var newNotificationHtml = `
        <a class="dropdown-item" href="#">

        </a>
        `;

        $('.menu-notification').prepend(newNotificationHtml);
    });
</script>