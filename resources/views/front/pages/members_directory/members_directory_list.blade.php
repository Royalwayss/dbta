@if(!empty($members_directory))
	@foreach($members_directory as $member)
				<div class="member-card">
					<div class="name"> {{ $member['designation_prefix'] }} {{ $member['member_name'] }}</div>
					<!--<div class="role">{{ $member['designation_prefix'] }}</div> -->
					<div class="details">
						<?php /*<div><strong>Prefix:</strong> {{ $member['designation_prefix'] }}</div> */ ?>
						<div><strong>Serial No:</strong> {{ $member['serial_no'] }}</div>
						@if(!empty($member['contact_no']))
						<div><strong>Contact:</strong> {{ $member['contact_no'] }}</div>
					    @endif
						@if(!empty($member['email']))
						<div><strong>Email:</strong> {{ $member['email'] }}</div>
						@endif
						@if(!empty($member['address']))
						<div><strong>Address:</strong> {{ $member['address'] }}</div>
					    @endif
					</div>
				</div>
	@endforeach
@else
	<p><strong>Members Directory not found</strong></p>
@endif
           