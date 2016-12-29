@if(Auth::check())
	<div class="float-chat">
		<div class="chat-float-user chat-over" id="online-user" type="button" data-toggle="popover"  title="Online">
			<i class="fa fa-user" aria-hidden="true"></i>
		</div>
		<div class="chat-float-message chat-over" id="chat-proper" tabindex="0" role="button" data-toggle="popover" data-trigger="focus">
			<i class="fa fa-comments" aria-hidden="true"></i>
			<span class="count-notification">
				<span class="number-notify" id="c-messages">
					@if(DataHelpers::knowMessageUnread() > 0)
						{{DataHelpers::knowMessageUnread()}}
					@endif
				</span>
			</span>
		</div>
		<div class="chat-float-tool chat-over">
			<i class="fa fa-cog" aria-hidden="true"></i>

		</div>
		<div class="chat-float-add chat-over" style="position: relative;">
			<a href="{{url('all_users')}}" style="color: #fff"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
			<span class="count-notification" style="right: 4px">
				<span class="number-notify">
					@if(DataHelpers::knowNotificationFriend() > 0)
						{{DataHelpers::knowNotificationFriend()}}
					@endif
				</span>
			</span>
		</div>
	</div>
@endif