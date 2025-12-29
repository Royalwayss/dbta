@if(!empty($members_directory))
	@foreach($members_directory as $member)
				<div class="member-card">
					<div class="name">{{ $member['member_name'] }}</div>
					<div class="role">{{ $member['role'] }}</div>
					<div class="details">
						<div><strong>Prefix:</strong> {{ $member['designation_prefix'] }}</div>
						<div><strong>Serial No:</strong> {{ $member['serial_no'] }}</div>
						<div><strong>Contact:</strong> {{ $member['contact_no'] }}</div>
						<div><strong>Email:</strong>{{ $member['email'] }}</div>
						<div><strong>Address:</strong>{{ $member['address'] }}</div>
					</div>
				</div>
	@endforeach
@else
	<p><strong>Members Directory not found</strong></p>
@endif
           